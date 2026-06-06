# Codex Agent Setup

This folder defines the project-specific Codex agent routing for the Woolworths-on-Kadence WordPress project.

## Active Agents

- `agents/wordpress-theme.toml`
  - Kadence child theme specialist.
  - Use for template parts, small hook-based PHP, theme styling, typography, responsive layout, and theme assets.

- `agents/wordpress-woocommerce.toml`
  - WooCommerce specialist.
  - Use for products, archives, single product pages, cart, checkout, account flows, price display, stock UI, WooCommerce hooks, filters, and template overrides.

- `agents/wordpress-plugin.toml`
  - Custom plugin specialist.
  - Use for post types, taxonomies, metaboxes, REST API, admin pages, feature services, helpers, hooks, and custom architecture.

- `agents/wordpress-css-architect.toml`
  - SCSS/CSS architecture specialist.
  - Use for design tokens, outside-in CSS structure, cascade strategy, layout utilities, component systems, and larger style migrations.

## Path Correction

The WordPress content root in this Local setup is:

`public/wp-content/`

When an agent instruction mentions `app/wp-content/...`, interpret that as `public/wp-content/...` for this workspace.

## Operating Rules

- Read the matching agent file before starting specialized work.
- Read `themes/kadence-child/GEMINI.md` before changing the child theme.
- Prefer source edits in `themes/kadence-child/assets/src/`.
- Run the theme build when source assets change, when practical.
- Report changed files and verification performed.
