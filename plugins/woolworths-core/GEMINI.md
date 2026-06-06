# Woolworths Core Plugin

Follow the **Unified Technical Standards** in the root `GEMINI.md` for all PHP and architecture development.

## Plugin Specifics
- **Primary Source:** `src/`.
- **Assets:** Build to `assets/`.
- **Focus:** Custom post types, taxonomies, REST API, and feature logic.
- **Integration:** Use hooks to interact with the theme and WooCommerce.

## Styling Policy
- Sass is allowed for plugin assets, including partials, nesting, mixins, functions, maps, and loops.
- CSS custom properties are the design-token source of truth.
- Do not use Sass variables for reusable design values such as colors, spacing, typography, radii, shadows, breakpoints, z-indexes, or component theme values.
- Sass maps/functions may be used for selector generation when the emitted CSS consumes custom properties.
