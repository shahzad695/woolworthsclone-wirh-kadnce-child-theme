<?php

add_action('woocommerce_after_shop_loop_item','add_save_button_inside_product_actions', 15);

function add_save_button_inside_product_actions() {
    global $product;

    if ( ! $product ) {
        return;
    }

    echo '<a 
        href="#"
        class="button product_type_simple product-save-button"
        data-product-id="' . esc_attr( $product->get_id() ) . '"
        aria-label="Save to list">
        Save to list
    </a>';
}