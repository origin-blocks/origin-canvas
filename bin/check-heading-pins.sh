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
exempt() {
	case "$1:$2" in
		*breath-statement.php:fontWeight)                     return 0 ;;
		*text-large-statement.php:fontWeight)                 return 0 ;;
		*text-large-statement.php:letterSpacing)              return 0 ;;
		*breath-statement.php:font-weight)                    return 0 ;;
		*text-large-statement.php:font-weight)                return 0 ;;
		*text-large-statement.php:letter-spacing)             return 0 ;;
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

# 1. Block comment JSON — the attribute the editor round-trips. Checked one property
#    at a time so the exemption can be property-specific.
for prop in fontWeight letterSpacing; do
	while IFS= read -r hit; do
		[ -z "$hit" ] && continue
		file="${hit%%:*}"
		exempt "$file" "$prop" && continue
		report "pins ${prop}: ${file}:$(printf '%s' "$hit" | cut -d: -f2)"
	done < <(grep -rnoE "<!-- (${BLOCKS}) [^>]*\"${prop}\"" patterns/ 2>/dev/null || true)
done

# 2. Saved HTML — the half a JSON-only check misses. Removing one and leaving the
#    other desyncs the block while the rendering silently stays wrong.
for prop in font-weight letter-spacing; do
	while IFS= read -r hit; do
		[ -z "$hit" ] && continue
		file="${hit%%:*}"
		exempt "$file" "$prop" && continue
		report "rendered tag sets ${prop}: ${file}:$(printf '%s' "$hit" | cut -d: -f2)"
	done < <(grep -rnoE "<h[1-6][^>]*style=\"[^\"]*${prop}:" patterns/ 2>/dev/null || true)
done

# 3. The accordion question carries its tracking on an inner span, not the block.
while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	report "accordion span still tracked: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE 'toggle-title" style="letter-spacing' patterns/ 2>/dev/null || true)

# 4. A heading's size must be a preset. A hand-written clamp scales on its own terms
#    and cannot be changed from the theme. Both halves are checked: the size can
#    desync exactly the way weight and tracking can.
while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	report "raw font size on a heading: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE "<!-- (${BLOCKS}) [^>]*\"fontSize\":\"(clamp|[0-9]|var)" patterns/ 2>/dev/null || true)

while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	report "raw font size on a rendered heading: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE '<h[1-6][^>]*style="[^"]*font-size:[[:space:]]*(clamp|[0-9]|var)' patterns/ 2>/dev/null || true)

# 5. Weight AND tracking live at one node. Either pinned per level defeats a variation
#    that sets it, so both are checked and both must be present on the base.
python3 - <<'PY' || status=1
import json, sys
d = json.load(open('theme.json'))
e = d['styles']['elements']
fail = False
for prop in ('fontWeight', 'letterSpacing'):
    bad = [k for k in ('h1','h2','h3','h4','h5','h6')
           if prop in e.get(k, {}).get('typography', {})]
    if bad:
        print('  ✗  per-level heading %s pin: %s' % (prop, ', '.join(bad)))
        fail = True
    if e['heading']['typography'].get(prop) is None:
        print('  ✗  elements.heading has no %s — the single lever is missing' % prop)
        fail = True
sys.exit(1 if fail else 0)
PY

if [ $status -eq 0 ]; then
	echo "Heading pins:"
	echo "  ✓  no pattern heading pins weight or tracking (statement register excepted)"
	echo "  ✓  every heading size is a preset, in the block and in the saved markup"
	echo "  ✓  heading weight and tracking live only at styles.elements.heading"
fi

exit $status
