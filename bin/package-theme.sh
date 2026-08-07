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

mkdir -p "$ROOT/dist"
git -C "$ROOT" archive --format=zip --prefix=origin-canvas/ -o "$ZIP_PATH" HEAD

printf 'Created %s\n' "$ZIP_PATH"
