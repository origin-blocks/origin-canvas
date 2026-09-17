#!/usr/bin/env bash
#
# Three style variations come in pairs: a full variation (palette and type together) and
# a typography variation that is the same type without the palette — editorial and
# serif-headings, expressive and space-grotesk, refined-sans and dm-sans. Nothing in
# theme.json ties a pair together, so a value changed in one file silently drifts from
# its twin. This fails the build when a pair no longer agrees.
#
# The contract is exact: the typography file equals the full file with `title` and
# `settings.color` removed. Every other node, down to the value, must match.
#
# Run from the theme root:  bash bin/check-variation-twins.sh

set -euo pipefail
cd "$(dirname "$0")/.."

python3 - <<'PY'
import json, sys

PAIRS = (
    ('styles/editorial.json',    'styles/typography/serif-headings.json'),
    ('styles/expressive.json',   'styles/typography/space-grotesk.json'),
    ('styles/refined-sans.json', 'styles/typography/dm-sans.json'),
)

def first_difference(a, b, path=''):
    """The first path where two JSON trees disagree, or None."""
    if isinstance(a, dict) and isinstance(b, dict):
        for key in sorted(set(a) | set(b)):
            here = '%s.%s' % (path, key) if path else key
            if key not in a:
                return here, '(absent)', b[key]
            if key not in b:
                return here, a[key], '(absent)'
            found = first_difference(a[key], b[key], here)
            if found:
                return found
        return None
    if isinstance(a, list) and isinstance(b, list):
        if len(a) != len(b):
            return path, '%d items' % len(a), '%d items' % len(b)
        for i, (x, y) in enumerate(zip(a, b)):
            found = first_difference(x, y, '%s[%d]' % (path, i))
            if found:
                return found
        return None
    # JSON types must match too: Python reads 1 == True and 0 == False as equal.
    if type(a) is not type(b) or a != b:
        return path, a, b
    return None

fail = False
print('Variation twins:')
for full_path, type_path in PAIRS:
    full = json.load(open(full_path))
    typo = json.load(open(type_path))
    expected = {k: v for k, v in full.items() if k != 'title'}
    if 'settings' in expected:
        expected['settings'] = {k: v for k, v in expected['settings'].items() if k != 'color'}
    actual = {k: v for k, v in typo.items() if k != 'title'}
    found = first_difference(expected, actual)
    if found:
        where, a, b = found
        print('  ✗  %s and %s differ at %s' % (full_path, type_path, where))
        print('       %s: %s' % (full_path, json.dumps(a)))
        print('       %s: %s' % (type_path, json.dumps(b)))
        fail = True
    else:
        print('  ✓  %s ≡ %s (minus title and settings.color)' % (full_path, type_path))
sys.exit(1 if fail else 0)
PY
