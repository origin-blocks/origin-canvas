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
  `core/query` (loops), `core/template-part/header|footer` (parts).
- **Post Types:** leave empty.
- **Inserter:** `true` for all user-facing patterns; `false` only for hidden template scaffolds
  (registered via `register_block_pattern` in `functions.php`).
- **Keywords:** 3–6 comma-separated terms from the pattern's title / category / obvious
  synonyms; do not repeat words already in the Title or Slug.

## Sources of truth
Pattern taxonomy & batch plan: `origin-business-plan/theme/master-pattern-library.md`.
Metadata / roles / AI-facing tags: `origin-business-plan/plans/patterns-strategy.md`.
These live outside this repo; the rules above restate the binding parts so agents don't need it.

## Extending the fixed category set
Any addition to the category list requires updating BOTH this `CLAUDE.md` AND
`master-pattern-library.md` in the same change. The "never invent a category" rule is absolute
for ad-hoc additions; this dual-update is the only sanctioned way to grow the set.
