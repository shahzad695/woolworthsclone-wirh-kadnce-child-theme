<?php
/**
 * WooCommerce Single Product Page Customizations
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Remove standard product meta (categories, tags) from single product summary.
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/**
 * Remove stock status display from single product page.
 */
add_filter( 'woocommerce_get_stock_html', '__return_empty_string' );

/**
 * Make products sold individually on the single product page to prevent quantity selection.
 */
add_filter( 'woocommerce_is_sold_individually', function( $return, $product ) {
    if ( is_product() ) {
        return true;
    }
    return $return;
}, 10, 2 );

/**
 * Render custom Australian Grown badge.
 * This is kept in the theme as it targets specific template locations with custom markup.
 */
function woolworths_render_australian_grown_badge() {
    global $product;

    if ( ! $product instanceof WC_Product ) {
        return;
    }

    $badge_url = get_stylesheet_directory_uri() . '/assets/src/img/australian-grown.avif';

    echo '<div class="woolworths-custom-badge"><img src="' . esc_url( $badge_url ) . '" alt="' . esc_attr__( 'Australian Grown', 'woolworths-clone' ) . '"></div>';
}

// Add the badge before product summary and before shop loop item title
add_action( 'woocommerce_before_single_product_summary', 'woolworths_render_australian_grown_badge', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woolworths_render_australian_grown_badge', 9 );
