#!/usr/bin/env bash
#
# Tight tracking comes from the size tokens in settings.custom.letterSpacing, never from
# a number typed into a pattern (CLAUDE.md rule 7). A raw value opts the text out of a
# style variation that retunes the tokens for its own face.
#
# Fails on:
#   - a heading-role block whose letterSpacing is not var(--wp--custom--letter-spacing--*)
#   - any text block with a negative raw letterSpacing. Negative tracking is the
#     display and statement register; positive tracking on eyebrows and labels stays.
#
# check-heading-pins.sh still decides WHICH headings may carry tracking at all; this
# check decides what the value may be.
#
# Run from the theme root:  bash bin/check-tracking-tokens.sh

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, re, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk

HEADINGS = {'heading', 'accordion-heading', 'post-title', 'query-title', 'comments-title'}
TOKEN = re.compile(r'^var\(--wp--custom--letter-spacing--[a-z-]+\)$')

# Type specimens on the theme landing. Each one displays a face at a set tracking, so the
# value IS the content: the DM Sans "Ag" shows that face's own -0.015em, which no Inter
# token holds. Keyed to file AND value, so a new value or a new file still fails.
SPECIMENS = {
    ('patterns/style-variations.php', '-0.02em'),
    ('patterns/style-variations.php', '-0.015em'),
    ('patterns/token-system.php', '-0.02em'),
}

files = sys.argv[1:] or sorted(glob.glob('patterns/*.php') + glob.glob('parts/*.html')
                              + glob.glob('templates/*.html'))
fail = False
for path in files:
    for node in walk(parse(path)):
        value = node['attrs'].get('style', {}).get('typography', {}).get('letterSpacing')
        if value is None or TOKEN.match(str(value)):
            continue
        value = str(value).strip()
        if node['name'] in HEADINGS:
            print('  ✗  %s:%d wp:%s letterSpacing %s is not a size token'
                  % (path, node['line'], node['name'], value))
            fail = True
        elif value.startswith('-') and (path, value) not in SPECIMENS:
            print('  ✗  %s:%d wp:%s letterSpacing %s: negative tracking must be a '
                  'size token' % (path, node['line'], node['name'], value))
            fail = True

if fail:
    sys.exit(1)
print('Tracking tokens:')
print('  ✓  every heading and negative letter spacing uses a '
      'var(--wp--custom--letter-spacing--*) token')
PY
