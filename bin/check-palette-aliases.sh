#!/usr/bin/env bash
#
# assets/css/palette-aliases.css is built from the map and the theme's stylesheets, so it holds
# the twin of every rule that names a renamed class only while it matches them (#116). This
# rebuilds it into a temp file and fails on any difference, with the diff printed.
#
# Run from the theme root:  bash bin/check-palette-aliases.sh

set -euo pipefail
cd "$(dirname "$0")/.."

built=$(mktemp)
trap 'rm -f "$built"' EXIT

php bin/build-palette-aliases.php "$built"

if ! diff -u assets/css/palette-aliases.css "$built"; then
	echo 'Palette aliases (#116):'
	echo '  ✗  assets/css/palette-aliases.css does not match its sources; run php bin/build-palette-aliases.php'
	exit 1
fi

echo 'Palette aliases (#116):'
echo '  ✓  assets/css/palette-aliases.css matches the map and the theme stylesheets'
