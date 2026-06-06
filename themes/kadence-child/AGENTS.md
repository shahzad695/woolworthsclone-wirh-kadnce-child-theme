# Kadence Child Theme Context

This is the active child theme for the Woolworths-style WooCommerce interface.

## Read First

Before changing this theme, read:

1. `GEMINI.md`
2. `../../.codex/README.md`
3. `../../.codex/agents/wordpress-theme.toml`

Also read the relevant specialist file when needed:

- WooCommerce behavior: `../../.codex/agents/wordpress-woocommerce.toml`
- Broad CSS architecture: `../../.codex/agents/wordpress-css-architect.toml`
- Custom plugin behavior: `../../.codex/agents/wordpress-plugin.toml`

## Theme Architecture

- Keep `functions.php` minimal.
- Load PHP modules through `inc/components/allComponents.php`.
- Put WooCommerce theme-level customizations in `inc/components/woocomerce/`.
- Put reusable markup in `template-parts/`.
- Put SCSS, JS, and source images in `assets/src/`.
- Do not hand-edit compiled assets in `assets/public/` unless the task explicitly requires it.

## CSS And JS

- Use mobile-first SCSS.
- Use Sass fully for authoring: partials, nesting, mixins, functions, maps, loops, and organization.
- Use CSS custom properties as the design-token source of truth.
- Do not use Sass variables for reusable colors, spacing, typography, radii, shadows, breakpoints, z-indexes, or component theme values.
- Sass variables are allowed only for local build logic, especially when maps/functions emit CSS that consumes custom properties.
- Use literal values in media query conditions, such as `48rem`; keep matching `--breakpoint-*` custom properties as documented tokens.
- Add new component styles as partials under `assets/src/css/` and import them through `assets/src/css/all.scss`.
- Prefer low-specificity selectors and project variables/tokens.
- Avoid `!important` unless there is no reasonable alternative.
- Keep JavaScript modular under `assets/src/js/`.
- Use `npm run dev` for watch mode and `npm run build` for production assets.

## PHP

- Keep child-theme PHP small, modular, and hook-based.
- Prefix project functions with `kadence_custom_`.
- Sanitize input and escape output.
- Use nonces and capability checks for mutations.
- Prefer WooCommerce hooks and APIs before template overrides.

## Verification

- For visual work, check mobile, tablet, and desktop widths.
- For WooCommerce work, check product, add-to-cart, cart, and checkout flows when relevant.
- For asset changes, run or note the needed build command.
