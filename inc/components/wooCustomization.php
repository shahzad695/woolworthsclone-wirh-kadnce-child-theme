<?php

add_action('woocommerce_after_shop_loop_item','add_save_button_inside_product_actions', 15);

function add_save_button_inside_product_actions() {
    global $product;

    if ( ! $product ) {
        return;
    }
    if ( ! is_user_logged_in() ) {
        return;
    }

    $saved = get_user_meta( get_current_user_id(), 'saved_products', true );
    $is_saved = is_array( $saved ) && in_array( $product->get_id(), $saved );

    $class = $is_saved ? 'is-saved' : '';
    $text  = $is_saved ? 'Saved' : 'Save';

    echo '<a 
        href="#"
        class="button product_type_simple product-save-button ' . esc_attr( $class ) . '"
        data-product-id="' . esc_attr( $product->get_id() ) . '"
        aria-label="' . esc_html( $text ) . ' to list">
        Save to list
    </a>';
}