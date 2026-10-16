#!/usr/bin/env bash
# Rebuild the local demo site from scratch: empty it, then seed it from the active theme.
# Usage: bin/demo/reset.sh <path-to-wordpress>   (e.g. ~/Sites/canvas-demo)
# Users and settings outside the seed stay; posts, pages, menus, comments, terms, uploads and
# Site Editor changes are deleted, so the demo never drifts.
#
# The script empties only a demo site: the folder must hold a DEMO-SITE.md marker file.
# bin/demo/setup.sh builds a new demo site with the marker. To make another install a demo
# site, create that file in its root by hand, e.g.
#   echo "# Canvas demo site" > ~/Sites/<site>/DEMO-SITE.md
# This script never creates the marker. Without it, it refuses and changes nothing.
set -euo pipefail

DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
MARKER="DEMO-SITE.md"

refuse() {
	echo "reset.sh: refused, nothing changed. $1" >&2
	exit 1
}

[ $# -ge 1 ] && [ -n "$1" ] || refuse "Give the demo site path, e.g. bin/demo/reset.sh ~/Sites/canvas-demo."
[ -d "$1" ] || refuse "$1 is not a directory."
WP_PATH="$(cd "$1" && pwd)"
[ -f "$WP_PATH/$MARKER" ] || refuse "$WP_PATH has no $MARKER marker, so it is not a demo site."

wp() { command wp --path="$WP_PATH" "$@"; }

if ! wp core is-installed 2>/dev/null; then
	echo "No WordPress install at $WP_PATH." >&2
	exit 1
fi

mkdir -p "$WP_PATH/wp-content/mu-plugins"
cp "$DIR/oc-demo-switches.php" "$WP_PATH/wp-content/mu-plugins/oc-demo-switches.php"

wp theme activate origin-canvas --quiet
wp site empty --uploads --yes --quiet
wp option delete theme_mods_origin-canvas --quiet >/dev/null 2>&1 || true
wp rewrite structure '/%postname%/' --quiet

# The demo notes hold the admin password, so the web server must never send them.
if ! grep -qs '<Files "DEMO-SITE.md">' "$WP_PATH/.htaccess"; then
	{
		printf '# The demo notes hold the admin password.\n<Files "DEMO-SITE.md">\nRequire all denied\n</Files>\n\n'
		cat "$WP_PATH/.htaccess" 2>/dev/null || true
	} >"$WP_PATH/.htaccess.new"
	mv "$WP_PATH/.htaccess.new" "$WP_PATH/.htaccess"
fi

# MAMP serves the site from a subfolder, so the rules need that RewriteBase.
if ! grep -qs '^# BEGIN WordPress' "$WP_PATH/.htaccess"; then
	base="$(wp option get home | sed -E 's#^https?://[^/]+##')/"
	cat >>"$WP_PATH/.htaccess" <<EOF
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase $base
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . ${base}index.php [L]
</IfModule>
# END WordPress
EOF
fi

wp eval-file "$DIR/seed.php"
wp rewrite flush --quiet
