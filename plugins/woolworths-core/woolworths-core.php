<?php
/**
 * Plugin Name: Woolworths Core
 * Description: Core plugin for Woolworths badge system (WooCommerce). OOP-only, theme independent.
 * Version: 1.0.0
 * Author: Generated
 * Text Domain: woolworths-core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'WOOL_CORE_PLUGIN_FILE', __FILE__ );
define( 'WOOL_CORE_PLUGIN_DIR', plugin_dir_path( WOOL_CORE_PLUGIN_FILE ) );
define( 'WOOL_CORE_PLUGIN_URL', plugin_dir_url( WOOL_CORE_PLUGIN_FILE ) );
define( 'WOOL_CORE_VERSION', '1.0.0' );

require_once WOOL_CORE_PLUGIN_DIR . 'src/Init.php';

add_action( 'plugins_loaded', function() {
    $init = new \WoolworthsCore\Init();
    $init->run();
} );
