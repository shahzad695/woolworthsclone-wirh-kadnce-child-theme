<?php
/**
 * Template part for displaying the main navigation
 *
 * @package WoolworthsClone
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

// Check if WooCommerce is active
$woocommerce_active = class_exists('WooCommerce');

// Get cart count and total safely
$cart_count = 0;
$cart_total = '$0.00';
if ($woocommerce_active && WC()->cart) {
    $cart_count = WC()->cart->get_cart_contents_count();
    $cart_total = WC()->cart->get_cart_total();
}
?>
<header class="navbar">
    <div class="navbar__main">
        <div class="container">
            <div class="navbar__logo">
                <?php the_custom_logo(); ?>
            </div>

            <div class="navbar__services">
                <select id="navbar__services-select" class="navbar__services-select"
                    aria-label="<?php esc_attr_e('Select service', 'woolworthsclone'); ?>">
                    <option value=""><?php esc_html_e('Everyday & Other Services', 'woolworthsclone'); ?></option>
                    <option value="insurance"><?php esc_html_e('Insurance', 'woolworthsclone'); ?></option>
                    <option value="mobile"><?php esc_html_e('Mobile', 'woolworthsclone'); ?></option>
                    <option value="money"><?php esc_html_e('Money Services', 'woolworthsclone'); ?></option>
                </select>
            </div>

            <div class="navbar__search">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="search" class="navbar__search-input"
                        placeholder="<?php esc_attr_e('Search products, recipes & ideas', 'woolworthsclone'); ?>" name="s"
                        value="<?php echo get_search_query(); ?>" />
                    <?php if ($woocommerce_active): ?>
                    <input type="hidden" name="post_type" value="product" />
                    <?php endif; ?>
                    <button type="submit" class="navbar__search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="navbar__actions">
                <a href="#" class="navbar__action-item">
                    <i class="fas fa-list"></i>
                    <div class="navbar__action-text">
                        <span class="navbar__action-label">Lists &</span>
                        <span class="navbar__action-title">Buy again</span>
                    </div>
                </a>

                <a href="<?php echo esc_url(wp_login_url()); ?>" class="navbar__action-item">
                    <i class="far fa-user"></i>
                    <div class="navbar__action-text">
                        <span class="navbar__action-label">Log in or Sign up</span>
                        <span class="navbar__action-title">My Account</span>
                    </div>
                </a>

                <a href="<?php echo $woocommerce_active ? esc_url(wc_get_cart_url()) : '#'; ?>" class="navbar__cart">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="navbar__cart-total"><?php echo esc_html($cart_total); ?></span>
                </a>
            </div>
        </div>
    </div>

    <nav class="navbar__categories">
        <div class="container">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'navbar__menu',
                'container'      => false,
                'fallback_cb'    => false,
            ));
            ?>
        </div>
    </nav>
</header>