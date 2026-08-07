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
while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	report "accordion span still tracked: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE 'toggle-title" style="letter-spacing' patterns/ 2>/dev/null || true)

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
while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	report "size is not a preset: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE "<!-- (${BLOCKS}) [^>]*\"fontSize\":\"[^\"]*\"" patterns/ 2>/dev/null \
	| grep -vE "\"fontSize\":\"(${PRESETS})\"" || true)

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
done < <(grep -rnoE '<!-- wp:heading [^>]*-->' patterns/ 2>/dev/null \
	| grep -v '"fontSize"' || true)

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
            scan_blocks(node.get('blocks', {}), here)
            for vname, vnode in (node.get('variations', {}) or {}).items():
                if isinstance(vnode, dict):
                    scan_blocks(vnode.get('blocks', {}), '%s.variations.%s' % (here, vname))

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

if [ $status -eq 0 ]; then
	echo "Heading pins:"
	echo "  ✓  no pattern heading pins weight or tracking (statement register excepted)"
	echo "  ✓  every wp:heading states a size, and every stated size is a preset"
	echo "  ✓  heading weight and tracking live only at styles.elements.heading"
fi

exit $status
