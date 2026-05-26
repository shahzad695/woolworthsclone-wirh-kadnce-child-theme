<?php
// remove product meta (stock position, categories and tags ) from single product page
remove_action(
    'woocommerce_single_product_summary',
    'woocommerce_template_single_meta',
    40
);

// remove stock status from single product page

add_filter( 'woocommerce_get_stock_html', '__return_empty_string' );

// make all products sold individually to prevent quantity selection and multiple additions to cart

add_filter( 'woocommerce_is_sold_individually', function( $return, $product ) {
    if ( is_product() ) return true;
    return $return;
}, 10, 2 );

// custom stock badges for single product page
add_action(
    'woocommerce_before_single_product_summary',
    'woolworths_custom_image_badge',
    5
);
add_action(
    'woocommerce_before_shop_loop_item_title',
    'woolworths_custom_image_badge',
    9
);

function woolworths_custom_image_badge() {

    global $product;

    if ( ! $product instanceof WC_Product ) {
        return;
    }

    // Your image URL (replace this)
    $badge_url = get_stylesheet_directory_uri() . '/assets/src/img/australian-grown.avif';

    echo '<div class="custom-product-badge">
            <img src="' . esc_url( $badge_url ) . '" alt="Badge">
          </div>';
}