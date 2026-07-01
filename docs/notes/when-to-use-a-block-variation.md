# When to use a Block Style Variation (vs base CSS / theme.json)

**Decision rule:** Before styling a core block, ask two questions in order.

### 1. Can the look be achieved through settings (block UI / theme.json)?
- **Yes** → use settings (theme.json block styles, `elements.link`, `supports`). No variation needed. The block stays fully user-driven and future-proof.
- **No — it requires custom CSS targeting a class with no settings hook** → go to Q2.

> The forcing fact in the post-terms case: `.wp-block-post-terms__prefix` has **no settings hook**. You can colour the term links via `elements.link`, but there is **no editor- or theme.json-level way to colour the prefix independently**. The two-tone look (prefix lighter, links darker) can therefore only exist as scoped CSS on `__prefix`.

### 2. The CSS has only two homes — pick by this test: must the plain block stay reachable?
- **Base CSS** (e.g. `.wp-block-post-terms__prefix { color: var(--text-muted) }`, global) — unconditional. **Every** instance of that block gets the treatment **forever**, with **no off switch**. A user wanting the plain block has to fight your CSS with more CSS, and if core later adds a prefix-styling hook, your global rule silently overrides whatever they set.
  - *Only defensible if you are happy that **no** instance of this block ever renders plainly.*
- **Variation** (`is-style-…` + a scoped `&__prefix` rule) — **opt-in**. Selected → the custom look applies. Deselected → stock block, fully settings-driven, future-proof. The default stays the default.

### Conclusion
When the look **cannot** be achieved through settings (needs scoped CSS) **AND** you want the plain block to remain reachable → a **variation is the only clean container** for that CSS.

### Caveat — "default look" via a pre-applied variation
This means the desired look is **not** the block's literal default appearance — it's a variation that **patterns apply via `className`**. That's fine and common (patterns ship with variations pre-applied all the time). It does mean any framing of "this is core/pattern base styling" is wrong: the correct end state is **one variation, pre-applied in the relevant patterns.**

---
**TL;DR:** No settings path + must keep the plain block → **variation**. Settings can do it → **settings**. Happy to lose the plain block entirely → base CSS (rare).

## Block styles vs plain classes
Register a block style only for a generic treatment a user would sensibly apply to any instance of that block (e.g. shadow, blur). For a one-pattern decorative look, use a plain CSS class in the pattern markup, not a registered block style — otherwise the look pollutes the Styles panel of every instance of that block. In this theme, `origin-canvas-canvas-grid` and `origin-canvas-pattern-thumb` are plain classes for this reason.

*Source: planning chat, Origin Canvas post-terms "Tags" variation.*
