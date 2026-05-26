# Woolworths Clone - Kadence Child Theme

This is a WordPress child theme for **Kadence**, specifically designed to clone the Woolworths website interface and functionality.

## Architecture & Conventions

### 1. PHP Modular Structure
- **Root Logic:** `functions.php` is kept clean, only requiring `inc/components/allComponents.php`.
- **Components:** Logic is organized into modular components within `inc/components/`.
    - `inc/components/woocomerce/`: Contains WooCommerce-specific overrides (Archive, Single Product).
    - `inc/components/ajax.php`: Centralized AJAX handlers.
    - `inc/template-functions/`: General helper functions and theme-specific logic.
- **Template Parts:** Reusable HTML blocks are stored in `template-parts/`.

### 2. Asset Management
- **Source Files:** Located in `assets/src/`.
    - **SCSS:** Organized by type (layout, components, global styles) in `assets/src/css/`.
    - **JS:** Modular JavaScript files in `assets/src/js/`.
- **Build System:** Webpack is used to bundle assets.
    - Entry point: `assets/src/index.js`.
    - Output: Compiled to `assets/public/frontend.css` and `assets/public/frontend.js`.
- **Scripts:**
    - `npm run dev`: Starts Webpack in development mode with `--watch`.
    - `npm run build`: Generates production-ready, minified assets.

### 3. Styling Conventions (SCSS)
- **Base:** `variables.scss`, `reset.scss`, `utility.scss`.
- **Layout:** `layout/` directory for grid and structural styles.
- **Components:** `components/` directory for specific UI elements (e.g., `shoppage/_product-cart.scss`).
- **Imports:** `all.scss` aggregates all SCSS files.

### 4. JavaScript Conventions
- Modern ES6+ syntax is used.
- **Axios:** Preferred for API requests (configured in `package.json`).
- **Modules:** JS logic is split into files like `navigation.js`, `header.js`, and `savetoProductsList.js`.

## Key Directories
- `inc/`: PHP core logic and components.
- `assets/src/`: Source code for CSS/JS/Images.
- `assets/public/`: Compiled distribution files (Do not edit directly).
- `template-parts/`: Custom template overrides and partials.

## Workflow
1. When adding new styles, create a new `_component.scss` file in `assets/src/css/components/` and import it into `all.scss`.
2. When adding new PHP functionality, consider creating a new component in `inc/components/` and including it in `all.components.php`.
3. Always run `npm run dev` during development to ensure assets are compiled in real-time.
