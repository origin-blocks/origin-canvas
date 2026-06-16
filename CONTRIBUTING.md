# Contributing to Origin Canvas

## Pattern asset paths are a stability contract

Patterns that users insert (the Home pattern, card patterns, etc.) bake their hardcoded
absolute asset URLs — `get_template_directory_uri() . '/…'` — into the user's saved content at
insert time. Those URLs are then **frozen in the user's database**; changing the theme's files
later does not change what is already saved.

Therefore: **never move or delete an image/asset path referenced by an insertable pattern**
without, in the SAME release, shipping a render-time rewrite shim (old path → new path, scoped
to the affected block types) AND documenting a sunset version for that shim. See
`origin_canvas_rewrite_legacy_card_image_paths()` in `functions.php` — the shim for the
1.0.x → `patterns/images/` card-image move — as the reference implementation (scoped to
`render_block_core/image` + `render_block_core/cover`, non-destructive, with a stated sunset).

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
