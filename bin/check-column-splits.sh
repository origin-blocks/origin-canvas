#!/usr/bin/env bash
#
# A two-column row splits on twelfths, and markup writes them one way: 50/50, 41.67/58.33,
# 58.33/41.67, 33.33/66.66 or 66.66/33.33. An off-twelfth split (48/52, 46/54) reads as a
# mistake beside the rows that keep the grid, so it snaps to the nearest twelfth the row's
# content supports, judged per pattern (#130).
#
# Allowed besides those pairs:
#   - no widths at all (Columns shares the row equally);
#   - one fixed cell in px, rem or em beside a column with no width: an element dimension,
#     such as an avatar or a label cell, not a split (team-grid, stats-stacked).
# A percentage beside a column with no width, or any other pair, fails. Rows of three to
# five columns have no rule yet and are not checked.
#
# Run from the theme root:  bash bin/check-column-splits.sh

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, re, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk

SPLITS = {('50%', '50%'), ('41.67%', '58.33%'), ('58.33%', '41.67%'),
          ('33.33%', '66.66%'), ('66.66%', '33.33%')}
FIXED = re.compile(r'^\d+(\.\d+)?(px|rem|em)$')

def allowed(widths):
    if widths in SPLITS or widths == (None, None):
        return True
    a, b = widths
    return (a is None) != (b is None) and bool(FIXED.match(a or b))

files = sys.argv[1:] or sorted(glob.glob('patterns/*.php') + glob.glob('parts/*.html')
                              + glob.glob('templates/*.html'))
fail = False
count = 0
for path in files:
    for node in walk(parse(path)):
        if node['name'] != 'columns':
            continue
        columns = [c for c in node['children'] if c['name'] == 'column']
        if len(columns) != 2:
            continue
        count += 1
        widths = tuple(c['attrs'].get('width') for c in columns)
        if not allowed(widths):
            print('  ✗  %s:%d two columns split %s; use 50/50, 41.67/58.33, 58.33/41.67, '
                  '33.33/66.66 or 66.66/33.33' % (path, node['line'],
                  ' / '.join(w or '(none)' for w in widths)))
            fail = True

if fail:
    sys.exit(1)
print('Column splits:')
print('  ✓  %d two-column rows split on twelfths or hold one fixed cell' % count)
PY
