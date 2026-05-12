# Contributing to the Origin Theme

Origin is the production WordPress theme that consumes the Origin Design System (ODS). This file captures the current rules so we stay aligned even while the DS pipeline is still experimental.

## 1. Tokens & Variables

- **Source of truth:** Tokens originate in ODS (`tokens/core`, `tokens/semantic`, `tokens/component`, `tokens/modes`). If a value is missing, add it upstream first.
- **Naming:** Token JSON keys = camelCase. Generated CSS variables = kebab-case (e.g. `textPrimary` → `--color-text-heading`).
- **Slug convention:** Origin uses human-readable slugs, not ODS shorthand:
  - Font sizes: `extra-small`, `small`, `regular`, `medium`, `large`, `extra-large`, `huge`, `display` (not `xs`, `sm`, `base`, `lg`)
  - Spacing: `none`, `extra-small`, `small`, `medium`, `large`, `extra-large`, `huge` (not numeric `4`, `8`, `16`)
  - Shadows: `none`, `small`, `medium`, `large` (not `sm`, `md`, `lg`)
- **Prefixes:** Use semantic prefixes already defined by ODS (`--color-*`, `--text-*`, `--surface-*`, `--wash-*`, `--spacing-*`, `--radii-*`, `--shadow-*`, `--motion-*`).
- **Editor exposure:** Only ship semantic roles (Surface Base, Text Muted, Primary, etc.) in `theme.json`. Numeric core tokens (`text-muted-100`) stay internal.

## 2. Templates, Parts, Patterns

- Templates reference hidden patterns only; no direct markup.
- Template parts (`parts/header.html`, `parts/footer.html`) include block patterns so they inherit DS updates.
- Hidden patterns own layout and must use semantic tokens. Placeholders should be obvious and flagged for replacement.
- **Hardcoded values policy:**
  - Colors: Always use presets (`var(--wp--preset--color--*)`), never hex
  - Spacing: Prefer presets; hardcoded ok for design-specific values, zeros, and `clamp()`
  - Font sizes: Prefer presets; `clamp()` allowed for fluid typography
  - Font weights: Inline values ok (no weight presets in theme.json)

## 3. Theme.json Guidelines

- Follow WordPress requirements: lowercase slug + human-readable name for each preset.
- Slugs should express semantic intent (`surface-base`, `text-heading`, `primary`) and stay stable once released.
- Palette, font sizes, spacing, radii, shadows map directly to the DS semantic layer; do not invent new presets inside the theme.

### theme.json best practices

- Prefer `theme.json` for styling instead of custom CSS when possible.
- Use semantic color names (Primary, Secondary) instead of descriptive ones.
- Stick to the shared spacing scale; avoid ad-hoc values.
- Translate ODS token names to editor-facing labels when exposing them in the palette. Document any descriptive names we choose for shared neutrals (e.g., `color.text-muted.300` / `color.border.default` → Pale Slate / `pale-slate`; `color.border.subtle` → Athens Grey / `athens-grey`) so authors see friendly roles while values stay in sync with the design system.
- Keep schema current (version 3) and test against style variations when they exist.
- We disable WordPress defaults to ensure only Origin tokens appear in the editor:
  - `settings.typography.defaultFontSizes: false`
  - `settings.spacing.defaultSpacingSizes: false`
  - `settings.shadow.defaultPresets: false`
  - `settings.color.defaultPalette: false`

### REM vs PX guidance

- Use rem when sizing should scale with typography (e.g., type-related spacing, form controls).
- Use px for layout, user-facing presets, borders/radii, and fixed elements where predictability matters.

## 4. Block Editor-Only Workflows

If you are experimenting directly inside the block editor (without the DS build):

1. Reuse the semantic presets already defined in `theme.json`.
2. If a new role is unavoidable, add it to `theme.json` *and* log an issue to add the same token upstream.
3. Avoid ad-hoc color pickers or custom spacing values—those become unmaintainable.

## 5. Open Questions / TODO

- Dark mode palette comes from `tokens/modes` but is not wired up yet.
- Motion + typography presets still mirror DS; revisit once we test in editor-heavy builds.

## 6. Testing checklist

- Verify presets/styling in both editor and frontend (including template parts/patterns touched).
- If style variations exist, sanity-check them against new `theme.json` changes.

Document anything new here so we are not hunting across repos for the current rules.

## 7. Release packaging

Build release zips with `bin/package-theme.sh`, not by zipping the working tree. The script uses `git archive` so `.gitattributes` can exclude internal docs and development-only files.

`docs/plans/*` is a pipeline workspace path, not a theme package artifact. It must remain uncommitted by pipeline agents and is excluded from release archives through `export-ignore`.

`docs/plans/current.md` and `docs/plans/master-pattern-library.md` are floating workspace artifacts: local docs kept on disk for agents and humans, but intentionally left uncommitted. Pipeline agents must not stage or commit them. If a human performs the one-time index cleanup to untrack those files, `.gitignore` keeps them local afterward.

## 8. Known issues / Workarounds

- Navigation link hover color is enforced via a CSS rule in `style.css` (not `theme.json`) because Gutenberg issue [#67884](https://github.com/WordPress/gutenberg/issues/67884) strips `!important` from `theme.json`. Remove the CSS workaround after upstream fixes.
