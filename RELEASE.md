# Releasing Origin Canvas

Read this before any tag, version or changelog work. The theme is not on wordpress.org. It
ships as a zip on a GitHub release, and pushing a version tag is what publishes it.

## What publishes

`.github/workflows/release.yml` runs on a pushed tag shaped `X.Y.Z`. It checks that the tag
is on `master`, then calls `origin-blocks/theme-workflows/.github/workflows/build-release.yml@v1`,
which builds `origin-canvas.X.Y.Z.zip` from `.distignore`, cuts the release body from the
`= X.Y.Z` entry in `readme.txt`, and creates the GitHub release. Never create the release by
hand: a manual one races the workflow. A tag is never moved; a wrong release gets a follow-up.

## Where the version lives

`style.css` (`Version:`), `package.json` (`version`) and the two root `version` values in
`package-lock.json`. `functions.php` reads `ORIGIN_CANVAS_VERSION` from `style.css`.

## The steps

1. In the main checkout on `develop`, with a clean tree and `develop` and `master` level with
   `origin`. The owner names the version.
2. `git flow release start X.Y.Z`.
3. Write the `readme.txt` entry against the last tag (`git log --merges --first-parent
   <tag>..develop`), following the writing guide's changelog rules, and set the four version
   strings. `bin/check-pattern-counts.sh` reads every "N patterns" in `readme.txt` as the
   library total, so a count of added or changed patterns needs a word between the number and
   "patterns". Leave the edits uncommitted until the owner has read `git diff` and said
   "commit".
4. Commit. `bash bin/package-theme.sh` builds `dist/origin-canvas.zip` as a preflight: list it
   (no `bin/`, `docs/`, `tests/`, `.github/`, `CLAUDE.md`, `CONTRIBUTING.md` or `RELEASE.md`),
   check the version strings inside, and compare its contents with `git archive HEAD`. Then
   diff its file list against the previous release's zip (`gh release download <last tag>
   --pattern '*.zip'`): every added or removed path must be one the changelog accounts for,
   and nothing from the excluded folders may appear. Build the zip once more the way the
   workflow does, from a fresh clone of the release head so no untracked file rides along
   (`rsync -a --exclude-from=.distignore ./ dist/origin-canvas/`, then `zip -r`), and confirm
   it unpacks to the same files as the preflight. The workflow runs only on the
   pushed tag, so these three compares are the last look before anything is public.
5. With the owner's go: `git flow release finish -m "X.Y.Z" X.Y.Z` (git-flow AVH 1.12.3).
   Before pushing, check that `git merge-base --is-ancestor master develop` succeeds,
   `git log --oneline develop..master` is empty, `git diff --stat master develop` is empty,
   and the tag's commit equals `master`.
6. `git push --atomic origin develop master X.Y.Z`.
7. Find the Release run for the tag (`gh run list --workflow release.yml`), watch it, then
   check the release: the title is `X.Y.Z`, the body equals the entry's bullets, and the one
   asset, `origin-canvas.X.Y.Z.zip`, unpacks to the same files as `git archive X.Y.Z`.
8. Check the docs site (branch `gh-pages`) against the entry and list what needs an update.
