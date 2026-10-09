#!/usr/bin/env bash
#
# Primary colors three roles at rest: eyebrows, stat figures and step numbers (the
# ordinal role), on light and dark grounds. A list index, such as the work-index row
# numbers, is not a step number: it stays text-muted with no role class. Reading text (body, headings,
# UI) and links keep their text roles (owner ruling, Oct 8; ODS RULES.md, "Primary:
# marks, accents and ambient"). Prices are not stat figures; they stay heading ink.
# Lesson: docs/solutions/styling/primary-never-colors-resting-text.md
#
# Each role is marked in markup with a block class, so this check reads color by role:
#   origin-canvas-eyebrow   origin-canvas-figure   origin-canvas-ordinal
#
# Fails on:
#   - a block or tag with a role class whose text is not primary
#   - primary text without a role class, set as textColor, style.color.text, a
#     has-primary-color class or an inline color on a block, or on an a, p, h1-h6, span
#     or mark tag, unless it is a state indicator listed below
#   - a primary link color at rest (elements.link.color.text), and a primary link arrow,
#     role-marked blocks included: a link inside an eyebrow keeps its text role
#
# Allowed without a role class:
#   - wp:icon (an icon is a mark), hover and focus colors, and primary fills (dots)
#   - the featured pricing tier's kicker and "Most chosen" label (ALLOW)
#   - the category above a single post's title (ALLOW_BLOCKS)
#   - the current nav item, primary through .current-menu-item in core-navigation.css,
#     a state this check does not read; a wp:navigation block is checked like any other
#
# Check marks are bullets: Check Primary and Check Circle Primary stay primary for
# users. Our pricing tiers and features-checklist want ink ticks, so every check list
# in INK_TICKS must use Check Neutral or Check Circle Neutral.
#
# Run from the theme root:  bash bin/check-primary-text.sh [files…]
# Self-test of the rule cases:  bash bin/check-primary-text.sh --self-test

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import glob, re, sys
sys.path.insert(0, 'bin/lib')
from block_tree import parse, walk, class_names

ROLES = ('origin-canvas-eyebrow', 'origin-canvas-figure', 'origin-canvas-ordinal')
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
TAG = re.compile(r'<(a|p|h[1-6]|span|mark)\b([^>]*)>', re.S)
CLASS = re.compile(r'\bclass="([^"]*)"')
PRIMARY_ATTR = re.compile(r'has-primary-color|(?<![\w-])color:\s*var\(--wp--preset--color--primary\)')
ARROW = re.compile(r'<span\b([^>]*)>\s*(?:&rarr;|→)\s*</span>')
LABEL = re.compile(r"esc_html__\(\s*'([^']*)'")


def allowed(path, text, pos):
    m = LABEL.search(text, pos, pos + 600)
    return m is not None and (path, m.group(1)) in ALLOW


def is_primary(value):
    return 'primary' in (value or '')


fail = set()
roles = [0]


def bad(path, line, msg):
    print('  ✗  %s:%d %s' % (path, line, msg))
    fail.add(path)


def check(path):
    text = open(path).read()
    lines = text.split('\n')
    for node in walk(parse(path)):
        a, name, cls = node['attrs'], node['name'], class_names(node)
        if (path in INK_TICKS and name == 'list'
                and any(c.startswith('is-style-origin-canvas-list-check') for c in cls)
                and not any(c.endswith('-neutral') for c in cls)):
            bad(path, node['line'], 'check list needs Check Neutral or Check Circle Neutral '
                'for ink ticks')
        style = a.get('style', {})
        primary = a.get('textColor') == 'primary' or is_primary(style.get('color', {}).get('text'))
        link = style.get('elements', {}).get('link', {}).get('color', {}).get('text')
        role = [c for c in cls if c in ROLES]
        if (path, name) in ALLOW_BLOCKS:
            continue
        if is_primary(link):
            bad(path, node['line'], 'wp:%s sets a primary link color at rest; links keep '
                'their text roles' % name)
        if role:
            roles[0] += 1
            if not primary:
                bad(path, node['line'], 'wp:%s has %s but is not primary' % (name, role[0]))
            continue
        if name == 'icon':
            continue
        if not primary:
            continue
        # The line can open with a parent block, so start at this block's own attribute.
        pos = sum(len(l) + 1 for l in lines[:node['line'] - 1])
        pos = max(pos, text.find('"textColor":"primary"', pos))
        if allowed(path, text, pos):
            continue
        bad(path, node['line'], 'wp:%s sets primary text without a role class; add '
            'origin-canvas-eyebrow, -figure or -ordinal, or use a text color' % name)
    for m in TAG.finditer(text):
        tag, attrs = m.group(1), m.group(2)
        c = CLASS.search(attrs)
        tag_cls = c.group(1).split() if c else []
        line = text.count('\n', 0, m.start()) + 1
        # A link is never primary at rest, role class or not.
        if tag == 'a' and PRIMARY_ATTR.search(attrs):
            bad(path, line, '<a> is a primary link at rest; links keep their text roles')
            continue
        if any(r in tag_cls for r in ROLES):
            if not PRIMARY_ATTR.search(attrs):
                bad(path, line, '<%s> has a role class but is not primary' % tag)
            continue
        if not PRIMARY_ATTR.search(attrs) or allowed(path, text, m.end()):
            continue
        if ARROW.match(text, m.start()):
            bad(path, line, 'link arrow is primary at rest; it takes the link color')
            continue
        bad(path, line, '<%s> is primary text without a role class' % tag)


# Each fixture is one invalid case and must fail on its own. The home and pricing page
# patterns must pass.
FIXTURES = {
    'role-link': '<!-- wp:paragraph {"className":"origin-canvas-eyebrow","style":{"elements":'
                 '{"link":{"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary"} -->\n'
                 '<p class="origin-canvas-eyebrow has-primary-color has-text-color has-link-color">'
                 '<a href="#">Work</a></p>\n<!-- /wp:paragraph -->\n',
    'role-anchor': '<!-- wp:paragraph {"className":"origin-canvas-eyebrow","textColor":"primary"} -->\n'
                   '<p class="origin-canvas-eyebrow has-primary-color has-text-color"><a class='
                   '"origin-canvas-eyebrow has-primary-color" href="#">Work</a></p>\n'
                   '<!-- /wp:paragraph -->\n',
    'navigation': '<!-- wp:navigation {"textColor":"primary"} /-->\n',
    'ordinal-muted': '<!-- wp:paragraph {"className":"origin-canvas-ordinal","textColor":"text-muted"} -->\n'
                     '<p class="origin-canvas-ordinal has-text-muted-color has-text-color">01</p>\n'
                     '<!-- /wp:paragraph -->\n',
    'a-class': '<!-- wp:paragraph -->\n<p><a class="has-primary-color" href="#">Work</a></p>\n'
               '<!-- /wp:paragraph -->\n',
    'a-inline': '<!-- wp:paragraph -->\n<p><a href="#" style="color:var(--wp--preset--color--primary)">'
                'Work</a></p>\n<!-- /wp:paragraph -->\n',
    'a-block': '<!-- wp:button {"textColor":"primary"} -->\n<div class="wp-block-button"><a class='
               '"wp-block-button__link has-primary-color has-text-color wp-element-button">Go</a></div>\n'
               '<!-- /wp:button -->\n',
}
HOME = ['patterns/%s.php' % s for s in ('hero-cover', 'breath-statement', 'work-index',
        'stat-band', 'process-numbered', 'feature-split', 'cta-band')]
PRICING = ['patterns/%s.php' % s for s in ('pricing-hero', 'features-checklist', 'process-cards',
           'testimonial-highlight-dark', 'faq-two-column', 'cta-with-image', 'pricing-single',
           'pricing-simple', 'card-pricing')]


def self_test():
    import io, os, tempfile, contextlib
    ok = True
    with tempfile.TemporaryDirectory() as tmp:
        for case, markup in FIXTURES.items():
            path = os.path.join(tmp, case + '.html')
            open(path, 'w').write(markup)
            fail.clear()
            with contextlib.redirect_stdout(io.StringIO()):
                check(path)
            print('  %s  %s fails' % ('✓' if fail else '✗', case))
            ok = ok and bool(fail)
    for label, paths in (('the seven home patterns', HOME), ('the nine pricing patterns', PRICING)):
        fail.clear()
        out = io.StringIO()
        with contextlib.redirect_stdout(out):
            for path in paths:
                check(path)
        print('  %s  %s pass' % ('✗' if fail else '✓', label))
        if fail:
            print(out.getvalue(), end='')
        ok = ok and not fail
    return ok


if sys.argv[1:] == ['--self-test']:
    print('Primary text self-test:')
    sys.exit(0 if self_test() else 1)

files = sys.argv[1:] or sorted(glob.glob('patterns/*.php') + glob.glob('parts/*.html')
                              + glob.glob('templates/*.html'))
for path in files:
    check(path)

if fail:
    print('Primary text: %d file(s) fail' % len(fail))
    sys.exit(1)
print('Primary text:')
print('  ✓  %d role-marked eyebrows, figures and step numbers are primary; no other '
      'primary resting text' % roles[0])
PY
