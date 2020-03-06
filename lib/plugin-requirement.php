<?php
/***** Active Plugin ********/
require_once( get_template_directory().'/lib/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'bestshop_register_required_plugins' );
function bestshop_register_required_plugins() {
    $plugins = array(
        array(
            'name'               => esc_html__( 'WooCommerce', 'bestshop' ), 
            'slug'               => 'woocommerce', 
            'required'           => true, 
            'version'            => '3.8.0'
        ),

         array(
            'name'               => esc_html__( 'Revslider', 'bestshop' ), 
            'slug'               => 'revslider', 
            'source'             => esc_url( get_template_directory_uri() . '/lib/plugins/revslider.zip' ), 
            'required'           => true, 
            'version'            => '6.1.5'
        ),
        
        array(
            'name'               => esc_html__( 'SW Core', 'bestshop' ),
            'slug'               => 'sw_core',
            'source'             => esc_url( get_template_directory_uri() . '/lib/plugins/sw_core.zip' ), 
            'required'           => true,   
            'version'            => '1.6.6'
        ),
        
        array(
            'name'               => esc_html__( 'SW WooCommerce', 'bestshop' ),
            'slug'               => 'sw_woocommerce',
            'source'             => esc_url( get_template_directory_uri() . '/lib/plugins/sw_woocommerce.zip' ), 
            'required'           => true,
            'version'            => '1.6.7'
        ),
        
        array(
            'name'               => esc_html__( 'SW Ajax Woocommerce Search', 'bestshop' ),
            'slug'               => 'sw_ajax_woocommerce_search',
            'source'             => esc_url( get_template_directory_uri() . '/lib/plugins/sw_ajax_woocommerce_search.zip' ), 
            'required'           => true,
            'version'            => '1.1.6'
        ),
        
        array(
            'name'               => esc_html__( 'Sw Woocommerce Swatches', 'bestshop' ),
            'slug'               => 'sw_wooswatches',
            'source'             => esc_url( get_template_directory_uri() . '/lib/plugins/sw_wooswatches.zip' ), 
            'required'           => true,
            'version'            => '1.0.6'
        ),

        array(
            'name'               => esc_html__( 'Sw Product Bundles', 'bestshop' ),
            'slug'               => 'sw-product-bundles',
            'source'             => esc_url( get_template_directory_uri() . '/lib/plugins/sw-product-bundles.zip' ), 
            'required'           => true,
            'version'            => '2.0.14'
        ),

        array(
            'name'               => esc_html__( 'Sw Product Brand', 'bestshop' ),
            'slug'               => 'sw_product_brand',
            'source'             => esc_url( get_template_directory_uri() . '/lib/plugins/sw_product_brand.zip' ), 
            'required'           => true,
            'version'            => '1.0.0'
        ),

        array(
            'name'               => esc_html__( 'One Click Install', 'bestshop' ), 
            'slug'               => 'one-click-demo-import', 
            'source'             => esc_url( get_template_directory_uri() . '/lib/plugins/one-click-demo-import.zip' ), 
            'required'           => true, 
        ),
        array(
            'name'               => esc_html__( 'Visual Composer', 'bestshop' ), 
            'slug'               => 'js_composer', 
            'source'             => esc_url( get_template_directory_uri() . '/lib/plugins/js_composer.zip' ), 
            'required'           => true, 
            'version'            => '6.0.5'
        ),  
        array(
            'name'               => esc_html__( 'MailChimp for WordPress Lite', 'bestshop' ),
            'slug'               => 'mailchimp-for-wp',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__( 'Contact Form 7', 'bestshop' ),
            'slug'               => 'contact-form-7',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__( 'YITH Woocommerce Compare', 'bestshop' ),
            'slug'               => 'yith-woocommerce-compare',
            'required'           => false
        ),
         array(
            'name'               => esc_html__( 'YITH Woocommerce Wishlist', 'bestshop' ),
            'slug'               => 'yith-woocommerce-wishlist',
            'required'           => false
        ), 
        array(
            'name'               => esc_html__( 'WordPress Seo', 'bestshop' ),
            'slug'               => 'wordpress-seo',
            'required'           => false,
        ),

    );      
    $config = array();

    tgmpa( $plugins, $config );

}
add_action( 'vc_before_init', 'bestshop_vcSetAsTheme' );
function bestshop_vcSetAsTheme() {
    vc_set_as_theme();
}