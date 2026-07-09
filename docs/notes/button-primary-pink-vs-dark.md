# Button primary: pink vs dark (ink)

**The model.** Origin Canvas buttons have four roles:

- **Dark (ink) fill = the DEFAULT primary.** A bare `core/button` renders ink: background `text-heading` (#111827), text `surface-base` (white). This is the everyday primary action.
- **Pink fill = the opt-in variation** `origin-canvas-fill-primary` ("Fill Primary"): background `primary` (#FF4387), white text. It is the *single spotlight* action — applied deliberately, never by default.
- **Outline = secondary**, surface-skinned: `outline` on white, `origin-canvas-outline-strong` on tinted, `origin-canvas-outline-light` on dark. Unchanged by this model.
- **Dark surfaces (#111827):** ink is invisible there, so the primary *promotes to pink*.

> Why pink is a variation, not the default: the default look should be the calm, reusable one. Pink is a focal accent — making it opt-in keeps "one screen, one pink" achievable and means a plain button is never accidentally loud. (See `when-to-use-a-block-variation.md`: the default stays the default; the loud look is a pre-applied variation.)

## The rule

> A pattern's primary button is PINK only if the pattern has its own pink "this is special" cue (e.g. a featured/recommended indicator) OR it sits on a dark background (where dark fill is invisible). Otherwise it ships DARK, and the user promotes their own single spotlight.

- Pink pairs with an existing pink cue in the **same** pattern, or is forced by a dark background. It is never decided by what else happens to be on the assembled page.
- Coders build patterns context-free, so the accent is always a concrete default baked into the markup — not a runtime judgment.
- Standalone heroes and CTA patterns ship **DARK** (unless they are on a dark background).
- Pink stays rare and earned.

## How to apply / reverse

- **Promote to pink:** select the button → Styles → "Fill Primary". In a pattern, add `is-style-origin-canvas-fill-primary` to both the `wp:button` block comment and the rendered `wp-block-button` class.
- **Back to dark:** deselect the variation (the bare button is ink by default).

## Per-pattern concrete rules

These are examples of the rule above — each is a concrete default baked into the pattern because a pink cue is present or the background is dark.

- **Pricing (`card-pricing.php`):** the featured/recommended column has a pink cue (the pink top indicator), so its primary button is pink (`is-style-origin-canvas-fill-primary`); side columns = `is-style-outline`. Pink appears exactly once.
- **Dark backgrounds (`hero-dark.php`, `cta-banner.php`):** the primary button is pink because dark fill would be invisible on the dark section.

---

*Source: "Invert button default to ink" plan, Origin Canvas.*
