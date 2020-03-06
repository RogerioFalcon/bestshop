<?php
/**
 * bestshop initial setup and constants
 */
function bestshop_setup() {
	// Make theme available for translation
	load_theme_textdomain( 'bestshop', get_template_directory() . '/lang' );

	// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
	register_nav_menus(array(
		'primary_menu' => esc_html__('Primary Menu', 'bestshop'),
		'vertical_menu' => esc_html__( 'Vertical Menu', 'bestshop' ),
		'mobile_menu' => esc_html__( 'Mobile Menu', 'bestshop' ),
	));
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'sw_theme' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	if( swg_options( 'product_zoom' ) ) :
		add_theme_support( 'wc-product-gallery-zoom' );
	endif;
	
	add_image_size( 'bestshop_blog-responsive', 590, 360, true );
	add_image_size( 'bestshop_blog-responsive2', 240, 280, true );
	
	add_theme_support( "title-tag" );
	
	add_theme_support('bootstrap-gallery');     // Enable Bootstrap's thumbnails component on [gallery]
	
	// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	add_theme_support('post-thumbnails');

	// Add post formats (http://codex.wordpress.org/Post_Formats)
	add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
	
	// Custom image header
	$bestshop_header_arr = array(
		'default-image' => get_template_directory_uri().'/assets/img/logo-default.png',
		'uploads'       => true
	);
	add_theme_support( 'custom-header', $bestshop_header_arr );
	
	// Custom Background 
	$bestshop_bgarr = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);
	add_theme_support( 'custom-background', $bestshop_bgarr );
	
	// Tell the TinyMCE editor to use a custom stylesheet
	add_editor_style( 'css/editor-style.css' );
	
	new Bestshop_Menu();
}
add_action('after_setup_theme', 'bestshop_setup');

