#!/usr/bin/env bash
#
# A Grid with a column count must use ONE blockGap value. Given a row and a column gap
# ({"top":…, "left":…}), WordPress 7.1 writes both into its column formula:
#
#   (100% - (var(--…large) var(--…extra-large) * (6 - 1)))
#
# That is invalid CSS, so the browser drops grid-template-columns and the grid falls to
# one column. The gap itself still renders, which hides the cause. The check covers the
# per-viewport gaps (style["@mobile"], style["@tablet"]) too.
#
# Run from the theme root:  bash bin/check-grid-gaps.sh

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk

files = sys.argv[1:] or sorted(glob.glob('patterns/*.php') + glob.glob('parts/*.html')
                              + glob.glob('templates/*.html'))
fail = False
count = 0
for path in files:
    for node in walk(parse(path)):
        layout = node['attrs'].get('layout', {})
        if layout.get('type') != 'grid' or 'columnCount' not in layout:
            continue
        count += 1
        style = node['attrs'].get('style', {})
        gaps = [('', style.get('spacing', {}).get('blockGap'))]
        gaps += [(' at ' + k, v.get('spacing', {}).get('blockGap'))
                 for k, v in style.items() if k.startswith('@') and isinstance(v, dict)]
        for where, gap in gaps:
            if isinstance(gap, dict):
                print('  ✗  %s:%d grid with columnCount has a two-value blockGap%s; '
                      'use one value' % (path, node['line'], where))
                fail = True

if fail:
    sys.exit(1)
print('Grid gaps:')
print('  ✓  %d grids with a column count use one blockGap value' % count)
PY
