#!/usr/bin/env bash
# Rebuild the public demo, a subsite of the demo network, from the seed, then put the logo
# header on it. Runs on the demo server as root:
#
#   bash /root/origin-canvas-demo/bin/demo/public-demo.sh https://demo.originblocks.dev/canvas/
#
# What it expects on the server (see "Public demo" in README.md):
#   /var/www/demo.originblocks.dev/public          the network's WordPress, owned by demo-originblocks
#   /root/origin-canvas-demo/bin/demo/              this folder, copied from the repo (the zip leaves bin/ out)
#   /root/origin-canvas-demo/assets/origin-canvas-logo.png   the logo, 400 px wide, from the brand SVG
#
# The site is emptied first, uploads included, so nothing saved on the demo survives a rebuild.
set -euo pipefail
URL="${1:?Give the subsite URL, e.g. https://demo.originblocks.dev/canvas/}"
ROOT="${DEMO_WP_ROOT:-/var/www/demo.originblocks.dev/public}"
HOME_DIR="${DEMO_HOME:-/root/origin-canvas-demo}"
OWNER="${DEMO_OWNER:-demo-originblocks}"
DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$ROOT"
W="wp --allow-root --url=$URL"
$W site empty --uploads --yes --quiet
$W option delete theme_mods_origin-canvas --quiet >/dev/null 2>&1 || true
$W rewrite structure "/%postname%/" --quiet
$W eval-file "$DIR/seed.php"
$W rewrite flush --quiet
# The logo header: the theme's header has no logo block, so the demo carries its own header
# part, built from the Header Marketing pattern with the logo at 200 px, no site title, the
# seeded menu and one outline button to the contact page.
lid=$($W media import "$HOME_DIR/assets/origin-canvas-logo.png" --title="Origin Canvas logo" --porcelain)
$W option update site_logo "$lid" --quiet
menu=$($W post list --post_type=wp_navigation --field=ID | head -1)
contact=$($W post list --post_type=page --name=contact-write-to-the-studio --field=url)
$W eval 'echo WP_Block_Patterns_Registry::get_instance()->get_registered("origin-canvas/header-marketing")["content"];' > "$HOME_DIR/header.html"
python3 "$DIR/public-demo-header.py" "$HOME_DIR/header.html" "$menu" "$contact"
pid=$($W post create --post_type=wp_template_part --post_status=publish --post_name=header --post_title=Header --post_content="$(cat "$HOME_DIR/header.html")" --porcelain)
$W post term set "$pid" wp_theme origin-canvas >/dev/null
$W post term set "$pid" wp_template_part_area header >/dev/null
chown -R "$OWNER:$OWNER" wp-content/uploads
echo "Rebuilt $URL: logo $lid, menu $menu, header part $pid"
