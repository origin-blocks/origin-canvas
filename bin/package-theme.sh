#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT="$(cd "$SCRIPT_DIR/.." && pwd)"
ZIP_PATH="$ROOT/dist/origin-canvas.zip"

# The zip is built from HEAD, so the checks below have to describe HEAD too. A dirty
# tree would let them pass on corrected files that are not in the archive, or fail on
# work in progress that is not in it either.
if ! git -C "$ROOT" diff-index --quiet HEAD -- 2>/dev/null; then
	echo "Working tree has uncommitted changes; the package is built from HEAD." >&2
	echo "Commit or stash them so the checks describe what is being shipped." >&2
	exit 1
fi

# The showcase copy quotes how many patterns and categories ship. Catch it here rather
# than in a release nobody can amend.
bash "$SCRIPT_DIR/check-pattern-counts.sh"

mkdir -p "$ROOT/dist"
git -C "$ROOT" archive --format=zip --prefix=origin-canvas/ -o "$ZIP_PATH" HEAD

printf 'Created %s\n' "$ZIP_PATH"
