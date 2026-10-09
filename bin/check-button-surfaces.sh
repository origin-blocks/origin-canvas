#!/usr/bin/env bash
#
# A secondary button takes its outline style from the surface it sits on (CLAUDE.md
# rule 10):
#
#   white (surface-base, or no fill)   core is-style-outline
#   tinted (surface-muted, -subtle)    core is-style-outline
#   dark (#111827, dark--bg, a cover)  is-style-origin-canvas-outline-light
#
# Outline's #6B7280 border holds on white and on a tint, and vanishes on dark. Outline
# Strong is retired: its class only keeps saved buttons styled, so a pattern that uses
# it fails. The surface is the nearest ancestor block that sets a fill. A fill this
# script cannot classify is reported, so a new surface gets a ruling.
#
# Run from the theme root:  bash bin/check-button-surfaces.sh

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk, class_names, ground

STYLE_FOR = {
    'white': 'is-style-outline',
    'tinted': 'is-style-outline',
    'dark': 'is-style-origin-canvas-outline-light',
}
RETIRED = 'is-style-origin-canvas-outline-strong'
OUTLINES = set(STYLE_FOR.values()) | {RETIRED}

files = sys.argv[1:] or sorted(glob.glob('patterns/*.php') + glob.glob('parts/*.html')
                              + glob.glob('templates/*.html'))
fail = False
count = 0
for path in files:
    for node in walk(parse(path)):
        if node['name'] != 'button':
            continue
        used = [c for c in class_names(node) if c in OUTLINES]
        if not used:
            continue
        count += 1
        found = ground(node)
        if used[0] == RETIRED:
            print('  \u2717  %s:%d %s is retired; use %s'
                  % (path, node['line'], RETIRED, STYLE_FOR.get(found, 'is-style-outline')))
            fail = True
        elif found.startswith('?'):
            print('  ✗  %s:%d %s on an unclassified fill %s; add it to this check'
                  % (path, node['line'], used[0], found[1:]))
            fail = True
        elif used[0] != STYLE_FOR[found]:
            print('  ✗  %s:%d %s on a %s surface; use %s'
                  % (path, node['line'], used[0], found, STYLE_FOR[found]))
            fail = True

if fail:
    sys.exit(1)
print('Button surfaces:')
print('  ✓  %d secondary buttons match their surface '
      '(outline on white and tinted, outline-light on dark)' % count)
PY
