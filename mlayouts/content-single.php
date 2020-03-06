<?php while (have_posts()) : the_post(); ?>
<div <?php post_class(); ?>>
	<?php $pfm = get_post_format();?>
	<div class="entry-wrap">
		<?php if( $pfm == '' || $pfm == 'image' ){?>
			<?php if( has_post_thumbnail() ){ ?>
				<div class="entry-thumb single-thumb">
						<?php the_post_thumbnail('bestshop_blog_mobile');?>						
				</div>
			<?php }?>
		<?php } ?>
		<h1 class="entry-title clearfix"><?php the_title(); ?></h1>
		<div class="entry-content clearfix">
			<div class="entry-meta clearfix">
				<span class="entry-author">
					<i class="fa fa-user"></i><?php esc_html_e('Post By:', 'bestshop'); ?> <?php the_author_posts_link(); ?>
				</span>
				<div class="entry-comment">
					<a href="<?php comments_link(); ?>">
						<i class="fa fa-comments-o"></i>
						<?php echo sprintf( _n( '%d Comment', '%d Comments', $post-> comment_count, 'bestshop' ), $post-> comment_count ); ?>
					</a>
				</div>
			</div>
			<div class="entry-summary single-content ">
				<?php the_content(); ?>	
				
				<div class="clear"></div>
				<!-- link page -->
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'bestshop' ).'</span>', 'after' => '</div>' , 'link_before' => '<span>', 'link_after'  => '</span>' ) ); ?>	
			</div>
			
			<div class="clear"></div>			
			<div class="single-content-bottom clearfix">
				<!-- Social -->
				<?php bestshop_get_social() ?>
			</div>
		</div>
	</div>
	
	<div class="clearfix"></div> 
	<?php if( get_the_author_meta( 'description',  $post->post_author ) != '' ): ?>
	<div id="authorDetails" class="clearfix">
		<div class="authorDetail">
			<div class="avatar">
				<?php echo get_avatar( $post->post_author , 100 ); ?>
			</div>
			<div class="infomation">
				<h4 class="name-author"><span><?php echo get_the_author_meta( 'user_nicename', $post->post_author )?></span></h4>
				<span class="email"><?php echo get_the_author_meta( 'user_email', $post->post_author )?></span>
			</div>	
		</div>
	</div> 
	<?php endif; ?>
	<div class="clearfix"></div>
	<!-- Relate Post -->
  <?php 
		global $post;
		global $related_term;
		$class_col= "";
		$categories = get_the_category($post->ID);								
		$category_ids = array();
		foreach($categories as $individual_category) {$category_ids[] = $individual_category->term_id;}
		if ($categories) {
				$related = array(
					'category__in' => $category_ids,
					'post__not_in' => array($post->ID),
					'showposts'=>3,
					'orderby'	=> 'name',	
					'ignore_sticky_posts'=>1
				   );
	?>
			<div class="single-post-relate-mobile">
				<h4><?php esc_html_e('Related News', 'bestshop'); ?></h4>
				<?php
					$related_term = new WP_Query($related);
					while($related_term -> have_posts()):$related_term -> the_post();
						$format = get_post_format();
				?>
					<div <?php post_class( $class_col ); ?> >
						<?php if ( get_the_post_thumbnail() ) { ?>
						<div class="item-relate-img">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('bestshop_related_mobile'); ?></a>
						</div>
						<?php } ?>

						<div class="item-relate-content">
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<div class="entry-meta">
								<span class="entry-author">
									<i class="fa fa-user"></i><?php esc_html_e('Post By:', 'bestshop'); ?> <?php the_author_posts_link(); ?>
								</span>
								<div class="entry-comment">
									<a href="<?php comments_link(); ?>">
										<i class="fa fa-comments-o"></i>
										<?php echo sprintf( _n( '%d Comment', '%d Comments', $post-> comment_count, 'bestshop' ), $post-> comment_count ); ?>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php
						endwhile;
						wp_reset_postdata();
					?>
			</div>
	  	<?php } ?>
		
		<div class="clearfix"></div>
		<!-- Comment Form -->
    <?php comments_template('/templates/comments.php'); ?>
</div>
<?php endwhile; ?>
