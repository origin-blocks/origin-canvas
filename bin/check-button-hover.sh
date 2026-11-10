#!/usr/bin/env bash
#
# A button's hover, keyboard focus and press are the state layer in core-button.css: the
# label color over the fill, no lift, no hover shadow, and no state color in theme.json or a
# style variation (#146). The invariant:
# - core-button.css has no transform, translate, scale or rotate declaration and no
#   box-shadow other than none;
# - no other theme stylesheet (style.css, assets/styles/*.css) and no css string in
#   theme.json or a style variation has one in a rule aimed at a button (.wp-block-button,
#   .wp-block-button__link, .wp-element-button, or the core/button block's own css). Focus
#   rings on form fields are not buttons and stay allowed;
# - no :hover, :focus, :focus-visible or :active of core/button, a variation, their nested
#   button elements or the global button element, in theme.json or a style variation,
#   carries color.background, color.gradient, color.text, border.color or a shadow key.
#
# Run from anywhere:  bash bin/check-button-hover.sh [theme root]
set -u
ROOT="${1:-$(cd "$(dirname "$0")/.." && pwd)}"
cd "$ROOT" || exit 1

echo "Button states:"

python3 -B - <<'PY'
import glob, json, re, sys

MOVE = re.compile(r"^(transform|translate|scale|rotate)\s*:")
SHADOW = re.compile(r"^box-shadow\s*:")
BUTTON = re.compile(r"wp-block-button|wp-element-button")
ok = True

def strip(css):
    return re.sub(r"/\*.*?\*/", " ", css, flags=re.S)

def bad_decls(body):
    out = []
    for d in body.split(";"):
        d = " ".join(d.split())
        if MOVE.match(d) or (SHADOW.match(d) and not re.match(r"^box-shadow\s*:\s*none$", d)):
            out.append(d)
    return out

def rules(css):
    """Innermost selector { declarations } pairs; @media wrappers fall away."""
    for m in re.finditer(r"([^{}]+)\{([^{}]*)\}", strip(css)):
        yield " ".join(m.group(1).split()), m.group(2)

def report(where, found):
    global ok
    print("  ✗  %s moves a button or gives it a shadow:" % where)
    for f in found:
        print("       " + f)
    ok = False

# 1. core-button.css: no move or shadow anywhere in it.
css_path = "assets/styles/core-button.css"
try:
    found = [d for _, body in rules(open(css_path).read()) for d in bad_decls(body)]
except OSError:
    print("  ✗  %s is missing or unreadable" % css_path)
    found, ok = [], False
if found:
    report(css_path, found)

# 2. Every other stylesheet: no move or shadow in a rule aimed at a button.
for path in ["style.css"] + sorted(set(glob.glob("assets/styles/*.css")) - {css_path}):
    found = ["%s { %s }" % (sel[:80], d) for sel, body in rules(open(path).read())
             if BUTTON.search(sel) for d in bad_decls(body)]
    if found:
        report(path, found)

# 3. theme.json and style variations: css strings and state colors.
STATES = (":hover", ":focus", ":focus-visible", ":active")
def scan_states(node, label, bad):
    for state in STATES:
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

def css_strings(node, path=""):
    if isinstance(node, dict):
        for k, v in node.items():
            if k == "css" and isinstance(v, str):
                yield path, v
            else:
                yield from css_strings(v, path + "/" + k)

for path in ["theme.json"] + sorted(glob.glob("styles/**/*.json", recursive=True)):
    t = json.load(open(path))
    styles = t.get("styles", {})
    button = styles.get("blocks", {}).get("core/button", {})
    bad = []
    scan_states(button, "core/button", bad)
    for name, v in button.get("variations", {}).items():
        scan_states(v, name, bad)
        scan_states(v.get("elements", {}).get("button", {}), name + ".elements.button", bad)
    scan_states(button.get("elements", {}).get("button", {}), "core/button.elements.button", bad)
    scan_states(styles.get("elements", {}).get("button", {}), "elements.button", bad)
    if bad:
        print("  ✗  %s sets a button state color or shadow:" % path)
        for b in bad:
            print("       " + b)
        ok = False
    for where, css in css_strings(styles, "styles"):
        if where.startswith("styles/blocks/core/button"):
            # The button block's own css: every declaration in it is the button's.
            found = bad_decls(re.sub(r"[{}]", ";", strip(css)))
        else:
            found = ["%s { %s }" % (sel[:80], d) for sel, body in rules(css)
                     if BUTTON.search(sel) for d in bad_decls(body)]
        if found:
            report("%s %s css" % (path, where), found)

if ok:
    print("  ✓  no lift, shadow or state color on a button in any stylesheet, theme.json or style variation")
else:
    print()
    print("A button's states are the label color over its fill, in core-button.css, and nothing else.")
sys.exit(0 if ok else 1)
PY
