#!/usr/bin/env bash
#
# An action link on its own line in a card or section ("View all →", "Read the case
# study →") is 600, so it reads clearly beside the quieter text around it (#121). A link
# inside a sentence keeps the sentence's weight, and the theme sets no link weight of its
# own: one would change every link on a user's site, the navigation included.
#
# An action link here is a Paragraph block whose whole content is one link and a closing →,
# inside the link or just after it. Its weight is the block's fontWeight, or a font-weight
# on the link itself.
#
# Named exceptions, each at 500:
#   hero-canvas        the hero's secondary link, set under its button pair. It reads as a
#                      standalone link beside the buttons, not as a section's action.
#   pattern-showcase,  sections of the theme's own landing page, not offered in the
#   template-showcase  inserter; the landing page is judged as one page.
#
# Run from the theme root:  bash bin/check-action-link-weights.sh

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - <<'PY'
import glob, re, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk

EXCEPTIONS = {'hero-canvas': '500', 'pattern-showcase': '500', 'template-showcase': '500'}
PHP = re.compile(r'<\?(?:php\b|=).*?\?>', re.S | re.I)
WHOLE_LINK = re.compile(r'^<p\b[^>]*>\s*<a\b([^>]*)>(.*?)</a>(.*)</p>$', re.S)
TAG = re.compile(r'<[^>]+>')
LINK_WEIGHT = re.compile(r'font-weight:\s*(\d+)')

fail = False
count = 0
seen = set()
for path in sorted(glob.glob('patterns/*.php')):
    name = path[len('patterns/'):-len('.php')]
    text = open(path).read()
    for node in walk(parse(path)):
        if node['name'] != 'paragraph':
            continue
        inner = PHP.sub('x', text[node['start']:node['end']]).strip()
        m = WHOLE_LINK.match(inner)
        if not m or '<a' in m.group(3):
            continue
        after = TAG.sub('', m.group(3)).strip()
        if after not in ('', '→') or not (TAG.sub('', m.group(2)).strip() + after).endswith('→'):
            continue
        typo = node['attrs'].get('style', {}).get('typography', {})
        weight = str(typo.get('fontWeight') or '')
        if not weight:
            w = LINK_WEIGHT.search(m.group(1))
            weight = w.group(1) if w else 'none'
        want = EXCEPTIONS.get(name, '600')
        count += 1
        seen.add(name)
        if weight != want:
            print('  ✗  %s:%d action link weight is %s; it should be %s'
                  % (path, node['line'], weight, want))
            fail = True

for name in sorted(set(EXCEPTIONS) - seen):
    print('  ✗  %s is a named exception but has no action link; take it off the list' % name)
    fail = True

if fail:
    sys.exit(1)
print('Action link weights:')
print('  ✓  %d action links: 600, or 500 in the named exceptions' % count)
PY
