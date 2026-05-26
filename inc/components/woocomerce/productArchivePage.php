<?php

/*
Product Save to list button cutomization
*/
add_action('woocommerce_after_shop_loop_item','add_save_button_inside_product_actions', 15);

function add_save_button_inside_product_actions() {
    global $product;

    if ( ! $product ) {
        return;
    }
    if ( ! is_user_logged_in() ) {
        return;
    }
    error_log( 'DEBUG TEST WORKING' );

    $saved = get_user_meta( get_current_user_id(), 'saved_products', true );
    $is_saved = is_array( $saved ) && in_array( $product->get_id(), $saved );

    $class = $is_saved ? 'is-saved' : '';
    $text  = $is_saved ? 'Saved' : 'Save';

    echo '<a 
        href="#"
        class="button product_type_simple product-save-button ' . esc_attr( $class ) . '"
        data-product-id="' . esc_attr( $product->get_id() ) . '"
        aria-label="' . esc_html( $text ) . ' to list">
        ' . esc_html( $text ) . ' to list
    </a>';
}

/*
           ****** Product badge cutomization ******
           ___________________________________________
*/
add_action( 'woocommerce_after_shop_loop_item_title', 'woolworths_stock_badges', 6 );

function woolworths_stock_badges() {
    global $product;

    if ( ! $product instanceof WC_Product ) {
        return;
    }

    echo '<div class="product__badge-wrap">';

    // OUT OF STOCK
    if ( ! $product->is_in_stock() ) {
        echo '<span class="product__badge product__badge--out bg-lighter">Out of Stock</span>';
    }
    // LOW STOCK (only if stock management enabled)
    elseif ( $product->managing_stock() ) {
        $stock_qty   = $product->get_stock_quantity();
        $low_stock   = wc_get_low_stock_amount( $product );

        if ( $low_stock && $stock_qty !== null && $stock_qty <= $low_stock ) {
            echo '<span class="product__badge product__badge--low bg-lighter">Low Stock</span>';
        }
    }

    echo '</div>';
}

// remove price for out of stock products

add_filter( 'woocommerce_get_price_html', 'woolworths_hide_price_out_of_stock', 10, 2 );

function woolworths_hide_price_out_of_stock( $price, $product ) {

    if ( ! $product->is_in_stock() ) {
        return ''; // remove price completely
    }

    return $price;
}