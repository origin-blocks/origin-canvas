#!/usr/bin/env bash
#
# Writes every pattern's markup the way the editor saves it (#111, CLAUDE.md rule 11). Each
# pattern body goes through wp.blocks.parse and wp.blocks.serialize in a real editor page on
# the local demo site, with every PHP call and every block kept in its WordPress 7.0 form
# (a Button with a width; Site, Post and Query Title with textAlign) swapped for a placeholder
# first and put back after, so they pass through untouched. A file that is already what the
# editor saves comes back byte for byte. Run it after editing a pattern, before handing off;
# bin/check-block-validity.sh stays the safety net at merge.
#
# Usage, from the theme root:
#   bash bin/normalize-patterns.sh [--check] [path-to-wordpress]   (default ~/Sites/canvas-demo)
#   --check writes nothing and fails when any file would change.
set -euo pipefail
cd "$(dirname "$0")/.."
ROOT="$(pwd)"
CHECK=0
[ "${1:-}" = "--check" ] && { CHECK=1; shift; }
WP_PATH="${1:-$HOME/Sites/canvas-demo}"
[ -d "$WP_PATH" ] || { echo "normalize-patterns.sh: $WP_PATH is not a directory." >&2; exit 1; }
WP_PATH="$(cd "$WP_PATH" && pwd)"
[ -f "$WP_PATH/DEMO-SITE.md" ] || { echo "normalize-patterns.sh: $WP_PATH has no DEMO-SITE.md marker, so it is not a demo site. Nothing changed." >&2; exit 1; }
[ -d "$ROOT/node_modules/@playwright/test" ] || { echo "normalize-patterns.sh: run npm install and npx playwright install chromium first." >&2; exit 1; }
WORK="$(mktemp -d)"
STATE="$WORK/draft.json"
WP_ARGS=(--path="$WP_PATH")
THEME="origin-canvas"
if [ "$(basename "$(dirname "$ROOT")")" = "origin-canvas-worktrees" ]; then
	THEME="origin-canvas-worktrees/$(basename "$ROOT")"
	cat >"$WORK/theme.php" <<PHP
<?php
WP_CLI::add_wp_hook( 'pre_option_stylesheet', static fn() => '$THEME' );
WP_CLI::add_wp_hook( 'pre_option_template', static fn() => '$THEME' );
PHP
	WP_ARGS+=(--require="$WORK/theme.php")
fi
cleanup() {
	if [ -f "$STATE" ] && ! command wp "${WP_ARGS[@]}" eval-file "$ROOT/bin/lib/block-validity-draft.php" end "$STATE"; then
		echo "  Clean-up failed. Retry: wp ${WP_ARGS[*]} eval-file $ROOT/bin/lib/block-validity-draft.php end $STATE" >&2
		exit 1
	fi
	rm -rf "$WORK"
}
trap cleanup EXIT
command wp "${WP_ARGS[@]}" eval-file "$ROOT/bin/lib/block-validity-draft.php" make "$STATE" >/dev/null

python3 - "$ROOT" "$WORK/bodies.json" <<'PY'
import glob, json, os, re, sys
root, out = sys.argv[1], sys.argv[2]
bodies, meta = {}, {}
for f in sorted(glob.glob(os.path.join(root, "patterns", "*.php"))):
    s = open(f).read()
    end = s.index("?>") + 2
    head, body = s[:end], s[end:]
    holders = []
    def hold(m):
        holders.append(m.group(0))
        return f"OCNHOLD{len(holders) - 1}X"
    # PHP calls, then the blocks kept in their 7.0 form, each replaced by an opaque token
    body = re.sub(r"<\?php.*?\?>", hold, body, flags=re.S)
    body = re.sub(r'<!-- wp:button \{[^\n]*"width":[^\n]*? -->.*?<!-- /wp:button -->', hold, body, flags=re.S)
    body = re.sub(r'<!-- wp:(?:site-title|post-title|query-title) \{[^\n]*"textAlign":[^\n]*? /-->', hold, body)
    rel = os.path.relpath(f, root)
    # The file keeps one newline after the header and one at the end; the editor writes neither.
    bodies[rel] = body.strip("\n")
    meta[rel] = {"head": head, "holders": holders, "tokens": sorted(set(re.findall(r"OCNHOLD(\d+)X", body)))}
json.dump(bodies, open(out, "w"))
json.dump(meta, open(out + ".meta", "w"))
PY
node "$ROOT/bin/lib/normalize-patterns.js" "$STATE" "$WORK/bodies.json" "$WORK/out.json"
[ -n "${OCN_DEBUG_DIR:-}" ] && cp "$WORK/bodies.json" "$WORK/bodies.json.meta" "$WORK/out.json" "$OCN_DEBUG_DIR"/

python3 - "$ROOT" "$WORK/bodies.json" "$WORK/out.json" "$CHECK" <<'PY'
import json, re, sys
root, bodies_path, out_path, check = sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4] == "1"
bodies = json.load(open(bodies_path)); meta = json.load(open(bodies_path + ".meta")); out = json.load(open(out_path))
# Every file is checked and its text built before any file is written, so a run that fails
# on one pattern writes nothing.
texts, broken = {}, []
for rel, body in bodies.items():
    new = out[rel]
    holders = meta[rel]["holders"]
    if sorted(set(re.findall(r"OCNHOLD(\d+)X", new))) != meta[rel]["tokens"] or len(re.findall(r"OCNHOLD\d+X", new)) != len(re.findall(r"OCNHOLD\d+X", body)):
        broken.append(rel); continue
    # A kept block can hold a PHP call, so a put-back token may hold another: repeat until none is left.
    while re.search(r"OCNHOLD\d+X", new):
        new = re.sub(r"OCNHOLD(\d+)X", lambda m: holders[int(m.group(1))], new)
    texts[rel] = meta[rel]["head"] + "\n" + new + "\n"
if broken:
    print("  ✗  the editor dropped a placeholder (a PHP call or a kept block) in: " + ", ".join(broken) + "; nothing written"); sys.exit(2)
changed = [rel for rel, text in texts.items() if open(root + "/" + rel).read() != text]
if not check:
    for rel in changed:
        open(root + "/" + rel, "w").write(texts[rel])
if changed:
    print(("  ✗  would change " if check else "  ~  rewrote ") + f"{len(changed)} pattern files:")
    for rel in changed: print("       " + rel)
    sys.exit(1 if check else 0)
print(f"  ✓  {len(bodies)} patterns are what the editor saves")
PY
