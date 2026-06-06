<?php
/**
 * Unified asset loading for the Woolworths clone project.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function woolworths_enqueue_assets() {
    // Child theme styles (compiled)
    wp_enqueue_style(
        'woolworths-style',
        get_stylesheet_directory_uri() . '/assets/public/frontend.css',
        [],
        wp_get_theme()->get( 'Version' )
    );

    // Child theme scripts (compiled)
    wp_enqueue_script(
        'woolworths-script',
        get_stylesheet_directory_uri() . '/assets/public/frontend.js',
        ['jquery'],
        null,
        true
    );

    // Localize data for AJAX and other frontend needs
    wp_localize_script(
        'woolworths-script',
        'woolworthsData',
        [
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'save_to_list_nonce' ),
        ]
    );
}
add_action( 'wp_enqueue_scripts', 'woolworths_enqueue_assets', 30 );
