# Clear Wellness 2026 — Theme Developer Guide

Custom WordPress theme using ACF Blocks, a modular SCSS system, and a Gulp build pipeline.

---

## Table of Contents

1. [Project Structure](#project-structure)
2. [Building New Blocks](#building-new-blocks)
3. [Gulp Build Pipeline](#gulp-build-pipeline)
4. [Security & Accessibility Notes](#security--accessibility-notes)

---

## Project Structure

```
clear-wellness-2026/
├── acf-json/               ACF field groups (auto-synced from WP admin)
├── app/
│   ├── Helpers/            BlockCategory, PostType, Router, etc.
│   └── Theme/              ThemeBlocks, ThemeSetup, ThemePostTypes, ThemeTaxonomies
├── dist/
│   ├── css/                Compiled CSS (do not edit directly)
│   └── js/                 Compiled JS (do not edit directly)
├── gulp/                   Individual Gulp task modules
├── parts/
│   ├── blocks/             ACF block templates ({block-name}-block.php)
│   ├── siteHeader.php
│   └── siteFooter.php
├── src/
│   ├── js/                 Source JavaScript modules
│   └── scss/               Source SCSS (modules + abstracts)
├── Gulpfile.js
├── functions.php           Global helpers: blockId(), openModal(), the_accordion()
└── setup.php               Theme setup and class instantiation
```

---

## Building New Blocks

Blocks are ACF blocks — PHP templates rendered by the `BlockCategory` class. Each new block requires three things: a PHP registration call, a template file, and an ACF field group.

### Step 1 — Register the block

Open `app/Theme/ThemeBlocks.php` and add a line inside the constructor:

```php
$blocks->addBlock( 'my-block', 'My Block' );
```

The first argument is the block slug (used to locate the template file). The second is the label shown in the Gutenberg inserter. Both must be kebab-case.

All blocks are grouped under the **Collective Measures** category in the inserter.

### Step 2 — Create the template file

Create `parts/blocks/my-block-block.php`. The `BlockCategory::renderBlock()` method wraps your template automatically inside:

```html
<div class="gcBlock [spacing / background / layout classes]">
    <!-- your template renders here via get_template_part() -->
</div>
```

Inside the template, get your ACF fields as usual:

```php
$title = get_field('title');
$content = get_field('content');
```

The following global block fields are available on every block at no extra cost (they are added via `acf-json/group_650807f39d965.json`):

| Field | Class applied to `.gcBlock` |
|---|---|
| Top / bottom spacing | `spacing--top-{value}`, `spacing--bottom-{value}` |
| Inside spacing | `inside-spacing--top-{value}`, `inside-spacing--bottom-{value}` |
| Background | `gcBlock--bg-{value}` |
| Layout | `gcBlock--layout-{value}` |
| Border top / bottom | `border-top`, `border-bottom` |
| Visibility | `gcBlock--visibility-hidden` (hidden on front-end, visible in admin) |
| Anchor ID | rendered as `id="…"` on the wrapper |

### Step 3 — Create the ACF field group

In the WordPress admin under **ACF → Field Groups**, create a new group. Set the location rule to:

> **Block** is equal to **Collective Measures / My Block**

Save — ACF will write the JSON to `acf-json/` automatically. Commit that file alongside your code.

### Step 4 — Optional: block preview image

If you want a static preview image to show in the block inserter instead of a live render, place a PNG at:

```
block-previews/my-block.png
```

The `BlockCategory` class checks for this file automatically and renders the image when `is_preview` is true.

### Useful helpers

`functions.php` provides three global helpers used across blocks:

**`blockId()`** — returns a unique string like `block-64f3a2…`. Use it to link `aria-labelledby` to headings and to ensure IDs are unique when a block appears multiple times on a page.

```php
$bid = blockId();
// <section aria-labelledby="<?= $bid; ?>-title">
// <h2 id="<?= $bid; ?>-title">…</h2>
```

**`openModal( $id, $title, $small )`** / **`closeModal()`** — renders a fully accessible `role="dialog"` modal shell with focus-trap JS already wired up. Use them instead of writing modal markup from scratch.

```php
<?php openModal( $slug, $card['title'] ); ?>
    <!-- modal body content -->
<?php closeModal(); ?>
```

**`the_accordion( $items, $title_class )`** — renders an accessible accordion from a repeater field array. Handles `aria-expanded`, `aria-controls`, and unique mask IDs internally.

---

## Gulp Build Pipeline

### Prerequisites

```bash
npm install
```

### Commands

| Command | What it does |
|---|---|
| `gulp` | Compile SCSS + JS, then watch for changes with BrowserSync |
| `gulp scss` | Compile SCSS once |
| `gulp js` | Compile JS once |
| `gulp module --myModuleName` | Scaffold a new SCSS module (see below) |

The default `gulp` task is what you run during active development. BrowserSync proxies `http://localhost` and injects CSS changes without a page reload; PHP and JS changes trigger a full reload.

### Source → output mapping

| Source | Output |
|---|---|
| `src/scss/app.scss` | `dist/css/app.css` |
| `src/scss/gutenberg.scss` | `dist/css/gutenberg.css` |
| `src/scss/admin-styles.scss` | `dist/css/admin-styles.css` |
| `src/js/*.js` | `dist/js/main.js` + `dist/js/main.min.js` |

Never edit files in `dist/` directly — they are overwritten on every build.

### Cache busting

Every build automatically rewrites the `Version:` timestamp in `style.css`. WordPress uses this value as a cache-buster for enqueued assets.

### SCSS module system

Styles are split into small modules under `src/scss/modules/`. Abstracts (color tokens, variables, mixins) live in `src/scss/modules/abstracts/` and are available in every module via `@use "abstracts" as *`.

To scaffold a new module, run:

```bash
gulp module --my-module-name
```

This command does three things automatically:

1. Creates `src/scss/modules/_my-module-name.scss` with the module boilerplate.
2. Adds `@forward "my-module-name"` to `src/scss/modules/_index.scss`.
3. Adds `@include my-module-name` to `src/scss/_modulesList.scss`.

After scaffolding, the module is compiled on the next SCSS build — no manual wiring needed.

---

## Security & Accessibility Notes

These notes summarize lessons learned from four rounds of audits (see `AUDIT.md` through `AUDIT4.md` for the full findings and fix history).

### Output escaping — always escape ACF fields

Every ACF field value must be escaped before output. The right function depends on where the value is used:

| Context | Function |
|---|---|
| HTML body (headings, text, `<p>`) | `esc_html( $value )` |
| HTML attributes (`class`, `id`, `aria-*`) | `esc_attr( $value )` |
| `href` or `src` URLs | `esc_url( $value )` |
| WYSIWYG / rich-text fields | Raw output is acceptable; `wp_kses_post( $value )` adds a defensive layer |
| Raw iframe embeds | Must be raw — restrict the ACF field to Editor+ role in field settings |

WYSIWYG fields are output unescaped because they contain HTML processed by WordPress on save. All other fields (text, textarea, select, image ID, etc.) must be escaped. When in doubt, escape.

For stripping tags from a WYSIWYG excerpt, use WordPress's own function:

```php
// Not this
strip_tags( $lede )

// This
esc_html( wp_strip_all_tags( $lede ) )
```

### Unique IDs

Any element that needs an `id` — headings used with `aria-labelledby`, modal targets, accordion panels — must have a unique ID in case the block appears more than once on a page. Use `blockId()` for block-level IDs and `uniqid()` for repeated items within a block (e.g. accordion items, team cards).

Hardcoded IDs on inline SVG `<mask>` elements are a common source of visual bugs when a block is repeated: the browser reuses the first mask for all subsequent instances. Always generate mask IDs dynamically.

### Conditional `aria-labelledby`

Only add `aria-labelledby` on a `<section>` when the heading it points to will actually be rendered:

```php
<section class="container"
    <?php if ( $title ): ?>aria-labelledby="<?= $bid; ?>-title"<?php endif; ?>>
```

A `<section>` with an `aria-labelledby` that points to a missing ID produces an anonymous, unlabelled landmark — no better than a `<div>`, but noisier.

### Modals

All modals must use the `openModal()` / `closeModal()` helpers in `functions.php`. These emit the correct `role="dialog"`, `aria-modal="true"`, and `aria-label` attributes, and the matching JS in `src/js/modal.js` handles focus trapping, Escape-to-close, and focus return to the trigger element.

Modal triggers must be `<button>` elements (not `<a href="#…">`), and must carry a `data-modal="modal-{id}"` attribute to connect to the JS.

### Accessible block sections

A `<section>` without an accessible name (`aria-labelledby` or `aria-label`) is not exposed as a named landmark by screen readers — it behaves identically to a `<div>`. For blocks that do not have an internal heading, either add an `aria-label` describing the section's purpose, or use `<div class="container">` instead.
