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
<header id="header" class="header header-style3">
	<?php if (is_active_sidebar('top2')) {?>
	<div class="header-top2">
		<div class="container">		
			<div class="top-header2 clearfix">
				<?php dynamic_sidebar('top2'); ?>
			</div>
		</div>
	</div>
	<?php }?>
	<?php if (is_active_sidebar('top')) {?>
	<div class="header-top">
		<div class="container">			
			<div class="top-header clearfix">
				<?php dynamic_sidebar('top'); ?>
			</div>
		</div>
	</div>
	<?php }?>
	<div class="header-mid">
		<div class="container">
			<div class="row">
				<!-- Logo -->
				<div class="logo-header col-lg-2 col-md-2 col-sm-3 col-xs-2 pull-left">
					<div class="bestshop-logo">
						<?php bestshop_logo(); ?>
					</div>
				</div>
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
				<?php if( !swg_options( 'disable_search' ) ) : ?>
					<div class="search-cate pull-right">
						<div class="icon-search"><span class="icon-zoom-2"></span></div>
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
				<!-- Primary menu -->
				<?php if ( has_nav_menu('primary_menu') ) { ?>
					<div id="main-menu" class="main-menu pull-right">
						<nav id="primary-menu" class="primary-menu">
							<div class="mid-header clearfix">
								<div class="navbar-inner navbar-inverse">
									<?php
									$bestshop_menu_class = 'nav nav-pills';
									if ( 'mega' == swg_options('menu_type') ){
										$bestshop_menu_class .= ' nav-mega';
									} else $bestshop_menu_class .= ' nav-css';
									?>
									<?php wp_nav_menu(array('theme_location' => 'primary_menu', 'menu_class' => $bestshop_menu_class)); ?>
								</div>
							</div>
						</nav>
					</div>
				<?php } ?>
				<!-- /Primary navbar -->
			</div>
		</div>
	</div>
</header>