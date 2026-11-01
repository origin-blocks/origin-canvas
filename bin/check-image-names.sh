#!/usr/bin/env bash
#
# Image files in patterns/images/ are named for what they show, never for the pattern,
# slot or category that first used them (CLAUDE.md, Pattern conventions 3b). A photo
# named gallery-proof-wall is welded to one pattern; the same photo named exercise-room
# can serve any pattern. Three things are checked:
#
#   1. Grammar. Lowercase kebab-case; logos are .png and everything else .webp. The name is
#      split on "-" and no token may be the first word of a pattern slug (read from the
#      Slug header of every patterns/*.php), a category slug, or a slot word. "avatar",
#      "portrait" and "logo" are kind prefixes, allowed only as the first token and only
#      with a subject after them. Whether a name fits its picture is a reviewer's read.
#   2. References. Every patterns/images/ path written in a pattern, template, part or
#      readme credit is a well-formed name of a file that exists, so a mistyped path
#      fails here and not on a visitor's screen. The demo seed's image table is read the
#      same way: the first string of each entry is a file name, however it is spelled.
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
SLUG = re.compile(r'^[ \t*]*Slug:\s*origin-canvas/([a-z0-9]+)', re.M)
PATTERN_WORDS = set()
for p in glob.glob('patterns/*.php'):
    m = SLUG.search(open(p).read())
    if m:
        PATTERN_WORDS.add(m.group(1))
FORBIDDEN = CATEGORY_WORDS | SLOT_WORDS | PATTERN_WORDS
NAME = re.compile(r'^[a-z0-9]+(?:-[a-z0-9]+)*\.(?:webp|png)$')

def grammar(name):
    """The reason a name breaks the grammar, or None."""
    if not NAME.match(name):
        return 'is not lowercase kebab-case .webp or .png'
    stem, ext = name.rsplit('.', 1)
    tokens = stem.split('-')
    if tokens[0] == 'logo' and ext != 'png':
        return 'is a logo, which is .png'
    if tokens[0] != 'logo' and ext != 'webp':
        return 'is a photo, which is .webp'
    if tokens[0] in KIND_PREFIXES and len(tokens) < 2:
        return 'is a kind prefix with no subject after it'
    for i, token in enumerate(tokens):
        if token in KIND_PREFIXES and i == 0:
            continue
        if token in FORBIDDEN or token in KIND_PREFIXES:
            return 'carries "%s", a pattern, slot or category word; name the subject' % token
    return None

fail = False
def bad(msg):
    global fail
    fail = True
    print('  ✗  ' + msg)

files = sorted(os.listdir(IMAGES))

# 1. Grammar.
checked = 0
for name in files:
    if name in GRAMMAR_EXCEPTIONS:
        continue
    checked += 1
    reason = grammar(name)
    if reason:
        bad('%s/%s %s' % (IMAGES, name, reason))

# 2. References. In markup the path runs to the closing quote, so any trailing typo
# (timber-stack.webp2, timber-stack.webp.) or wrong extension (.wepb) is the whole name and
# fails the grammar instead of matching a real file by prefix. In the readme only a credit's
# "(patterns/images/<file>)" is a reference; prose that mentions the folder names no file.
present = set(files)
refs = {}
for path in glob.glob('patterns/*.php') + glob.glob('templates/*') + glob.glob('parts/*'):
    for m in re.finditer(r'patterns/images/([^"\']*)["\']', open(path).read()):
        refs.setdefault(m.group(1), set()).add(path)
for m in re.finditer(r'\(patterns/images/([^)]*)\)', open('readme.txt').read()):
    refs.setdefault(m.group(1), set()).add('readme.txt')
# The seed's image table: every entry is `'key' => array( '<file>', '<alt>' )`. The first
# argument must be a quoted literal, so the name can be read however it is spelled.
seed = 'bin/demo/seed.php'
if os.path.exists(seed):
    table = re.search(r'/\* Images from the theme\. \*/(.*?)\) as \$key => \$image \)', open(seed).read(), re.S)
    if not table:
        bad('%s has no image table under "/* Images from the theme. */"; the check cannot read it' % seed)
    else:
        # Every `'key' =>` entry counts, whether written array( ... ) or [ ... ], and the
        # first argument must be a quoted literal; anything else fails as unreadable.
        for m in re.finditer(r"'[a-z_]+'\s*=>\s*(.*?),", table.group(1)):
            head = m.group(1).strip()
            lit = re.fullmatch(r'''(?:array\(|\[)\s*(['"])(.*)\1''', head)
            if lit:
                refs.setdefault(lit.group(2), set()).add(seed)
            else:
                bad('%s image table entry "%s" does not open with a quoted file name; the check cannot read it' % (seed, head))
for name, where in sorted(refs.items()):
    if not NAME.match(name):
        bad('%s/%s, named by %s, is not a well-formed image name' % (IMAGES, name, ', '.join(sorted(where))))
    elif name not in present:
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
print('  ✓  %d of %d names pass the grammar (%d pre-rule names excepted until 2.0.0), %d referenced names are well formed and exist, every name shipped in %s to %s is present or named in the exception table (%d)'
      % (checked, len(files), len(GRAMMAR_EXCEPTIONS), len(refs), tags[0], tags[-1], len(STABILITY_EXCEPTIONS)))
PY
