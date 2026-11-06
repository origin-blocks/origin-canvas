# Origin Canvas — theme repo guide

Origin Canvas is a WordPress block theme. Patterns live in `patterns/*.php`: a doc-block header
registers each one and the body is block markup. Read these rules before creating, renaming or
recategorizing a pattern.

## Who the design is for
- **Audience:** solo builders, freelancers and small teams who build WordPress sites, for
  clients or for themselves; small agencies are next.
- **Surfaces:** the theme's frame, setup and docs are judged for that builder. Demo pages and
  patterns are judged for the visitors of the business the page portrays (an attorney's
  clients, a gym's new members) and for the job of each row. When the business is unknown,
  check contrasting real uses; never impose Origin's own look.
- **Before changing a visual value:** name the reader and the surface, look at the change on
  the real page, and say what the reader gains. Fitting a scale is not a reason.

## Where rules live
- Every design decision lives in the code, in a `bin/check-*.sh` or in a GitHub issue in this
  repo, in the same step as the change, never only in a scratch folder, a chat or an agent's
  memory. Record a new trap the same way. Never commit private detail, design notes, lessons or
  an archive.
- Some rules have a check; a rule with no check is held only by review. `bin/package-theme.sh`
  runs every check that needs nothing outside this repo, the shipped-values check with
  `--release`, so a pending removal stops the package. Run `check-block-validity.sh` (needs
  WordPress), `check-tracking-render.sh` (needs a browser) and `check-roster-names.sh` (needs
  the writing guide clone) before a merge.
- An issue that holds a rule closes only when the rule lives in a check (its exceptions named
  there, each with a reason) or in a code comment next to the code it governs, or is dropped on
  purpose with the reason on the issue. A closed issue is history, not a rule.
- Merge gate: the reviewer matches every commit that cites a ruling or decision against the
  code, check or issue that holds it. If none does, the merge stops.
- A release follows `RELEASE.md`; read it before any tag, version or changelog work.
- Report verification honestly: name the method of each check, and list any check not done.
- Every user-visible string follows the house writing guide. The pattern title, description,
  keyword and category rules stay in this file; add writing rules to the guide, never here.

## Pattern rules

### 1. Namespace
Every pattern slug and custom category is `origin-canvas/<kebab-slug>`, never `origin/`. Hidden
template scaffolds use `origin-canvas/hidden-*`.

### 2. Categories: exactly one, from a fixed set
Give each pattern one category: the first match in this list. It runs specific to generic, so
two people reach the same answer (a hero with a CTA is `hero`, a pricing table with stats is
`pricing`). Bare slugs are core's; `origin-canvas/` ones are registered in `functions.php` →
`origin_canvas_register_pattern_categories()`.

1. `origin-canvas/hero` — the main heading at the largest size, with a lead or buttons
2. `testimonials` — a quote or review
3. `origin-canvas/pricing` — a pricing table or tier
4. `origin-canvas/stats` — a metrics or numbers band
5. `team` — people or team cards
6. `origin-canvas/features` — a feature grid or list
7. `origin-canvas/faq` — Q&A
8. `contact` — a contact form or details
9. `gallery` — an image gallery
10. `origin-canvas/logos` — a logo strip
11. `origin-canvas/author` — an author or byline card
12. `origin-canvas/card` — a generic reusable card
13. `posts` — a query or blog loop
14. `call-to-action` — a conversion section (a newsletter signup counts)
15. `text` — editorial content with no more specific role
16. `origin-canvas/page` — a full-page composition only

Header and footer patterns use the bare `header` and `footer`; template scaffolds use `hidden`.
Never invent a category, least of all one WordPress already registers (`banner`, `query` and
the core slugs above): a twin puts two entries in the inserter for one thing. Check with
`WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( 'slug' )`. Growing the
set takes this list and a matching `category: <slug>` GitHub label, in the same change.

### 3. Names: role-based, never page-scoped
Name a pattern for what it is, so any page can use it: `stat-band`, `features-grid`,
`testimonial-single`, never `landing-*` or `<page>-<section>`. Names, titles, descriptions and
keywords go job, then layout, then style, with no position or page word; keywords may carry true
use words ("about page", "introduction"). A shipped slug is never renamed.

Page patterns are `page-<role>-NN`: the role is the page's job (home, about, pricing, contact,
services) and the number tells versions apart. Never renumber or reuse a number, retired ones
included (`page-home-01` became `page-studio`). The title describes the page without the number
("Home: Centered Hero"); site type, tone and layout go in keywords. `page-studio` and
`page-landing-01` keep their shipped slugs.

### 3b. Image file names: the subject, never the pattern
Name a file in `patterns/images/` for what it shows (`exercise-room.webp`), never for the pattern
or slot that first used it. The only prefixes are `avatar-`, `portrait-` and `logo-`, followed
by the person or client. A shipped name stays until a major version, because saved content
points at its URL. `bin/check-image-names.sh` holds the grammar and its exceptions; whether a
name fits its picture is the reviewer's read.

### 4. Page patterns are `wp:pattern` references only
A page pattern's body is only `<!-- wp:pattern {"slug":"origin-canvas/…"} /-->` references.
Model: `patterns/page-studio.php`.

### 5. Pattern header
Copy the header of `patterns/page-studio.php` and change only the variable fields:

```php
<?php
/**
 * Title: <Human Title>
 * Slug: origin-canvas/<kebab-slug>
 * Description: <one sentence: what a user sees in the pattern>
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

- **Viewport Width:** `1500`, unless there is a deliberate reason.
- **Block Types:** LEAVE EMPTY for standalone section/page patterns. Populate ONLY when the
  pattern is bound to a block context: `core/post-content` (content-area patterns),
  `core/query` (loops), `core/template-part/header|footer` (parts). A marketing/features/
  testimonial/hero SECTION is standalone → **empty**, NOT `core/post-content`. (`core/post-content`
  binds the pattern to the post-content inserter only; a section is inserted anywhere, so binding it
  is wrong.) NOTE: several existing section patterns still carry a stray `core/post-content` — that is
  known drift to be stripped, not a convention to copy.
- **Post Types:** leave empty.
- **Inserter:** `true`, except hidden template scaffolds (registered in `functions.php`), the
  landing page's own showcase sections (`pattern-showcase`, `style-variations`,
  `template-showcase`, `token-system`, `product-grid`) and retired patterns
  (`breath-statement`), which keep their file and slug until a major version.
- **Keywords:** 3–6 comma-separated terms a user might *type* that are **not already** in the
  Title, Slug, Description, or Category — synonyms, alternate names, content words and true
  use words (rule 3). Never repeat a word that already appears in those fields: WordPress joins
  title, description, keywords and category into ONE searched string and scores it all-or-nothing (see
  `getItemSearchRank`), so a repeat cannot improve ranking — it only spends the budget. A
  pattern titled "Hero Centered" is already found by "hero"; its keywords should buy
  "banner", "masthead", "introduction".

### 6. Tokens over hardcodes
Every colour, spacing and font size is a preset from `theme.json`. The scales are fluid
(`clamp()`), so a hardcoded px opts out of fluid type and spacing and out of every style
variation.

- Inline hex only for sanctioned per-product identity marks.
- Dark bands write no hex. `custom.dark.bg` is `contrast` and `custom.dark.text` is `base-2`, so
  a variation's ink reaches every dark pattern; new dark patterns use the `contrast` and
  `base-2` presets directly. Secondary text is `base-2` at 72%, hover fills 8% and lines 12%,
  each a `color-mix` of `var(--wp--custom--dark--text)` (#127).
- **If a design hands you a value that isn't on the scale, do NOT hardcode it and do not snap
  it.** A near step changes the rendering. Report the gap and get a ruling: use an existing
  step, or add one to `theme.json`.
- Spacing presets are fluid ranges: pick the token whose max matches the design value, never a
  flat px to hit a number.
- Outside the rule: a `max-width` reading measure, and element dimensions (an avatar, an icon
  bubble, a fixed media column), which have no scale. Where patterns share a dimension, put it
  in a class so they cannot drift (`.origin-canvas-quote-mark`).
- **Never inline an `<svg>` in pattern content.** `<svg>` is not in WordPress's KSES
  allowlist, so it is stripped on insert for any user without `unfiltered_html` — Editors,
  Authors, and most multisite roles would get the pattern with the graphic missing. Ship
  decorative glyphs from the theme layer instead: a data-URI `mask-image` on an empty group,
  coloured with `background-color: var(--wp--preset--color--primary)` so it tracks the
  palette. `core-list.css` (check icon) and `core-group.css` (quote mark) are the reference
  implementations.

### 6b. Pattern CSS is a last resort
A change to an existing block rule made so one pattern lands is never the fix. Exhaust core
first: Row, Stack and Grid child sizing (Fill, Fit, Fixed), the block styles core ships, the
colour, border and spacing supports, and per-viewport Hide. `divider-with-text` is the
reference: two separators set to Fill and a label at Fit, with no pattern CSS. While 7.0 is the
minimum, Fixed is saved as `"fixed"` plus the `origin-canvas-no-shrink` utility (`style.css`
says why).

A job core cannot do but more than one pattern needs becomes a utility, named for the job, in
the Utilities section of `style.css`. Add one only for a real second use. Anything else goes
where it loads least: the `core-<block>.css` of a block most pages lack (Cover, Accordion), or
else the "Pattern CSS" section at the end of `style.css`, one commented section per pattern. A
class is the hook: core has no per-pattern loader, and Additional CSS rules are stripped when an
Author saves. Ask the owner before adding pattern CSS.

### 7. Pattern headings pin size, never weight or tracking
Every `wp:heading` in a pattern sets `fontSize` and the matching `has-<preset>-font-size` class.
A bare heading takes the `theme.json` element ladder, which is tuned for authored prose, and a
ladder change must never move a shipped pattern.

Weight belongs to the style variation, at `styles.elements.heading`. An inline `fontWeight`
emits a `style` attribute that beats every variation, and our landing page sells one-click
style variations. For a new block: if it renders as `h1`–`h6`, the variation owns its weight; if
it renders a `<p>` (the site title at `level: 0`), the block is the only lever and a pin is
correct. The comment reply title is pinned in both `theme.json` and `core-comments.css`: change
both or neither. The statement register (`breath-statement`, `text-large-statement`,
`lead-statement`) pins `fontWeight: 500` and nothing else: lighter than the voice is its
identity. `bin/check-heading-pins.sh` and `bin/lib/check-heading-blocks.py` hold every
exemption.

Tracking follows size: `settings.custom.letterSpacing` holds one token per size band, and
`style.css` maps the preset classes and heading levels to them. Heading tracking is one value at
`styles.elements.heading`. Never set it per level or on a heading block, in `theme.json`, a
variation or CSS, or a Global Styles "Headings" letter spacing stops reaching every level. A
variation with another face overrides only the tokens or that one value. A pattern never sets `letterSpacing` on a heading or statement; eyebrows and labels stay at
0.06em. `bin/check-tracking-tokens.sh` and `bin/check-tracking-render.sh` hold the bands.

### 8. Shared components are judged against every page that uses them
A change to a template part or a widely reused pattern is justified against every page that
uses it, never one composition. A page that wants a different header needs a different header,
not an edit to the shared one: design the component family on its own terms, then assign it per
template. A raw value with an exact token equivalent is tokenised; one
without is reported for a ruling, never snapped (rule 6).

### 10. Secondary buttons follow the surface
A secondary button is `is-style-outline` on a white or tinted surface and
`is-style-origin-canvas-outline-light` on a dark one. The surface is the nearest block that sets
a fill. `bin/check-button-surfaces.sh` holds the table. Outline Strong is retired; never use it.

### 11. Pattern markup is what the editor saves
After editing a pattern, run `bin/normalize-patterns.sh`: it writes the markup as the editor
saves it and keeps the WordPress 7.0 forms the minimum still needs. Markup the editor rewrites
makes the user's saved page differ from the pattern; `bin/check-block-validity.sh` fails on it.
Copy markup from the editor's Code editor, never from the rendered page.
