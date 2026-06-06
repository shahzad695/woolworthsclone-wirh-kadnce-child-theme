<?php
/**
 * Plugin Name: Woolworths Core
 * Description: Core plugin for the Woolworths clone project. Handles business logic, badges, and custom features.
 * Version: 1.1.0
 * Author: Shahzad
 * Text Domain: woolworths-core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Global Constants
define( 'WOOLWORTHS_CORE_FILE', __FILE__ );
define( 'WOOLWORTHS_CORE_DIR', plugin_dir_path( WOOLWORTHS_CORE_FILE ) );
define( 'WOOLWORTHS_CORE_URL', plugin_dir_url( WOOLWORTHS_CORE_FILE ) );
define( 'WOOLWORTHS_CORE_VERSION', '1.1.0' );

// Load the main initialization class
require_once WOOLWORTHS_CORE_DIR . 'src/Init.php';

/**
 * Initialize the plugin after all plugins are loaded.
 */
add_action( 'plugins_loaded', function() {
    $woolworths_core = new \WoolworthsCore\Init();
    $woolworths_core->run();
} );
