<?php get_header(); ?>
<?php 
	$bestshop_sidebar_template	= get_post_meta( get_the_ID(), 'page_sidebar_layout', true );
	$bestshop_sidebar 			= get_post_meta( get_the_ID(), 'page_sidebar_template', true );
?>
	<?php if ( !is_front_page() ) { ?>
	<div class="bestshop_breadcrumbs">
		<div class="container">
			<?php				
				if ( function_exists( 'bestshop_breadcrumb' ) ){
					bestshop_breadcrumb( '<div class="breadcrumbs custom-font theme-clearfix">', '</div>' );
				} 
			?>
		</div>
		<div class="listing-title">	
			<div class="container">
				<h1><?php bestshop_title(); ?></h1>
			</div>			
		</div>
	</div>	
	<?php } ?>
	
	<div class="container">
		<div class="row">
		<?php 
			if ( is_active_sidebar( $bestshop_sidebar ) && $bestshop_sidebar_template != 'right' && $bestshop_sidebar_template !='full' ):
			$bestshop_left_span_class = 'col-lg-'.swg_options('sidebar_left_expand');
			$bestshop_left_span_class .= ' col-md-'.swg_options('sidebar_left_expand_md');
			$bestshop_left_span_class .= ' col-sm-'.swg_options('sidebar_left_expand_sm');
		?>
			<aside id="left" class="sidebar <?php echo esc_attr( $bestshop_left_span_class ); ?>">
				<?php dynamic_sidebar( $bestshop_sidebar ); ?>
			</aside>
		<?php endif; ?>
		
			<div id="contents" role="main" class="main-page <?php bestshop_content_page(); ?>">
				<?php
				get_template_part('templates/content', 'page')
				?>
			</div>
			<?php 
			if ( is_active_sidebar( $bestshop_sidebar ) && $bestshop_sidebar_template != 'left' && $bestshop_sidebar_template !='full' ):
				$bestshop_left_span_class = 'col-lg-'.swg_options('sidebar_left_expand');
				$bestshop_left_span_class .= ' col-md-'.swg_options('sidebar_left_expand_md');
				$bestshop_left_span_class .= ' col-sm-'.swg_options('sidebar_left_expand_sm');
			?>
				<aside id="right" class="sidebar <?php echo esc_attr($bestshop_left_span_class); ?>">
					<?php dynamic_sidebar( $bestshop_sidebar ); ?>
				</aside>
			<?php endif; ?>
		</div>		
	</div>
<?php get_footer(); ?>

