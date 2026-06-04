<?php
namespace WoolworthsCore\Assets;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class AssetLoader {
    public function enqueue_styles() {
        wp_register_style(
            'woolworths-core-badges',
            WOOL_CORE_PLUGIN_URL . 'assets/public/product-badges.css',
            [],
            WOOL_CORE_VERSION
        );

        wp_enqueue_style( 'woolworths-core-badges' );
    }
}
