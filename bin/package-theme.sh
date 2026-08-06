#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT="$(cd "$SCRIPT_DIR/.." && pwd)"
ZIP_PATH="$ROOT/dist/origin-canvas.zip"

# The showcase copy quotes how many patterns and categories ship. Catch it here rather
# than in a release nobody can amend.
bash "$SCRIPT_DIR/check-pattern-counts.sh"

mkdir -p "$ROOT/dist"
git -C "$ROOT" archive --format=zip --prefix=origin-canvas/ -o "$ZIP_PATH" HEAD

printf 'Created %s\n' "$ZIP_PATH"
