#!/usr/bin/env bash
#
# Tracking follows size, measured on the rendered page (CLAUDE.md rule 7). The static check,
# bin/check-tracking-tokens.sh, reads block markup on every commit; this one renders every
# pattern and reads what the browser shows, so an inline pin that beats a size class, an
# inherited value or a CSS rule cannot hide. Run it before a branch merges.
#
# It needs a local demo site (a DEMO-SITE.md marker in its root) with the demo switches
# mu-plugin (bin/demo/oc-demo-switches.php), WP-CLI, and `npm install` plus
# `npx playwright install chromium` in this folder.
#
# What it does:
#   1. Makes one published page on the demo site holding every pattern in patterns/ by its
#      wp:pattern reference. Page patterns (page-*) are left out: they hold only references
#      to patterns that are measured on their own (CLAUDE.md rule 4).
#   2. Measures that page, and the author box and comments on the single post with the most
#      comments (they render nothing on a page), at 1440 and 390, under the default style
#      and every style variation (tests/tracking-render.spec.js).
#   3. Moves the page to the Trash, whatever the result.
# A worktree checkout is shown through ?octheme=<folder>, so the page shows this branch.
#
# Usage, from the theme root:
#   bash bin/check-tracking-render.sh [path-to-wordpress]   (default ~/Sites/canvas-demo)

set -euo pipefail
cd "$(dirname "$0")/.."
ROOT="$(pwd)"

WP_PATH="${1:-$HOME/Sites/canvas-demo}"
[ -d "$WP_PATH" ] || { echo "check-tracking-render.sh: $WP_PATH is not a directory." >&2; exit 1; }
WP_PATH="$(cd "$WP_PATH" && pwd)"
[ -f "$WP_PATH/DEMO-SITE.md" ] || {
	echo "check-tracking-render.sh: $WP_PATH has no DEMO-SITE.md marker, so it is not a demo site. Nothing changed." >&2
	exit 1
}
[ -d "$ROOT/node_modules/@playwright/test" ] || {
	echo "check-tracking-render.sh: run npm install and npx playwright install chromium first." >&2
	exit 1
}

wp() { command wp --path="$WP_PATH" "$@"; }

OCTHEME=""
if [ "$(basename "$(dirname "$ROOT")")" = "origin-canvas-worktrees" ]; then
	OCTHEME="$(basename "$ROOT")"
fi

WORK="$(mktemp -d)"
PAGE_ID=""
cleanup() {
	if [ -n "$PAGE_ID" ]; then
		command wp --path="$WP_PATH" post delete "$PAGE_ID" >/dev/null 2>&1 \
			&& echo "  Moved the temporary page $PAGE_ID to the Trash." \
			|| echo "  Could not trash the temporary page $PAGE_ID; trash it by hand." >&2
	fi
	rm -rf "$WORK"
}
trap cleanup EXIT

sed -n 's/^ \* Slug: origin-canvas\/\([a-z0-9-]*\)$/\1/p' patterns/*.php | grep -v '^page-' | sort >"$WORK/slugs.txt"

read -r PAGE_ID PAGE_URL < <(wp eval-file "$ROOT/bin/lib/tracking-render-page.php" "$WORK/slugs.txt")
[ -n "$PAGE_ID" ] && [ -n "$PAGE_URL" ] || { echo "check-tracking-render.sh: the page was not made." >&2; exit 1; }
POST_URL="$(wp post list --post_type=post --post_status=publish --orderby=comment_count --order=DESC --posts_per_page=1 --field=url)"

python3 -B - "$WORK/config.json" "$OCTHEME" "$PAGE_URL" "$POST_URL" <<'PY'
import glob, json, os, sys
out, octheme, page, post = sys.argv[1:5]
variations = [''] + sorted(os.path.splitext(os.path.basename(f))[0]
                           for f in glob.glob('styles/*.json') + glob.glob('styles/*/*.json'))
targets = [{'url': page, 'roots': [{'selector': '.octr', 'pattern': ''}]}]
if post:
    targets.append({'url': post, 'roots': [
        {'selector': '.wp-block-group:has(> .origin-canvas-author-avatar)', 'pattern': 'author-box'},
        {'selector': '.wp-block-comments', 'pattern': 'hidden-comments'}]})
json.dump({'octheme': octheme, 'variations': variations, 'targets': targets}, open(out, 'w'))
print('Tracking, rendered: %d patterns, %d style passes (default + %d variations), 1440 and 390%s'
      % (sum(1 for _ in open(os.path.join(os.path.dirname(out), 'slugs.txt'))), len(variations),
         len(variations) - 1, ', theme ?octheme=' + octheme if octheme else ''))
PY

TRACKING_RENDER="$WORK/config.json" npx playwright test tests/tracking-render.spec.js --retries=0 --workers=4
