# Origin Canvas — theme repo guide

Origin Canvas is a WordPress Full Site Editing (FSE) block theme. User-facing block
patterns live in `patterns/*.php`; each is a PHP file whose doc-block header registers it
and whose body is block markup. This file's rules are BINDING — read them before creating,
renaming, or recategorizing any pattern.

## Pattern conventions

### 1. Namespace
Every user-facing pattern **slug** and every **custom category** is `origin-canvas/<kebab-slug>`.
The business-plan docs sometimes use an `origin/` namespace — that is aspirational and **NOT
shipped**; do not use it. Hidden template scaffolds use slugs `origin-canvas/hidden-*`.

### 2. Categories — role-based, from a FIXED set, exactly ONE per pattern
Assign every pattern **exactly one** category (no comma-separated multi-category lines).
The set is fixed — **never invent a new category** (no `landing`, no page-scoped buckets):

Custom (all `origin-canvas/`): `hero`, `card`, `features`, `testimonial`, `pricing`, `text`,
`faq`, `team`, `stats`, `contact`, `gallery`, `logos`, `author`, `page`, `posts`.
Core WP slugs (used bare, no prefix, no custom registration): `header`, `footer`, `call-to-action`.

To choose the one category, test in this numbered order and take the **first match**.
**Tie-breaker: when a pattern could plausibly fit more than one, the earliest-numbered entry
wins** (the list is frozen specific→generic so two people reach the same answer — e.g. a hero
that contains a CTA is `hero` (1), not `call-to-action` (14); a pricing table with stats is
`pricing` (3), not `stats` (4)):

1. `origin-canvas/hero` — a page-top hero section
2. `origin-canvas/testimonial` — a quote / review
3. `origin-canvas/pricing` — a pricing table / tier
4. `origin-canvas/stats` — a metrics / numbers band
5. `origin-canvas/team` — people / team cards
6. `origin-canvas/features` — a feature grid / list
7. `origin-canvas/faq` — Q&A
8. `origin-canvas/contact` — a contact form / details
9. `origin-canvas/gallery` — an image gallery
10. `origin-canvas/logos` — a logo strip
11. `origin-canvas/author` — an author / byline card
12. `origin-canvas/card` — a generic reusable card
13. `origin-canvas/posts` — a query / blog loop (bare `posts` / `query` are DRIFT → use `origin-canvas/posts`)
14. `call-to-action` — a conversion / CTA section (newsletter signup counts here; core slug, used bare)
15. `origin-canvas/text` — text / editorial content with no more-specific role (divider-with-text, breath statement)
16. `origin-canvas/page` — a full-page composition only

`header` / `footer` patterns use the bare core slugs. Custom categories are registered in
`functions.php` → `origin_canvas_register_pattern_categories()`, and **only** when a batch
introduces them — registering or using a category outside this fixed set is forbidden.

### 3. Names — role-based, never page-scoped
Name a pattern for what it **is**, so it's reusable on any page: `stat-band`, `features-grid`,
`testimonial-single`. **Never** `landing-*` or any `<page>-<section>` form. A section pattern
welded to one page ("landing-cta") is wrong; it's a `cta-*` that any page can use.

### 4. Full-page patterns compose via `wp:pattern` refs only
A page pattern's body is **only** `<!-- wp:pattern {"slug":"origin-canvas/…"} /-->` references —
no inlined section markup. Model: `patterns/page-studio.php`. Category: `origin-canvas/page`.

### 5. Pattern-header doc-block
Every pattern file opens with this header (copy `patterns/page-studio.php` verbatim and change
only the variable fields):

```php
<?php
/**
 * Title: <Human Title>
 * Slug: origin-canvas/<kebab-slug>
 * Description: <one sentence: what the pattern is / where it's used>
 * Categories: <one category>
 * Keywords: <comma, separated, terms>
 * Viewport Width: 1500
 * Block Types:
 * Post Types:
 * Inserter: true
 *
 * @package Origin
 */
?>
```

Per-field rules:
- **Categories:** exactly ONE value (rule 2). Custom = `origin-canvas/<cat>`; core patterns use
  bare `header` / `footer` / `call-to-action`; template scaffolds use bare `hidden` (their SLUG
  is still `origin-canvas/hidden-*`).
- **Description:** required, one sentence.
- **Viewport Width:** `1500` is the standard; deviate only with a deliberate reason.
- **Block Types:** LEAVE EMPTY for standalone section/page patterns. Populate ONLY when the
  pattern is bound to a block context: `core/post-content` (content-area patterns),
  `core/query` (loops), `core/template-part/header|footer` (parts). A marketing/features/
  testimonial/hero SECTION is standalone → **empty**, NOT `core/post-content`. (`core/post-content`
  binds the pattern to the post-content inserter only; a section is inserted anywhere, so binding it
  is wrong.) NOTE: several existing section patterns still carry a stray `core/post-content` — that is
  known drift to be stripped, not a convention to copy.
- **Post Types:** leave empty.
- **Inserter:** `true` for all user-facing patterns; `false` only for hidden template scaffolds
  (registered via `register_block_pattern` in `functions.php`).
- **Keywords:** 3–6 comma-separated terms a user might *type* that are **not already** in the
  Title, Slug, Description, or Category — synonyms, alternate names, use-case words. Never
  repeat a word that already appears in those fields: WordPress joins title, description,
  keywords and category into ONE searched string and scores it all-or-nothing (see
  `getItemSearchRank`), so a repeat cannot improve ranking — it only spends the budget. A
  pattern titled "Hero Centered" is already found by "hero"; its keywords should buy
  "banner", "masthead", "above the fold".

### 6. Tokens over hardcodes — NEVER put bespoke px in a pattern
Every **colour** = palette slug. Every **spacing** = spacing preset slug. Every **font size** =
font-size preset slug. The theme's scales are fluid (`clamp()`); hardcoding px in a pattern
silently opts that value out of fluid type/spacing and out of every style variation.

- Inline hex is permitted ONLY for dark sections (`#111827` bg, `#F3F4F6` text), since
  `custom.dark.*` is not a palette, and for sanctioned per-product identity marks.
- **If a design hands you a value that isn't on the scale, do NOT hardcode it.** Snap it to
  the nearest scale step and tell the designer to update their board, or file a `theme.json`
  change to add the step. Those are the only two options.
- Font-size scale (px): 13 · 14 · 16 · 18 · 20 · 24 · 30 · 36 · 48 · 60 · 72
  (`extra-small` · `small` · `regular` · `regular-plus` · `medium` · `large` · `extra-large` ·
  `huge` · `display` · `display-xl` · `display-2xl`). There is no 15, 19, 22, 23 or 34.
- Spacing presets are fluid ranges — pick the token whose max matches the design value; do not
  replace a token with a flat px to hit a number exactly.
- A `max-width` **measure** (reading-line cap on a heading/body) is the exception: it is a
  typographic constraint, not a responsive gap, and may be a flat value.
- **Element dimensions are also outside this rule.** The rule governs *design tokens* —
  colour, spacing, type. It does not govern the intrinsic size of a thing: an avatar
  (48/64/180px), an icon bubble, a wireframe box, a fixed media column. Those are layout
  dimensions, not scale steps, and there is no token scale for them. Where several patterns
  share a dimension, put it in a class so they cannot drift apart (see
  `.origin-canvas-quote-mark`), rather than repeating the number in each pattern.
- **Never inline an `<svg>` in pattern content.** `<svg>` is not in WordPress's KSES
  allowlist, so it is stripped on insert for any user without `unfiltered_html` — Editors,
  Authors, and most multisite roles would get the pattern with the graphic missing. Ship
  decorative glyphs from the theme layer instead: a data-URI `mask-image` on an empty group,
  coloured with `background-color: var(--wp--preset--color--primary)` so it tracks the
  palette. `core-list.css` (check icon) and `core-group.css` (quote mark) are the reference
  implementations.
### 7. Every heading inside a pattern carries an explicit `fontSize` preset
A `wp:heading` in a pattern must always set `"fontSize"` (and the matching
`has-<preset>-font-size` class on the tag). **Never** leave a pattern heading bare.

Bare headings are for **authored content only** — they inherit `styles.elements.h1…h6` from
`theme.json`, which is tuned for someone typing prose into the editor. A pattern is designed
composition: its heading sizes are a design decision, not an authoring default.

The consequence of getting this wrong is silent and wide: changing an element default in
`theme.json` restyles every bare pattern heading at once. A heading-ladder change intended
for authored content must **never** move a shipped pattern's rendering.

### 8. Shared components are judged against every page that uses them
A change to a template part (header, footer) or to a widely-reused pattern must be justified
against that component's **full usage across the theme** — never against one page composition.

A value that is right for a single marketing layout is not thereby right for the component.
A page can't restyle global chrome anyway: header and footer are template parts, so "the
landing page wants a tighter header" is a request for a *different header*, not an edit to the
shared one. Design the component family on its own terms first, then assign per template.

Corollary for spacing: when a raw value has an exact equivalent on the scale, tokenising it is
a no-op and always correct. When it does not, do **not** snap it silently — a near-miss token
changes the rendering. Report the gap and get a ruling.

## Sources of truth
Pattern taxonomy & batch plan: `origin-business-plan/theme/master-pattern-library.md`.
Metadata / roles / AI-facing tags: `origin-business-plan/plans/patterns-strategy.md`.
These live outside this repo; the rules above restate the binding parts so agents don't need it.

## Extending the fixed category set
Any addition to the category list requires updating BOTH this `CLAUDE.md` AND
`master-pattern-library.md` in the same change. The "never invent a category" rule is absolute
for ad-hoc additions; this dual-update is the only sanctioned way to grow the set.
