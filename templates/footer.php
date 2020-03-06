<?php 	
	$bestshop_page_footer   	 = ( get_post_meta( get_the_ID(), 'page_footer_style', true ) != '' ) ? get_post_meta( get_the_ID(), 'page_footer_style', true ) : swg_options( 'footer_style' );
	$bestshop_copyright_text 	 = swg_options( 'footer_copyright' );
	$bestshop_copyright_footer = get_post_meta( get_the_ID(), 'copyright_footer_style', true );
	$bestshop_copyright_footer  = ( get_post_meta( get_the_ID(), 'copyright_footer_style', true ) != '' ) ? get_post_meta( get_the_ID(), 'copyright_footer_style', true ) : swg_options('copyright_style');
?>

<footer id="footer" class="footer default theme-clearfix">
	<!-- Content footer -->
	<div class="container">
		<?php 
			if( $bestshop_page_footer != '' ) :
				echo swg_get_the_content_by_id( $bestshop_page_footer ); 
			endif;
		?>
	</div>
	<div class="footer-copyright <?php echo esc_attr( $bestshop_copyright_footer ); ?>">
		<div class="container">
			<!-- Copyright text -->
			<div class="copyright-text">
				<?php if( $bestshop_copyright_text == '' ) : ?>
					<p>&copy;<?php echo date_i18n('Y') .' '. esc_html__('WordPress Theme SW Bestshop. All Rights Reserved.','bestshop'); ?></p>
				<?php else : ?>
					<?php echo wp_kses( $bestshop_copyright_text, array( 'a' => array( 'href' => array(), 'title' => array(), 'class' => array() ), 'p' => array()  ) ) ; ?>
				<?php endif; ?>
			</div>
			<?php if (is_active_sidebar('footer-copyright')){ ?>
			<div class="sidebar-copyright">
				<?php dynamic_sidebar('footer-copyright'); ?>
			</div>
		<?php } ?>
		</div>
	</div>
</footer>