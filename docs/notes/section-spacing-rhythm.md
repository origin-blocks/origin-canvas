# Section spacing & vertical rhythm

## The rule
Every standalone section pattern gets `colossal` vertical padding, top and bottom — uniform. This is the house rhythm (heroes, CTAs, feature/card/stat/process sections all use it).

## Exceptions
- **Composition wrappers & structural shells** (`page-*` assemblers, `hidden-*`, `header-default`) → no section padding (inherit). They assemble other patterns; they don't add their own vertical space.
- **A row with a visual divider gets its own symmetric padding** (above and below), so the divider breathes instead of jamming against content:
  - Border or horizontal rule on the row → padding top + bottom. Example: `work-index.php` (client list) — section is `colossal`/`colossal`, and each bordered client row is `large`/`large` with a 1px top border.
  - Background color on the row → padding top + bottom so the fill reads as a band with breathing room, not a tight strip.
- **Sub-components meant to nest inside a section** (`card-blog-post`, `card-team-member`, `card-testimonial`, `post-loop-*`) → smaller padding (`medium`/`large`/`extra-large`), because the parent section already supplies the `colossal` rhythm.
- **`hero-cover`** — section padding `colossal` top, `huge` bottom (about half the colossal rhythm). A deliberate exception so the hero sits closer to the following section without being flush.
- **`hero-canvas`** (landing hero) — section padding `massive`/`massive` (symmetric), taller than the colossal rhythm, to match the marketing comp.

## Note on background color
A background color does not change the padding token — a section is `colossal` whether plain, tinted, or dark. Background only makes the padding visible as a colored band. Adjacent sections can therefore look unevenly spaced when one side's `colossal` is a colored band and the other is white space, even though the token is identical. This is appearance, not a token bug.

## In-pattern spacing
Space siblings inside a pattern with `blockGap` by default. When one element needs a one-off gap, set it with `margin-top` on that element, not `margin-bottom` — so gaps don't compound. Spacing values are chosen per pattern; this sets the property to use, not a fixed rhythm.

---
*Source: Origin Canvas section-spacing planning (Studio page rhythm work).*
