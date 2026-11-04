#!/usr/bin/env bash
#
# Images ship with no hidden metadata. Every image the repo tracks is read chunk by chunk
# and fails when it carries any of these:
#
#   WebP  EXIF, XMP or C2PA chunks
#   PNG   eXIf, tEXt, iTXt, zTXt or caBX (C2PA) chunks
#   JPEG  APP1 (EXIF, XMP), APP11 (C2PA, JUMBF), APP13 (IPTC) segments or a comment
#
# A colour profile (WebP ICCP, PNG iCCP, JPEG APP2) is not metadata: it sets how the
# colours render, so it stays. How each image was made is recorded in the readme's credits
# and the provenance table in CONTRIBUTING.md, not inside the file.
#
# --strip removes the flagged chunks from WebP and PNG files in place. The image data is
# copied byte for byte, so the picture does not change; update the file's provenance hash
# after (bin/check-asset-provenance.sh --rows). A JPEG is not stripped: export it again
# without metadata.
#
# Run from the theme root:  bash bin/check-image-metadata.sh [--strip] [files…]

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import struct, subprocess, sys

args = sys.argv[1:]
strip = '--strip' in args
files = [a for a in args if a != '--strip'] or [
    f for f in subprocess.run(['git', 'ls-files'], capture_output=True, text=True, check=True).stdout.split('\n')
    if f.lower().endswith(('.webp', '.png', '.jpg', '.jpeg'))
]

WEBP_BAD = {b'EXIF', b'XMP ', b'C2PA'}
PNG_BAD = {b'eXIf', b'tEXt', b'iTXt', b'zTXt', b'caBX'}
JPEG_BAD = {0xE1: 'APP1', 0xEB: 'APP11', 0xED: 'APP13', 0xFE: 'COM'}

def webp(d):
    keep, bad, i = [], [], 12
    while i + 8 <= len(d):
        t = d[i:i+4]; n = struct.unpack('<I', d[i+4:i+8])[0]; end = i + 8 + n + (n & 1)
        (bad if t in WEBP_BAD else keep).append(d[i:end] if t not in WEBP_BAD else t.decode().strip())
        i = end
    body = b'WEBP' + b''.join(keep)
    return bad, b'RIFF' + struct.pack('<I', len(body)) + body

def png(d):
    keep, bad, i = [d[:8]], [], 8
    while i + 8 <= len(d):
        n = struct.unpack('>I', d[i:i+4])[0]; t = d[i+4:i+8]; end = i + 12 + n
        (bad if t in PNG_BAD else keep).append(d[i:end] if t not in PNG_BAD else t.decode())
        i = end
    return bad, b''.join(keep)

def jpeg(d):
    bad, i = [], 2
    while i + 4 <= len(d) and d[i] == 0xFF and d[i+1] != 0xDA:
        if d[i+1] in JPEG_BAD:
            bad.append(JPEG_BAD[d[i+1]])
        i += 2 + struct.unpack('>H', d[i+2:i+4])[0]
    return bad, None

failed = 0
for f in files:
    d = open(f, 'rb').read()
    if d[:4] == b'RIFF' and d[8:12] == b'WEBP':
        bad, clean = webp(d)
    elif d[:8] == b'\x89PNG\r\n\x1a\n':
        bad, clean = png(d)
    elif d[:2] == b'\xff\xd8':
        bad, clean = jpeg(d)
    else:
        continue
    if not bad:
        continue
    kinds = ', '.join(sorted(set(bad)))
    if strip and clean is not None:
        open(f, 'wb').write(clean)
        print(f'  ✓  {f}: removed {kinds} ({len(d) - len(clean)} bytes); update its provenance hash')
    else:
        failed += 1
        print(f'  ✗  {f}: carries {kinds}')

if failed:
    print(f'\n{failed} image(s) carry hidden metadata. Run with --strip for WebP and PNG; export a JPEG again without metadata.')
    sys.exit(1)
print(f'  ✓  {len(files)} images carry no EXIF, XMP, text or C2PA metadata')
PY
