<?php
namespace WoolworthsCore\ACF;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FieldGroupRegistrar {
    public function register() {
        if ( ! function_exists( 'acf_add_local_field_group' ) ) {
            return;
        }

        acf_add_local_field_group(array(
            'key' => 'group_woolworths_product_badge',
            'title' => 'Woolworths Product Badge',
            'fields' => array(
                array(
                    'key' => 'field_wool_enable_badge',
                    'label' => 'Enable Badge',
                    'name' => 'enable_badge',
                    'type' => 'true_false',
                    'ui' => 1,
                ),
                array(
                    'key' => 'field_wool_badge_type',
                    'label' => 'Badge Type',
                    'name' => 'badge_type',
                    'type' => 'select',
                    'choices' => array(
                        'organic' => 'organic',
                        'original' => 'original',
                        'special' => 'special',
                        'custom' => 'custom',
                    ),
                    'ui' => 1,
                ),
                array(
                    'key' => 'field_wool_badge_image',
                    'label' => 'Badge Image',
                    'name' => 'badge_image',
                    'type' => 'image',
                    'return_format' => 'url',
                ),
                array(
                    'key' => 'field_wool_badge_position',
                    'label' => 'Badge Position',
                    'name' => 'badge_position',
                    'type' => 'select',
                    'choices' => array(
                        'top-left' => 'top-left',
                        'top-right' => 'top-right',
                        'bottom-left' => 'bottom-left',
                        'bottom-right' => 'bottom-right',
                    ),
                    'ui' => 1,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'product',
                    ),
                ),
            ),
        ));
    }
}
