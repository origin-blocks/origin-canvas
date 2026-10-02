#!/usr/bin/env bash
#
# hero-centered-logos reuses logos-row's six client marks at the same widths, so the
# two rows read as one set wherever a page shows both. Nothing in WordPress ties them
# together: the widths are per-image block settings in two separate files, free to
# drift the next time either pattern is touched. This compares them.
#
# Each image carries its width twice — once as the block attribute WordPress validates
# against (`"width":"137px"`) and once as the inline style the front end renders
# (`style="width:137px"`). They are checked against each other as well, since an edit
# that moves only one leaves the editor and the page disagreeing.
#
# Run from the theme root:  bash bin/check-logo-widths.sh

set -euo pipefail
cd "$(dirname "$0")/.."

# One "logo-name.png width" line per image, in document order, read from the inline
# style on the img tag (filename and style share that line).
rendered_widths() {
	sed -nE 's|.*/(logo-[a-z-]+\.png)".*style="width:([0-9]+)px".*|\1 \2|p' "$1"
}

# The block attribute widths, in document order.
attribute_widths() {
	sed -nE 's|.*"width":"([0-9]+)px".*|\1|p' "$1"
}

fail=0
report() {
	echo "FAIL: $1" >&2
	fail=1
}

a=patterns/logos-row.php
b=patterns/hero-centered-logos.php

for f in "$a" "$b"; do
	if [[ ! -f $f ]]; then
		echo "check-logo-widths: $f is missing." >&2
		exit 1
	fi
	count=$( rendered_widths "$f" | wc -l | tr -d ' ' )
	if [[ $count -ne 6 ]]; then
		report "$f lists $count logos, expected 6. Update this check if the set changed."
	fi
	if ! diff -q <( rendered_widths "$f" | awk '{print $2}' ) <( attribute_widths "$f" ) > /dev/null; then
		report "$f has an image whose \"width\" attribute and inline style disagree."
	fi
done

if ! diff -u <( rendered_widths "$a" ) <( rendered_widths "$b" ) > /tmp/logo-widths.$$.diff; then
	report "the logo rows disagree (- logos-row, + hero-centered-logos):"
	cat "/tmp/logo-widths.$$.diff" >&2
fi
rm -f "/tmp/logo-widths.$$.diff"

if [[ $fail -ne 0 ]]; then
	exit 1
fi

echo "Logo widths match across logos-row and hero-centered-logos."
