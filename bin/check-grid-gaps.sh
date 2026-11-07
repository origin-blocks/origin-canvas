#!/usr/bin/env bash
#
# A Grid that sets both a column count and a minimum column width must use ONE blockGap
# value. For that grid only, WordPress writes the gap into its column formula, and a row
# and a column gap ({"top":…, "left":…}) go in as two values:
#
#   (100% - (var(--…large) var(--…extra-large) * (6 - 1)))
#
# That is invalid CSS, so the browser drops grid-template-columns and the grid falls to
# one column. The gap itself still renders, which hides the cause. A grid with a column
# count alone gets repeat(N, minmax(0, 1fr)), with no gap in it, so two gaps are fine
# there (layout.php, WordPress 7.0 and 7.1). The check covers each viewport
# (style["@mobile"], style["@tablet"]): its layout and gap override the base ones.
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
        if layout.get('type') != 'grid':
            continue
        style = node['attrs'].get('style', {})
        base_gap = style.get('spacing', {}).get('blockGap')
        views = [('', layout, base_gap)]
        for k, v in style.items():
            if k.startswith('@') and isinstance(v, dict):
                gap = v.get('spacing', {}).get('blockGap', base_gap)
                views.append((' at ' + k, {**layout, **v.get('layout', {})}, gap))
        counted = False
        for where, lay, gap in views:
            if not (lay.get('columnCount') and lay.get('minimumColumnWidth')):
                continue
            if not counted:
                count += 1
                counted = True
            if isinstance(gap, dict):
                print('  ✗  %s:%d grid with a column count and a minimum column width has a '
                      'two-value blockGap%s; use one value' % (path, node['line'], where))
                fail = True

if fail:
    sys.exit(1)
print('Grid gaps:')
print('  ✓  %d grids with a column count and a minimum column width use one blockGap value' % count)
PY
