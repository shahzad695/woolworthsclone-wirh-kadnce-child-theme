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