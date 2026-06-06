<?php
namespace WoolworthsCore\Services;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use WC_Product;

class ProductBadge {
    protected const VALID_POSITIONS = [
        'top-left',
        'top-right',
        'bottom-left',
        'bottom-right',
    ];

    public function __construct() {
        add_filter( 'woocommerce_get_product_thumbnail', [ $this, 'inject_badges_into_thumbnail' ], 20, 2 );
        add_filter( 'woocommerce_single_product_image_thumbnail_html', [ $this, 'inject_badges_into_single_image' ], 20, 2 );
        add_filter( 'woocommerce_get_price_html', [ $this, 'maybe_hide_price_out_of_stock' ], 10, 2 );
    }

    /**
     * Hide price for out of stock products.
     */
    public function maybe_hide_price_out_of_stock( $price, $product ) {
        if ( ! $product instanceof WC_Product ) {
            return $price;
        }

        if ( ! $product->is_in_stock() ) {
            return '';
        }

        return $price;
    }

    public function inject_badges_into_thumbnail( $html, $post_id = null ) {
        $product_id = $this->resolve_product_id( $post_id );
        if ( ! $product_id ) {
            return $html;
        }

        $badges = $this->get_badges( $product_id );
        if ( empty( $badges ) ) {
            return $html;
        }

        return $html . $this->render_badges_grouped( $badges );
    }

    public function inject_badges_into_single_image( $html, $attachment_id = null ) {
        $product_id = $this->resolve_product_id();
        if ( ! $product_id ) {
            return $html;
        }

        $badges = $this->get_badges( $product_id );
        if ( empty( $badges ) ) {
            return $html;
        }

        return $html . $this->render_badges_grouped( $badges );
    }

    protected function resolve_product_id( $maybe_id = null ) {
        if ( $maybe_id && is_numeric( $maybe_id ) ) {
            $post_type = get_post_type( $maybe_id );
            if ( 'product' === $post_type ) {
                return (int) $maybe_id;
            }
        }

        global $product;
        if ( isset( $product ) && is_a( $product, 'WC_Product' ) ) {
            return (int) $product->get_id();
        }

        $post = get_post();
        if ( $post && 'product' === get_post_type( $post ) ) {
            return (int) $post->ID;
        }

        return 0;
    }

    public function get_badges( $product_id ) {
        $product = wc_get_product( $product_id );
        if ( ! $product ) {
            return [];
        }

        $badges = array_merge(
            $this->collect_automatic_badges( $product ),
            $this->collect_manual_badges( $product_id )
        );

        usort( $badges, function( $a, $b ) {
            return (int) ( $b['priority'] ?? 0 ) <=> (int) ( $a['priority'] ?? 0 );
        } );

        $grouped = [];
        foreach ( $badges as $badge ) {
            $position = $this->normalize_position( $badge['position'] ?? 'top-right' );
            $grouped[ $position ][] = $badge;
        }

        return $grouped;
    }

    protected function collect_automatic_badges( WC_Product $product ) {
        $badges = [];

        if ( ! $product->is_in_stock() ) {
            $badges[] = $this->make_badge([
                'type' => 'out_of_stock',
                'text' => __( 'Out of stock', 'woolworths-core' ),
                'class' => 'wool-badge--out',
                'position' => 'top-left',
                'priority' => 100,
            ]);
        }

        if ( $product->managing_stock() ) {
            $qty = $product->get_stock_quantity();
            $threshold = method_exists( $product, 'get_low_stock_amount' )
                ? (int) $product->get_low_stock_amount()
                : absint( get_option( 'woocommerce_notify_low_stock_amount', 2 ) );

            if ( null !== $qty && $qty <= $threshold ) {
                $badges[] = $this->make_badge([
                    'type' => 'low_stock',
                    'text' => __( 'Low stock', 'woolworths-core' ),
                    'class' => 'wool-badge--low',
                    'position' => 'bottom-right',
                    'priority' => 40,
                ]);
            }
        }

        if ( $product->is_on_sale() ) {
            $badges[] = $this->make_badge([
                'type' => 'sale',
                'text' => __( 'Sale', 'woolworths-core' ),
                'class' => 'wool-badge--sale',
                'position' => 'top-right',
                'priority' => 50,
            ]);
        }

        $created = get_post_time( 'U', false, $product->get_id() );
        if ( $created && time() - (int) $created <= 7 * DAY_IN_SECONDS ) {
            $badges[] = $this->make_badge([
                'type' => 'new',
                'text' => __( 'New', 'woolworths-core' ),
                'class' => 'wool-badge--new',
                'position' => 'bottom-left',
                'priority' => 45,
            ]);
        }

        return $badges;
    }

    protected function collect_manual_badges( $product_id ) {
        $badges = [];

        if ( ! function_exists( 'get_field' ) ) {
            return $badges;
        }

        $enabled = get_field( 'enable_badge', $product_id );
        if ( ! $enabled ) {
            return $badges;
        }

        $type = get_field( 'badge_type', $product_id );
        $position = $this->normalize_position( get_field( 'badge_position', $product_id ) );
        $image = get_field( 'badge_image', $product_id );

        if ( 'custom' === $type && $image ) {
            $badges[] = $this->make_badge([
                'type' => 'custom',
                'image' => esc_url_raw( $image ),
                'class' => 'wool-badge--custom',
                'position' => $position,
                'priority' => 60,
            ]);

            return $badges;
        }

        if ( in_array( $type, [ 'organic', 'original', 'special' ], true ) ) {
            $badges[] = $this->make_badge([
                'type' => $type,
                'text' => ucfirst( $type ),
                'class' => 'wool-badge--' . sanitize_html_class( $type ),
                'position' => $position,
                'priority' => 60,
            ]);
        }

        return $badges;
    }

    protected function make_badge( $args = array() ) {
        return wp_parse_args( $args, [
            'type' => 'custom',
            'text' => '',
            'image' => '',
            'class' => '',
            'position' => 'top-right',
            'priority' => 10,
        ]);
    }

    protected function normalize_position( $position ) {
        return in_array( $position, self::VALID_POSITIONS, true ) ? $position : 'top-right';
    }

    protected function render_badges_grouped( $grouped_badges ) {
        if ( empty( $grouped_badges ) || ! is_array( $grouped_badges ) ) {
            return '';
        }

        $html = '';
        foreach ( self::VALID_POSITIONS as $slot ) {
            if ( empty( $grouped_badges[ $slot ] ) ) {
                continue;
            }

            $html .= '<div class="woolworths-badges woolworths-badges--' . esc_attr( $slot ) . '">';
            foreach ( $grouped_badges[ $slot ] as $badge ) {
                $class = isset( $badge['class'] ) ? esc_attr( $badge['class'] ) : '';
                $html .= '<div class="wool-badge-wrap ' . $class . '">';
                if ( ! empty( $badge['image'] ) ) {
                    $html .= '<img class="wool-badge-image" src="' . esc_url( $badge['image'] ) . '" alt="' . esc_attr( $badge['type'] ) . '">';
                } else {
                    $html .= '<span class="wool-badge-text">' . esc_html( $badge['text'] ) . '</span>';
                }
                $html .= '</div>';
            }
            $html .= '</div>';
        }

        return $html;
    }
}
