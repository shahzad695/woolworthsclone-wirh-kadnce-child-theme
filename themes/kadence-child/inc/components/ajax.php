<?php

function woolworths_toggle_save_product() {
    if ( ! check_ajax_referer( 'save_to_list_nonce', 'nonce', false ) || ! is_user_logged_in() ) {
        wp_send_json_error( __( 'Unauthorized request.', 'woolworths-clone' ) );
    }

    $product_id = absint( $_POST['product_id'] ?? 0 );
    if ( ! $product_id ) {
        wp_send_json_error( __( 'Invalid product ID.', 'woolworths-clone' ) );
    }

    $user_id = get_current_user_id();
    $saved   = get_user_meta( $user_id, 'saved_products', true );

    if ( ! is_array( $saved ) ) {
        $saved = [];
    }

    if ( in_array( $product_id, $saved ) ) {
        $saved = array_diff( $saved, [ $product_id ] );
        $state = 'removed';
    } else {
        $saved[] = $product_id;
        $state = 'added';
    }

    update_user_meta( $user_id, 'saved_products', $saved );

    wp_send_json_success([
        'state' => $state,
    ]);
}

add_action( 'wp_ajax_toggle_save_product', 'woolworths_toggle_save_product' );
add_action( 'wp_ajax_nopriv_toggle_save_product', 'woolworths_toggle_save_product' );