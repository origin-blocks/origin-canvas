#!/usr/bin/env bash
#
# A distribution theme never ships canon names or copy inside template parts or dynamic
# patterns (#130). A part or a template renders on every site that runs the theme, and a
# dynamic pattern shows the site's own posts, so a demo name there is a stranger's name on
# the user's site. Demo people, dates, post titles and tag names are demo data in the demo
# site's content (bin/demo/seed.php). Static patterns may carry canon copy: the user
# inserts them and replaces it.
#
# Checked: parts/*.html, templates/*.html, and every pattern that holds a dynamic block
# (a query, post, comment or term block) or is filed under header, footer or hidden, since
# those become parts and templates. They must not hold:
#   - a name or company from the roster (the Studio and Clients tables in the writing
#     guide's brands/origin-patterns.md, read at run time so the list has one home);
#   - a written date, such as "Apr 18, 2026".
#
# Run from the theme root:  bash bin/check-roster-names.sh [files…]
# The roster is read from $ORIGIN_PATTERNS_BRAND, by default
# ~/Projects/writing/brands/origin-patterns.md.

set -euo pipefail
cd "$(dirname "$0")/.."

BRAND="${ORIGIN_PATTERNS_BRAND:-$HOME/Projects/writing/brands/origin-patterns.md}"
[ -f "$BRAND" ] || {
	echo "check-roster-names.sh: no roster at $BRAND. Clone the writing guide or set ORIGIN_PATTERNS_BRAND." >&2
	exit 1
}

python3 -B - "$BRAND" "$@" <<'PY'
import glob, re, sys

brand, files = sys.argv[1], sys.argv[2:]

def table(text, heading):
    """The rows of the first table under a ### heading, as lists of cells."""
    m = re.search(r'^### %s\s*$(.*?)(?=^#)' % re.escape(heading), text, re.M | re.S)
    rows = [[c.strip() for c in line.strip().strip('|').split('|')]
            for line in (m.group(1) if m else '').splitlines() if line.startswith('|')]
    return rows[2:]  # past the header row and the rule

text = open(brand).read()
studio, clients = table(text, 'The Studio'), table(text, 'The Clients')
if not studio or not clients:
    print('check-roster-names.sh: no Studio or Clients table in %s; update this check.' % brand)
    sys.exit(1)
names = sorted({r[0] for r in studio} | {r[0] for r in clients} | {r[2] for r in clients})

seed = open('bin/demo/seed.php').read()
titles = re.findall(r"^\t\t'title'\s*=>\s*'([^']+)'", seed, re.M)
tags = sorted({t for group in re.findall(r"'tags'\s*=>\s*array\(([^)]*)\)", seed)
               for t in re.findall(r"'([^']+)'", group) if ' ' in t})
if not titles or not tags:
    print('check-roster-names.sh: no demo post titles or tags in bin/demo/seed.php; '
          'update this check.')
    sys.exit(1)
copy = sorted(set(titles))

DYNAMIC = re.compile(r'<!--\s+wp:(query|post-[a-z-]+|comments?[a-z-]*|query-title'
                     r'|term-description|categories|tag-cloud|latest-posts|archives)[\s/]')
PART = re.compile(r'^[ \t*]*Categories:\s*(header|footer|hidden)\s*$', re.M | re.I)
DATE = re.compile(r'\b(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)[a-z]*\.? \d{1,2}, \d{4}\b')

if not files:
    files = sorted(glob.glob('parts/*.html') + glob.glob('templates/*.html'))
    for path in sorted(glob.glob('patterns/*.php')):
        body = open(path).read()
        if DYNAMIC.search(body) or PART.search(body):
            files.append(path)

fail = False
for path in files:
    for n, line in enumerate(open(path), 1):
        # Text in markup is HTML-escaped: "Ash &amp; Pine" is "Ash & Pine".
        plain = line.replace('&amp;', '&').replace('&#038;', '&')
        found = [name for name in names + copy if name in plain]
        found += [tag for tag in tags if tag in plain.lower()]
        found += [m.group(0) for m in DATE.finditer(plain)]
        for hit in found:
            print('  ✗  %s:%d holds "%s": demo data belongs in the demo site, not a part, '
                  'template or dynamic pattern' % (path, n, hit))
            fail = True

if fail:
    sys.exit(1)
print('Roster names:')
print('  ✓  %d parts, templates and dynamic patterns hold none of %d roster names, '
      '%d demo post titles and tags, and no written date'
      % (len(files), len(names), len(copy) + len(tags)))
PY
