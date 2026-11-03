#!/usr/bin/env bash
#
# Every binary the theme ships has a provenance row in CONTRIBUTING.md (Asset provenance):
# path, SHA-256 of the shipped file, source, how it was made, date added. A tracked file is
# a binary when it holds a NUL byte or is not UTF-8 anywhere in it, whatever its extension. This fails when
# a binary has no row, a row's hash differs from the file, a row's source or made-with cell
# is empty, under twelve characters or holds a placeholder word in capitals (SOURCE, MADE WITH,
# TODO, TBD, FIXME, XXX), or a row names a file that is gone.
#
# Run from anywhere:  bash bin/check-asset-provenance.sh        the check
#                     bash bin/check-asset-provenance.sh --rows   print rows for files without one
set -u
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT" || exit 2
MODE="${1:-check}"

python3 - "$MODE" <<'PY'
import hashlib, re, subprocess, sys
mode = sys.argv[1]
def is_binary(path):
    data = open(path, "rb").read()
    if b"\x00" in data:
        return True
    try:
        data.decode("utf-8")
    except UnicodeDecodeError:
        return True
    return False
files = sorted(f for f in subprocess.check_output(["git", "ls-files"]).decode().split("\n") if f and is_binary(f))
doc = open("CONTRIBUTING.md").read()
start = doc.find("## Asset provenance")
if start < 0:
    print("  ✗  CONTRIBUTING.md has no Asset provenance section")
    sys.exit(1)
rows, thin = {}, []
for m in re.finditer(r"^\| `([^`]+)` \| `([0-9a-f]{64})` \| ([^|]*) \| ([^|]*) \| ([^|]*) \|", doc[start:], re.M):
    rows[m.group(1)] = m.group(2)
    for cell in (m.group(3), m.group(4)):
        text = cell.strip()
        if len(text) < 12 or re.search(r"\b(SOURCE|MADE WITH|TODO|TBD|FIXME|XXX)\b", text) or text in ("?", "-"):
            thin.append(m.group(1))
hashes = {f: hashlib.sha256(open(f, "rb").read()).hexdigest() for f in files}
if mode == "--rows":
    today = subprocess.check_output(["date", "+%Y-%m-%d"]).decode().strip()
    for f in files:
        if f not in rows or rows[f] != hashes[f]:
            print(f"| `{f}` | `{hashes[f]}` | SOURCE | MADE WITH | {today} |")
    sys.exit(0)
status = 0
print("Asset provenance:")
for f in files:
    if f not in rows:
        print(f"  ✗  {f}: no row")
        status = 1
    elif rows[f] != hashes[f]:
        print(f"  ✗  {f}: the row's hash is not the file's ({rows[f][:12]}… vs {hashes[f][:12]}…)")
        status = 1
for p in sorted(set(thin)):
    print(f"  ✗  {p}: the source or made-with cell is empty or a placeholder")
    status = 1
for p in rows:
    if p not in hashes:
        print(f"  ✗  {p}: a row for a file that is gone")
        status = 1
if status == 0:
    print(f"  ✓  {len(files)} binaries, each with a row whose hash is the file's")
else:
    print()
    print("Add or fix the rows in CONTRIBUTING.md, Asset provenance: bin/check-asset-provenance.sh --rows prints them.")
sys.exit(status)
PY
