#!/usr/bin/env bash
# Build a new local demo site from nothing: WordPress core, a database, an admin user, the theme
# symlinks and the DEMO-SITE.md marker, then the demo content through reset.sh.
# Usage: bin/demo/setup.sh <path> [<db-name>]   (e.g. bin/demo/setup.sh ~/Sites/canvas-demo)
#
# It needs WP-CLI (with PHP's mysqli), a MySQL server and a web server that serves the parent
# folder. The defaults fit MAMP: MySQL root/root on MAMP's socket, Apache serving ~/Sites at
# http://localhost/. The database name defaults to the folder name.
#
# Environment variables, all optional:
#   DEMO_DB_HOST         MySQL host, host:port or host:/socket (default MAMP's socket)
#   DEMO_DB_USER         MySQL user (default root)
#   DEMO_DB_PASSWORD     MySQL password (default root)
#   DEMO_SITES_DIR       the folder the web server serves (default ~/Sites)
#   DEMO_SITES_URL       the URL of that folder (default http://localhost)
#   DEMO_URL             the site URL; overrides the two above
#   DEMO_ADMIN_USER      admin login (default admin)
#   DEMO_ADMIN_EMAIL     admin email (default admin@example.test)
#   DEMO_WP_VERSION      WordPress version (default latest)
#   DEMO_WP_LOCALE       WordPress locale (default en_US)
#   DEMO_THEME_DIR       origin-canvas checkout to link (default the main checkout of this repo)
#   DEMO_WORKTREES_DIR   worktrees folder to link (default <theme dir>-worktrees, if it exists)
#
# It refuses, and changes nothing, if the folder or the database already exists. The admin
# password is generated and written only to <path>/DEMO-SITE.md, which stays on this machine.
set -euo pipefail

DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
MARKER="DEMO-SITE.md"

refuse() {
	echo "setup.sh: refused, nothing changed. $1" >&2
	exit 1
}

[ $# -ge 1 ] && [ -n "$1" ] || refuse "Give the new site path, e.g. bin/demo/setup.sh ~/Sites/canvas-demo."
command -v wp >/dev/null || refuse "WP-CLI (wp) is not installed."

TARGET="${1%/}"
PARENT="$(dirname "$TARGET")"
[ -d "$PARENT" ] || refuse "$PARENT does not exist."
WP_PATH="$(cd "$PARENT" && pwd)/$(basename "$TARGET")"
[ ! -e "$WP_PATH" ] || refuse "$WP_PATH already exists."

DB_NAME="${2:-$(basename "$WP_PATH")}"
[[ "$DB_NAME" =~ ^[A-Za-z0-9_-]{1,64}$ ]] || refuse "Database name '$DB_NAME' may use only letters, digits, - and _."

DB_HOST="${DEMO_DB_HOST:-localhost:/Applications/MAMP/tmp/mysql/mysql.sock}"
DB_USER="${DEMO_DB_USER:-root}"
DB_PASSWORD="${DEMO_DB_PASSWORD:-root}"
SITES_DIR="${DEMO_SITES_DIR:-$HOME/Sites}"
SITES_URL="${DEMO_SITES_URL:-http://localhost}"
ADMIN_USER="${DEMO_ADMIN_USER:-admin}"
ADMIN_EMAIL="${DEMO_ADMIN_EMAIL:-admin@example.test}"
WP_VERSION="${DEMO_WP_VERSION:-latest}"
WP_LOCALE="${DEMO_WP_LOCALE:-en_US}"

if [ -n "${DEMO_URL:-}" ]; then
	URL="${DEMO_URL%/}"
else
	[ -d "$SITES_DIR" ] || refuse "$SITES_DIR does not exist. Set DEMO_SITES_DIR or DEMO_URL."
	SITES_DIR="$(cd "$SITES_DIR" && pwd)"
	case "$WP_PATH" in
		"$SITES_DIR"/*) URL="${SITES_URL%/}/${WP_PATH#"$SITES_DIR"/}" ;;
		*) refuse "$WP_PATH is not inside $SITES_DIR, so its URL is unknown. Set DEMO_URL." ;;
	esac
fi

# The site shows the main checkout (develop), even when this script runs from a worktree.
if [ -n "${DEMO_THEME_DIR:-}" ]; then
	THEME_DIR="$DEMO_THEME_DIR"
elif common="$(git -C "$DIR" rev-parse --path-format=absolute --git-common-dir 2>/dev/null)"; then
	THEME_DIR="$(dirname "$common")"
else
	THEME_DIR="$DIR/../.."
fi
[ -f "$THEME_DIR/style.css" ] || refuse "$THEME_DIR is not an origin-canvas checkout. Set DEMO_THEME_DIR."
THEME_DIR="$(cd "$THEME_DIR" && pwd)"
WORKTREES_DIR="${DEMO_WORKTREES_DIR:-$THEME_DIR-worktrees}"
if [ -d "$WORKTREES_DIR" ]; then
	WORKTREES_DIR="$(cd "$WORKTREES_DIR" && pwd)"
elif [ -n "${DEMO_WORKTREES_DIR:-}" ]; then
	refuse "$WORKTREES_DIR does not exist."
else
	WORKTREES_DIR=""
fi

# Talks to MySQL through PHP's mysqli, not the mysql client, which may not speak the server's
# auth plugin. The action is in $DEMO_DB_ACTION: "exists" prints 1 or 0, "create" makes it.
db() {
	DEMO_DB_ACTION="$1" DEMO_DB_HOST="$DB_HOST" DEMO_DB_USER="$DB_USER" \
		DEMO_DB_PASSWORD="$DB_PASSWORD" DEMO_DB_NAME="$DB_NAME" \
		command wp eval --skip-wordpress '
			mysqli_report( MYSQLI_REPORT_OFF );
			$host = getenv( "DEMO_DB_HOST" );
			$port = null;
			$socket = null;
			if ( preg_match( "#^([^:]*):(/.+)$#", $host, $m ) ) {
				list( , $host, $socket ) = $m;
			} elseif ( preg_match( "#^([^:]*):(\d+)$#", $host, $m ) ) {
				$host = $m[1];
				$port = (int) $m[2];
			}
			$db = @new mysqli( $host ?: "localhost", getenv( "DEMO_DB_USER" ), getenv( "DEMO_DB_PASSWORD" ), "", $port, $socket );
			if ( $db->connect_errno ) {
				fwrite( STDERR, "Cannot connect to MySQL: " . $db->connect_error . "\n" );
				exit( 2 );
			}
			$name = getenv( "DEMO_DB_NAME" );
			if ( "exists" === getenv( "DEMO_DB_ACTION" ) ) {
				$r = $db->query( "SHOW DATABASES LIKE \"" . $db->real_escape_string( addcslashes( $name, "%_" ) ) . "\"" );
				echo $r && $r->num_rows ? 1 : 0;
			} elseif ( ! $db->query( "CREATE DATABASE `" . $name . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci" ) ) {
				fwrite( STDERR, "Cannot create the database: " . $db->error . "\n" );
				exit( 2 );
			}
		'
}

exists="$(db exists)" || refuse "Check DEMO_DB_HOST, DEMO_DB_USER and DEMO_DB_PASSWORD, and that MySQL runs."
[ "$exists" = 0 ] || refuse "Database '$DB_NAME' already exists."

# From here on, a failure leaves a half-built site. Say what to remove before a second run.
CREATED=""
trap '[ $? -eq 0 ] || echo "setup.sh: failed. Created so far:${CREATED:- nothing}. Move the folder to the Trash and drop the database before you run it again." >&2' EXIT

wp() { command wp --path="$WP_PATH" "$@"; }

mkdir "$WP_PATH"
CREATED=" folder $WP_PATH"
# WP-CLI unpacks the zip in memory, which can pass the 128M PHP default.
wp core download --version="$WP_VERSION" --locale="$WP_LOCALE" --exec='ini_set( "memory_limit", "512M" );' --quiet
wp config create --dbname="$DB_NAME" --dbuser="$DB_USER" --dbpass="$DB_PASSWORD" --dbhost="$DB_HOST" --skip-check --quiet
db create
CREATED="$CREATED, database $DB_NAME"

ADMIN_PASSWORD="$(command wp eval --skip-wordpress 'echo bin2hex( random_bytes( 12 ) );')"
wp core install --url="$URL" --title="Origin" --admin_user="$ADMIN_USER" \
	--admin_password="$ADMIN_PASSWORD" --admin_email="$ADMIN_EMAIL" --skip-email --quiet
wp plugin delete --all --quiet

ln -s "$THEME_DIR" "$WP_PATH/wp-content/themes/origin-canvas"
[ -z "$WORKTREES_DIR" ] || ln -s "$WORKTREES_DIR" "$WP_PATH/wp-content/themes/origin-canvas-worktrees"

worktrees_line="- \`wp-content/themes/origin-canvas-worktrees\` links to \`$WORKTREES_DIR\`, for \`?octheme=\`."
[ -n "$WORKTREES_DIR" ] || worktrees_line="- No worktrees folder is linked, so \`?octheme=\` has no branches to show."

(
	umask 077
	cat >"$WP_PATH/$MARKER" <<EOF
# Origin Canvas demo site

A local WordPress site that runs the Origin Canvas theme with demo content. This file marks the
folder as a demo site for \`bin/demo/reset.sh\`. It holds the admin password: keep it on this
machine and never commit it.

## URLs

- Site: $URL/
- Admin: $URL/wp-admin/
- Login: \`$ADMIN_USER\`, password \`$ADMIN_PASSWORD\`
- Blog: $URL/blog/
- Pattern library: $URL/pattern-library/ (administrators only)
- Design system: $URL/design-system/ (administrators only)
- Database: \`$DB_NAME\` on \`$DB_HOST\`, user \`$DB_USER\`

## Theme

- \`wp-content/themes/origin-canvas\` links to \`$THEME_DIR\`. The site shows that checkout as it is on disk.
$worktrees_line
- No plugins are installed.

## Reset, switches and checks

See \`bin/demo/README.md\` in the theme checkout.
EOF
)

trap - EXIT
"$DIR/reset.sh" "$WP_PATH"

echo "Demo site ready: $URL/"
echo "The admin login and password are in $WP_PATH/$MARKER."
