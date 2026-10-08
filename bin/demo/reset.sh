#!/usr/bin/env bash
# Rebuild the local demo site from scratch: empty it, then seed it from the active theme.
# Usage: bin/demo/reset.sh [path-to-wordpress]   (default: ~/Sites/canvas-demo)
# Users and settings outside the seed stay; posts, pages, menus, comments, terms, uploads and
# Site Editor changes are deleted, so the demo never drifts.
set -euo pipefail

DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
WP_PATH="${1:-$HOME/Sites/canvas-demo}"

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

# MAMP serves the site from a subfolder, so the rules need that RewriteBase.
if [ ! -f "$WP_PATH/.htaccess" ]; then
	base="$(wp option get home | sed -E 's#^https?://[^/]+##')/"
	cat >"$WP_PATH/.htaccess" <<EOF
# The demo notes hold the admin password.
<Files "DEMO-SITE.md">
Require all denied
</Files>

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
