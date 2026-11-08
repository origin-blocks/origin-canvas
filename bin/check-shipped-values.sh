#!/usr/bin/env bash
#
# Shipped values stay supported (#130). Canvas runs on live wordpress.org installs, and
# the dev database proves nothing: assume every slug, preset and class a release shipped
# is saved in someone's content. A rename or a removal breaks that content without a
# warning (a wp:pattern reference renders nothing, a preset var resolves to nothing, a
# class loses its look), so it needs a render-time shim, CSS or a render_block filter,
# with a sunset note. Never a $wpdb query or a content change in the theme: the #116 migration
# lives in a separate plugin (bin/check-palette-names.sh holds that boundary). A shipped
# pattern slug is never renamed.
#
# This compares the working tree with the latest release tag and fails on any value that
# release had and the tree has lost. Every release passed this check against the one
# before it, so the chain covers every release; what an older release lost is history,
# not listed here.
#   pattern     a Slug in patterns/
#   template    a file in templates/, or a customTemplates name in theme.json
#   part        a file in parts/, or a templateParts name in theme.json
#   preset      a palette, gradient, duotone, font size, font family, spacing or shadow slug;
#               a renamed one passes while inc/palette-map.php maps it to a preset the tree
#               still has
#   custom      a settings.custom value in theme.json, as the --wp--custom--… variable
#               WordPress prints for it; pattern markup writes these into saved content. A
#               renamed line height passes as a renamed preset does
#   rename      an old => new line in inc/palette-map.php: it keeps names from before the
#               #116 rename working in saved content, so dropping one is a loss
#   style       a block style name registered in functions.php; a style dropped from the
#               Styles list passes while its is-style- class is still styled (the shim)
#   class       an origin-canvas- or is-style-origin-canvas- class styled in the theme's
#               CSS, or a block style variation in theme.json
# Two lists hold removals since the latest release, each entry with its reason:
#   RETIRED   decided: the owner accepted the break.
#   PENDING   waiting on a decision: a shim with a sunset, or acceptance. They pass day to
#             day and fail with --release, so none ships undecided.
# An entry the latest release no longer has is history: the check fails until it is taken
# off its list.
#
# Run from the theme root:  bash bin/check-shipped-values.sh [--release]

set -euo pipefail
cd "$(dirname "$0")/.."

[ -n "$(git tag --list '[0-9]*.[0-9]*.[0-9]*')" ] || {
	echo "check-shipped-values.sh: no release tags. Run git fetch --tags." >&2
	exit 1
}

python3 -B - "$@" <<'PY'
import glob, json, os, re, subprocess, sys

release = '--release' in sys.argv[1:]
tags = subprocess.run(['git', 'tag', '--list', '[0-9]*.[0-9]*.[0-9]*', '--sort=v:refname'],
                      capture_output=True, text=True, check=True).stdout.split()

# Removed on develop since the latest release, decided: value -> the reason.
RETIRED = {}

# Removed on develop since the latest release, waiting on a decision: value -> what is
# waiting.
PENDING = {}

CLASS = re.compile(r'\.((?:is-style-)?origin-canvas-[a-z0-9_-]+)')
SLUG = re.compile(r'^[ \t/*#@]*Slug:\s*(\S+)', re.M | re.I)
STYLES = re.compile(r'function origin_canvas_register_block_styles\(.*?\n}', re.S)
PRESETS = {
    'color': ('color', 'palette'), 'gradient': ('color', 'gradients'),
    'duotone': ('color', 'duotone'), 'font-size': ('typography', 'fontSizes'),
    'font-family': ('typography', 'fontFamilies'), 'spacing': ('spacing', 'spacingSizes'),
    'shadow': ('shadow', 'presets'),
}

def kebab(key):
    """WordPress's _wp_to_kebab_case: lineHeight -> line-height, medium-large stays."""
    words = re.findall(r'[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+', key)
    return '-'.join(w.lower() for w in words)

def custom_vars(node, path=()):
    """Every settings.custom leaf as the CSS variable WordPress prints for it."""
    if isinstance(node, dict):
        for k, v in node.items():
            yield from custom_vars(v, path + (kebab(k),))
    elif path:
        yield '--wp--custom--' + '--'.join(path)

def palette_map(text):
    """The #116 rename: kind -> {old: new}, from inc/palette-map.php (one 'old' => 'new' per line).
    lineHeight names a settings.custom.lineHeight key."""
    out = {}
    for kind in ('color', 'spacing', 'lineHeight'):
        m = re.search(r"'%s'\s*=>\s*array\((.*?)\)," % kind, text, re.S)
        out[kind] = dict(re.findall(r"'([a-z0-9-]+)'\s*=>\s*'([a-z0-9-]+)',", m.group(1))) if m else {}
    return out

RENAMED = palette_map(open('inc/palette-map.php').read() if os.path.exists('inc/palette-map.php') else '')

class Tree:
    """The theme's files at a tag, or on disk when ref is None."""
    def __init__(self, ref):
        self.ref = ref
        if ref:
            out = subprocess.run(['git', 'ls-tree', '-r', '--name-only', ref],
                                 capture_output=True, text=True, check=True).stdout
            self.files = out.split()
        else:
            self.files = [os.path.relpath(os.path.join(d, f)) for d, _, fs in os.walk('.')
                          for f in fs]
            self.files = [f for f in self.files if not f.startswith(('.git', 'node_modules'))]

    def read(self, path):
        if self.ref:
            r = subprocess.run(['git', 'show', '%s:%s' % (self.ref, path)],
                               capture_output=True, text=True)
            return r.stdout if r.returncode == 0 else ''
        return open(path).read() if os.path.exists(path) else ''

def values(tree):
    found = set()
    for f in tree.files:
        top, name = f.split('/', 1) if '/' in f else ('', f)
        if top == 'patterns' and f.endswith('.php'):
            m = SLUG.search(tree.read(f)[:8192])
            if m:
                found.add('pattern ' + m.group(1))
        elif top in ('templates', 'parts') and f.endswith('.html') and '/' not in name:
            found.add('%s %s' % (top[:-1], name[:-5]))
        elif f.endswith('.css') and not f.startswith(('bin/', 'tests/')):
            found.update('class ' + c for c in CLASS.findall(tree.read(f)))
    try:
        theme = json.loads(tree.read('theme.json'))
    except ValueError:
        theme = {}
    settings = theme.get('settings', {})
    for kind, (group, key) in PRESETS.items():
        for preset in settings.get(group, {}).get(key, []) or []:
            found.add('preset %s %s' % (kind, preset['slug']))
    found.update('custom ' + v for v in custom_vars(settings.get('custom', {})))
    for kind, pairs in palette_map(tree.read('inc/palette-map.php')).items():
        found.update('rename %s %s' % (kind, old) for old in pairs)
    found.update('part ' + p['name'] for p in theme.get('templateParts', []))
    found.update('template ' + t['name'] for t in theme.get('customTemplates', []))
    for block in theme.get('styles', {}).get('blocks', {}).values():
        found.update('class is-style-' + v for v in block.get('variations', {}))
    m = STYLES.search(tree.read('functions.php'))
    if m:
        found.update('style ' + s for s in re.findall(r"'name'\s*=>\s*'([a-z0-9-]+)'", m.group(0)))
    return found

latest = tags[-1]
shipped = values(Tree(latest))
now = values(Tree(None))
fail = False
print('Shipped values (release %s):' % latest)
for value in sorted(shipped - now):
    kind, _, name = value.partition(' ')
    sub, _, old = name.partition(' ')
    line_old = name[len('--wp--custom--line-height--'):]
    if kind == 'style' and 'class is-style-' + name in now:
        print('  ✓  %s left the Styles list; its class is still styled' % value)
    elif kind == 'preset' and old in RENAMED.get(sub, {}) and 'preset %s %s' % (sub, RENAMED[sub][old]) in now:
        print('  ✓  preset %s %s is renamed to %s; inc/palette-map.php maps it (#116)' % (sub, old, RENAMED[sub][old]))
    elif (kind == 'custom' and name.startswith('--wp--custom--line-height--')
          and line_old in RENAMED['lineHeight']
          and 'custom --wp--custom--line-height--' + RENAMED['lineHeight'][line_old] in now):
        print('  ✓  custom %s is renamed to --wp--custom--line-height--%s; inc/palette-map.php maps it (#116)'
              % (name, RENAMED['lineHeight'][line_old]))
    elif value in RETIRED:
        print('  ~  %s is retired: %s' % (value, RETIRED[value]))
    elif value in PENDING:
        print('  %s  %s is gone: %s' % ('✗' if release else '!', value, PENDING[value]))
        fail = fail or release
    else:
        print('  ✗  %s shipped in %s and is gone: restore it, shim it, or list it with its '
              'reason' % (value, latest))
        fail = True
for value in sorted(list(RETIRED) + list(PENDING)):
    if value in now:
        print('  ✗  %s is listed as gone but is back; take it off the list' % value)
        fail = True
    elif value not in shipped:
        print('  ✗  %s is listed, but %s does not have it: it is history, take it off the list'
              % (value, latest))
        fail = True
if fail:
    sys.exit(1)
print('  ✓  %d values from %s are still supported%s' % (len(shipped & now), latest,
      ', %d pending' % len(PENDING) if PENDING else ''))
PY
