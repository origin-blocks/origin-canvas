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

COMMENT = re.compile(r'<!-- wp:(%s)(\s+(\{.*?\}))?\s*/?-->' % '|'.join(BLOCKS), re.S)

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

    # Tolerant of serialization: space before the colon, upper case, and single- or
    # double-quoted style attributes. `font-weight : 800` pins exactly as tightly.
    for prop in PROPS:
        css = CSS_NAME[prop]
        found = re.search(r'%s\s*:\s*([^;"\']+)' % css, tag, re.I)
        if found:
            value = found.group(1).strip()
            if (base, prop, value) not in EXEMPT:
                bad('%s:%d rendered tag sets %s:%s' % (path, line_no, css, value))

    if re.search(r'font-size\s*:', tag, re.I):
        bad('%s:%d rendered heading sets font-size inline' % (path, line_no))

    if size is not None:
        # WordPress splits a digit from the letters that follow it, so display-2xl
        # becomes has-display-2-xl-font-size.
        slug = re.sub(r'(\d)([a-z])', r'\1-\2', size)
        if ('has-%s-font-size' % slug) not in tag:
            bad('%s:%d states %s but the tag has no has-%s-font-size class'
                % (path, line_no, size, slug))


def assert_exemptions():
    """The statement register keeps exactly what it carries — so removing a documented
    pin is as much a change as adding one. Without this the exemption is allow-only and
    the register could quietly lose its identity."""
    for base, prop, value in sorted(EXEMPT):
        path = 'patterns/%s' % base
        try:
            source = open(path).read()
        except IOError:
            bad('%s is missing — it carries a documented %s pin' % (path, prop))
            continue
        # Strip ALL whitespace, not just spaces: the attributes may be split across
        # lines and indented with tabs.
        flat = re.sub(r'\s+', '', source)
        if '"%s":"%s"' % (prop, value) not in flat:
            bad('%s no longer pins %s:%s in the block — the statement register keeps '
                'exactly what it has' % (path, prop, value))

        # And in the saved markup: dropping it from one layer leaves the other lying.
        css = CSS_NAME[prop]
        tag = re.search(r'<h[1-6][^>]*>', source)
        if not tag:
            bad('%s has no heading tag to carry its %s pin' % (path, prop))
            continue
        found = re.search(r'%s\s*:\s*([^;"\']+)' % css, tag.group(0), re.I)
        if not found or found.group(1).strip() != value:
            bad('%s no longer sets %s:%s on the tag — the statement register keeps '
                'exactly what it has' % (path, css, value))


PRESETS = presets()

for path in sorted(glob.glob('patterns/*.php')):
    base = path.split('/')[-1]
    source = open(path).read()
    # Matched against the WHOLE file, not line by line: a block comment may be split
    # across lines, and a per-line scan would not see it at all.
    for match in COMMENT.finditer(source):
        block, raw = match.group(1), match.group(3)
        line_no = source.count('\n', 0, match.start()) + 1
        try:
            attrs = json.loads(raw) if raw else {}
        except ValueError:
            bad('%s:%d block comment is not valid JSON' % (path, line_no))
            continue
        size = check_attributes(path, line_no, base, block, attrs)
        check_saved_tag(path, line_no, base, size, source[match.end():match.end() + 600])

assert_exemptions()

sys.exit(1 if fail else 0)
