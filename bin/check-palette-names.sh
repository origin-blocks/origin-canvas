#!/usr/bin/env bash
#
# The palette rename (#116) holds: no old colour, spacing or line height code is left in the
# theme outside the compatibility layer, and the theme runs no direct queries.
#
# The codes were renamed, not only the labels (owner ruling, #116). Saved 1.3.1 sites keep
# rendering through the aliases in inc/palette-aliases.php and assets/css/palette-aliases.css;
# the theme's own files use the new codes only. The old codes are read from inc/palette-map.php,
# the one map.
#
# Fails on, in every tracked file except inc/palette-*.php, assets/css/palette-aliases.css (the
# built twin rules, which name the old classes on purpose), bin/ and readme.txt (its changelog is
# history):
#   var:preset|color|<old>, --wp--preset--color--<old> (raw or with "--" encoded as core saves
#   it in block attributes), has-<old>-color|background-color|border-color (never core's
#   generic has-border-color), an old slug as a value in a block comment's attribute JSON
#   (`: "<old>"`, any space after the colon: "border": is a style key in patterns and
#   theme.json, while "textColor": "border" is a value), var:preset|spacing|compact,
#   --wp--preset--spacing--compact, var:custom|line-height|body and
#   --wp--custom--line-height--body.
# And on $wpdb in any PHP file: the content migration lives in a separate plugin.
#
# Run from the theme root:  bash bin/check-palette-names.sh

set -euo pipefail
cd "$(dirname "$0")/.."

python3 -B - "$@" <<'PY'
import re, subprocess, sys

text = open('inc/palette-map.php').read()
old = {}
for kind in ('color', 'spacing', 'lineHeight'):
    m = re.search(r"'%s'\s*=>\s*array\((.*?)\)," % kind, text, re.S)
    old[kind] = [o for o, _ in re.findall(r"'([a-z0-9-]+)'\s*=>\s*'([a-z0-9-]+)',", m.group(1))] if m else []
if not old['color']:
    print('check-palette-names.sh: no colour map in inc/palette-map.php', file=sys.stderr)
    sys.exit(1)

colour = '|'.join(re.escape(o) for o in sorted(old['color'], key=len, reverse=True))
spacing = '|'.join(re.escape(o) for o in old['spacing'])
line = '|'.join(re.escape(o) for o in old['lineHeight'])
END = r'(?![a-z0-9-])'
ENC = r'\\u002d\\u002d'
FORMS = [
    re.compile(r'var:preset\|color\|(?:%s)%s' % (colour, END)),
    re.compile(r'--wp--preset--color--(?:%s)%s' % (colour, END)),
    re.compile(ENC + 'wp' + ENC + 'preset' + ENC + 'color' + ENC + r'(?:%s)%s' % (colour, END)),
    re.compile(r'(?<![a-z0-9-])has-(?:%s)-(?:color|background-color|border-color)%s' % (colour, END)),
    re.compile(r'var:preset\|spacing\|(?:%s)%s' % (spacing, END)),
    re.compile(r'--wp--preset--spacing--(?:%s)%s' % (spacing, END)),
    re.compile(ENC + 'wp' + ENC + 'preset' + ENC + 'spacing' + ENC + r'(?:%s)%s' % (spacing, END)),
    re.compile(r'var:custom\|line-height\|(?:%s)%s' % (line, END)),
    re.compile(r'--wp--custom--line-height--(?:%s)%s' % (line, END)),
]
VALUE = re.compile(r':\s*"(?:%s)"' % colour)
COMMENT = re.compile(r'<!--\s+/?wp:[a-z][a-z0-9_/-]*\s+(\{.*?\})\s+/?-->', re.S)

files = subprocess.run(['git', 'ls-files'], capture_output=True, text=True, check=True).stdout.split('\n')
hits = []
for path in filter(None, files):
    if path.startswith('bin/') or path in ('readme.txt', 'assets/css/palette-aliases.css') or re.match(r'inc/palette-[^/]*\.php$', path):
        continue
    try:
        body = open(path, encoding='utf-8').read()
    except (UnicodeDecodeError, FileNotFoundError, IsADirectoryError):
        continue
    for rx in FORMS:
        for m in rx.finditer(body):
            if m.group(0) != 'has-border-color':
                hits.append('%s: %s' % (path, m.group(0)))
    for c in COMMENT.finditer(body):
        for m in VALUE.finditer(c.group(1)):
            hits.append('%s: %s' % (path, m.group(0)))

for path in filter(None, files):
    if not path.endswith('.php'):
        continue
    for n, row in enumerate(open(path, encoding='utf-8', errors='replace'), 1):
        if '$wpdb' in row:
            hits.append('%s:%d: $wpdb' % (path, n))

if hits:
    print('Palette names (#116):')
    for h in hits:
        print('  ✗  ' + h)
    sys.exit(1)
print('Palette names (#116):\n  ✓  no old colour, spacing or line height code outside the compatibility layer; no $wpdb')
PY
