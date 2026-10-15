#!/usr/bin/env bash
#
# Tracking follows size (CLAUDE.md rule 7; ODS "Tracking follows size"). theme.json holds one
# token per size band (settings.custom.letterSpacing), and style.css gives each font-size
# preset its band's token. A letter spacing set on a block in a pattern overrides that, so
# every one must agree with the size it sits on. A raw value also opts the text out of a style
# variation that retunes the tokens for its own face.
#
# The band of a size is read from theme.json: the extra-large preset and up is display, large
# is large, medium is medium, and anything smaller is base. A block's size is its own
# fontSize preset, or for a heading with none its level's size (styles.elements.h1-h6), or
# the nearest parent's preset, or the body size.
#
# Fails on a block letterSpacing that is:
#   - set on a block whose size is raw (not a preset): the size has no band, so fix it first
#   - a var(--wp--custom--letter-spacing--*) token that is not the token for the size's band
#   - 0, 0px, 0em or normal on text in the medium band or larger, which turns its tracking off
#   - positive and not 0.06em, the one tracking for uppercase labels and numbers set as labels
#   - negative and raw, or anything but a token on a heading-role block
#
# check-heading-pins.sh still decides WHICH headings may carry tracking at all; this check
# decides what the value may be. bin/check-tracking-render.sh checks the same rules on the
# rendered page, where an inherited value or a CSS rule also shows.
#
# Run from the theme root:  bash bin/check-tracking-tokens.sh [files…]

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, json, re, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk, ancestors

HEADINGS = {'heading', 'accordion-heading', 'post-title', 'query-title', 'comments-title'}
TOKEN = re.compile(r'^var\(--wp--custom--letter-spacing--([a-z-]+)\)$')
PRESET_VAR = re.compile(r'^var(?:\(--wp--preset--font-size--|:preset\|font-size\|)([a-z0-9-]+)\)?$')
ZERO = {'0', '0px', '0em', '0rem', 'normal'}
LABEL = '0.06em'

# Type specimens on the theme landing. Each one displays a face at a set tracking, so the
# value IS the content: the DM Sans "Ag" shows that face's own -0.015em, which no Inter
# token holds. Keyed to file, value AND the block's text, so a new value, a new file or
# another block at the same value still fails.
SPECIMENS = {
    ('patterns/style-variations.php', '-0.02em', 'Ag'),
    ('patterns/style-variations.php', '-0.015em', 'Ag'),
    ('patterns/token-system.php', '-0.02em', 'Aa'),
}

theme = json.load(open('theme.json'))
REM = 16.0


def px(size):
    m = re.match(r'^([\d.]+)(rem|px)$', str(size).strip())
    if not m:
        return None
    return float(m.group(1)) * (REM if m.group(2) == 'rem' else 1)


PRESETS = {f['slug']: px(f['size']) for f in theme['settings']['typography']['fontSizes']}
TOKENS = set(theme['settings']['custom']['letterSpacing'])
# The band floors, from the presets style.css maps to each token.
FLOORS = [('display', PRESETS['extra-large']), ('large', PRESETS['large']),
          ('medium', PRESETS['medium'])]
LEVELS = {}
for level in range(1, 7):
    raw = theme['styles']['elements'].get('h%d' % level, {}).get('typography', {}).get('fontSize', '')
    m = PRESET_VAR.match(raw)
    LEVELS[level] = m.group(1) if m else None
BODY = px(theme['styles']['typography']['fontSize'])


def band(size):
    for name, floor in FLOORS:
        if size >= floor:
            return name
    return 'base'


def size_of(node):
    """(px, label) of the node's size, or (None, raw value) when the size is raw."""
    for n in [node] + list(ancestors(node)):
        attrs = n['attrs']
        if attrs.get('fontSize') in PRESETS:
            return PRESETS[attrs['fontSize']], attrs['fontSize']
        raw = attrs.get('style', {}).get('typography', {}).get('fontSize')
        if raw:
            m = PRESET_VAR.match(str(raw))
            if m and m.group(1) in PRESETS:
                return PRESETS[m.group(1)], m.group(1)
            return None, str(raw)
        if n is node and n['name'] == 'heading':
            slug = LEVELS.get(int(attrs.get('level', 2)))
            if slug:
                return PRESETS[slug], 'h%d %s' % (int(attrs.get('level', 2)), slug)
    return BODY, 'body'


PHP_TEXT = re.compile(r"<\?php.*?__\(\s*'((?:[^'\\]|\\.)*)'.*?\?>", re.S)


def text_of(source, node):
    inner = source[node['start']:node['end']]
    inner = PHP_TEXT.sub(lambda m: m.group(1), inner)
    inner = re.sub(r'<\?php.*?\?>', '', inner, flags=re.S)
    return re.sub(r'\s+', ' ', re.sub(r'<[^>]+>', '', inner)).strip()


files = sys.argv[1:] or sorted(glob.glob('patterns/*.php') + glob.glob('parts/*.html')
                              + glob.glob('templates/*.html'))
fail = False


def bad(path, node, value, why):
    global fail
    print('  ✗  %s:%d wp:%s letterSpacing %s: %s' % (path, node['line'], node['name'], value, why))
    fail = True


checked = 0
for path in files:
    source = open(path).read()
    for node in walk(parse(path)):
        value = node['attrs'].get('style', {}).get('typography', {}).get('letterSpacing')
        if value is None:
            continue
        value = str(value).strip()
        if (path, value, text_of(source, node)) in SPECIMENS:
            continue
        checked += 1
        token = TOKEN.match(value)
        if node['name'] in HEADINGS and not token:
            bad(path, node, value, 'a heading takes a size token or nothing')
            continue
        if value.startswith('-') and not token:
            bad(path, node, value, 'negative tracking must be a size token')
            continue
        if value == LABEL:
            continue
        if not token and value not in ZERO:
            bad(path, node, value, 'positive tracking is %s (labels and numbers set as '
                'labels)' % LABEL)
            continue
        size, label = size_of(node)
        if size is None:
            bad(path, node, value, 'off-scale size %s: set a font-size preset first' % label)
            continue
        want = band(size)
        if token:
            if token.group(1) not in TOKENS:
                bad(path, node, value, 'no such token')
            elif token.group(1) != want:
                bad(path, node, value, 'the size is %s (%gpx), so the token is %s'
                    % (label, size, want))
        elif want != 'base':
            bad(path, node, value, 'turns tracking off at %s (%gpx); remove it so the %s '
                'token applies' % (label, size, want))

if fail:
    sys.exit(1)
print('Tracking tokens:')
print('  ✓  %d block letter spacings match their size band; labels at %s; specimens keyed '
      'by text' % (checked, LABEL))
PY
