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
# This compares the working tree with every release tag and fails on any value a release
# had that the tree has lost:
#   pattern     a Slug in patterns/
#   template    a file in templates/, or a customTemplates name in theme.json
#   part        a file in parts/, or a templateParts name in theme.json
#   preset      a palette, gradient, duotone, font size, font family, spacing or shadow slug
#   style       a block style name registered in functions.php; a style dropped from the
#               Styles list passes while its is-style- class is still styled (the shim)
#   class       an origin-canvas- or is-style-origin-canvas- class styled in the theme's
#               CSS, or a block style variation in theme.json
# Two lists hold the exceptions, each entry with its reason:
#   RELEASED  removals that already shipped in a release, without a shim. Restoring them
#             now would change pages users have already updated (orchestrator decision,
#             #130).
#   PENDING   removals on develop since the latest release that wait on a decision: a
#             shim with a sunset, or a ruling that accepts the break. They pass day to day
#             and fail with --release, so none ships undecided. A decided removal moves
#             to RETIRED with its ruling.
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

# Removed in a release, without a shim: value -> the release it left, and why. Each one
# left two to five releases ago; restoring it now would change pages users have already
# updated, so it stays gone (orchestrator decision, #130).
RELEASED = {
    'style blur-image-less': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style blur-image-more': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style dark-code': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style excerpt-truncate-2': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style excerpt-truncate-3': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style list-check': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style list-check-circle': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style media-boxed': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style outline-strong': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style preformatted-dark': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style rounded-full': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style separator-dotted': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style separator-thin': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'style term-button': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'class is-style-outline-strong': '1.0.2, block styles renamed with the origin-canvas- prefix',
    'class is-style-wire': '1.0.2',
    'class is-style-origin-canvas-icon-accessibility': '1.0.3',
    'class is-style-origin-canvas-icon-compass': '1.0.3',
    'class is-style-origin-canvas-icon-contrast': '1.0.3',
    'class is-style-origin-canvas-icon-layers': '1.0.3',
    'class is-style-origin-canvas-icon-layout-dashboard': '1.0.3',
    'class is-style-origin-canvas-icon-monitor-smartphone': '1.0.3',
    'class is-style-origin-canvas-icon-palette': '1.0.3',
    'class is-style-origin-canvas-icon-ruler': '1.0.3',
    'class is-style-origin-canvas-icon-type': '1.0.3',
    'class is-style-origin-canvas-icon-zap': '1.0.3',
    'template home': '1.0.4',
    'class is-style-origin-canvas-term-button': '1.1.0',
    'style origin-canvas-term-button': '1.1.0',
    'pattern origin-canvas/hidden-home': '1.1.0, the front page became the user\'s own page',
    'template front-page': '1.1.0, the front page became the user\'s own page',
    'pattern origin-canvas/page-home-01': '1.2.0, renamed page-studio (CLAUDE.md rule 3)',
    'class origin-canvas-post-grid-arrow': '1.2.0',
    'class origin-canvas-post-grid-card': '1.2.0',
    'class origin-canvas-post-grid-category': '1.2.0',
    'class origin-canvas-post-grid-content': '1.2.0',
    'class origin-canvas-post-grid-excerpt': '1.2.0',
    'class origin-canvas-post-grid-footer': '1.2.0',
    'class origin-canvas-post-grid-title': '1.2.0',
    'preset font-family display': '1.3.0',
}

# Removed on develop since the latest release, decided: value -> the ruling.
RETIRED = {
    # Landing showcase only (Inserter false): the loss is accepted (orchestrator
    # decision, #130).
    'class origin-canvas-group-head': 'landing showcase only, loss accepted',
    'class origin-canvas-type-ramp': 'landing showcase only, loss accepted',
    # Its one rule never applied: core's position: absolute outranked it and the flyout
    # card already sets the z-index (b50f5cb), so no saved page changes.
    'class origin-canvas-main-nav': 'its rule had no effect, nothing to keep',
}

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

shipped = {}
for tag in tags:
    for value in values(Tree(tag)):
        shipped[value] = tag  # the last release that had it
now = values(Tree(None))
fail = False
released = 0
print('Shipped values (releases %s to %s):' % (tags[0], tags[-1]))
for value in sorted(set(shipped) - now):
    if value.startswith('style ') and 'class is-style-' + value[6:] in now:
        print('  ✓  %s left the Styles list; its class is still styled' % value)
    elif value in RELEASED and shipped[value] != tags[-1]:
        released += 1
    elif value in RETIRED:
        print('  ~  %s last shipped in %s and is retired: %s' % (value, shipped[value],
                                                               RETIRED[value]))
    elif value in PENDING:
        print('  %s  %s last shipped in %s and is gone: %s' % ('✗' if release else '!', value,
                                                 shipped[value], PENDING[value]))
        fail = fail or release
    else:
        print('  ✗  %s shipped in %s and is gone: restore it, shim it, or list it with its '
              'reason' % (value, shipped[value]))
        fail = True
stale = sorted(v for v in list(RELEASED) + list(RETIRED) + list(PENDING) if v in now)
for value in stale:
    print('  ✗  %s is listed as gone but is back; take it off the list' % value)
    fail = True
if fail:
    sys.exit(1)
print('  ✓  %d values from the releases are still supported; %d left in a past release '
      '(RELEASED)%s' % (len(set(shipped) & now), released,
                        ', %d pending' % len(PENDING) if PENDING else ''))
PY
