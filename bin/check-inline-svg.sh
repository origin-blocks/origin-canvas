#!/usr/bin/env bash
#
# No pattern, part or template writes an inline <svg> (#130). WordPress's KSES allowlist has no
# svg, so the markup is stripped when a user without unfiltered_html saves the page: Authors
# and Contributors on a single site, everyone but Super Admins on multisite. Icons use the
# core Icon block; a glyph it can't draw comes from the theme's CSS (CLAUDE.md rule 6).
#
# Run from the theme root:  bash bin/check-inline-svg.sh

set -euo pipefail
cd "$(dirname "$0")/.."

hits="$(grep -rniI --include='*.php' --include='*.html' '<svg' patterns parts templates || true)"
if [ -n "$hits" ]; then
	echo "$hits" | sed 's/^/  ✗  /; s/$/  (inline svg; use the core Icon block)/'
	exit 1
fi
echo 'Inline SVG:'
echo '  ✓  no pattern, part or template writes an inline <svg>'
