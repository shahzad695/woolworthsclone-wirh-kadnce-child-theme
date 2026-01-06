<?php
/**
 * Kadence Child Theme functions
 */

add_action( 'wp_enqueue_scripts', function() {

    // Parent theme stylesheet (optional but safe)
    wp_enqueue_style(
        'kadence-parent',
        get_template_directory_uri() . '/style.css'
    );

    // Child theme stylesheet
    wp_enqueue_style(
        'kadence-child',
        get_stylesheet_directory_uri() . '/style.css',
        [ 'kadence-parent' ],
        wp_get_theme()->get('Version')
    );

}, 20 );