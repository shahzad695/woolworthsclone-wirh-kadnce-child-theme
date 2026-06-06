<?php
namespace WoolworthsCore\Assets;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class AssetLoader {
    /**
     * Enqueue styles for the product badge system.
     */
    public function enqueue_styles() {
        wp_register_style(
            'woolworths-core-badges',
            WOOLWORTHS_CORE_URL . 'assets/public/product-badges.css',
            [],
            WOOLWORTHS_CORE_VERSION
        );

        wp_enqueue_style( 'woolworths-core-badges' );
    }
}
