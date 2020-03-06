<?php get_template_part('header'); ?>
<div class="wrapper_404">
	<div class="container">
		<div class="row">
			<?php $bestshop_404page = swg_options( 'page_404' ); ?>
			<?php if( $bestshop_404page != '' ) : ?>
				<?php echo swg_get_the_content_by_id( $bestshop_404page ); ?>
			<?php else: ?>	
				<div class="content_404">
					<div class="erro-image">
						<img class="img_logo" alt="<?php echo esc_attr__( '404', 'bestshop' ) ?>" src="<?php echo get_template_directory_uri(); ?>/assets/img/img-404.jpg">
					</div>
					<div class="block-top">
						<h2><?php esc_html_e( 'Oops, Sorry We Can’t Find That Page', 'bestshop' ) ?></h2>
						<p><?php esc_html_e( "Either something went wrong of the page doesn't exist anymore.", "bestshop" ) ?></p>
					</div>
					<div class="block-bottom">
						<a href="<?php echo esc_url( home_url('/') ); ?>" class="btn-404 back2home" title="<?php esc_attr_e( 'Back To Home', 'bestshop' ) ?>"><?php esc_html_e( "Back To Home", 'bestshop' )?></a>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_template_part('footer'); ?>