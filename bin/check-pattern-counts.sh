#!/usr/bin/env bash
#
# The showcase and pricing patterns quote how many patterns and categories the theme
# ships. Those numbers are prose, so nothing stops them drifting when a batch lands —
# and they have drifted before. This counts what is actually on disk and fails if the
# copy disagrees.
#
# Run from the theme root:  bash bin/check-pattern-counts.sh

set -euo pipefail
cd "$(dirname "$0")/.."

# Inserter-visible patterns: everything in patterns/ except the hidden template
# scaffolds and anything that opts out.
patterns=0
for file in patterns/*.php; do
	case "$(basename "$file")" in hidden-*) continue ;; esac
	grep -q 'Inserter: *false' "$file" || patterns=$((patterns + 1))
done

# Distinct categories in use, ignoring the bare "hidden" bucket the scaffolds sit in.
categories=$(grep -h '^ \* Categories:' patterns/*.php |
	sed 's/.*Categories: *//' | tr ',' '\n' | sed 's/^ *//;s/ *$//' |
	grep -v '^hidden$' | grep -v '^$' | sort -u | wc -l | tr -d ' ')

status=0

check() {
	local label="$1" actual="$2" file="$3" pattern="$4"
	local claimed
	claimed=$(grep -o "$pattern" "$file" | head -1 | grep -o '[0-9]\+' || true)
	if [ -z "$claimed" ]; then
		echo "  ?  $file — no $label count found (did the copy change?)"
		status=1
	elif [ "$claimed" != "$actual" ]; then
		echo "  ✗  $file — says $claimed $label, found $actual"
		status=1
	else
		echo "  ✓  $file — $actual $label"
	fi
}

echo "Pattern inventory:"
check patterns   "$patterns"   patterns/pattern-showcase.php '[0-9]\+ patterns'
check categories "$categories" patterns/pattern-showcase.php '[0-9]\+ categories'
check patterns   "$patterns"   patterns/product-grid.php     '[0-9]\+ patterns'

if [ "$status" -ne 0 ]; then
	echo
	echo "Counts in user-facing copy no longer match the theme. Update the copy above."
fi

exit "$status"
