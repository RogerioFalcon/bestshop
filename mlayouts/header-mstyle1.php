<?php 
	/* 
	** Content Header
	*/
	$sticky_mobile	= swg_options( 'sticky_menu' );
?>
<?php if( is_front_page() || get_post_meta( get_the_ID(), 'page_mobile_enable', true ) || is_search() || swg_options( 'mobile_header_inside' ) ): ?>
<header id="header" class="header header-mobile-style1">
	<div class="header-wrrapper clearfix">
		<div class="header-top-mobile clearfix">
			<div class="bestshop-logo pull-left">
				<?php bestshop_logo(); ?>
			</div>
			<div class="header-menu-categories pull-right">
				<?php if ( has_nav_menu('vertical_menu') ) {?>
					<div class="vertical_megamenu">
						<?php wp_nav_menu(array('theme_location' => 'vertical_menu', 'menu_class' => 'nav vertical-megamenu')); ?>
					</div>
			<?php } ?>
			</div>
			<?php if( !swg_options( 'disable_cart' ) ) : ?>
			<div class="header-cart pull-right">
				<?php get_template_part( 'woocommerce/minicart-ajax' ); ?>
			</div>
			<?php endif; ?>
			<?php if( !swg_options( 'disable_search' ) ) : ?>
			<div class="search-cate pull-right">
				<div class="icon-search"><span class="icon-zoom-2"></span><label><?php esc_html_e( "Search", 'bestshop' )?></label></div>
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
		</div>
	</div>
</header>
<?php else : ?>
<!--  header page -->
<?php get_template_part( 'mlayouts/breadcrumb', 'mobile' ); ?>
	<!-- End header -->
<?php endif; ?>