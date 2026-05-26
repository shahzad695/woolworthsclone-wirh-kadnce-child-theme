<?php
/**
 * Kadence Child Theme functions
 */

 function kadence_child_theme_styles_enqueue() {

    // Child theme stylesheet
    wp_enqueue_style(
        'kadence-child', get_stylesheet_directory_uri() . '/assets/public/frontend.css',[ ],wp_get_theme()->get('Version'));
     wp_enqueue_script(
        'woolworth-save-products', get_stylesheet_directory_uri() . '/assets/public/frontend.js', [], null, true);

    wp_localize_script(
        'woolworth-save-products',
        'woolworthSave',
        [
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'save_to_list_nonce' ),
        ]
    );

}
add_action( 'wp_enqueue_scripts', 'kadence_child_theme_styles_enqueue', 30 );