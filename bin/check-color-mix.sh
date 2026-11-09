#!/usr/bin/env bash
#
# WordPress strips color-mix() from the CSS it writes at render: its sanitizer
# (safecss_filter_attr) keeps only var(), calc(), min(), max(), minmax(), clamp() and repeat()
# among CSS functions, through 7.1. A block that saves its own HTML keeps its inline style as
# saved, so the dark bands' color-mix text and borders render. Two places are written at render
# instead, and a color-mix there is dropped without a warning (a Site Title tint renders in
# full contrast, #96):
#   - every attribute of a block with no HTML of its own (Site Title, Navigation, Post
#     Template, Template Part): WordPress builds its wrapper and styles from the attributes;
#   - style.elements on any block: link, button and heading colours become a CSS rule.
# It fails there also where WordPress ignores the value instead (a Template Part colour, a
# :focus state) and inside a var() fallback, so it needs no list of what each block supports.
# The fix is a theme.json settings.custom token read with var(), as custom.watermark.color
# colours footer-wordmark's Site Title.
#
# PHP can print a value this file does not show, so these fail as unverifiable: PHP anywhere in
# the attributes of a block the two rules cover, PHP in any block's attributes that can add or
# rename one (it can add style.elements), and attributes that do not parse. In a block that
# saves its own HTML, PHP passes only as one escaped echo inside a string value, such as a
# Cover's image URL (block_tree.php_shapes). PHP in a block's own markup does not count as
# saved HTML.
#
# Run from the theme root:  bash bin/check-color-mix.sh [files…]

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, re, sys
sys.path.insert(0, 'bin/lib')
from block_tree import PHP, parse, walk

COLOR_MIX = re.compile(r'color-mix\(', re.I)
FIX = ('use a theme.json settings.custom token read with var() (custom.watermark.color is '
       'one), or remove it')


def found(value, path):
    if isinstance(value, dict):
        for key, inner in value.items():
            yield from found(inner, '%s.%s' % (path, key) if path else key)
    elif isinstance(value, list):
        for i, inner in enumerate(value):
            yield from found(inner, '%s[%d]' % (path, i))
    elif isinstance(value, str) and COLOR_MIX.search(value):
        yield path


def has_html(node, text):
    """Whether the block's inner markup holds anything once its child blocks and PHP are cut
    out."""
    pos, own = node['start'], []
    for child in node['children']:
        own.append(text[pos:child['outer_start']])
        pos = child['outer_end']
    own.append(text[pos:node['end']])
    return bool(PHP.sub('', ''.join(own)).strip())


files = sys.argv[1:] or sorted(glob.glob('patterns/**/*.php', recursive=True)
                              + glob.glob('parts/*.html') + glob.glob('templates/*.html'))
fail = False
for path in files:
    text = open(path).read()
    for node in walk(parse(path)):
        if node['name'] == 'root':
            continue
        where = '%s:%d %s' % (path, node['line'], node['name'])
        if node['attrs_error']:
            print('  ✗  %s: its attributes do not parse, so a color-mix in them cannot be ruled '
                  'out' % where)
            fail = True
            continue
        if node['php_shapes_attrs']:
            print('  ✗  %s: PHP in its attributes can add or rename one this file does not '
                  'show; write them without PHP, or as one escaped echo in a value' % where)
            fail = True
            continue
        style = node['attrs'].get('style')
        elements = style.get('elements') if isinstance(style, dict) else None
        built = not has_html(node, text)
        if node['php_in_attrs'] and (built or elements):
            print('  ✗  %s: PHP in its attributes can print a value this file does not show, '
                  'and WordPress writes them at render; write them without PHP' % where)
            fail = True
            continue
        hits = found(node['attrs'], '') if built else found(elements, 'style.elements')
        for attr in hits:
            print('  ✗  %s sets color-mix() in %s, which WordPress strips at render or ignores; '
                  '%s' % (where, attr, FIX))
            fail = True

if fail:
    sys.exit(1)
print('color-mix:')
print('  ✓  no color-mix in a block WordPress builds at render, or in an element style')
PY
