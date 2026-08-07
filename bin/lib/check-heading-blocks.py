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


def walk_typography(node, trail='', sizes=False):
    """Every typography.<prop> at any depth. A weight under style.elements.link pins
    linked heading text just as a direct one does — the theme.json checker already
    walks this way, and the pattern side has to match it. With sizes=True, yields raw
    fontSize instead, which can hide at the same depths."""
    wanted = ('fontSize',) if sizes else PROPS
    if not isinstance(node, dict):
        return
    typography = node.get('typography')
    if isinstance(typography, dict):
        for prop in wanted:
            if prop in typography:
                yield prop, str(typography[prop]), trail
    for key, value in node.items():
        if key != 'typography' and isinstance(value, dict):
            yield from walk_typography(
                value, '%s.%s' % (trail, key) if trail else key, sizes)


CSS_PIN = re.compile(
    r'(^|[\s;{])(font-weight|letter-spacing|font|font-variation-settings)\s*:', re.I | re.M)

# The same selector set the stylesheet scanner uses: a heading tag, any heading block
# class, the accordion toggle button, or the span holding the question.
HEADING_NAME = re.compile(
    r'(?:(?<=^)|(?<=[\s,>+~(.\'"=]))'
    r'(h[1-6]|wp-block-'
    r'(heading|post-title|query-title|comments-title|accordion-heading)'
    r'(__toggle(-title)?)?)\b', re.I)


def check_block_css(path, line_no, attrs, scoped_to_heading):
    """WordPress 7.0 stores per-block custom CSS in style.css — verified rendering:
    it emits `has-custom-css wp-custom-css-<hash>` on the tag. On a heading that CSS is
    already scoped, so any weight or tracking declaration pins it; on another block,
    only a rule naming a heading does."""
    css = attrs.get('style', {}).get('css')
    if not isinstance(css, str):
        return
    css = re.sub(r'/\*.*?\*/', '', css, flags=re.S)

    # On a heading block the CSS is already scoped to it, so a bare declaration list
    # or any rule inside it pins the heading.
    if scoped_to_heading:
        if CSS_PIN.search(css):
            bad('%s:%d block custom CSS sets heading weight or tracking'
                % (path, line_no))
        return

    # On any other block, the pinned declaration and the heading selector must be in
    # the SAME rule: `& p { font-weight:700 } & .wp-block-heading { color:red }` sets
    # no heading weight, and reporting it would be a false positive.
    for selector, body in re.findall(r'([^{}]+)\{([^{}]*)\}', css, re.S):
        if CSS_PIN.search(body) and HEADING_NAME.search(selector):
            bad('%s:%d block custom CSS sets heading weight or tracking: %s'
                % (path, line_no, ' '.join(selector.split())))


def check_attributes(path, line_no, base, block, attrs):
    typography = attrs.get('style', {}).get('typography', {})

    for prop, value, trail in walk_typography(attrs.get('style', {})):
        if (base, prop, value) in EXEMPT and not trail:
            continue
        where = ' at style.%s' % trail if trail else ''
        bad('%s:%d pins %s:%s%s' % (path, line_no, prop, value, where))

    size = attrs.get('fontSize')
    if size is not None and size not in PRESETS:
        bad('%s:%d size is not a preset: %s' % (path, line_no, size))

    # A raw size hidden in style.typography instead of the fontSize attribute — at any
    # depth, so a size under elements.link is caught the way a weight there is.
    for prop, value, trail in walk_typography(attrs.get('style', {}), sizes=True):
        where = ' at style.%s' % trail if trail else ' in style.typography'
        bad('%s:%d sets a raw font size%s: %s' % (path, line_no, where, value))

    # Rule 7 reaches the blocks that ARE composed content and save their own markup:
    # wp:heading and wp:accordion-heading. It does not reach a post-title in a
    # hidden-* scaffold, which renders the page's own title and should inherit the h1
    # ladder — 7 of the 9 post-titles here do exactly that.
    if block in ('heading', 'accordion-heading') and size is None:
        bad('%s:%d wp:%s states no fontSize' % (path, line_no, block))

    return size


def check_saved_tag(path, line_no, base, size, window):
    """The comment and the saved markup must agree — a half-edit leaves the rendering
    wrong while the attributes look right."""
    # A browser ignores CSS comments, so `style="font-weight/**/:800"` still pins.
    # Strip them before matching rather than allowing for them in every pattern.
    window = re.sub(r'/\*.*?\*/', '', window, flags=re.S)

    match = re.search(r'<(h[1-6])[^>]*>', window)
    if not match:
        return
    tag = match.group(0)

    # The whole heading element, not just its opening tag: <h2><a style="font-weight">
    # pins the text that is actually read. Bounded by the closing tag when present.
    close = window.find('</%s>' % match.group(1), match.end())
    element = window[match.start():close] if close != -1 else tag

    # Tolerant of serialization: space before the colon, upper case, and single- or
    # double-quoted style attributes. `font-weight : 800` pins exactly as tightly.
    for prop in PROPS:
        css = CSS_NAME[prop]
        for found in re.finditer(r'%s\s*:\s*([^;"\']+)' % css, element, re.I):
            value = found.group(1).strip()
            if (base, prop, value) in EXEMPT:
                continue
            inner = '' if found.start() < len(tag) else ' inside the heading'
            bad('%s:%d rendered heading sets %s:%s%s'
                % (path, line_no, css, value, inner))

    if re.search(r'font-size\s*:', element, re.I):
        bad('%s:%d rendered heading sets font-size inline' % (path, line_no))

    # The same two shorthands the stylesheet scanner treats as pins: `font:` sets
    # weight, and a wght axis on font-variation-settings does too.
    for shorthand in ('font', 'font-variation-settings'):
        for found in re.finditer(r'(^|[\s;"\'])%s\s*:\s*([^;"\']+)' % shorthand,
                                 element, re.I):
            bad('%s:%d rendered heading sets %s:%s'
                % (path, line_no, shorthand, found.group(2).strip()))

    if size is not None:
        # WordPress splits a digit from the letters that follow it, so display-2xl
        # becomes has-display-2-xl-font-size.
        slug = re.sub(r'(\d)([a-z])', r'\1-\2', size)
        # An exact class token, not a substring: `has-huge-font-size-bad` contains
        # `has-huge-font-size` but WordPress would not apply the preset.
        attr = re.search(r'class=["\']([^"\']*)["\']', tag)
        classes = attr.group(1).split() if attr else []
        if ('has-%s-font-size' % slug) not in classes:
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


# `\s+`, matching COMMENT above: WordPress accepts any whitespace — including a
# newline — between the block name and its attributes.
ANY_BLOCK = re.compile(r'<!-- wp:[a-z][a-z0-9-]*(/[a-z0-9-]+)?\s+(\{.*?\})\s*/?-->', re.S)
SCOPED = ('heading', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6')


def check_scoped_elements(path, source):
    """Any block can scope heading rules at style.elements.heading — a Group doing so
    overrides every heading inside it, defeating the single lever exactly as a pin on
    the heading itself would. The theme.json checker already covers this shape."""
    for match in ANY_BLOCK.finditer(source):
        try:
            attrs = json.loads(match.group(2))
        except ValueError:
            continue
        elements = attrs.get('style', {}).get('elements', {})
        if not isinstance(elements, dict):
            continue
        line_no = source.count('\n', 0, match.start()) + 1
        check_block_css(path, line_no, attrs, scoped_to_heading=False)
        for name in SCOPED:
            typography = elements.get(name, {}).get('typography', {})
            for prop in PROPS:
                if prop in typography:
                    bad('%s:%d scopes %s on %s — heading %s belongs to the theme'
                        % (path, line_no, prop, name, prop))
            # A size scoped from a parent takes the heading off the scale just as a
            # raw size on the block itself would.
            if 'fontSize' in typography:
                bad('%s:%d scopes a raw font size on %s: %s'
                    % (path, line_no, name, typography['fontSize']))


PRESETS = presets()

for path in sorted(glob.glob('patterns/*.php')):
    base = path.split('/')[-1]
    source = open(path).read()
    check_scoped_elements(path, source)
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
        check_block_css(path, line_no, attrs, scoped_to_heading=True)
        size = check_attributes(path, line_no, base, block, attrs)
        # Only the two blocks that actually serialize a heading tag. post-title,
        # query-title and comments-title render dynamically and save nothing, so
        # scanning past them would judge the NEXT heading as if it were theirs.
        if block in ('heading', 'accordion-heading'):
            # The rest of the file, not a fixed slice: the element is bounded by its
            # own closing tag, which a window can fall short of on a long heading.
            check_saved_tag(path, line_no, base, size, source[match.end():])

assert_exemptions()

sys.exit(1 if fail else 0)
