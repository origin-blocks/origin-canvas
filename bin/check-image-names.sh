#!/usr/bin/env bash
#
# Image files in patterns/images/ are named for what they show, never for the pattern,
# slot or category that first used them (CLAUDE.md, Pattern conventions 3b). A photo
# named gallery-proof-wall is welded to one pattern; the same photo named exercise-room
# can serve any pattern. Three things are checked:
#
#   1. Grammar. Lowercase kebab-case, .webp or .png. The name is split on "-" and no
#      token may be the first word of a pattern slug (read from patterns/*.php), a
#      category slug, or a slot word. "avatar", "portrait" and "logo" are kind prefixes,
#      allowed only as the first token.
#   2. References. Every patterns/images/ file named by a pattern, template, part, the
#      demo seed or a readme credit exists, so a mistyped path fails here and not on a
#      visitor's screen.
#   3. Stability. Every name that any release tag shipped in patterns/images/ still
#      exists at HEAD: a user's saved content points at the theme's image URL, so a
#      shipped name never changes before a major version (CONTRIBUTING.md, asset paths).
#
# Exceptions are named below, each with its reason.
#
# Run from the theme root:  bash bin/check-image-names.sh

set -euo pipefail
cd "$(dirname "$0")/.."

[ -n "$(git tag --list '[0-9]*.[0-9]*.[0-9]*')" ] || {
	echo "check-image-names.sh: no release tags. Run git fetch --tags." >&2
	exit 2
}

python3 -B - <<'PY'
import glob, os, re, subprocess, sys

IMAGES = 'patterns/images'

# Names that break the grammar but shipped before the rule existed (1.1.0 to 1.3.1).
# Users' saved content points at them, so they are renamed at 2.0.0, not before.
GRAMMAR_EXCEPTIONS = {
    'card-image-text-1.webp': 'shipped 1.0.0 to 1.4.0; renamed at 2.0.0',
    'card-image-text-2.webp': 'shipped 1.0.0 to 1.4.0; renamed at 2.0.0',
    'card-image-text-3.webp': 'shipped 1.0.0 to 1.4.0; renamed at 2.0.0',
    'card-blog-1.webp': 'shipped 1.0.0 to 1.4.0; renamed at 2.0.0',
    'card-blog-3.webp': 'shipped 1.0.0 to 1.4.0; renamed at 2.0.0',
    'card-testimonial-1.webp': 'shipped 1.0.0 to 1.4.0; renamed at 2.0.0',
}

# Names a release tag shipped that HEAD no longer has. 1.4.0 was published on GitHub on
# 2026-11-01 and never reached wordpress.org; the owner accepted the saved-content risk
# for that day's installs and ruled the rename without a shim (1.4.1 changelog).
STABILITY_EXCEPTIONS = {
    # Removed on 2026-08-07 (4415891) as unused, before 1.3.0; the team patterns of 1.1.0 and
    # 1.2.0 placed it, so content saved from them lost the image then. Recorded, not repaired.
    'card-team-1.webp': 'removed before 1.3.0 as unused (4415891); shipped in 1.1.0 and 1.2.0',
    'gallery-guidelines.webp': 'renamed tax-folder.webp in 1.4.1 (1.4.0 name, owner ruling)',
    'gallery-meeting-table.webp': 'renamed site-visit.webp in 1.4.1 (1.4.0 name, owner ruling)',
    'gallery-paper-stock.webp': 'renamed front-door.webp in 1.4.1 (1.4.0 name, owner ruling)',
    'gallery-proof-wall.webp': 'renamed exercise-room.webp in 1.4.1 (1.4.0 name, owner ruling)',
    'gallery-screen-review.webp': 'renamed yard-sign.webp in 1.4.1 (1.4.0 name, owner ruling)',
    'gallery-studio-shelf.webp': 'renamed service-menus.webp in 1.4.1 (1.4.0 name, owner ruling)',
    'hero-cover-thistle-pine.webp': 'renamed timber-stack.webp in 1.4.1 (1.4.0 name, owner ruling)',
    'feature-split-calder.webp': 'renamed clinic-sign.webp in 1.4.1 (1.4.0 name, owner ruling)',
    'card-image-text-northgate.webp': 'renamed shop-front.webp in 1.4.1 (1.4.0 name, owner ruling)',
    'card-image-text-mercer-street.webp': 'renamed frame-samples.webp in 1.4.1 (1.4.0 name, owner ruling)',
    'card-image-text-linden-lark.webp': 'deleted in 1.4.1; no release ever placed it',
    'testimonial-highlight-1.webp': 'deleted in 1.4.1; no release ever placed it',
    'logo-thistle-pine.png': 'deleted in 1.4.1; no release ever placed it',
    'logo-linden-lark.png': 'deleted in 1.4.1; no release ever placed it',
}

KIND_PREFIXES = {'avatar', 'portrait', 'logo'}
CATEGORY_WORDS = {'hero', 'card', 'features', 'pricing', 'stats', 'faq', 'logos', 'author',
                  'page', 'header', 'footer', 'call', 'action', 'text', 'testimonials',
                  'team', 'posts', 'contact', 'gallery', 'hidden'}
SLOT_WORDS = {'gallery', 'card', 'portrait', 'avatar', 'hero', 'cover'}
PATTERN_WORDS = {os.path.basename(p).split('-')[0].replace('.php', '')
                 for p in glob.glob('patterns/*.php')}
FORBIDDEN = CATEGORY_WORDS | SLOT_WORDS | PATTERN_WORDS
NAME = re.compile(r'^[a-z0-9]+(?:-[a-z0-9]+)*\.(?:webp|png)$')

fail = False
def bad(msg):
    global fail
    fail = True
    print('  ✗  ' + msg)

files = sorted(os.listdir(IMAGES))

# 1. Grammar.
for name in files:
    if name in GRAMMAR_EXCEPTIONS:
        continue
    if not NAME.match(name):
        bad('%s/%s is not lowercase kebab-case .webp or .png' % (IMAGES, name))
        continue
    tokens = name.rsplit('.', 1)[0].split('-')
    for i, token in enumerate(tokens):
        if token in KIND_PREFIXES and i == 0:
            continue
        if token in FORBIDDEN or token in KIND_PREFIXES:
            bad('%s/%s carries "%s", a pattern, slot or category word; name the subject'
                % (IMAGES, name, token))
            break

# 2. References.
present = set(files)
refs = {}
for path in glob.glob('patterns/*.php') + glob.glob('templates/*') + glob.glob('parts/*') + ['readme.txt']:
    for m in re.finditer(r'patterns/images/([A-Za-z0-9_.-]+\.(?:webp|png))', open(path).read()):
        refs.setdefault(m.group(1), set()).add(path)
seed = 'bin/demo/seed.php'
if os.path.exists(seed):
    for m in re.finditer(r"'([A-Za-z0-9_.-]+\.(?:webp|png))'", open(seed).read()):
        refs.setdefault(m.group(1), set()).add(seed)
for name, where in sorted(refs.items()):
    if name not in present:
        bad('%s/%s is named by %s but does not exist' % (IMAGES, name, ', '.join(sorted(where))))

# 3. Stability.
tags = subprocess.run(['git', 'tag', '--list', '[0-9]*.[0-9]*.[0-9]*', '--sort=v:refname'],
                      capture_output=True, text=True, check=True).stdout.split()
shipped = {}
for tag in tags:
    out = subprocess.run(['git', 'ls-tree', '--name-only', tag, IMAGES + '/'],
                         capture_output=True, text=True).stdout.split()
    for path in out:
        shipped.setdefault(os.path.basename(path), tag)
for name, tag in sorted(shipped.items()):
    if name not in present and name not in STABILITY_EXCEPTIONS:
        bad('%s/%s shipped in %s and is gone; a shipped name never changes before a major version'
            % (IMAGES, name, tag))
for name in STABILITY_EXCEPTIONS:
    if name in present:
        bad('%s/%s is listed as renamed or deleted but still exists; drop it from the exception table'
            % (IMAGES, name))

if fail:
    sys.exit(1)
print('Image names:')
print('  ✓  %d files named for their subject, %d references resolve, every name shipped in %s to %s is present'
      % (len(files), len(refs), tags[0], tags[-1]))
PY
