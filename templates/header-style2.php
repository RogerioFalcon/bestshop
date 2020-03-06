	<?php 
/* 
** Content Header
*/
$bestshop_page_header  = get_post_meta( get_the_ID(), 'page_header_style', true );
$bestshop_colorset  	= swg_options('scheme');
$bestshop_logo 		= swg_options('sitelogo');
$sticky_menu 			= swg_options( 'sticky_menu' );
$bestshop_menu_item 	= ( swg_options( 'menu_number_item' ) ) ? swg_options( 'menu_number_item' ) : 11;
$bestshop_more_text 	= ( swg_options( 'menu_more_text' ) ) ? swg_options( 'menu_more_text' ) : esc_html__( 'See More', 'bestshop' );
$bestshop_less_text 	= ( swg_options( 'menu_less_text' ) ) ? swg_options( 'menu_less_text' ) : esc_html__( 'See Less', 'bestshop' );
$bestshop_menu_text 	= ( swg_options( 'menu_title_text' ) )	 ? swg_options( 'menu_title_text' )	: esc_html__( 'All Categories', 'bestshop' );
$bestshop_page_header  = ( get_post_meta( get_the_ID(), 'page_header_style', true ) != '' && ( is_single() || is_page() ) ) ? get_post_meta( get_the_ID(), 'page_header_style', true ) : swg_options('header_style'); 
?>
<header id="header" class="header header-style2">
	<?php if (is_active_sidebar('top2')) {?>
	<div class="header-top">
		<div class="container">			
			<div class="top-header clearfix">
				<?php dynamic_sidebar('top2'); ?>
			</div>
		</div>
	</div>
	<?php }?>
	<div class="header-mid">
		<div class="container">
			<div class="row">
				<!-- Logo -->
				<div class="mid-header col-lg-2 col-md-3 col-sm-3 col-xs-2 pull-left">
					<div class="bestshop-logo">
						<?php bestshop_logo(); ?>
					</div>
				</div>
				<!-- Primary menu -->
				<?php if( !swg_options( 'disable_search' ) ) : ?>
					<div class="search-cate col-lg-7 col-md-5 col-sm-7 pull-left">
						<?php if( is_active_sidebar( 'search' ) && class_exists( 'sw_woo_search_widget' ) ): ?>
						<?php dynamic_sidebar( 'search' ); ?>
						<?php else : ?>
							<div class="widget bestshop_top non-margin">
								<div class="widget-inner">
									<?php get_template_part( 'widgets/sw_top/searchcate' ); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<!-- /Primary navbar -->
				<?php if( !swg_options( 'disable_cart' ) ) : ?>
					<div class="header-cart pull-right">
						<?php get_template_part( 'woocommerce/minicart-ajax' ); ?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar('header-right3')) {?>		
					<div class="header-right pull-right">
						<?php dynamic_sidebar('header-right3'); ?>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
</header>