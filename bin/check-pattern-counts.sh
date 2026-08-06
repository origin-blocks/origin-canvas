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
# Mirror WordPress exactly (class-wp-theme.php): it scans patterns/ RECURSIVELY, and
# treats Inserter as true only for "yes" or "true" — every other value, including a
# typo, hides the pattern. An absent header defaults to visible.
pattern_files() {
	find patterns -type f -name '*.php' | sort
}

# Read one header field the way WordPress does. get_file_data() matches
# /^(?:[ \t]*<\?(?:php)?)?[ \t\/*#@]*Field:(.*)$/mi over the first 8KB — any mix of
# spaces, tabs, slashes, asterisks, hashes or @ may precede the name, and the match is
# case-insensitive. Anchoring on " * Field:" would miss a legally-formatted header.
header_field() {
	head -c 8192 "$1" | sed -nE "s|^[[:space:]]*(<\\?(php)?)?[[:space:]/*#@]*$2:[[:space:]]*(.*)$|\\3|Ip" | head -1 | sed 's/[[:space:]]*$//'
}

inserter_visible() {
	local v
	v=$(header_field "$1" Inserter)
	[ -z "$v" ] && return 0
	case "$(printf '%s' "$v" | tr '[:upper:]' '[:lower:]')" in
		yes|true) return 0 ;;
		*) return 1 ;;
	esac
}

patterns=0
while IFS= read -r file; do
	if inserter_visible "$file"; then
		patterns=$((patterns + 1))
	fi
done < <(pattern_files)

# Distinct categories, counted only from the patterns a user can actually insert — the
# same set as above, so the two numbers can never disagree about what counts.
categories=$(while IFS= read -r file; do
	if inserter_visible "$file"; then
		header_field "$file" Categories
	fi
done < <(pattern_files) | tr ',' '\n' | sed 's/^ *//;s/ *$//' |
	grep -v '^$' | sort -u | wc -l | tr -d ' ')

status=0

# Check EVERY claim, not just the first in a file: a second sentence quoting a stale
# number would otherwise hide behind a correct one earlier in the same file.
check() {
	local label="$1" actual="$2" found=0 singular

	# English plurals are not a suffix trim — "categories" is singular "category".
	# Matching both, case-insensitively and with loose spacing, means a stale
	# "14 Category" or "61  patterns" cannot slip past a green run.
	case "$label" in
		categories) singular="category" ;;
		*) singular="${label%s}" ;;
	esac

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
	done < <(pattern_files | xargs grep -Eino "[0-9]+[[:space:]]+($label|$singular)" -- 2>/dev/null;
		grep -Eino "[0-9]+[[:space:]]+($label|$singular)" readme.txt 2>/dev/null | sed 's|^|readme.txt:|')

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
