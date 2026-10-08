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
# A link arrow is no exception: it takes the link color at rest, and the whole link,
# text and arrow, turns primary on hover and focus.
#
# Allowed:
#   - hover and focus colors, which this check does not read, and primary fills (dots)
#   - the featured pricing tier's kicker and "Most chosen" label, listed below
#   - the category above a single post's title, the one editorial accent, listed below
#
# Check marks are bullets: Check Primary and Check Circle Primary stay primary for
# users. Our pricing tiers and features-checklist want ink ticks, so every check list
# in INK_TICKS must use Check Neutral or Check Circle Neutral.
#
# Run from the theme root:  bash bin/check-primary-text.sh

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, re, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk, class_names

# (file, label): the featured tier's state labels. They mark the tier, with its top
# frame and button, so they are indicators, not resting text.
ALLOW = {
    ('patterns/card-pricing.php', 'Studio'),
    ('patterns/pricing-simple.php', 'Studio'),
    ('patterns/pricing-single.php', 'The Site Sprint'),
    ('patterns/pricing-hero.php', 'Most chosen'),
}
INK_TICKS = {
    'patterns/pricing-hero.php',
    'patterns/card-pricing.php',
    'patterns/pricing-simple.php',
    'patterns/pricing-single.php',
    'patterns/features-checklist.php',
}
# (file, block): the single-post category, primary at rest (owner ruling, Oct 8).
ALLOW_BLOCKS = {
    ('patterns/hidden-single.php', 'post-terms'),
    ('patterns/hidden-single-right-sidebar.php', 'post-terms'),
}
TAG = re.compile(r'<(p|h[1-6]|span|mark)\b([^>]*)>', re.S)
PRIMARY_ATTR = re.compile(r'has-primary-color|(?<![\w-])color:\s*var\(--wp--preset--color--primary\)')
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
        if (path in INK_TICKS and node['name'] == 'list'
                and any(c.startswith('is-style-origin-canvas-list-check') for c in class_names(node))
                and not any(c.endswith('-neutral') for c in class_names(node))):
            print('  \u2717  %s:%d check list needs Check Neutral or Check Circle Neutral '
                  'for ink ticks' % (path, node['line']))
            fail = True
        raw = a.get('style', {}).get('color', {}).get('text', '')
        if node['name'] == 'icon' or not (a.get('textColor') == 'primary' or 'primary' in raw):
            continue
        if (path, node['name']) in ALLOW_BLOCKS:
            count += 1
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
        if allowed(path, text, m.end()):
            continue
        print('  ✗  %s:%d <%s> is primary resting text; only the featured tier label '
              'may be' % (path, text.count('\n', 0, m.start()) + 1, tag))
        fail = True

if fail:
    sys.exit(1)
print('Primary text:')
print('  ✓  no resting text in primary (%d featured-tier and single-post labels allowed)' % count)
PY
