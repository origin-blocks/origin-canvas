#!/usr/bin/env bash
#
# The content and wide widths belong to Global Styles (Layout). A pattern that writes them
# as literals (a contentSize of 720px, a wideSize or maxWidth of 1200px) opts that block out
# of the Layout control: a user who widens the site in Global Styles sees every block move
# but that one (#130). Write the width by role instead: a group that should reach the wide
# width takes align "wide" and no contentSize (cta-band-dark, hero-statement), and a fixed
# cell inside Columns takes a column width (team-grid).
#
# Fails on any block attribute whose value is theme.json's settings.layout.contentSize or
# wideSize, read at run time, or a width those settings have shipped with (720px, 1200px),
# so a literal left behind by a change to the presets still fails.
#
# Run from the theme root:  bash bin/check-layout-widths.sh [files…]

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, json, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk

layout = json.load(open('theme.json'))['settings']['layout']
WIDTHS = {'720px': 'contentSize', '1200px': 'wideSize'}
WIDTHS.update({layout['contentSize']: 'contentSize', layout['wideSize']: 'wideSize'})

# Known, waiting on a fix in its own branch (#130): the wide page scaffold sets its post
# content to the wide width as a literal.
KNOWN = {('patterns/hidden-page-wide.php', 'post-content', 'layout.contentSize', '1200px')}

def literals(value, path=''):
    if isinstance(value, dict):
        for key, inner in value.items():
            yield from literals(inner, '%s.%s' % (path, key) if path else key)
    elif isinstance(value, list):
        for i, inner in enumerate(value):
            yield from literals(inner, '%s[%d]' % (path, i))
    elif isinstance(value, str) and value.strip() in WIDTHS:
        yield path, value.strip()

files = sys.argv[1:] or sorted(glob.glob('patterns/*.php') + glob.glob('parts/*.html')
                              + glob.glob('templates/*.html'))
fail = False
known = 0
for path in files:
    for node in walk(parse(path)):
        for where, value in literals(node['attrs']):
            if (path, node['name'], where, value) in KNOWN:
                known += 1
                continue
            print('  ✗  %s:%d %s sets %s to %s, a %s from Global Styles; write it by role'
                  % (path, node['line'], node['name'], where, value, WIDTHS[value]))
            fail = True

if fail:
    sys.exit(1)
print('Layout widths:')
print('  ✓  no block writes the content or wide width (%s) as a literal (%d known, #130)'
      % (', '.join(sorted(WIDTHS)), known))
PY
