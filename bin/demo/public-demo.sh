#!/usr/bin/env bash
# Rebuild the public demo, a subsite of a multisite, from the seed, then put the logo header
# on it. Runs on the demo server as root:
#
#   DEMO_WP_ROOT=<WordPress root> DEMO_HOME=<folder holding bin/demo and assets> DEMO_OWNER=<unix owner> \
#     bash <DEMO_HOME>/bin/demo/public-demo.sh <subsite URL>
#
# The server, its paths and the URL are in the owner's private notes, not in this repo.
# The site is emptied first, uploads included, so nothing saved on the demo survives a rebuild.
# Like reset.sh, it only touches a site marked as a demo: the subsite's option oc_demo_site
# must be "yes" (set once by hand with `wp option update oc_demo_site yes --url=<subsite>`).
# Without the marker it refuses and changes nothing.
set -euo pipefail
refuse() {
	echo "public-demo.sh: refused, nothing changed. $1" >&2
	exit 1
}
URL="${1:-}"
[ -n "$URL" ] || refuse "Give the subsite URL."
: "${DEMO_WP_ROOT:?set DEMO_WP_ROOT to the WordPress root}"
: "${DEMO_HOME:?set DEMO_HOME to the folder holding bin/demo and assets}"
: "${DEMO_OWNER:?set DEMO_OWNER to the unix owner of wp-content}"
[ -d "$DEMO_WP_ROOT" ] || refuse "$DEMO_WP_ROOT is not a directory."
[ -f "$DEMO_HOME/assets/origin-canvas-logo.png" ] || refuse "$DEMO_HOME/assets/origin-canvas-logo.png is missing."
DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$DEMO_WP_ROOT"
W="wp --allow-root --url=$URL"
[ "$($W option get oc_demo_site 2>/dev/null || true)" = "yes" ] || refuse "$URL is not marked as a demo site (option oc_demo_site is not \"yes\")."
$W site empty --uploads --yes --quiet
$W option update oc_demo_site yes --quiet
$W option delete theme_mods_origin-canvas --quiet >/dev/null 2>&1 || true
$W rewrite structure "/%postname%/" --quiet
$W eval-file "$DIR/seed.php"
$W rewrite flush --quiet
# The logo header: the theme's header has no logo block, so the demo carries its own header
# part, built from the Header Marketing pattern with the logo at 200 px, no site title, the
# seeded menu and one outline button to the contact page.
lid=$($W media import "$DEMO_HOME/assets/origin-canvas-logo.png" --title="Origin Canvas logo" --porcelain)
$W option update site_logo "$lid" --quiet
menu=$($W post list --post_type=wp_navigation --field=ID | head -1)
contact=$($W post list --post_type=page --name=contact --field=url)
$W eval 'echo WP_Block_Patterns_Registry::get_instance()->get_registered("origin-canvas/header-marketing")["content"];' > "$DEMO_HOME/header.html"
python3 "$DIR/public-demo-header.py" "$DEMO_HOME/header.html" "$menu" "$contact"
pid=$($W post create --post_type=wp_template_part --post_status=publish --post_name=header --post_title=Header --post_content="$(cat "$DEMO_HOME/header.html")" --porcelain)
$W post term set "$pid" wp_theme origin-canvas >/dev/null
$W post term set "$pid" wp_template_part_area header >/dev/null
chown -R "$DEMO_OWNER:$DEMO_OWNER" wp-content/uploads
echo "Rebuilt $URL: logo $lid, menu $menu, header part $pid"
