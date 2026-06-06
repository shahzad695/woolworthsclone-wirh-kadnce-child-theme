# Kadence Child Theme

Follow the **Unified Technical Standards** in the root `GEMINI.md` for all PHP, SCSS, and JS development.

## Theme Specifics
- **Primary Logic:** `inc/components/allComponents.php`.
- **Assets:** Edit in `assets/src/`, build to `assets/public/`.
- **WooCommerce:** Keep overrides in `inc/components/woocomerce/`.
- **Templates:** Use `template-parts/` for reusable markup.

## Styling Policy
- Sass is the authoring language and may use partials, nesting, mixins, functions, maps, and loops.
- CSS custom properties are the design-token source of truth.
- Do not use Sass variables for reusable design values such as colors, spacing, typography, radii, shadows, breakpoints, z-indexes, or component theme values.
- Sass variables, maps, and functions are allowed for local build logic when they emit CSS that consumes custom properties.
- Use literal values in media query conditions; CSS custom properties cannot be used inside media query conditions.
