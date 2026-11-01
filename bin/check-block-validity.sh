#!/usr/bin/env bash
#
# Every pattern loads in the block editor with no invalid block, no "Attempt recovery" prompt
# and no block the editor rewrites on load. Run it before a branch merges.
#
# It needs a local demo site (a DEMO-SITE.md marker in its root), WP-CLI, and `npm install`
# plus `npx playwright install chromium` in this folder.
#
# What it does:
#   1. Makes one draft page on the demo site and reads the markup of every registered
#      origin-canvas pattern, each in a Group classed by its slug, with wp:pattern references
#      replaced by their markup (bin/lib/block-validity-draft.php). It opens one login
#      session of its own.
#   2. Opens the draft in the editor in Playwright's own Chromium, never your browser, loads
#      every pattern into it as the inserter does, and counts invalid blocks, recovery
#      prompts and rewritten blocks per pattern (tests/block-validity.spec.js). Saving is
#      locked in that editor.
#   3. Moves the draft to the Trash and ends its own session, whatever the result. Other
#      login sessions are not touched.
# From a worktree checkout, the draft holds that worktree's pattern markup (WP-CLI loads the
# worktree as the theme). The editor itself runs the site's active theme, origin-canvas on
# develop, so a branch that changes editor code in functions.php is checked against develop's.
#
# Usage, from the theme root:
#   bash bin/check-block-validity.sh [path-to-wordpress]   (default ~/Sites/canvas-demo)

set -euo pipefail
cd "$(dirname "$0")/.."
ROOT="$(pwd)"

WP_PATH="${1:-$HOME/Sites/canvas-demo}"
[ -d "$WP_PATH" ] || { echo "check-block-validity.sh: $WP_PATH is not a directory." >&2; exit 1; }
WP_PATH="$(cd "$WP_PATH" && pwd)"
[ -f "$WP_PATH/DEMO-SITE.md" ] || {
	echo "check-block-validity.sh: $WP_PATH has no DEMO-SITE.md marker, so it is not a demo site. Nothing changed." >&2
	exit 1
}
[ -d "$ROOT/node_modules/@playwright/test" ] || {
	echo "check-block-validity.sh: run npm install and npx playwright install chromium first." >&2
	exit 1
}

WORK="$(mktemp -d)"
STATE="$WORK/draft.json"

# A worktree is loaded as the theme for WP-CLI only, so the draft holds this branch's markup.
WP_ARGS=(--path="$WP_PATH")
THEME="origin-canvas"
if [ "$(basename "$(dirname "$ROOT")")" = "origin-canvas-worktrees" ]; then
	THEME="origin-canvas-worktrees/$(basename "$ROOT")"
	cat >"$WORK/theme.php" <<PHP
<?php
WP_CLI::add_wp_hook( 'pre_option_stylesheet', static fn() => '$THEME' );
WP_CLI::add_wp_hook( 'pre_option_template', static fn() => '$THEME' );
PHP
	WP_ARGS+=(--require="$WORK/theme.php")
fi

# A failed clean-up fails the check and keeps the state file, so it can be run again by hand.
cleanup() {
	if [ -f "$STATE" ] && ! command wp "${WP_ARGS[@]}" eval-file "$ROOT/bin/lib/block-validity-draft.php" end "$STATE"; then
		echo "  Clean-up failed. Retry: wp ${WP_ARGS[*]} eval-file $ROOT/bin/lib/block-validity-draft.php end $STATE" >&2
		exit 1
	fi
	rm -rf "$WORK"
}
trap cleanup EXIT

COUNT="$(command wp "${WP_ARGS[@]}" eval-file "$ROOT/bin/lib/block-validity-draft.php" make "$STATE")"
echo "Block validity: $COUNT patterns from $THEME, in one editor draft"

BLOCK_VALIDITY="$STATE" npx playwright test tests/block-validity.spec.js --retries=0 --workers=1 --reporter=line
