# Contributing to Origin Canvas

## Pattern asset paths are a stability contract

Patterns that users insert (the Home pattern, card patterns, etc.) bake their hardcoded
absolute asset URLs — `get_template_directory_uri() . '/…'` — into the user's saved content at
insert time. Those URLs are then **frozen in the user's database**; changing the theme's files
later does not change what is already saved.

Therefore: **never move or delete an image/asset path referenced by an insertable pattern**
without, in the SAME release, shipping a render-time rewrite shim (old path → new path, scoped
to the affected block types) AND documenting a sunset version for that shim. The reference
implementation is the shim for the 1.0.x → `patterns/images/` card-image move: added in
commits `62f9ac4` and `6cc1ee7` (1.1.0; scoped to `render_block_core/image` +
`render_block_core/cover`, non-destructive, sunset 1.3.0) and removed after that sunset.

This applies with extra force to the **Home pattern under the user-owned front-page model**:
the front page is now a user-owned Page seeded from `page-home-01` (no `front-page.html`
template). The Home pattern's `hero-cover` / `feature-split` image URLs are written into that
Page's content the moment it is inserted or seeded, so relocating those images without a shim
will break every site that has the Home page saved.

### Checklist before moving or removing a pattern asset

1. Is the asset referenced by an **insertable** pattern (`Inserter: true`) or by the
   starter-content Home seed? If yes, its URL is (or will be) frozen in user content.
2. If you must move/rename it, add a scoped render-time rewrite shim in the same release.
3. Give the shim an explicit **sunset** version in its docblock and log the removal as a
   follow-up.
4. Keep the old directory deleted — the shim heals at output; it does not resurrect paths.

## Running the JavaScript tests

The theme's one front-end script, `assets/js/anchor-navigation.js`, has a Playwright suite
in `tests/`. It runs the real script and the real `style.css` in Chromium against fixture
pages built in memory, so it needs no WordPress and no web server. Node.js 20 or later is
required (`@playwright/test` declares it; CI uses 22).

```sh
npm ci
npx playwright install chromium   # once per machine
npm test
```

CI runs the same three steps on every push and pull request (`.github/workflows/test.yml`).
`tests/` and the Playwright config never ship: both are export-ignored for `git archive`
and listed in `.distignore`.

The fixtures in `tests/fixture.js` mirror the markup WordPress core renders for the
Navigation block and the theme's mobile-menu overlay part; the class names and the core
lines they come from are listed in that file's header. Core's overlay itself is not in
the loop — a stand-in clears the overlay's classes when its close button is clicked — so
one check stays manual after a WordPress upgrade or a change to `parts/mobile-menu.html`:
on a page with same-page anchor links, at 600px or narrower, open the mobile menu, tap a
section link, and confirm the overlay closes and the page scrolls to the section below
the sticky header.
