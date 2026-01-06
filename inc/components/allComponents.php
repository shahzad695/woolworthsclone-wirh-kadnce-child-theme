<?php
/**
 * All base features
 */
require get_template_directory() . '/inc/components/base.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/components/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/components/jetpack.php';
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/components/template-tags.php';