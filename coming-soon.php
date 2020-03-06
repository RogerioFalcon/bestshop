<?php wp_head();
	/*
	Template Name: Coming soon
	*/
	$bestshop_dirction = swg_options('direction');
 ?>
	<div class="wp-comingsoon <?php echo sprintf( ( $bestshop_dirction == 'rtl')? '%s' : '', 'rtl' ); ?>">
		<div class="content-comingsoon">
			<div class="container">
				<div class="row">
					 <div id="contents" role="main" class="col-lg-12 col-md-12 col-sm-12">
						<?php if(have_posts()):
							while (have_posts()) : the_post(); ?>
								<div <?php post_class(); ?>>
									<div class="entry-content">
									  <?php the_content(); ?>
									</div>
								</div>
								<?php
							endwhile;
						else:
							get_template_part('templates/no-results');
						endif;
					?>
					</div>
				</div>
			</div>		
		</div>
	</div>
<?php wp_footer(); ?>

