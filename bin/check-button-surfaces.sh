#!/usr/bin/env bash
#
# A secondary button takes its outline style from the surface it sits on (CLAUDE.md
# rule 10, from the design notes' button roles):
#
#   white (surface-base, or no fill)   core is-style-outline
#   tinted (surface-muted, -subtle)    is-style-origin-canvas-outline-strong
#   dark (#111827, dark--bg, a cover)  is-style-origin-canvas-outline-light
#
# Core's outline washes out on a tint, outline-strong's #6B7280 border is heavy on white,
# and both vanish on dark. The surface is the nearest ancestor block that sets a fill.
# A fill this script cannot classify is reported, so a new surface gets a ruling.
#
# Run from the theme root:  bash bin/check-button-surfaces.sh

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk, ancestors, class_names

STYLE_FOR = {
    'white': 'is-style-outline',
    'tinted': 'is-style-origin-canvas-outline-strong',
    'dark': 'is-style-origin-canvas-outline-light',
}
OUTLINES = set(STYLE_FOR.values())

SLUGS = {
    'surface-base': 'white',
    'surface-muted': 'tinted', 'surface-subtle': 'tinted',
    'surface-subtle-hover': 'tinted', 'border': 'tinted', 'on-dark': 'tinted',
    'text-heading': 'dark', 'text-body': 'dark', 'text-muted': 'dark',
}
RAW = {
    '#fff': 'white', '#ffffff': 'white', 'var(--wp--preset--color--surface-base)': 'white',
    '#f3f4f6': 'tinted', 'var(--wp--preset--color--surface-muted)': 'tinted',
    '#111827': 'dark', 'var(--wp--custom--dark--bg)': 'dark',
    'var(--wp--preset--color--text-heading)': 'dark',
}


def surface(node):
    """The fill of the nearest ancestor that sets one, or None if none does."""
    a = node['attrs']
    if node['name'] == 'cover':
        return 'white' if a.get('isDark') is False else 'dark'
    if a.get('backgroundColor'):
        return SLUGS.get(a['backgroundColor'], '?' + a['backgroundColor'])
    raw = a.get('style', {}).get('color', {}).get('background')
    if raw:
        if raw.startswith('var:preset|color|'):
            slug = raw.split('|')[-1]
            return SLUGS.get(slug, '?' + slug)
        return RAW.get(raw.lower(), '?' + raw)
    if a.get('gradient') or a.get('style', {}).get('color', {}).get('gradient'):
        return '?gradient'
    # header-marketing carries its fill as a class rather than the attribute.
    for name in class_names(node):
        if name.startswith('has-') and name.endswith('-background-color'):
            slug = name[len('has-'):-len('-background-color')]
            return SLUGS.get(slug, '?' + slug)
    return None


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
        ground = 'white'
        for up in ancestors(node):
            found = surface(up)
            if found:
                ground = found
                break
        if ground.startswith('?'):
            print('  ✗  %s:%d %s on an unclassified fill %s; add it to this check'
                  % (path, node['line'], used[0], ground[1:]))
            fail = True
        elif used[0] != STYLE_FOR[ground]:
            print('  ✗  %s:%d %s on a %s surface; use %s'
                  % (path, node['line'], used[0], ground, STYLE_FOR[ground]))
            fail = True

if fail:
    sys.exit(1)
print('Button surfaces:')
print('  ✓  %d secondary buttons match their surface '
      '(outline on white, outline-strong on tinted, outline-light on dark)' % count)
PY
