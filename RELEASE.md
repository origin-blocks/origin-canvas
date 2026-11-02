# Releasing Origin Canvas

The git-flow steps are the pipeline's `templates/release-gate.md`. This file holds only what
Canvas does differently; where the two differ, this file wins.

- **What publishes.** The theme is on wordpress.org (since 1.3.1) and GitHub. Pushing a tag
  `X.Y.Z` runs `.github/workflows/release.yml`: `verify-master` (the tag is on `master`,
  `bin/package-theme.sh` passes, the zip is under 5,000,000 bytes), `release` (the shared
  `origin-blocks/theme-workflows` build makes `origin-canvas.X.Y.Z.zip` and the GitHub release
  from the `= X.Y.Z` entry in `readme.txt`) and `deploy-demo` (ships the tag to the public demo).
  Never create the release by hand, and never move a tag: a wrong release gets a follow-up.
- **Version strings.** `style.css` (`Version:`), `package.json` and the two root `version`
  values in `package-lock.json`. There is no `changelog.txt` and no stable tag; the entry is
  written against the last tag (`git log --merges --first-parent <tag>..develop`).
  `bin/check-pattern-counts.sh` reads every "N patterns" in `readme.txt` as the library total,
  so a count of added or changed patterns needs a word between the number and "patterns".
- **Preflight, in place of the gate's build step.** On the release branch after the commit:
  `bash bin/package-theme.sh`, list `dist/origin-canvas.zip` (no `bin/`, `docs/`, `tests/`,
  `.github/`, `CLAUDE.md`, `CONTRIBUTING.md` or `RELEASE.md`), compare it with `git archive HEAD`,
  diff its file list against the previous release's asset (`gh release download <tag>
  --pattern '*.zip'`; every difference is one the entry accounts for), and build once more from a
  fresh clone the way the workflow does (`rsync -a --exclude-from=.distignore`, then `zip -r`).
- **Order.** Finish, then `git push --atomic origin develop master X.Y.Z`. Watch the run
  (`gh run list --workflow release.yml`). Check the release: title `X.Y.Z`, body equal to the
  entry's bullets, the one asset unpacking to the same files as `git archive X.Y.Z`, and its size
  read against the previous release's. Check the demo shows the release. The gate's demo gate and
  hand-made GitHub release do not apply.
- **wordpress.org.** The owner uploads the GitHub asset (downloaded, never a local build). When
  `https://downloads.wordpress.org/theme/origin-canvas.X.Y.Z.zip` returns 200, `diff -rq` its
  contents against the asset's: it must print nothing.
- **Docs.** Check the docs site (branch `gh-pages`) against the entry and list what needs an update.
