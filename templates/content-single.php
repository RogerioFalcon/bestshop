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
	
			<div class="single main <?php bestshop_content_blog(); ?>" >
			<?php while (have_posts()) : the_post();  ?>
			<?php $related_post_column = swg_options('sidebar_blog'); ?>
			<div <?php post_class(); ?>>
				<?php $pfm = get_post_format();?>
				<div class="entry-wrap">
					<?php if( $pfm == '' || $pfm == 'image' ){?>
						<?php if( has_post_thumbnail() ){ ?>
							<div class="entry-thumb single-thumb">
								<?php the_post_thumbnail('full'); ?>
							</div>
						<?php }?>
					<?php } ?>
					<div class="entry-content clearfix">
						<h1 class="entry-title clearfix"><?php the_title(); ?></h1>
						<div class="entry-meta clearfix">
							<span class="entry-author">
								<i class="fa fa-pencil" aria-hidden="true"></i><?php esc_html_e('Post by:', 'bestshop'); ?> <?php the_author_posts_link(); ?>
							</span>
							<span class="entry-date"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><a href="<?php echo get_permalink($post->ID)?>"><?php echo get_the_date( '', $post->ID );?></a></span>
							<span class="entry-comment">
								<i class="fa fa-comment-o" aria-hidden="true"></i><a href="<?php comments_link(); ?>"><?php echo sprintf( _n( '%d Comment', '%d Comments', $post-> comment_count , 'bestshop' ), number_format_i18n( $post-> comment_count ) ); ?></a>
							</span>
							<span class="entry-cate"><i class="fa fa-tags" aria-hidden="true"></i>
							<?php 
							$categories = get_the_category();
							$separator = ', ';
							$output = '';
							if ( ! empty( $categories ) ) {
							    foreach( $categories as $category ) {
							        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'bestshop' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
							    }
							    echo trim( $output, $separator );
							}
							?>
							</span>
						</div>
						<div class="entry-summary single-content ">
							<?php the_content(); ?>							
							<div class="clear"></div>
							<!-- link page -->
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'bestshop' ).'</span>', 'after' => '</div>' , 'link_before' => '<span>', 'link_after'  => '</span>' ) ); ?>	
						</div>
						
						<div class="clear"></div>
						<?php if(get_the_tag_list()) { ?>	
							<div class="single-content-bottom clearfix">
								<div class="entry-tag single-tag pull-left">
									<span><?php esc_html_e( 'TAGS: ', 'bestshop' ) ?></span><?php echo get_the_tag_list('',', ','');  ?>
								</div>							
								<?php bestshop_get_social() ?>
								<!-- Social -->
							</div>
						<?php } ?>
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
							<p><?php the_author_meta( 'description',  $post->post_author ) ;?></p>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="clearfix"></div>
				<!-- Comment Form -->
				<?php comments_template('/templates/comments.php'); ?>
				<!-- Relate Post -->
				<?php 
					global $post;
					global $related_term;
					$class_col= "";
					$categories = get_the_category($post->ID);								
					$category_ids = array();
					foreach($categories as $individual_category) {$category_ids[] = $individual_category->term_id;}
					if ($categories) {
						if($related_post_column =='full'){
							$class_col .= 'col-lg-3 col-md-3 col-sm-3';
							$related = array(
								'category__in' => $category_ids,
								'post__not_in' => array($post->ID),
								'showposts'=>4,
								'orderby'	=> 'name',	
								'ignore_sticky_posts'=>1
								 );
						} else {
							$class_col .= 'col-lg-4 col-md-4 col-sm-4';
							$related = array(
								'category__in' => $category_ids,
								'post__not_in' => array($post->ID),
								'showposts'=>3,
								'orderby'	=> 'name',	
								'ignore_sticky_posts'=>1
								 );
						} 
				?>
				<div class="single-post-relate">
					<h4><?php esc_html_e('Related News', 'bestshop'); ?></h4>
					<div class="row">
					<?php
						$related_term = new WP_Query($related);
						while($related_term -> have_posts()):$related_term -> the_post();
							$format = get_post_format();
					?>
						<div <?php post_class( $class_col ); ?> >
							<?php if ( get_the_post_thumbnail() ) { ?>
							<div class="item-relate-img">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
							</div>
							<?php } ?>
							<div class="item-relate-content">
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<div class="entry-meta">
									<span class="entry-date"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><a href="<?php echo get_permalink($post->ID)?>"><?php echo get_the_date( '', $post->ID );?></a></span>
									<span class="entry-comment">
									<i class="fa fa-comment-o" aria-hidden="true"></i><a href="<?php comments_link(); ?>"><?php echo sprintf( _n( '%d Comment', '%d Comments', $post-> comment_count , 'bestshop' ), number_format_i18n( $post-> comment_count ) ); ?></a>
								</span>
								</div>
							</div>
						</div>
						<?php
							endwhile;
							wp_reset_postdata();
						?>
					</div>
				</div>
				<?php } ?>
				
				<div class="clearfix"></div>
			</div>
			<?php endwhile; ?>
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