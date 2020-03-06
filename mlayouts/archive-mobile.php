<?php get_template_part('header'); ?>
	<div class="container">
		<div class="category-contents <?php bestshop_content_blog(); ?>">
			<div class="row blog-content blog-content-grid">
				<?php 			
					while( have_posts() ) : the_post();
						get_template_part( 'mlayouts/content', 'grid' );
					endwhile;
				?>				
			</div>
				<?php get_template_part('mlayouts/pagination','mobile'); ?>
		</div>
	</div>
<?php get_template_part('footer'); ?>
