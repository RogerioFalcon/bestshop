<?php 
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.1
 */
 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	if( bestshop_mobile_check() ) :
		get_template_part('mlayouts/archive','product-mobile');
	else: 
		get_template_part( 'woocommerce/template-archive-product' );
	endif;
?>
