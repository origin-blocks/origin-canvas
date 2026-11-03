#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT="$(cd "$SCRIPT_DIR/.." && pwd)"
ZIP_PATH="$ROOT/dist/origin-canvas.zip"

# The zip is built from HEAD, so the checks below have to describe HEAD too. A dirty
# tree would let them pass on corrected files that are not in the archive, or fail on
# work in progress that is not in it either.
# Untracked files matter as much as modified ones: a committed pattern can reference an
# image that was never added, and the archive would be built without it.
dirty=$(git -C "$ROOT" status --porcelain --untracked-files=normal -- . ':(exclude)dist')
if [ -n "$dirty" ]; then
	echo "Working tree is not clean; the package is built from HEAD." >&2
	echo "$dirty" >&2
	echo "Commit or remove the above so the archive matches what was checked." >&2
	exit 1
fi

# The showcase copy quotes how many patterns and categories ship. Catch it here rather
# than in a release nobody can amend.
bash "$SCRIPT_DIR/check-pattern-counts.sh"
bash "$SCRIPT_DIR/check-heading-pins.sh"
bash "$SCRIPT_DIR/check-button-hover.sh"
bash "$SCRIPT_DIR/check-variation-twins.sh"
bash "$SCRIPT_DIR/check-logo-widths.sh"
bash "$SCRIPT_DIR/check-column-splits.sh"
bash "$SCRIPT_DIR/check-layout-widths.sh"
bash "$SCRIPT_DIR/check-image-slots.sh"
# Image names describe the subject, every referenced image exists, and no shipped name is gone.
bash "$SCRIPT_DIR/check-image-names.sh"
bash "$SCRIPT_DIR/check-post-card-twins.sh"
bash "$SCRIPT_DIR/check-page-h1.sh"
# No old palette code outside the compatibility layer, and no $wpdb (#116).
bash "$SCRIPT_DIR/check-palette-names.sh"
# The built twin rules match the map and the stylesheets they come from (#116).
bash "$SCRIPT_DIR/check-palette-aliases.sh"
# A shipped value removed since the last release must have its shim or ruling before the
# package is built: pending removals fail here.
bash "$SCRIPT_DIR/check-shipped-values.sh" --release

mkdir -p "$ROOT/dist"
git -C "$ROOT" archive --format=zip --prefix=origin-canvas/ -o "$ZIP_PATH" HEAD

# The zip is uploaded through the WordPress admin, so it is subject to the host's PHP upload
# limit; 5 MB is the mark the owner set (2026-11-01, after 1.4.0 shipped at 5.9 MB). The
# release workflow reads BUDGET_DEFAULT from this line to measure the zip it publishes. The
# override exists for the mutation test only.
BUDGET_DEFAULT=5000000
BUDGET="${ORIGIN_CANVAS_PACKAGE_BUDGET:-$BUDGET_DEFAULT}"
if ! [[ "$BUDGET" =~ ^[1-9][0-9]{0,11}$ ]]; then
	echo "ORIGIN_CANVAS_PACKAGE_BUDGET must be a positive integer of at most 12 digits, got '$BUDGET'." >&2
	exit 2
fi
bytes=$(stat -f%z "$ZIP_PATH" 2>/dev/null || stat -c%s "$ZIP_PATH")
if [ "$bytes" -gt "$BUDGET" ]; then
	echo "Package is $bytes bytes, over the $BUDGET byte budget. Cut images before releasing." >&2
	exit 1
fi

printf 'Created %s (%s bytes, budget %s)\n' "$ZIP_PATH" "$bytes" "$BUDGET"
