#!/usr/bin/env bash
#
# A pattern's Block Types header says which block it is offered for, not where it can be
# inserted (#130). `core/post-content` puts a pattern in the "Choose a pattern" window that
# opens on a new page, and in the inserter's "Starter content" category. So:
#
#   - a page pattern (category origin-canvas/page) sets exactly `core/post-content`, so a new
#     page is offered the theme's pages;
#   - a section leaves Block Types empty, so no section sits in that window as if it were a
#     page;
#   - a pattern bound to a block keeps that block, and only when it really is that block's
#     pattern: BOUND below names each allowed value, the test it must pass and why.
#
# Any other value fails. A slug starting origin-canvas/page- must be in the page category
# and the reverse, so this check and check-page-h1.sh read the same pages; and a pattern
# names one category, so the page test cannot be dodged with a list.
#
# Headers are read as WordPress reads them: every .php file under patterns/, recursively;
# the first 8 KB; the field name in any case; the rest of the line up to `*/` or `?>`; then
# split on commas and whitespace (get_file_data, _cleanup_header_comment, wp_parse_list).
#
# Run from the theme root:  bash bin/check-block-types.sh

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - <<'PY'
import glob, re, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse

PAGE = 'origin-canvas/page'
STARTER = 'core/post-content'

def top_level_query(path, slug, categories):
    top = parse(path)['children']
    return len(top) == 1 and top[0]['name'] == 'query'

def part(area):
    return lambda path, slug, categories: (categories == [area]
                                           and slug.startswith('origin-canvas/%s-' % area))

# Allowed bindings besides the page rule: value -> (test, reason).
BOUND = {
    'core/query': (
        top_level_query,
        'a loop: the Query block offers it in its placeholder and its Replace list; it '
        'must be one Query block at the top level'),
    'core/template-part/header': (
        part('header'),
        'a header part: the template part placeholder and Replace list for the header '
        'area offer it; category header and slug origin-canvas/header-*'),
    'core/template-part/footer': (
        part('footer'),
        'a footer part: the same for the footer area; category footer and slug '
        'origin-canvas/footer-*'),
}

def header(text, name):
    m = re.search(r'^(?:[ \t]*<\?(?:php)?)?[ \t/*#@]*' + re.escape(name) + r':(.*)$',
                  text, re.M | re.I)
    if not m:
        return ''
    return re.sub(r'\s*(?:\*/|\?>).*', '', m.group(1)).strip()

def parse_list(value):
    return [v for v in re.split(r'[\s,]+', value) if v]

files = sorted(glob.glob('patterns/**/*.php', recursive=True))
fail = False
pages = bound = 0

def report(path, message):
    global fail
    print('  ✗  %s %s' % (path, message))
    fail = True

for path in files:
    with open(path, encoding='utf-8', errors='replace') as f:
        text = f.read(8192)
    slug = header(text, 'Slug')
    if not slug:
        continue
    categories = parse_list(header(text, 'Categories'))
    types = parse_list(header(text, 'Block Types'))
    is_page = PAGE in categories

    if len(categories) > 1:
        report(path, 'lists %d categories (%s); a pattern names one'
               % (len(categories), ', '.join(categories)))
    if slug.startswith('origin-canvas/page-') != is_page:
        report(path, 'slug %s and category %s disagree; a page-* slug goes with %s and only it'
               % (slug, ', '.join(categories) or '(none)', PAGE))

    if is_page:
        pages += 1
        if types != [STARTER]:
            report(path, 'is a page pattern with Block Types "%s"; set exactly %s so a new '
                   'page offers it' % (', '.join(types), STARTER))
        continue

    for value in types:
        if value == STARTER:
            report(path, 'is not a page pattern but lists %s, which puts it in the new-page '
                   'window; leave Block Types empty' % STARTER)
        elif value not in BOUND:
            report(path, 'lists Block Types %s, which no rule allows' % value)
        elif not BOUND[value][0](path, slug, categories):
            report(path, 'lists %s but is not that block\'s pattern (%s)' % (value, BOUND[value][1]))
        else:
            bound += 1

if fail:
    sys.exit(1)
print('Block types:')
print('  ✓  %d page patterns set %s; %d bound patterns pass their block\'s test; '
      'no other pattern sets Block Types' % (pages, STARTER, bound))
PY
