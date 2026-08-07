#!/usr/bin/env bash
#
# Patterns state a heading's SIZE and nothing else about the type. Weight and letter
# spacing belong to the style variation, and an inline value on a block emits a
# style="…" attribute that beats every rule a variation can produce — so one pinned
# heading is a heading the user cannot restyle.
#
# This fails the build if a heading-role block pins either property, or if a heading
# sets a raw font size instead of a preset. Both have happened; see CLAUDE.md rule 7.
#
# Run from the theme root:  bash bin/check-heading-pins.sh

set -euo pipefail
cd "$(dirname "$0")/.."

status=0

# The statement register is the one exemption: being lighter than the theme's voice is
# its identity. The exemption is per FILE AND per PROPERTY, not per file — the two
# differ, and a blanket file skip would let breath-statement gain a tracking pin it
# does not have.
# Keyed on file, property AND value: the rule is that these files keep exactly what
# they already have, so changing 500 to 800 must fail like any other new pin.
exempt() {
	case "$1|$2|$3" in
		*breath-statement.php\|fontWeight\|500)            return 0 ;;
		*breath-statement.php\|font-weight\|500)           return 0 ;;
		*text-large-statement.php\|fontWeight\|500)        return 0 ;;
		*text-large-statement.php\|font-weight\|500)       return 0 ;;
		*text-large-statement.php\|letterSpacing\|-0.01em) return 0 ;;
		*text-large-statement.php\|letter-spacing\|-0.01em) return 0 ;;
	esac
	return 1
}

# Every block that renders as a heading. A wp:heading-only sweep once missed twelve
# nodes across the others, which is why they are named individually here.
# Not listed, and deliberately so: wp:site-title renders a <p> at level 0, so the
# element default cannot reach it and its block-level weight is the only lever.
BLOCKS='wp:heading|wp:accordion-heading|wp:query-title|wp:post-title|wp:comments-title'

report() {
	printf '  ✗  %s\n' "$1"
	status=1
}

# The legal sizes, read from theme.json rather than hardcoded, so adding a scale step
# does not silently make this check wrong.
PRESETS=$(python3 -c "
import json
d = json.load(open('theme.json'))
print('|'.join(s['slug'] for s in d['settings']['typography']['fontSizes']))")

# 1. Block comment JSON — the attribute the editor round-trips. Checked one property
#    at a time so the exemption can be property-specific.
for prop in fontWeight letterSpacing; do
	while IFS= read -r hit; do
		[ -z "$hit" ] && continue
		file="${hit%%:*}"
		val=$(printf '%s' "$hit" | grep -oE "\"${prop}\":\"[^\"]*\"" | head -1 | cut -d'"' -f4)
		exempt "$file" "$prop" "$val" && continue
		report "pins ${prop}:${val}: ${file}:$(printf '%s' "$hit" | cut -d: -f2)"
	done < <(grep -rnoE "<!-- (${BLOCKS}) [^>]*\"${prop}\":\"[^\"]*\"" patterns/ 2>/dev/null || true)
done

# 2. Saved HTML — the half a JSON-only check misses. Removing one and leaving the
#    other desyncs the block while the rendering silently stays wrong.
for prop in font-weight letter-spacing; do
	while IFS= read -r hit; do
		[ -z "$hit" ] && continue
		file="${hit%%:*}"
		val=$(printf '%s' "$hit" | grep -oE "${prop}:[^;\"]*" | head -1 | cut -d: -f2)
		exempt "$file" "$prop" "$val" && continue
		report "rendered tag sets ${prop}:${val}: ${file}:$(printf '%s' "$hit" | cut -d: -f2)"
	done < <(grep -rnoE "<h[1-6][^>]*style=\"[^\"]*${prop}:[^;\"]*" patterns/ 2>/dev/null || true)
done

# 3. The accordion question carries its tracking on an inner span, not the block.
#    Matched on the CLASS and the property independently, in either attribute order
#    and anywhere inside the style value — an exact-substring match would miss
#    style="color:red;letter-spacing:-0.01em" or a span with another attribute first.
while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	report "accordion span still styled: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE '<span[^>]*toggle-title[^>]*>' patterns/ 2>/dev/null \
	| grep -E 'style="[^"]*(font-weight|letter-spacing):' || true)

# 4. A heading's size must be a preset. A hand-written clamp scales on its own terms
#    and cannot be changed from the theme. Both halves are checked: the size can
#    desync exactly the way weight and tracking can.
# An allowlist, not a blacklist: the invariant is "IF a size is stated, it is a
# preset", so anything else fails. A blacklist of clamp/digits/var would miss calc(),
# min(), max() and a bare .875rem.
#
# A STATED size must be a preset; a heading is not required to state one. The two are
# different rules and only the first is mechanical. Rule 7 requires a preset on
# `wp:heading`, which is composed content. It does not reach `wp:post-title` in a
# hidden-* template scaffold: that block renders the page's own title, and inheriting
# the h1 ladder is the correct behaviour there — 7 of the 9 post-titles in this theme
# do exactly that, while the 2 in blog loops state a size because the title is a card
# element. Encoding "must state a size" would flag all 7 as defects.
# The closing quote is part of the match: without it "huge-custom" satisfies a
# "huge" alternation and a bogus size passes as a preset.
while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	report "size is not a preset: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE "<!-- (${BLOCKS}) [^>]*\"fontSize\":\"[^\"]*\"" patterns/ 2>/dev/null \
	| grep -vE "\"fontSize\":\"(${PRESETS})\"([,}]|$)" || true)

# A heading's rendered tag must carry NO inline font-size at all — the preset arrives
# as a has-<slug>-font-size class.
while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	report "rendered heading sets font-size inline: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE '<h[1-6][^>]*style="[^"]*font-size:' patterns/ 2>/dev/null || true)

# Rule 7 proper: a wp:heading is composed content and must state its size, so that a
# change to the element ladder cannot restyle a shipped pattern. This applies to
# wp:heading only — see the note above on why post-title in a scaffold is exempt.
while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	report "wp:heading states no fontSize: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE '<!-- wp:heading( [^>]*)?-->' patterns/ 2>/dev/null \
	| grep -v '"fontSize"' || true)

# The attribute alone does not render: WordPress emits the size as a
# has-<slug>-font-size class on the tag. A block that states a preset while its saved
# markup lacks the class renders unpinned — the desync this whole script guards.
python3 - <<'PY' || status=1
import glob, re, sys
fail = False
for path in sorted(glob.glob('patterns/*.php')):
    lines = open(path).read().split('\n')
    for i, line in enumerate(lines):
        # Both static heading blocks that save markup. post-title/query-title render
        # dynamically and emit no tag here, so they cannot be checked this way.
        for m in re.finditer(r'<!-- wp:(?:accordion-)?heading [^>]*"fontSize":"([a-z0-9-]+)"', line):
            slug = m.group(1)
            # WordPress kebab-cases the slug for the class and splits a digit from the
            # letters that follow it: display-2xl becomes has-display-2-xl-font-size.
            css = re.sub(r'(\d)([a-z])', r'\1-\2', slug)
            window = '\n'.join(lines[i:i + 4])
            tag = re.search(r'<h[1-6][^>]*>', window)
            if tag and ('has-%s-font-size' % css) not in tag.group(0):
                print('  ✗  %s:%d states %s but the tag has no has-%s-font-size class'
                      % (path, i + 1, slug, css))
                fail = True
sys.exit(1 if fail else 0)
PY

# 5. Weight AND tracking live at one node. Either pinned per level defeats a variation
#    that sets it, so both are checked and both must be present on the base.
python3 - <<'PY' || status=1
import glob, json, sys

PROPS  = ('fontWeight', 'letterSpacing')
LEVELS = ('h1', 'h2', 'h3', 'h4', 'h5', 'h6')

# Heading-role blocks. core/site-title is absent on purpose: it renders a <p> at
# level 0, so elements.heading cannot reach it and its own weight is the only lever.
BLOCKS = ('core/heading', 'core/accordion-heading', 'core/post-title',
          'core/query-title', 'core/comments-title')

fail = False

def walk(node, path):
    """Every typography.<prop> at any depth — a pin nested under elements.link
    overrides linked heading text just as a direct one does."""
    if not isinstance(node, dict):
        return
    typ = node.get('typography')
    if isinstance(typ, dict):
        for prop in PROPS:
            if prop in typ:
                yield prop, path
    for key, val in node.items():
        if key != 'typography' and isinstance(val, dict):
            yield from walk(val, '%s.%s' % (path, key))

def check(styles, label, require_base):
    global fail
    e = styles.get('elements', {})
    for prop in PROPS:
        bad = [k for k in LEVELS if prop in e.get(k, {}).get('typography', {})]
        if bad:
            print('  ✗  %s: per-level heading %s pin: %s' % (label, prop, ', '.join(bad)))
            fail = True
        if require_base and e.get('heading', {}).get('typography', {}).get(prop) is None:
            print('  ✗  %s: elements.heading has no %s — the single lever is missing'
                  % (label, prop))
            fail = True

    # Heading blocks wherever they appear. They nest: this theme already carries
    # styles.blocks.core/accordion.variations.<name>.blocks.core/accordion-item, so a
    # heading pinned inside a block-style variation renders and must not slip past.
    def scan_blocks(blocks, prefix):
        global fail
        if not isinstance(blocks, dict):
            return
        for name, node in blocks.items():
            if not isinstance(node, dict):
                continue
            here = '%s.%s' % (prefix, name) if prefix else name
            if name in BLOCKS:
                for prop, path in walk(node, here):
                    print('  ✗  %s: %s pins %s at %s — it is a heading and follows the '
                          'variation' % (label, name, prop, path))
                    fail = True
            else:
                # Any block may scope element rules: styles.blocks.core/group
                # .elements.heading.typography.fontWeight overrides every heading
                # inside a Group and defeats the single lever just as surely.
                els = node.get('elements', {})
                for ename in ('heading',) + LEVELS:
                    typ = els.get(ename, {}).get('typography', {}) if isinstance(els, dict) else {}
                    for prop in PROPS:
                        if prop in typ:
                            print('  ✗  %s: %s scopes %s on %s — heading %s belongs to '
                                  'styles.elements.heading'
                                  % (label, here, prop, ename, prop))
                            fail = True
            scan_blocks(node.get('blocks', {}), here)
            for vname, vnode in (node.get('variations', {}) or {}).items():
                if not isinstance(vnode, dict):
                    continue
                vpath = '%s.variations.%s' % (here, vname)
                # A variation node carries the same shapes as the block it varies, so
                # it needs the same two checks — not just its nested blocks.
                vels = vnode.get('elements', {})
                if isinstance(vels, dict):
                    for ename in ('heading',) + LEVELS:
                        vtyp = vels.get(ename, {}).get('typography', {})
                        for prop in PROPS:
                            if prop in vtyp:
                                print('  ✗  %s: %s scopes %s on %s — heading %s belongs '
                                      'to styles.elements.heading'
                                      % (label, vpath, prop, ename, prop))
                                fail = True
                if name in BLOCKS:
                    for prop, path in walk(vnode, vpath):
                        print('  ✗  %s: %s pins %s at %s — it is a heading and follows '
                              'the variation' % (label, name, prop, path))
                        fail = True
                scan_blocks(vnode.get('blocks', {}), vpath)

    scan_blocks(styles.get('blocks', {}), '')

check(json.load(open('theme.json'))['styles'], 'theme.json', True)

# A variation may set elements.heading — that is the whole point — but must not pin a
# level or a heading block, which would defeat itself.
for f in sorted(glob.glob('styles/**/*.json', recursive=True)):
    try:
        d = json.load(open(f))
    except ValueError:
        print('  ✗  %s: invalid JSON' % f)
        fail = True
        continue
    check(d.get('styles', {}), f, False)

sys.exit(1 if fail else 0)
PY

# 6. CSS is the last way in. A rule targeting a heading tag or a heading block's class
#    overrides the single lever exactly as a theme.json pin would, and the structured
#    scans above cannot see it — including the `css` strings inside theme.json.
python3 - <<'PY' || status=1
import glob, json, re, sys

# Real CSS is multi-line, so the whole file is read and rule bodies are matched across
# newlines. A line-oriented grep only catches `h2 { font-weight: 800 }` written on one
# line, which is not how anyone writes it.
# A heading may be named anywhere in a selector: after a combinator, inside :where()
# or :is(), or welded into a compound like `.is-style-x.wp-block-heading`. The leading
# boundary therefore allows `(` and `.` too — this theme's own CSS leans on :where().
HEADING = re.compile(
    r'(?:(?<=^)|(?<=[\s,>+~(.]))'
    r'(h[1-6]|wp-block-'
    r'(heading|post-title|query-title|comments-title|accordion-heading))\b')
# `font:` is included because the shorthand sets weight — `font: 800 1rem/1.2 Inter`
# pins a heading exactly as `font-weight` does.
PINNED  = re.compile(r'(^|[\s;{])(font-weight|letter-spacing|font)\s*:', re.M)
RULE    = re.compile(r'([^{}]+)\{([^{}]*)\}', re.S)

fail = False

def scan(css, label):
    """Report a rule only if a selector that is NOT the sanctioned exception targets a
    heading. `.comment-reply-title, h2 { … }` must fail on the h2 half."""
    global fail
    for sel, body in RULE.findall(css):
        if not PINNED.search(body):
            continue
        for one in sel.split(','):
            one = one.strip()
            if not one:
                continue
            # Skip only a selector that IS the sanctioned reply title — not one that
            # merely mentions it. `.comment-reply-title h2` pins a real heading, and
            # `.not-comment-reply-title.wp-block-heading` is a different class entirely.
            if re.search(r'(^|[\s,>+~(])\.comment-reply-title\s*$', one):
                continue
            if HEADING.search(one):
                flat = ' '.join(one.split())
                print('  ✗  CSS sets heading weight or tracking: %s — %s' % (label, flat))
                fail = True
                break

for path in sorted(glob.glob('assets/styles/*.css')) + ['style.css']:
    try:
        scan(open(path).read(), path)
    except IOError:
        pass

def walk(node, path, label):
    if isinstance(node, dict):
        for k, v in node.items():
            if k == 'css' and isinstance(v, str):
                scan(v, '%s %s' % (label, path))
            else:
                walk(v, '%s.%s' % (path, k), label)
    elif isinstance(node, list):
        for i, v in enumerate(node):
            walk(v, '%s[%d]' % (path, i), label)

# theme.json AND every variation file — a variation may carry css strings too, and one
# selected at runtime overrides headings exactly as the base would.
walk(json.load(open('theme.json')).get('styles', {}), 'styles', 'theme.json')
for f in sorted(glob.glob('styles/**/*.json', recursive=True)):
    try:
        walk(json.load(open(f)).get('styles', {}), 'styles', f)
    except ValueError:
        pass
sys.exit(1 if fail else 0)
PY

if [ $status -eq 0 ]; then
	echo "Heading pins:"
	echo "  ✓  no pattern heading pins weight or tracking (statement register excepted)"
	echo "  ✓  every wp:heading states a size, and every stated size is a preset"
	echo "  ✓  heading weight and tracking live only at styles.elements.heading"
fi

exit $status
