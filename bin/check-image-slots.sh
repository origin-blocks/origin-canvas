#!/usr/bin/env bash
#
# Demo images are cut to their slot, so a picture is sharp at its largest and no slot
# carries a heavier file than it shows (#130):
#
#   avatar   480 × 480 px (1:1): an Image block styled Rounded Full, shown as a circle
#            up to 180 px
#   card     1200 × 800 px (3:2): any other Image block in a card pattern (category
#            origin-canvas/card), which must also crop at aspectRatio 3/2
#   gallery  1536 × 1024 px (3:2): an Image block at aspectRatio 3/2 in a gallery
#            pattern (category gallery)
#   portrait 1120 × 1400 px (4:5): an Image block at aspectRatio 4/5 outside a team
#            pattern; team portraits are people, cut at 480 × 600, and not ruled here
# The gallery and portrait slots take the sizes their images shipped at (orchestrator
# decision, #130).
# The img src of an image in a slot must be a theme file in patterns/images/, so its size
# can be read.
#
# Other images have no ruled slot and are not checked. Sizes are read from the files' own
# headers (WebP, PNG).
#
# Run from the theme root:  bash bin/check-image-slots.sh [files…]

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, re, struct, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk, class_names

CARD, AVATAR, GALLERY, PORTRAIT = (1200, 800), (480, 480), (1536, 1024), (1120, 1400)
SRC = re.compile(r'<img\b[^>]*?\ssrc="([^"]*)"')
IMAGE = re.compile(r'/patterns/images/([A-Za-z0-9_.-]+\.(?:webp|png))$')
CATEGORY = re.compile(r'^[ \t*]*Categories:\s*(\S+)', re.M)

def size(path):
    """Pixel width and height from a WebP or PNG header."""
    data = open(path, 'rb').read(32)
    if data[:8] == b'\x89PNG\r\n\x1a\n':
        return struct.unpack('>II', data[16:24])
    if data[:4] == b'RIFF' and data[8:12] == b'WEBP':
        chunk = data[12:16]
        if chunk == b'VP8 ':
            w, h = struct.unpack('<HH', data[26:30])
            return w & 0x3fff, h & 0x3fff
        if chunk == b'VP8L':
            bits = struct.unpack('<I', data[21:25])[0]
            return (bits & 0x3fff) + 1, ((bits >> 14) & 0x3fff) + 1
        if chunk == b'VP8X':
            return (int.from_bytes(data[24:27], 'little') + 1,
                    int.from_bytes(data[27:30], 'little') + 1)
    return None

files = sys.argv[1:] or sorted(glob.glob('patterns/*.php'))
fail = False
count = 0
for path in files:
    text = open(path).read()
    category = CATEGORY.search(text)
    category = category.group(1) if category else ''
    card = category == 'origin-canvas/card'
    for node in walk(parse(path)):
        if node['name'] != 'image':
            continue
        if 'is-style-origin-canvas-rounded-full' in class_names(node):
            slot, want = 'avatar', AVATAR
        elif card:
            slot, want = 'card', CARD
            if node['attrs'].get('aspectRatio') != '3/2':
                print('  ✗  %s:%d card image crops at %s; the card slot is 3/2'
                      % (path, node['line'], node['attrs'].get('aspectRatio') or 'no ratio'))
                fail = True
        elif category == 'gallery' and node['attrs'].get('aspectRatio') == '3/2':
            slot, want = 'gallery', GALLERY
        elif category != 'team' and node['attrs'].get('aspectRatio') == '4/5':
            slot, want = 'portrait', PORTRAIT
        else:
            continue
        count += 1
        src = SRC.search(text[node['start']:node['end']])
        m = IMAGE.search(src.group(1)) if src else None
        if not m:
            print('  ✗  %s:%d %s image is not a file in patterns/images/; its size cannot be read'
                  % (path, node['line'], slot))
            fail = True
            continue
        got = size('patterns/images/' + m.group(1))
        if got != want:
            print('  ✗  %s:%d %s in the %s slot is %s; that slot takes %d × %d px'
                  % (path, node['line'], m.group(1), slot,
                     '%d × %d px' % got if got else 'unreadable', want[0], want[1]))
            fail = True

if fail:
    sys.exit(1)
print('Image slots:')
print('  ✓  %d avatar, card, gallery and portrait images are cut to their slot' % count)
PY
