# Demo site

A local WordPress site that runs the Origin Canvas theme with demo content, the way a user sees
it. Nothing in `bin/` ships in the theme zip.

Each demo site holds a `DEMO-SITE.md` file in its root. It marks the folder as a demo site, lists
its URLs and holds the admin password. It stays on that machine and is never committed. The
scripts here change only a folder that holds this file.

## Setup

You need WP-CLI, MySQL and a web server that serves the parent folder. The defaults fit MAMP with
MySQL root/root on MAMP's socket, Apache on port 80 and the document root set to `~/Sites`, so
a site is at http://localhost/<folder>/. MAMP's own defaults differ (`/Applications/MAMP/htdocs`
on port 8888): change MAMP's settings, or set `DEMO_SITES_DIR` and `DEMO_SITES_URL` to match.

```
bin/demo/setup.sh ~/Sites/canvas-demo                 # database canvas-demo
bin/demo/setup.sh ~/Sites/canvas-demo my-database     # another database name
```

The script downloads WordPress, creates the database, installs the site with a generated admin
password, links the theme, writes `DEMO-SITE.md` and runs the reset. It refuses if the folder or
the database already exists. The folder name may use only letters, digits, `.`, `-` and `_`.

- `wp-content/themes/origin-canvas` links to the main checkout of the repo the script runs in,
  so the site shows develop as it is on disk, even when you run it from a worktree.
- `wp-content/themes/origin-canvas-worktrees` links to the `origin-canvas-worktrees` folder
  beside that checkout, if there is one.
- No plugins are installed. The reset adds the switches plugin to `wp-content/mu-plugins/`.

Environment variables change the defaults. The script header lists them all: the MySQL host,
user and password, the served folder and its URL, the site URL, the admin login and email, the
WordPress version and locale, and the two folders to link. For example:

```
DEMO_DB_HOST=127.0.0.1:3306 DEMO_DB_PASSWORD=secret bin/demo/setup.sh ~/Sites/canvas-demo
```

## Reset

Run from any origin-canvas checkout that has `bin/demo/`:

```
bin/demo/reset.sh ~/Sites/canvas-demo
```

The reset deletes all posts, pages, menus, comments, terms, uploads and Site Editor changes, then
seeds the site again from `bin/demo/seed.php`. It also copies the switches plugin into
`wp-content/mu-plugins/` and makes sure `.htaccess` denies web access to `DEMO-SITE.md`. Users
stay.

## Content

- Home: the `page-studio` pattern, set as the front page.
- One page for every other `origin-canvas/page-*` pattern, titled with the pattern's title, using
  the **Page (Full Width, No Title)** template.
- Blog: the posts page, with nine posts in three categories, featured images from the theme, and
  comments from the studio team.
- Primary menu: Home, the page-pattern pages, Blog.

Each page holds a reference to its pattern, so it renders the pattern as the active theme has it
now. A change to an existing page pattern shows on reload, also under `?octheme=`.

To add a page pattern, add `patterns/page-<role>-NN.php` to the theme, then run the reset. The
seed finds every registered `origin-canvas/page-*` pattern, makes a page for it and adds it to the
menu.

## Switches

Front end only. They save nothing and can be combined.

- `?octheme=<worktree-folder>` shows a branch, for example `?octheme=fix-primary-resting-text`.
- `?ocvariation=<slug>` shows a style variation, for example `?ocvariation=editorial` or
  `?ocvariation=blue`. The slug is the file name in `styles/`, `styles/colors/` or
  `styles/typography/`.

The switch applies to the page you open only. Links in the menu lead back to the plain site.

## Pattern library

`/pattern-library/`, open to every visitor. It shows every registered pattern by category, hidden
patterns last. It is a route in `bin/demo/pattern-library`, not a page, and takes `?octheme=` and
`?ocvariation=`.

## Design system

`/design-system/`, administrators only. A private page that the seed makes, holding one block
that renders `bin/demo/design-system` inside the theme's own template. It shows text colors and
surfaces with their contrast ratios as the browser paints them.

## Checks

Two checks run against a demo site before a branch merges. Both need `npm install` and
`npx playwright install chromium` in the theme folder, and take the site path (default
`~/Sites/canvas-demo`):

```
bash bin/check-block-validity.sh ~/Sites/canvas-demo
bash bin/check-tracking-render.sh ~/Sites/canvas-demo
```

- `check-block-validity.sh` loads every pattern into one editor draft and fails on an invalid
  block, a recovery prompt or a block the editor rewrites on load.
- `check-tracking-render.sh` renders every pattern at 1440 and 390, under every style variation,
  and checks letter spacing against font size.
