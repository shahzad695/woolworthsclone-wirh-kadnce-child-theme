<?php
/**
 * WooCommerce Archive Page Customizations
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add custom classes to the loop add to cart link.
 */
add_filter( 'woocommerce_loop_add_to_cart_link', function( $html ) {
    return str_replace(
        'button',
        'button woolworths-button btn-primary',
        $html
    );
} );

/**
 * Render the "Save to List" button on archive and single product pages.
 */
function woolworths_render_save_button() {
    global $product;

    if ( ! $product instanceof WC_Product || ! is_user_logged_in() ) {
        return;
    }

    $saved    = get_user_meta( get_current_user_id(), 'saved_products', true );
    $is_saved = is_array( $saved ) && in_array( $product->get_id(), $saved );

    $class = $is_saved ? 'is-saved' : '';
    $text  = $is_saved ? __( 'Saved', 'woolworths-clone' ) : __( 'Save', 'woolworths-clone' );

    printf(
        '<a href="#" class="woolworths-button product_type_simple btn-outline %s" data-product-id="%d" aria-label="%s to list">%s to list</a>',
        esc_attr( $class ),
        absint( $product->get_id() ),
        esc_html( $text ),
        esc_html( $text )
    );
}

// Add save button inside product actions on product archive page
add_action( 'woocommerce_after_shop_loop_item', 'woolworths_render_save_button', 15 );
// Add save button inside product actions on single product page
add_action( 'woocommerce_before_add_to_cart_button', 'woolworths_render_save_button', 25 );
