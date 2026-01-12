<?php
function woolworth_toggle_save_product() {

if ( ! is_user_logged_in() ) {
wp_send_json_error( 'not_logged_in' );
}

$product_id = absint( $_POST['product_id'] );
$user_id = get_current_user_id();

$saved = get_user_meta( $user_id, 'saved_products', true );

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

add_action( 'wp_ajax_toggle_save_product', 'woolworth_toggle_save_product' );