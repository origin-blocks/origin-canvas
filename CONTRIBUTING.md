# Contributing to the Origin Theme

Origin is a Full Site Editing WordPress theme. This file captures the current theme-local contribution and release rules.

## 1. Theme Tokens & Variables

- **Source of truth:** Origin theme tokens live in this repository, primarily in `theme.json` and `style.css`. Do not pull values from the block plugin, marketing site, or other design-surface token files.
- **Naming:** WordPress preset slugs and custom CSS variables use lowercase kebab-case.
- **Slug convention:** Origin uses human-readable slugs:
  - Font sizes: `extra-small`, `small`, `regular`, `medium`, `large`, `extra-large`, `huge`, `display` (not `xs`, `sm`, `base`, `lg`)
  - Spacing: `none`, `extra-small`, `small`, `medium`, `large`, `extra-large`, `huge` (not numeric `4`, `8`, `16`)
  - Shadows: `none`, `small`, `medium`, `large` (not `sm`, `md`, `lg`)
- **Prefixes:** Use the existing theme preset and custom-property naming already defined in `theme.json` and `style.css`.
- **Editor exposure:** Only ship semantic roles (Surface Base, Text Muted, Primary, etc.) in `theme.json`.

## 2. Templates, Parts, Patterns

- Templates reference hidden patterns only; no direct markup.
- Template parts (`parts/header.html`, `parts/footer.html`) include block patterns so they inherit theme updates.
- Hidden patterns own layout and must use semantic tokens. Placeholders should be obvious and flagged for replacement.
- **Hardcoded values policy:**
  - Colors: Always use presets (`var(--wp--preset--color--*)`), never hex
  - Spacing: Prefer presets; hardcoded ok for design-specific values, zeros, and `clamp()`
  - Font sizes: Prefer presets; `clamp()` allowed for fluid typography
  - Font weights: Inline values ok (no weight presets in theme.json)

## 3. Theme.json Guidelines

- Follow WordPress requirements: lowercase slug + human-readable name for each preset.
- Slugs should express semantic intent (`surface-base`, `text-heading`, `primary`) and stay stable once released.
- Palette, font sizes, spacing, radii, and shadows are owned by this theme. Keep new presets sparse and aligned with the existing `theme.json` structure.

### theme.json best practices

- Prefer `theme.json` for styling instead of custom CSS when possible.
- Use semantic color names (Primary, Secondary) instead of descriptive ones.
- Stick to the shared spacing scale; avoid ad-hoc values.
- Use editor-facing labels when exposing presets in the palette. Document any descriptive names we choose for shared neutrals so authors see friendly roles while values stay stable.
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

If you are experimenting directly inside the block editor:

1. Reuse the semantic presets already defined in `theme.json`.
2. If a new role is unavoidable, add it to `theme.json` or `style.css` and document the decision here.
3. Avoid ad-hoc color pickers or custom spacing values—those become unmaintainable.

## 5. Open Questions / TODO

- Dark mode palette is not wired up yet.
- Motion and typography presets may need another pass after editor-heavy testing.

## 6. Testing checklist

- Verify presets/styling in both editor and frontend (including template parts/patterns touched).
- If style variations exist, sanity-check them against new `theme.json` changes.

Document anything new here so we are not hunting across repos for the current rules.

## 7. Release packaging

Release source of truth:

- Development starts in the private repository.
- Public release work is synced into `origin-blocks/origin-theme` without private history.
- Public follows GitFlow: `develop` is the integration branch, `master` is the release branch.
- Release tags are plain SemVer (`0.1.0`, not `v0.1.0`) and must be created only in the public repository from commits contained in `master`.
- The private repository must not publish theme releases.

Build release zips with `bin/package-theme.sh`, not by zipping the working tree. The script uses `git archive` so `.gitattributes` can exclude internal docs and development-only files.

`docs/plans/*` is a pipeline workspace path, not a theme package artifact. It must remain uncommitted by pipeline agents and is excluded from release archives through `export-ignore`.

`docs/plans/current.md` and `docs/plans/master-pattern-library.md` are floating workspace artifacts: local docs kept on disk for agents and humans, but intentionally left uncommitted. Pipeline agents must not stage or commit them. If a human performs the one-time index cleanup to untrack those files, `.gitignore` keeps them local afterward.

## 8. Known issues / Workarounds

- Navigation link hover color is enforced via a CSS rule in `style.css` (not `theme.json`) because Gutenberg issue [#67884](https://github.com/WordPress/gutenberg/issues/67884) strips `!important` from `theme.json`. Remove the CSS workaround after upstream fixes.
