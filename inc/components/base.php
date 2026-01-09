<?php
/**
 * Kadence Child Theme functions
 */

 function kadence_child_theme_styles_enqueue() {

    // Child theme stylesheet
    wp_enqueue_style(
        'kadence-child', get_stylesheet_directory_uri() . '/assets/public/frontend.css',[ ],wp_get_theme()->get('Version')
    );

}
add_action( 'wp_enqueue_scripts', 'kadence_child_theme_styles_enqueue', 30 );