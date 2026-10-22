#!/usr/bin/env bash
#
# A page carries its own h1 (Oct 3, #129). Page patterns go on the Full Width or No Title
# templates, which print no post title, so the page's one h1 has to come from the pattern.
# A page with none gives a screen reader and a search engine no main heading; a page with
# two has no single one.
#
# Each origin-canvas/page-* pattern is followed through its wp:pattern references to the
# section patterns it places, and the h1 count is taken over the whole page: an <h1> in
# saved markup, plus a dynamic heading block (post title, query title, site title) set to
# level 1. Exactly one must be found. No exceptions.
#
# Run from the theme root:  bash bin/check-page-h1.sh

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - <<'PY'
import glob, re, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk

SLUG = re.compile(r'^[ \t/*#@]*Slug:\s*(\S+)', re.M | re.I)
PHP = re.compile(r'<\?php.*?\?>', re.S)
H1 = re.compile(r'<h1[\s>]', re.I)
# Dynamic blocks save no markup, so their level is read from the block comment. The
# default is the block's own: the query title and site title render h1 when unset.
DYNAMIC = {'post-title': 2, 'query-title': 1, 'site-title': 1}

files = {}
for path in sorted(glob.glob('patterns/*.php')):
    m = SLUG.search(open(path).read(8192))
    if m:
        files[m.group(1)] = path

def count(path, seen):
    if path in seen:
        sys.exit('  ✗  %s places itself through a pattern reference' % path)
    seen = seen | {path}
    total = len(H1.findall(PHP.sub('', open(path).read())))
    for node in walk(parse(path)):
        name = node['name']
        if name in DYNAMIC and node['attrs'].get('level', DYNAMIC[name]) == 1:
            total += 1
        elif name == 'pattern':
            slug = node['attrs'].get('slug', '')
            if slug not in files:
                sys.exit('  ✗  %s:%d places %s, which no file registers'
                         % (path, node['line'], slug))
            total += count(files[slug], seen)
    return total

fail = False
pages = [(s, p) for s, p in files.items() if s.startswith('origin-canvas/page-')]
for slug, path in pages:
    n = count(path, frozenset())
    if n != 1:
        print('  ✗  %s renders %d h1 elements; a page pattern carries exactly one' % (path, n))
        fail = True

if fail:
    sys.exit(1)
print('Page h1:')
print('  ✓  each of %d page patterns renders exactly one h1' % len(pages))
PY
