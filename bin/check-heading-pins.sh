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
# its identity, so it pins weight (and, in one file, the tracking that rides with it).
EXEMPT='patterns/(breath-statement|text-large-statement)\.php'

# Every block that renders as a heading. A wp:heading-only sweep once missed twelve
# nodes across the other three, which is why they are named individually here.
BLOCKS='wp:heading|wp:accordion-heading|wp:query-title|wp:post-title'

report() {
	printf '  ✗  %s\n' "$1"
	status=1
}

# 1. Block comment JSON — the attribute the editor round-trips.
while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	printf '%s' "$hit" | grep -qE "$EXEMPT" && continue
	report "pins weight or tracking: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE "<!-- (${BLOCKS}) [^>]*(fontWeight|letterSpacing)[^>]*>" patterns/ 2>/dev/null || true)

# 2. Saved HTML — the half a JSON-only check misses. Removing one and leaving the
#    other desyncs the block while the rendering silently stays wrong.
while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	printf '%s' "$hit" | grep -qE "$EXEMPT" && continue
	report "rendered tag still styled: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE '<h[1-6][^>]*style="[^"]*(font-weight|letter-spacing)' patterns/ 2>/dev/null || true)

# 3. The accordion question carries its tracking on an inner span, not the block.
while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	report "accordion span still tracked: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE 'toggle-title" style="letter-spacing' patterns/ 2>/dev/null || true)

# 4. A heading's size must be a preset. A hand-written clamp scales on its own terms
#    and cannot be changed from the theme.
while IFS= read -r hit; do
	[ -z "$hit" ] && continue
	report "raw font size on a heading: ${hit%%:*}:$(printf '%s' "$hit" | cut -d: -f2)"
done < <(grep -rnoE "<!-- (${BLOCKS}) [^>]*\"fontSize\":\"(clamp|[0-9])" patterns/ 2>/dev/null || true)

# 5. Weight lives at one node. A per-level pin defeats any variation that sets it.
python3 - <<'PY' || status=1
import json, sys
d = json.load(open('theme.json'))
e = d['styles']['elements']
bad = [k for k in ('h1','h2','h3','h4','h5','h6')
       if 'fontWeight' in e.get(k, {}).get('typography', {})]
if bad:
    print('  ✗  per-level heading weight pin: %s' % ', '.join(bad))
    sys.exit(1)
if e['heading']['typography'].get('fontWeight') is None:
    print('  ✗  elements.heading has no fontWeight — the single lever is missing')
    sys.exit(1)
PY

if [ $status -eq 0 ]; then
	echo "Heading pins:"
	echo "  ✓  no pattern heading pins weight or tracking (statement register excepted)"
	echo "  ✓  every heading size is a preset"
	echo "  ✓  heading weight lives only at styles.elements.heading"
fi

exit $status
