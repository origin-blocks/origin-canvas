#!/usr/bin/env bash
#
# Primary marks; it never colors resting text (owner ruling, Oct 8). The user picks the
# primary through style variations and presets, and most primaries fail AA as text.
# Lesson: docs/solutions/styling/primary-never-colors-resting-text.md
#
# Fails on primary text color, set as textColor, style.color.text, a has-primary-color
# class or an inline color, on:
#   - any block except wp:icon (an icon is a mark)
#   - a p, h1-h6, span or mark tag in the saved markup
#
# Allowed:
#   - a span or mark that holds only an arrow glyph: the arrow is a mark, the link text
#     beside it stays ink
#   - hover and focus colors, which this check does not read, and primary fills (dots)
#   - the featured pricing tier's kicker and "Most chosen" label, listed below
#
# Run from the theme root:  bash bin/check-primary-text.sh

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, re, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk

# (file, label): the featured tier's state labels. They mark the tier, with its top
# frame and button, so they are indicators, not resting text.
ALLOW = {
    ('patterns/card-pricing.php', 'Studio'),
    ('patterns/pricing-simple.php', 'Studio'),
    ('patterns/pricing-single.php', 'The Site Sprint'),
    ('patterns/pricing-hero.php', 'Most chosen'),
}
TAG = re.compile(r'<(p|h[1-6]|span|mark)\b([^>]*)>', re.S)
PRIMARY_ATTR = re.compile(r'has-primary-color|(?<![\w-])color:\s*var\(--wp--preset--color--primary\)')
ARROW = re.compile(r'^\s*(&rarr;|&#8594;|→)\s*$')
LABEL = re.compile(r"esc_html__\(\s*'([^']*)'")


def allowed(path, text, pos):
    m = LABEL.search(text, pos, pos + 600)
    return m is not None and (path, m.group(1)) in ALLOW


files = sys.argv[1:] or sorted(glob.glob('patterns/*.php') + glob.glob('parts/*.html')
                              + glob.glob('templates/*.html'))
fail = False
count = 0
for path in files:
    text = open(path).read()
    lines = text.split('\n')
    for node in walk(parse(path)):
        a = node['attrs']
        raw = a.get('style', {}).get('color', {}).get('text', '')
        if node['name'] == 'icon' or not (a.get('textColor') == 'primary' or 'primary' in raw):
            continue
        # The line can open with a parent block, so start at this block's own attribute.
        pos = sum(len(l) + 1 for l in lines[:node['line'] - 1])
        pos = max(pos, text.find('"textColor":"primary"', pos))
        if allowed(path, text, pos):
            count += 1
            continue
        print('  ✗  %s:%d wp:%s sets primary text; use text-heading, text-body or '
              'text-muted' % (path, node['line'], node['name']))
        fail = True
    for m in TAG.finditer(text):
        tag, attrs = m.group(1), m.group(2)
        if not PRIMARY_ATTR.search(attrs):
            continue
        end = text.find('</%s>' % tag, m.end())
        if tag in ('span', 'mark') and ARROW.match(text[m.end():end]):
            continue
        if allowed(path, text, m.end()):
            continue
        print('  ✗  %s:%d <%s> is primary resting text; only an arrow glyph or the '
              'featured tier label may be' % (path, text.count('\n', 0, m.start()) + 1, tag))
        fail = True

if fail:
    sys.exit(1)
print('Primary text:')
print('  ✓  no resting text in primary (%d featured-tier labels allowed)' % count)
PY
