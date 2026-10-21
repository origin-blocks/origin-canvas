#!/usr/bin/env bash
#
# card-blog-post is the static, hand-picked editorial card; post-loop-grid is the loop
# that shows the same card for every post. They are visual twins: a design change lands in
# both (#130). Nothing in WordPress ties them together, since one is a Group of static
# blocks and the other a post template of post blocks, so this compares the values they
# share, role by role:
#
#   card      fill and corner radius (the card Group, the image's top corners)
#   inset     the space from the card's edges and image to its text: the loop's text
#             Group pads all four sides; the static card pads the sides on its text
#             Group and the bottom on the card, with the card's block gap below the image
#   image     aspect ratio
#   category  color, size, weight and case, and the loop's link color at rest
#   title     heading level, size and color, and the loop's link color at rest
#   excerpt   color and size
#
# A radius token is read from theme.json, so var:custom|radius|medium and 8px agree.
# Tracking and the meta line are not compared: the static card names the author and
# reading time, the loop shows only the date.
#
# Run from the theme root:  bash bin/check-post-card-twins.sh [card.php loop.php]

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import json, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk

card_path, loop_path = (sys.argv[1:3] if len(sys.argv) > 2
                        else ('patterns/card-blog-post.php', 'patterns/post-loop-grid.php'))
RADII = json.load(open('theme.json'))['settings']['custom']['radius']

def resolve(value):
    if isinstance(value, str) and value.startswith('var:custom|radius|'):
        return RADII.get(value.split('|')[-1], value)
    return value

def corners(attrs, which):
    radius = attrs.get('style', {}).get('border', {}).get('radius')
    if isinstance(radius, dict):
        return [resolve(radius.get(c)) for c in which]
    return [resolve(radius)] * len(which)

def color(slug_or_var):
    return (slug_or_var or '').split('|')[-1] or None

def first(nodes, test, what, path):
    for node in nodes:
        if test(node):
            return node
    print('  ✗  %s: no %s found; update this check if the pattern changed' % (path, what))
    sys.exit(1)

def link_color(node):
    """The resting link color a block sets for its own links, or None."""
    return color(node['attrs'].get('style', {}).get('elements', {}).get('link', {})
                 .get('color', {}).get('text'))

def spacing(node):
    return node['attrs'].get('style', {}).get('spacing', {})

def typo(node):
    a = node['attrs']
    t = a.get('style', {}).get('typography', {})
    return a.get('textColor'), a.get('fontSize'), t.get('fontWeight'), t.get('textTransform')

TOP, BOTTOM, ALL = ('topLeft', 'topRight'), ('bottomLeft', 'bottomRight'), (
    'topLeft', 'topRight', 'bottomLeft', 'bottomRight')

# The static card.
nodes = list(walk(parse(card_path)))
group = first(nodes, lambda n: n['name'] == 'group' and n['attrs'].get('backgroundColor'),
              'card Group with a fill', card_path)
image = first(nodes, lambda n: n['name'] == 'image', 'Image', card_path)
category = first(nodes, lambda n: n['name'] == 'paragraph' and n['attrs'].get('style', {})
                 .get('typography', {}).get('textTransform') == 'uppercase',
                 'uppercase category paragraph', card_path)
text = first(group['children'], lambda n: n['name'] == 'group', 'text Group in the card', card_path)
title = first(nodes, lambda n: n['name'] == 'heading', 'Heading', card_path)
excerpt = first(nodes, lambda n: n['name'] == 'paragraph' and n['attrs'].get('textColor') == 'text-body',
                'text-body excerpt paragraph', card_path)
card = {
    'card fill': group['attrs']['backgroundColor'],
    'inset top, right, bottom, left': (
        spacing(group).get('blockGap'), spacing(text).get('padding', {}).get('right'),
        spacing(group).get('padding', {}).get('bottom'), spacing(text).get('padding', {}).get('left')),
    'card radius': sorted(set(corners(group['attrs'], ALL) + corners(image['attrs'], TOP))),
    'image aspect ratio': image['attrs'].get('aspectRatio'),
    'category color, size, weight, case': typo(category),
    'title level, size, color': (title['attrs'].get('level', 2), title['attrs'].get('fontSize'),
                                 title['attrs'].get('textColor')),
    'excerpt color, size': (excerpt['attrs'].get('textColor'), excerpt['attrs'].get('fontSize')),
}

# The loop card.
nodes = list(walk(parse(loop_path)))
group = first(nodes, lambda n: n['name'] == 'group' and n['attrs'].get('backgroundColor'),
              'card Group with a fill', loop_path)
image = first(nodes, lambda n: n['name'] == 'post-featured-image', 'Post Featured Image', loop_path)
category = first(nodes, lambda n: n['name'] == 'post-terms', 'Post Terms', loop_path)
title = first(nodes, lambda n: n['name'] == 'post-title', 'Post Title', loop_path)
excerpt = first(nodes, lambda n: n['name'] == 'post-excerpt', 'Post Excerpt', loop_path)
loop = {
    'card fill': group['attrs']['backgroundColor'],
    'inset top, right, bottom, left': tuple(spacing(group).get('padding', {}).get(side)
                                            for side in ('top', 'right', 'bottom', 'left')),
    'card radius': sorted(set(corners(image['attrs'], TOP) + corners(group['attrs'], BOTTOM))),
    'image aspect ratio': image['attrs'].get('aspectRatio'),
    'category color, size, weight, case': typo(category),
    'title level, size, color': (title['attrs'].get('level', 2), title['attrs'].get('fontSize'),
                                 link_color(title) or title['attrs'].get('textColor')),
    'excerpt color, size': (excerpt['attrs'].get('textColor'), excerpt['attrs'].get('fontSize')),
}
# The loop's category and title are links: what shows at rest is the link color, so it
# must match the card's text color as well as the block's own text color.
card['category link color'] = card['category color, size, weight, case'][0]
card['title link color'] = card['title level, size, color'][2]
loop['category link color'] = link_color(category)
loop['title link color'] = link_color(title)

fail = False
print('Post card twins:')
for role in card:
    a, b = card[role], loop[role]
    if isinstance(a, tuple):
        a, b = list(a), list(b)
    if role == 'card radius' and len(a) != 1:
        print('  ✗  %s mixes corner radii %s' % (card_path, a))
        fail = True
    if a != b:
        print('  ✗  %s differs: %s has %s, %s has %s' % (role, card_path, json.dumps(a),
                                                       loop_path, json.dumps(b)))
        fail = True
    else:
        print('  ✓  %s: %s' % (role, json.dumps(a)))
sys.exit(1 if fail else 0)
PY
