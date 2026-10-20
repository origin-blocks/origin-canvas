#!/usr/bin/env bash
#
# Shipped values stay supported (#130). Canvas runs on live wordpress.org installs, and
# the dev database proves nothing: assume every slug, preset and class a release shipped
# is saved in someone's content. A rename or a removal breaks that content without a
# warning (a wp:pattern reference renders nothing, a preset var resolves to nothing, a
# class loses its look), so it needs a render-time shim, CSS or a render_block filter,
# with a sunset note. Never a $wpdb query or a content change (theme review rules). A
# shipped pattern slug is never renamed.
#
# This compares the working tree with the latest release tag (or the tag given) and fails
# on any value the release had that the tree has lost:
#   pattern     a Slug in patterns/
#   template    a file in templates/, or a customTemplates name in theme.json
#   part        a file in parts/, or a templateParts name in theme.json
#   preset      a palette, gradient, duotone, font size, font family, spacing or shadow slug
#   style       a block style name registered in functions.php; a style dropped from the
#               Styles list passes while its is-style- class is still styled (the shim)
#   class       an origin-canvas- or is-style-origin-canvas- class styled in the theme's
#               CSS, or a block style variation in theme.json
# A value retired on purpose goes in RETIRED below with its reason: the shim and its
# sunset, or the ruling that accepts the break.
#
# Run from the theme root:  bash bin/check-shipped-values.sh [tag]

set -euo pipefail
cd "$(dirname "$0")/.."

TAG="${1:-$(git tag --list '[0-9]*.[0-9]*.[0-9]*' --sort=-v:refname | head -1)}"
git rev-parse -q --verify "$TAG^{commit}" >/dev/null || {
	echo "check-shipped-values.sh: no release tag $TAG. Run git fetch --tags." >&2
	exit 1
}

python3 -B - "$TAG" <<'PY'
import glob, json, os, re, subprocess, sys

tag = sys.argv[1]

# value -> why it may be gone. Each entry names its shim and sunset, or its ruling.
RETIRED = {
    # Styled in 1.3.1; develop moved each look into block settings or a utility and
    # dropped the class's CSS, so a copy saved from 1.3.1 renders differently. Waiting on
    # the owner: add a shim or accept the change (#130).
    'class origin-canvas-card-blog-image': 'pending owner, #130',
    'class origin-canvas-group-head': 'pending owner, #130',
    'class origin-canvas-main-nav': 'pending owner, #130',
    'class origin-canvas-process-step-number': 'pending owner, #130',
    'class origin-canvas-sidebar-categories': 'pending owner, #130',
    'class origin-canvas-testimonial-card': 'pending owner, #130',
    'class origin-canvas-type-ramp': 'pending owner, #130',
}

CLASS = re.compile(r'\.((?:is-style-)?origin-canvas-[a-z0-9_-]+)')
SLUG = re.compile(r'^[ \t/*#@]*Slug:\s*(\S+)', re.M | re.I)
STYLES = re.compile(r'function origin_canvas_register_block_styles\(.*?\n}', re.S)
PRESETS = {
    'color': ('color', 'palette'), 'gradient': ('color', 'gradients'),
    'duotone': ('color', 'duotone'), 'font-size': ('typography', 'fontSizes'),
    'font-family': ('typography', 'fontFamilies'), 'spacing': ('spacing', 'spacingSizes'),
    'shadow': ('shadow', 'presets'),
}

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
    found.update('part ' + p['name'] for p in theme.get('templateParts', []))
    found.update('template ' + t['name'] for t in theme.get('customTemplates', []))
    for block in theme.get('styles', {}).get('blocks', {}).values():
        found.update('class is-style-' + v for v in block.get('variations', {}))
    m = STYLES.search(tree.read('functions.php'))
    if m:
        found.update('style ' + s for s in re.findall(r"'name'\s*=>\s*'([a-z0-9-]+)'", m.group(0)))
    return found

shipped, now = values(Tree(tag)), values(Tree(None))
fail = False
print('Shipped values (since %s):' % tag)
for value in sorted(shipped - now):
    if value.startswith('style ') and 'class is-style-' + value[6:] in now:
        print('  ✓  %s left the Styles list; its class is still styled' % value)
    elif value in RETIRED:
        print('  ~  %s is gone: %s' % (value, RETIRED[value]))
    else:
        print('  ✗  %s shipped in %s and is gone: restore it, shim it, or list it in RETIRED '
              'with its reason' % (value, tag))
        fail = True
if fail:
    sys.exit(1)
print('  ✓  %d values from %s are still supported' % (len(shipped & now), tag))
PY
