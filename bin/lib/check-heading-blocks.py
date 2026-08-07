"""Heading-role block checks, run from bin/check-heading-pins.sh.

The block comment is PARSED as JSON rather than pattern-matched. WordPress accepts
`"fontWeight": "700"` with whitespace and reorders keys freely, so a check tied to one
serialization would pass a hand-edited pattern that still pins a heading.

Every rule here comes from CLAUDE.md rule 7: a pattern states a heading's size and
nothing else about the type.
"""

import glob
import json
import re
import sys

BLOCKS = ('heading', 'accordion-heading', 'query-title', 'post-title', 'comments-title')
PROPS = ('fontWeight', 'letterSpacing')
CSS_NAME = {'fontWeight': 'font-weight', 'letterSpacing': 'letter-spacing'}

# The statement register keeps exactly what it already carries — file, property AND
# value, so changing 500 to 800 fails like any other new pin. The two files differ.
EXEMPT = {
    ('breath-statement.php', 'fontWeight', '500'),
    ('text-large-statement.php', 'fontWeight', '500'),
    ('text-large-statement.php', 'letterSpacing', '-0.01em'),
}

COMMENT = re.compile(r'<!-- wp:(%s)(\s+(\{.*?\}))?\s*/?-->' % '|'.join(BLOCKS))

fail = False


def bad(message):
    global fail
    print('  \u2717  %s' % message)
    fail = True


def presets():
    data = json.load(open('theme.json'))
    return {s['slug'] for s in data['settings']['typography']['fontSizes']}


def check_attributes(path, line_no, base, block, attrs):
    typography = attrs.get('style', {}).get('typography', {})

    for prop in PROPS:
        if prop in typography:
            value = str(typography[prop])
            if (base, prop, value) not in EXEMPT:
                bad('%s:%d pins %s:%s' % (path, line_no, prop, value))

    size = attrs.get('fontSize')
    if size is not None and size not in PRESETS:
        bad('%s:%d size is not a preset: %s' % (path, line_no, size))

    # A raw size hidden in style.typography instead of the fontSize attribute.
    if 'fontSize' in typography:
        bad('%s:%d sets a raw font size in style.typography: %s'
            % (path, line_no, typography['fontSize']))

    # Rule 7 reaches wp:heading, which is composed content. It does not reach a
    # post-title in a hidden-* scaffold: that renders the page's own title and should
    # inherit the h1 ladder. 7 of the 9 post-titles here do exactly that.
    if block == 'heading' and size is None:
        bad('%s:%d wp:heading states no fontSize' % (path, line_no))

    return size


def check_saved_tag(path, line_no, base, size, window):
    """The comment and the saved markup must agree — a half-edit leaves the rendering
    wrong while the attributes look right."""
    match = re.search(r'<h[1-6][^>]*>', window)
    if not match:
        return
    tag = match.group(0)

    for prop in PROPS:
        css = CSS_NAME[prop]
        found = re.search(r'%s:\s*([^;"]+)' % css, tag)
        if found:
            value = found.group(1).strip()
            if (base, prop, value) not in EXEMPT:
                bad('%s:%d rendered tag sets %s:%s' % (path, line_no, css, value))

    if re.search(r'font-size:', tag):
        bad('%s:%d rendered heading sets font-size inline' % (path, line_no))

    if size is not None:
        # WordPress splits a digit from the letters that follow it, so display-2xl
        # becomes has-display-2-xl-font-size.
        slug = re.sub(r'(\d)([a-z])', r'\1-\2', size)
        if ('has-%s-font-size' % slug) not in tag:
            bad('%s:%d states %s but the tag has no has-%s-font-size class'
                % (path, line_no, size, slug))


PRESETS = presets()

for path in sorted(glob.glob('patterns/*.php')):
    base = path.split('/')[-1]
    lines = open(path).read().split('\n')
    for index, line in enumerate(lines):
        for match in COMMENT.finditer(line):
            block, raw = match.group(1), match.group(3)
            line_no = index + 1
            try:
                attrs = json.loads(raw) if raw else {}
            except ValueError:
                bad('%s:%d block comment is not valid JSON' % (path, line_no))
                continue
            size = check_attributes(path, line_no, base, block, attrs)
            check_saved_tag(path, line_no, base, size, '\n'.join(lines[index:index + 4]))

sys.exit(1 if fail else 0)
