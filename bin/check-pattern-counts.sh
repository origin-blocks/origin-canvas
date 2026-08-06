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

# Inserter-visible patterns: everything in patterns/ that does not opt out. WordPress
# treats no/false/0 as opting out, and this theme writes "no"; the hidden-* filename
# prefix is a convention, not the mechanism, so match on the header itself.
patterns=0
for file in patterns/*.php; do
	if grep -Eqi '^ \* Inserter: *(no|false|0) *$' "$file"; then
		continue
	fi
	patterns=$((patterns + 1))
done

# Distinct categories, counted only from the patterns a user can actually insert — the
# same set as above, so the two numbers can never disagree about what counts.
categories=$(for file in patterns/*.php; do
	grep -Eqi '^ \* Inserter: *(no|false|0) *$' "$file" && continue
	grep -h '^ \* Categories:' "$file"
done | sed 's/.*Categories: *//' | tr ',' '\n' | sed 's/^ *//;s/ *$//' |
	grep -v '^$' | sort -u | wc -l | tr -d ' ')

status=0

# Check EVERY claim, not just the first in a file: a second sentence quoting a stale
# number would otherwise hide behind a correct one earlier in the same file.
check() {
	local label="$1" actual="$2" found=0

	while IFS= read -r hit; do
		found=$((found + 1))
		local file="${hit%%:*}" rest="${hit#*:}"
		local line="${rest%%:*}" claimed="${rest#*:}"
		claimed="${claimed%%[!0-9]*}"
		if [ "$claimed" != "$actual" ]; then
			echo "  ✗  $file:$line — says $claimed $label, found $actual"
			status=1
		else
			echo "  ✓  $file:$line — $actual $label"
		fi
	# Case-insensitive, tolerant of extra spacing, and matches the singular too, so a
	# stale "14 Category" or "61  patterns" cannot slip past a green run.
	done < <(grep -Eino "[0-9]+[[:space:]]+${label%s}s?" patterns/*.php readme.txt 2>/dev/null)

	if [ "$found" -eq 0 ]; then
		echo "  ?  no '$label' count found anywhere — did the copy change?"
		status=1
	fi
}

echo "Pattern inventory:"
check patterns   "$patterns"
check categories "$categories"

if [ "$status" -ne 0 ]; then
	echo
	echo "Counts in user-facing copy no longer match the theme. Update the copy above."
fi

exit "$status"
