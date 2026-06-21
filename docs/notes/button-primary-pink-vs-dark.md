# Button primary: pink vs dark (ink)

**The model.** Origin Canvas buttons have four roles:

- **Dark (ink) fill = the DEFAULT primary.** A bare `core/button` renders ink: background `text-heading` (#111827), text `surface-base` (white). This is the everyday primary action.
- **Pink fill = the opt-in variation** `origin-canvas-fill-primary` ("Fill Primary"): background `primary` (#FF4387), white text. It is the *single spotlight* action — applied deliberately, never by default.
- **Outline = secondary**, surface-skinned: `outline` on white, `origin-canvas-outline-strong` on tinted, `origin-canvas-outline-light` on dark. Unchanged by this model.
- **Dark surfaces (#111827):** ink is invisible there, so the primary *promotes to pink*.

> Why pink is a variation, not the default: the default look should be the calm, reusable one. Pink is a focal accent — making it opt-in keeps "one screen, one pink" achievable and means a plain button is never accidentally loud. (See `when-to-use-a-block-variation.md`: the default stays the default; the loud look is a pre-applied variation.)

## Pink-usage decision tree (deterministic)

Apply in order, top to bottom. The first matching rule wins.

1. **On a dark section?** → pink.
2. **Secondary action?** → outline (surface-skinned to the background).
3. **Primary on a light surface?** → DARK by default. Promote to pink **only** if it is the single highest-intent action in that viewport.
4. **Two pink candidates in one viewport?** → the lesser one stays dark.

**For standalone patterns specifically:** default to DARK and pre-apply pink only where the pattern's whole purpose is one decision (a hero or closing-CTA pattern). When in doubt → dark. A user can one-click promote dark→pink; they can't un-see two clashing pinks.

## How to apply / reverse

- **Promote to pink:** select the button → Styles → "Fill Primary". In a pattern, add `is-style-origin-canvas-fill-primary` to both the `wp:button` block comment and the rendered `wp-block-button` class.
- **Back to dark:** deselect the variation (the bare button is ink by default).

## Per-pattern concrete rules

Spotlight decisions are **hardcoded into the pattern**, never left to a "one pink per viewport" runtime judgment. A coder builds a pattern in isolation with no knowledge of what else sits on the assembled page, so the correct accent must be a concrete default in the markup. These per-pattern rules override the viewport clause of the decision tree above.

- **Pricing (`card-pricing.php`):** the featured/recommended column = pink top indicator **and** pink primary button (`is-style-origin-canvas-fill-primary`); side columns = `is-style-outline`. Pink appears exactly once. Baked into the pattern; no viewport reasoning.

---

*Source: "Invert button default to ink" plan, Origin Canvas. This note is also the spec for the later per-pattern pink-spotlight sweep.*
