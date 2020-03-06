<?php get_template_part('header'); ?>
<?php 
	$bestshop_sidebar_template =( swg_options('sidebar_blog') ) ? swg_options('sidebar_blog') : 'right';
	$bestshop_blog_styles = ( swg_options('blog_layout') ) ? swg_options('blog_layout') : 'list';
?>

<div class="bestshop_breadcrumbs">
	<div class="container">
		<?php
			if (!is_front_page() ) {
				if (function_exists('bestshop_breadcrumb')){
					bestshop_breadcrumb('<div class="breadcrumbs custom-font theme-clearfix">', '</div>');
				} 
			} 
		?>
	</div>
</div>

<div class="container">
	<div class="row sidebar-row">
		<!-- Left Sidebar -->
		<?php $sidebar_template 		= ( swg_options('sidebar_blog') ) ? swg_options('sidebar_blog') : ''; ?>
		<?php if ( is_active_sidebar('left-blog') ):
			$bestshop_left_span_class = ( swg_options('sidebar_left_expand') ) ? 'col-lg-'.swg_options('sidebar_left_expand') : 'col-lg-3';
			$bestshop_left_span_class .= ( swg_options('sidebar_left_expand_md') ) ? ' col-md-'.swg_options('sidebar_left_expand_md') : ' col-md-3';
			$bestshop_left_span_class .= ( swg_options('sidebar_left_expand_sm') ) ? ' col-sm-'.swg_options('sidebar_left_expand_sm') : ' col-sm-4';
		?>
		<aside id="left" class="sidebar <?php echo esc_attr($bestshop_left_span_class); ?> <?php echo esc_attr( ( $sidebar_template == 'right' ||  $sidebar_template == 'full' ) ? 'hidden' : '' ) ?>">
			<?php dynamic_sidebar('left-blog'); ?>
		</aside>
		<?php endif; ?>
		
		<div class="category-contents <?php bestshop_content_blog(); ?>">
			<!-- No Result -->
			<?php if (!have_posts()) : ?>
			<?php get_template_part('templates/no-results'); ?>
			<?php endif; ?>			
			
			<?php 
				$bestshop_blogclass = 'blog-content blog-content-'. $bestshop_blog_styles;
				if( $bestshop_blog_styles == 'grid' ){
					$bestshop_blogclass .= ' row';
				}
			?>
			<div class="<?php echo esc_attr( $bestshop_blogclass ); ?>">
			<?php 			
				while( have_posts() ) : the_post();
					get_template_part( 'templates/content', $bestshop_blog_styles );
				endwhile;
			?>
			<?php get_template_part('templates/pagination'); ?>
			</div>
			<div class="clearfix"></div>
		</div>
		
		<!-- Right Sidebar -->
		<?php if ( is_active_sidebar('right-blog') ):
			$bestshop_right_span_class = ( swg_options('sidebar_right_expand') ) ? 'col-lg-'.swg_options('sidebar_right_expand') : 'col-lg-3';
			$bestshop_right_span_class .= ( swg_options('sidebar_right_expand_md') ) ? ' col-md-'.swg_options('sidebar_right_expand_md') : ' col-md-3';
			$bestshop_right_span_class .= ( swg_options('sidebar_right_expand_sm') ) ? ' col-sm-'.swg_options('sidebar_right_expand_sm') : ' col-sm-4';
		?>
		<aside id="right" class="sidebar <?php echo esc_attr($bestshop_right_span_class); ?> <?php echo esc_attr( ( $sidebar_template == 'left' ||  $sidebar_template == 'full' ) ? 'hidden' : '' ) ?>">
			<?php dynamic_sidebar('right-blog'); ?>
		</aside>
		<?php endif; ?>
	</div>
</div>
<?php get_template_part('footer'); ?>
