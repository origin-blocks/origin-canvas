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
`render_block_core/cover`, non-destructive), removed in 1.4.0 after its 1.3.0 sunset, and
restored in 1.4.3 because wordpress.org distributed 1.0.x and those sites still update. Its
sunset is now 2.0.0, the first version allowed to change a shipped asset name.

This applies with extra force to the **Home pattern under the user-owned front-page model**:
the front page is now a user-owned Page seeded from `page-studio` (no `front-page.html`
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

## Pattern markup is what the editor saves

After editing a pattern, run `bash bin/normalize-patterns.sh` (a local demo site with the
`DEMO-SITE.md` marker, WP-CLI, `npm install` and Playwright's Chromium, as
`bin/check-block-validity.sh` needs). It sends every pattern body through the editor's own parse
and serialize in a real editor page and writes the result back, with each PHP call and each
block kept in its WordPress 7.0 form left untouched, so the file holds what the editor saves:
class order, attribute order, defaults left out. `--check` writes nothing and fails when a file
would change. `bin/check-block-validity.sh` stays the safety net at merge.

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

## Font files

The Source Serif 4 faces in `assets/fonts/source-serif/` are cut from Adobe's release, not
downloaded ready-made, so a new weight must be cut the same way or the pair will not match
optically. Provenance and recipe, for the next face:

- Source: `https://github.com/adobe-fonts/source-serif/releases/download/4.004R/source-serif-4.004.zip`
  (sha256 `cb3e95d6e3c1273d44300dd464e568d4c9613b28199c53c50454af4b40bbdac1`), file
  `VAR/SourceSerif4Variable-Roman.ttf` (sha256 `38e35c59990b5a39ffb9fb841dfa6f5d2a80ce2c5ea004c3e433b1efd83ebbd0`).
  OFL 1.1; `LICENSE.txt` in the font directory covers every cut.
- Tools: fontTools 4.60.2 with brotli 1.1.0 (Python 3.9).
- Instance: `fontTools.varLib.instancer.instantiateVariableFont(font, {"wght": N, "opsz": 14}, updateFontNames=False)`.
  Optical size 14 is what the shipped 700 carries (advance of `A` = 712 units); the static
  4.004 instances are opsz 20 and do not match it. Rewrite name IDs 1/2/3/4/6 to the static
  strings (`Source Serif 4`, `<Style>`, `4.004;ADBO;SourceSerif4-<Style>`,
  `Source Serif 4 <Style>`, `SourceSerif4-<Style>`), drop 16/17/25, set `OS/2.usWeightClass`.
- Subset: `fontTools.subset.Subsetter` with `unicodes` = the shipped 700's cmap (918 code
  points), `layout_features` = its GSUB/GPOS feature tags (`ccmp dnom frac kern liga locl
  mark mkmk numr pnum tnum`), `hinting=False`, `notdef_outline=True`, `name_IDs=['*']`,
  `passthrough_tables=True`, `drop_tables` minus `BASE`, `STAT`, `gasp`.
- Then: name records limited to the 700's (platform, encoding, language, id) set; `gasp`
  and `STAT` copied from the 700 with the weight axis value and its name record (ID 344)
  changed; saved with `flavor = "woff2"`.
- Result for 600: `SourceSerif4-600.woff2`, sha256
  `55e2bdee5fb978c258481a8f8be65e06b654116d3a4f0c34ba3c282b9de51fea`, 58,252 bytes; same
  1,035 glyphs, code points, features and name-record set as the 700, and the same tables
  except the 700's seven-byte `prep` stub, which an unhinted cut does not carry.

## Asset provenance

Every binary the theme ships (fonts, pattern images, the screenshot) has a row here: its path,
the SHA-256 of the shipped file, where it came from, how it was made, and the date it was added.
Where a tool, a version or a prompt was not recorded at the time, the row says so, so a reader
knows what the record holds and what it does not. `bin/check-asset-provenance.sh` finds every
tracked binary by content, hashes it and fails when a file has no row, a row's hash no longer
matches, a row's source or made-with cell is empty or a placeholder, or a row names a file that
is gone; `bin/package-theme.sh` runs it. When you add or replace a binary, run
`bin/check-asset-provenance.sh --rows` to print the rows it needs, fill in the source and how it
was made, and add them below. The readme's Images, Logos, Fonts and Theme Screenshot sections
hold the user-facing credits and licenses; this table holds the hashes. The Source Serif recipe
is under Font files above.

| Path | SHA-256 | Source | Made with | Added |
|---|---|---|---|---|
| `assets/fonts/dm-sans/DMSans-VariableFont_opsz,wght.woff2` | `5fe2bb2f523a173e958842ab146937570fd26482d2bf5b6ead214a00c12e1aa3` | Google Fonts, DM Sans, OFL 1.1 (readme, Fonts) | Downloaded as shipped; font version not recorded, the hash identifies the file | 2026-05-08 |
| `assets/fonts/inter/inter-400-italic.woff2` | `708b7baa59a80d80465229b74f1dcb599d3ee76515a93d304337b92efb964afe` | Google Fonts, Inter, OFL 1.1 (readme, Fonts) | Downloaded as shipped; font version not recorded, the hash identifies the file | 2026-05-08 |
| `assets/fonts/inter/inter-400-normal.woff2` | `b6f9db9e45be20f3c1312c97fbee7ec36b7d8280f8caa4d53c9ba0408cc9997a` | Google Fonts, Inter, OFL 1.1 (readme, Fonts) | Downloaded as shipped; font version not recorded, the hash identifies the file | 2026-05-08 |
| `assets/fonts/inter/inter-500-italic.woff2` | `9f4481b062ed1cf93cd72d7e3731e49f28f0db980f0f9b06db170a75316548f1` | Google Fonts, Inter, OFL 1.1 (readme, Fonts) | Downloaded as shipped; font version not recorded, the hash identifies the file | 2026-05-08 |
| `assets/fonts/inter/inter-500-normal.woff2` | `8458f8afa67b5691c1fcbe51607a2dafb53a9839e48131c608a186b65415d96d` | Google Fonts, Inter, OFL 1.1 (readme, Fonts) | Downloaded as shipped; font version not recorded, the hash identifies the file | 2026-05-08 |
| `assets/fonts/inter/inter-600-italic.woff2` | `8789e3e4f2cb727ad4cecbcf8cd289011e56cad1b65690828c67deb76534807b` | Google Fonts, Inter, OFL 1.1 (readme, Fonts) | Downloaded as shipped; font version not recorded, the hash identifies the file | 2026-05-08 |
| `assets/fonts/inter/inter-600-normal.woff2` | `8e52a861dc26ff4608c50bd7ff89b65d0d6216a2afe7b47ce5d84544811ca400` | Google Fonts, Inter, OFL 1.1 (readme, Fonts) | Downloaded as shipped; font version not recorded, the hash identifies the file | 2026-05-08 |
| `assets/fonts/inter/inter-700-italic.woff2` | `af46bd584de8bb0aabfdab5c8651f943b089d09959ba30ae75454689c56f3bd2` | Google Fonts, Inter, OFL 1.1 (readme, Fonts) | Downloaded as shipped; font version not recorded, the hash identifies the file | 2026-05-08 |
| `assets/fonts/inter/inter-700-normal.woff2` | `220976705fbec109f43c5cfdceca639e99ace7e51f3eb67292b105d3575eb39b` | Google Fonts, Inter, OFL 1.1 (readme, Fonts) | Downloaded as shipped; font version not recorded, the hash identifies the file | 2026-05-08 |
| `assets/fonts/source-serif/SourceSerif4-600.woff2` | `55e2bdee5fb978c258481a8f8be65e06b654116d3a4f0c34ba3c282b9de51fea` | Adobe's Source Serif 4.004 release, OFL 1.1 | Cut with fontTools 4.60.2 and brotli 1.1.0 by the recipe under Font files | 2026-09-16 |
| `assets/fonts/source-serif/SourceSerif4-700.woff2` | `703ad5b5c3769879bcaa5f61ee7f95fbaa55bd6680b86d62373498c21f6739c6` | Adobe's Source Serif 4.004 release, OFL 1.1 | Cut with fontTools 4.60.2 and brotli 1.1.0 by the recipe under Font files | 2026-05-08 |
| `assets/fonts/space-grotesk/SpaceGrotesk-Variable.woff2` | `e5b39a7e2b0c19a4b75d697d210992c593e857802a3c495ae6df599ba626e6e9` | Google Fonts, Space Grotesk, OFL 1.1 (readme, Fonts) | Downloaded as shipped; font version not recorded, the hash identifies the file | 2026-05-08 |
| `patterns/images/architecture-interior.webp` | `4b53776752424711aab8a7d95f0702e8b103e06e106156bc81bac5fc1e89e002` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-05-08 |
| `patterns/images/avatar-ben-carter.webp` | `c3856eb48703b133ce64da8eb8d766368f766ec6e1979e8fae3921c8e560ba48` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-10-10 |
| `patterns/images/avatar-catherine-rowe.webp` | `9be822c60a37f127c34302028c244fec584bbc577c16bd69a018d3f76491b75f` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-09-25 |
| `patterns/images/avatar-claire-bennett.webp` | `5c9547f669a90e777056e9840aa88ff71969a2842162ddaf3c5528e80ef3f23d` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-08-07 |
| `patterns/images/avatar-emma-whitaker.webp` | `34d4e704560f8dbac363498b1aa0926b46a8d4374777a1da417b93c7fc3f50ab` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-07-31 |
| `patterns/images/avatar-hannah-wright.webp` | `c7f37346d5ead0e3c7c607907ee5adbb5e6120c5bc58509048479b72b51c5ee6` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-08-05 |
| `patterns/images/avatar-helen-marsh.webp` | `b197f28f84351f0dd19aed5ae271acbf0121d58b7c59f66c172d4916e9004ff2` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-09-25 |
| `patterns/images/avatar-joanna-pryce.webp` | `ab6456719fbd2e9191dd87e436e4905c3ec44576b68fe1539376eb61fdf9a881` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-09-25 |
| `patterns/images/avatar-marcus-holloway.webp` | `b11347f4fb026c3e5f991c49d6b48addc4964595fc8d20b7d5017f3cdfa8bdf1` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-08-05 |
| `patterns/images/avatar-michael-hughes.webp` | `27abb8e0c23cedc2d4321e63029f6cec171a403b2674df2d9e2d1880198b4f79` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-07-30 |
| `patterns/images/avatar-owen-parry.webp` | `5fb36eadce7bfe31a68f96f26ce08825f353fea0ff56f39f9eefc6250cb2f4e1` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-09-25 |
| `patterns/images/avatar-rachel-moore.webp` | `34d4e704560f8dbac363498b1aa0926b46a8d4374777a1da417b93c7fc3f50ab` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-10-04 |
| `patterns/images/avatar-ruth-mason.webp` | `da4ffc0b8e3c65f436911d96d4bcbedf4a6ad46869e786e9297910ddc9b12a0a` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-09-25 |
| `patterns/images/avatar-sarah-jenkins.webp` | `5fb36eadce7bfe31a68f96f26ce08825f353fea0ff56f39f9eefc6250cb2f4e1` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-07-31 |
| `patterns/images/card-blog-1.webp` | `e8ec22f8973442cae439625c44f20c3bcf91b4df964ad0628f984212e7c0860e` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-05-08 |
| `patterns/images/card-blog-3.webp` | `3c896d9ea204c7a767200adbc97f5f25ee879868a6a5357807c51f24a1b9de5f` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-05-08 |
| `patterns/images/card-image-text-1.webp` | `e807165cbd96d9af3f4e12f9a20b113a3c4ed8caba61a17ab2b769ce24b6f1d5` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-05-08 |
| `patterns/images/card-image-text-2.webp` | `21b08bb2a6a05ed6386be2ba56703c61197914823bf4c1a85010c54495c40754` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-05-08 |
| `patterns/images/card-image-text-3.webp` | `f83a272c6f991e3a5e9363cb405d87a68b72ef24438357fb5764c263e02c9b8e` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-05-08 |
| `patterns/images/card-testimonial-1.webp` | `30337ab4dcefe6a2fe5ad9b7a809a9a152b09d57e60ab3c167b1f88e8e84853f` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-05-08 |
| `patterns/images/clinic-sign.webp` | `937543d0ae454abb19b08b261d276f7e5a3a6c955bab44a0f22ef371996711bc` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-09-25 |
| `patterns/images/desk-notebook-overhead.webp` | `53e9609112cea01cc9883c21bbfdf7f13647fd77ee6dd35ab810566610d0cd05` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded; cut to 2x of its widest column on 2026-11-01 (07ad504), tool not recorded | 2026-08-07 |
| `patterns/images/exercise-room.webp` | `e75b3fcece1cdb4c98436919cb08571c82110f4375aadb657efe47e9efd19275` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded; cut to 2x of its widest column on 2026-11-01 (07ad504), tool not recorded | 2026-09-29 |
| `patterns/images/frame-samples.webp` | `f83a272c6f991e3a5e9363cb405d87a68b72ef24438357fb5764c263e02c9b8e` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-10-04 |
| `patterns/images/front-door.webp` | `e016268229645a47ffe6049225637ebde139f42caa2753f4be08b7120f7f2cc4` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded; cut to 2x of its widest column on 2026-11-01 (07ad504), tool not recorded | 2026-09-29 |
| `patterns/images/hartwell-tea-detail.webp` | `937543d0ae454abb19b08b261d276f7e5a3a6c955bab44a0f22ef371996711bc` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-08-07 |
| `patterns/images/logo-ash-pine.png` | `b56486397b50fc33966fb7a58959f9a8936a94bda7ba08afe58dad8c61d11e6d` | Made for Origin Canvas, GPL-2.0-or-later (readme, Logos) | Drawn for the demo; tool not recorded | 2026-10-05 |
| `patterns/images/logo-ashby-rowe.png` | `043bd49457b6ce3d68a06be07dc90f3f27477ca7e8820269d1628531e3891299` | Made for Origin Canvas, GPL-2.0-or-later (readme, Logos) | Drawn for the demo; tool not recorded | 2026-09-29 |
| `patterns/images/logo-calder.png` | `fb20e9a45e1362f84429d97374e9b8c554b21d35274d5950ccb3f8d8b2685071` | Made for Origin Canvas, GPL-2.0-or-later (readme, Logos) | Drawn for the demo; tool not recorded | 2026-09-29 |
| `patterns/images/logo-clearwater.png` | `653987d2cf8162f999ee5de68efe33e2e06043de12401d8ac86622679ec2de65` | Made for Origin Canvas, GPL-2.0-or-later (readme, Logos) | Drawn for the demo; tool not recorded | 2026-09-29 |
| `patterns/images/logo-fairview.png` | `fb463088b5368df457cd54d3148e2d48902b8c914eaebea4298c993f366ceeca` | Made for Origin Canvas, GPL-2.0-or-later (readme, Logos) | Drawn for the demo; tool not recorded | 2026-09-29 |
| `patterns/images/logo-kestrel.png` | `7fa1fb49222b1cd365ea6d6f039732d4b9fc932d2a52f087f39b65c6b385e3e5` | Made for Origin Canvas, GPL-2.0-or-later (readme, Logos) | Drawn for the demo; tool not recorded | 2026-09-29 |
| `patterns/images/logo-mercer-street.png` | `7677c005a3e304d934219496233893eb62fab346c7aeaa301d592a67d2e06b97` | Made for Origin Canvas, GPL-2.0-or-later (readme, Logos) | Drawn for the demo; tool not recorded | 2026-10-05 |
| `patterns/images/logo-northgate.png` | `9f43a1e681535d547449252dc6aeeb66e45971631ce1615582ffce89a1b5dbd9` | Made for Origin Canvas, GPL-2.0-or-later (readme, Logos) | Drawn for the demo; tool not recorded | 2026-09-29 |
| `patterns/images/logo-westmount.png` | `3293a9c0508885501c4eb7d4363d2d044c4925032f0dba3cddbf99ab6c37ceb0` | Made for Origin Canvas, GPL-2.0-or-later (readme, Logos) | Drawn for the demo; tool not recorded | 2026-09-29 |
| `patterns/images/portrait-ben-carter.webp` | `21b1dcf8b1c4cd857714d17b346e3e440f4d3b14e1968661bdca03eb6e1acad8` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-10-11 |
| `patterns/images/portrait-claire-bennett.webp` | `5eb5d1f8c9d0df670bebd2a977fcf89bd9311520aaaa8cab92d5e49c78a0f9e4` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-10-11 |
| `patterns/images/portrait-hannah-wright.webp` | `04be1762833884e8150840d6322ecdeda1b95442c20abcb79ec90cac87eed726` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-10-11 |
| `patterns/images/portrait-marcus-holloway.webp` | `8a3e1a218fd7d8e60921fcf9c95871c3c9b29527507feca45c09f1b90d35e708` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-10-11 |
| `patterns/images/service-menus.webp` | `a9bbab47c3a550e14058e6b5b93402652754f058b6a1767f8c415f675b2663af` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded; cut to 2x of its widest column on 2026-11-01 (07ad504), tool not recorded | 2026-09-29 |
| `patterns/images/shop-front.webp` | `e807165cbd96d9af3f4e12f9a20b113a3c4ed8caba61a17ab2b769ce24b6f1d5` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-09-25 |
| `patterns/images/site-visit.webp` | `4f15fbc06d9aad7472b682b4948ac3e2802cad155969d000bb000d9f2defe71d` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded; cut to 2x of its widest column on 2026-11-01 (07ad504), tool not recorded | 2026-09-29 |
| `patterns/images/studio-one-project.webp` | `4e67ec23b4a4bc68977e38619d8cfcee4cd88ffb027f8df153171576ae892330` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-09-26 |
| `patterns/images/studio-review.webp` | `f16ea535c83e4ff5631de7d511181627d28c0906dede7052eaa663f78500764b` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded; cut to 2x of its widest column on 2026-11-01 (07ad504), tool not recorded | 2026-07-26 |
| `patterns/images/studio-type-proofs.webp` | `02fb85820b8bf3d8e83cdd904c2facb292eaadffd08032caafe2d76ade37b44b` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-09-26 |
| `patterns/images/studio-wireframe-review.webp` | `f94cd37404f522097eed9e23b2527f33102d5f9b622bbfeeff5b389e9f4a648c` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-09-26 |
| `patterns/images/studio-worktable.webp` | `9a836e04ecd7684080c42afd3290120c1f2e6fd6d935914afeac591c6124773d` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-07-26 |
| `patterns/images/tax-folder.webp` | `2cccd33490cb2a0e28247986fc2de70c724749b082e3961505b6fb74cac55d5c` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded; cut to 2x of its widest column on 2026-11-01 (07ad504), tool not recorded | 2026-09-29 |
| `patterns/images/timber-stack.webp` | `1ad96d9aafbe15d19fa43693222b8d3ed2dd28ad08d2c16cde10fbb5d90c92e5` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded | 2026-09-25 |
| `patterns/images/workspace-laptop.webp` | `fad38c1ead7d36e0f3fe5bfded54c042f4970920284558969675e73add68c7de` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded; cut to 2x of its widest column on 2026-11-01 (07ad504), tool not recorded | 2026-05-08 |
| `patterns/images/yard-sign.webp` | `e98958d3235ea81d5784a40457744e0e96db8d26b67a3bb63f7cc945a6d0fa1a` | AI-generated for Origin Canvas, GPLv3 (readme, Images) | OpenAI image generation (ChatGPT); prompt and model version not recorded; cut to 2x of its widest column on 2026-11-01 (07ad504), tool not recorded | 2026-09-29 |
| `screenshot.jpg` | `f5ffc3aeba4ca3525f58df3b77829562659a355ed2090225f9f19d34e2af024b` | The local demo's home page (readme, Theme Screenshot) | Browser capture at 1200 x 900, saved as JPEG (e776ae8) | 2026-05-15 |
