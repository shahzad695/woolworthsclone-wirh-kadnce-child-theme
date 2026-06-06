<?php
namespace WoolworthsCore;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use WoolworthsCore\ACF\FieldGroupRegistrar;
use WoolworthsCore\Assets\AssetLoader;
use WoolworthsCore\Services\ProductBadge;

/**
 * Main Initialization class for Woolworths Core.
 */
class Init {
    protected $product_badge;
    protected $asset_loader;
    protected $field_group_registrar;

    /**
     * Boot the plugin logic.
     */
    public function run() {
        $this->load_dependencies();
        $this->register_hooks();
        $this->boot_services();
    }

    /**
     * Load required class files.
     */
    protected function load_dependencies() {
        require_once WOOLWORTHS_CORE_DIR . 'src/Services/ProductBadge.php';
        require_once WOOLWORTHS_CORE_DIR . 'src/ACF/FieldGroupRegistrar.php';
        require_once WOOLWORTHS_CORE_DIR . 'src/Assets/AssetLoader.php';
    }

    /**
     * Register global WordPress hooks.
     */
    protected function register_hooks() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        add_action( 'acf/init', [ $this, 'register_acf_fields' ] );
    }

    /**
     * Instantiate services.
     */
    protected function boot_services() {
        $this->product_badge         = new ProductBadge();
        $this->asset_loader          = new AssetLoader();
        $this->field_group_registrar = new FieldGroupRegistrar();
    }

    /**
     * Enqueue plugin assets.
     */
    public function enqueue_assets() {
        $this->asset_loader->enqueue_styles();
    }

    /**
     * Register ACF fields.
     */
    public function register_acf_fields() {
        $this->field_group_registrar->register();
    }
}
