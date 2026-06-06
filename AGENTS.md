# WordPress Content Context

This is the active WordPress customization area for the project.

## Required Context

Before changing code in `wp-content`, read:

1. `.codex/README.md`
2. `.codex/agents/wordpress-theme.toml`
3. `.codex/agents/wordpress-woocommerce.toml`
4. `.codex/agents/wordpress-plugin.toml`
5. `.codex/agents/wordpress-css-architect.toml`
6. `themes/kadence-child/AGENTS.md`
7. `themes/kadence-child/GEMINI.md`

## Boundaries

- Prefer custom code in `themes/kadence-child/` or a custom plugin.
- Do not edit `themes/kadence/`.
- Do not edit `plugins/woocommerce/`.
- Do not edit WordPress core.
- Treat `themes/kadence-child/assets/src/` as source files.
- Treat `themes/kadence-child/assets/public/` as build output.

## Agent Routing

- `wordpress-theme`: Kadence child theme, template parts, small hooks, responsive layout, typography, local SCSS/CSS.
- `wordpress-woocommerce`: WooCommerce behavior, hooks, filters, product/cart/checkout/account flows.
- `wordpress-plugin`: Custom plugin architecture, admin features, REST API, post types, taxonomies, metaboxes, services.
- `wordpress-css-architect`: CSS system design, tokens, cascade, responsive architecture, SCSS organization.
