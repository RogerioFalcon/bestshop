<?php if ( class_exists( 'WooCommerce' ) && !swg_options( 'disable_cart' ) ) { ?>
<?php
	$bestshop_page_header = ( get_post_meta( get_the_ID(), 'page_header_style', true ) != '' ) ? get_post_meta( get_the_ID(), 'page_header_style', true ) : swg_options('header_style');
	if($bestshop_page_header == 'style5'){
		get_template_part( 'woocommerce/minicart-ajax-style2' ); 
	}elseif($bestshop_page_header == 'style8'){
		get_template_part( 'woocommerce/minicart-ajax-style3' ); 
	}else{
		get_template_part( 'woocommerce/minicart-ajax' ); 
	}	
?>
<?php } ?>