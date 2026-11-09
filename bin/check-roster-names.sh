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
#   - a name or company from the roster (STUDIO, CLIENTS and COMPANIES below, copied from
#     the roster in the house writing guide: a person added there is added here too);
#   - a demo post title, category name, or tag name of two words or more, read from
#     bin/demo/seed.php (case-insensitive for tags). A one-word tag, such as "launch", is
#     an ordinary word and is not checked;
#   - a written date, such as "Apr 18, 2026".
# Allowed: the links under the Services label in footer-default and footer-dark, which
# share two names with the demo categories. They are placeholder copy the user replaces
# (#130).
#
# Run from the theme root:  bash bin/check-roster-names.sh [files…]

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, re, sys

files = sys.argv[1:]

STUDIO = ['Claire Bennett', 'Marcus Holloway', 'Hannah Wright', 'Ben Carter']
CLIENTS = ['Michael Hughes', 'Rachel Moore', 'Catherine Rowe', 'Owen Parker', 'Simon Fletcher',
           'Caleb Reid', 'Joanna Price', 'Ruth Mason', 'Helen Marsh']
COMPANIES = ['Westmount Realty', 'Mercer Street Framing', 'Ashby & Rowe Law',
             'Kestrel Physical Therapy', 'Northgate Cycle Works', 'Ash & Pine Woodworks',
             'Clearwater Accounting', 'Calder Veterinary Clinic', 'Fairview Architects']
names = sorted(set(STUDIO) | set(CLIENTS) | set(COMPANIES))

seed = open('bin/demo/seed.php').read()
titles = re.findall(r"^\t\t'title'\s*=>\s*'([^']+)'", seed, re.M)
tags = sorted({t for group in re.findall(r"'tags'\s*=>\s*array\(([^)]*)\)", seed)
               for t in re.findall(r"'([^']+)'", group) if ' ' in t})
if not titles or not tags:
    print('check-roster-names.sh: no demo post titles or tags in bin/demo/seed.php; '
          'update this check.')
    sys.exit(1)
categories = re.findall(r"^\t'[a-z]+'\s*=>\s*array\(\s*'([^']+)',",
                        seed.split('/* Categories and tags. */')[-1], re.M)
if not categories:
    print('check-roster-names.sh: no demo categories in bin/demo/seed.php; update this check.')
    sys.exit(1)
copy = sorted(set(titles) | set(categories))

# The footer Services links: placeholder copy (#130). Allowed only
# as a link under the Services label in these two files.
ALLOWED = {(path, name) for path in ('patterns/footer-default.php', 'patterns/footer-dark.php')
           for name in ('Brand identity', 'Websites')}
LABEL = re.compile(r"<p\b(?:(?!<a\b).)*esc_html__\( '([^']+)'")
LINK = "<a href=\"#\"><?php echo esc_html__( '%s', 'origin-canvas' ); ?></a>"

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
    label = None
    for n, line in enumerate(open(path), 1):
        m = LABEL.search(line)
        if m:
            label = m.group(1)
        # Text in markup is HTML-escaped: "Ash &amp; Pine" is "Ash & Pine".
        plain = line.replace('&amp;', '&').replace('&#038;', '&')
        found = [name for name in names + copy if name in plain]
        found += [tag for tag in tags if tag in plain.lower()]
        found += [m.group(0) for m in DATE.finditer(plain)]
        for hit in found:
            if (path, hit) in ALLOWED and label == 'Services' and LINK % hit in line:
                continue
            print('  ✗  %s:%d holds "%s": demo data belongs in the demo site, not a part, '
                  'template or dynamic pattern' % (path, n, hit))
            fail = True

if fail:
    sys.exit(1)
print('Roster names:')
print('  ✓  %d parts, templates and dynamic patterns hold none of %d roster names, '
      '%d demo post titles, categories and tags, and no written date'
      % (len(files), len(names), len(copy) + len(tags)))
PY
