#!/usr/bin/env bash
#
# A button's hover, keyboard focus and press are the state layer in core-button.css: the
# label color over the fill, no lift, no hover shadow, and theme.json holds no state color
# (#146). The invariant: core-button.css has no transform or translate declaration and no
# box-shadow other than none, and no :hover, :focus, :focus-visible or :active of core/button, a
# variation, their nested button elements or the global button element in theme.json carries color.background, color.gradient,
# color.text, border.color or a shadow key: the state layer is the only state.
#
# Run from anywhere:  bash bin/check-button-hover.sh [theme.json] [core-button.css]
set -u
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
THEME_JSON="${1:-$ROOT/theme.json}"
CSS="${2:-$ROOT/assets/styles/core-button.css}"
status=0

echo "Button states:"

if [ ! -r "$CSS" ]; then
	echo "  ✗  $CSS is missing or unreadable"
	status=1
fi

# Every declaration in the stylesheet, read whole: comments dropped, whitespace and line
# breaks collapsed, then split on the braces and semicolons, so a property and its value
# are judged together however they are laid out.
python3 - "$CSS" <<'PY' || status=1
import re, sys
css = open(sys.argv[1]).read()
css = re.sub(r"/\*.*?\*/", " ", css, flags=re.S)
css = re.sub(r"\s+", " ", css)
decls = [d.strip() for d in re.split(r"[{};]", css) if d.strip()]
moves = [d for d in decls if re.match(r"^(transform|translate)\s*:", d)]
shadows = [d for d in decls if re.match(r"^box-shadow\s*:", d) and not re.match(r"^box-shadow\s*:\s*none$", d)]
ok = True
if moves:
    print("  ✗  " + sys.argv[1] + " moves a button:")
    for d in moves:
        print("       " + d)
    ok = False
else:
    print("  ✓  " + sys.argv[1] + ": no transform on a button")
if shadows:
    print("  ✗  " + sys.argv[1] + " gives a button a shadow:")
    for d in shadows:
        print("       " + d)
    ok = False
else:
    print("  ✓  " + sys.argv[1] + ": no hover shadow on a button")
sys.exit(0 if ok else 1)
PY

python3 - "$THEME_JSON" <<'PY' || status=1
import json, sys
t = json.load(open(sys.argv[1]))
button = t.get("styles", {}).get("blocks", {}).get("core/button", {})
bad = []
def scan(node, label):
    for state in (":hover", ":focus", ":focus-visible", ":active"):
        s = node.get(state)
        if not isinstance(s, dict):
            continue
        for key in ("background", "gradient", "text"):
            if key in s.get("color", {}):
                bad.append(f"{label} {state} color.{key}")
        border = s.get("border", {})
        if "color" in border:
            bad.append(f"{label} {state} border.color")
        for side in ("top", "right", "bottom", "left"):
            if "color" in border.get(side, {}):
                bad.append(f"{label} {state} border.{side}.color")
        if "shadow" in s:
            bad.append(f"{label} {state} shadow")
scan(button, "core/button")
for name, v in button.get("variations", {}).items():
    scan(v, name)
    scan(v.get("elements", {}).get("button", {}), name + ".elements.button")
scan(button.get("elements", {}).get("button", {}), "core/button.elements.button")
scan(t.get("styles", {}).get("elements", {}).get("button", {}), "elements.button")
if bad:
    print("  ✗  theme.json sets a button state color or shadow:")
    for b in bad:
        print("       " + b)
    sys.exit(1)
print("  ✓  theme.json: no state color or shadow on core/button, its variations or the button element")
PY

if [ "$status" -ne 0 ]; then
	echo
	echo "A button's states are the label color over its fill, in core-button.css, and nothing else."
fi
exit "$status"
