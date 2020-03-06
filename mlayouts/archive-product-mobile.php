<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	get_template_part( 'header' );
?>
<div class="container">
	<div id="contents" role="main">
		<?php
			/**
			 * woocommerce_before_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			 global $post;
			do_action('woocommerce_before_main_content');
		?>
		<div class="products-wrapper">	
					
			<?php if ( have_posts() ) : ?>
				<?php do_action('woocommerce_message'); ?>
				<?php 					
					woocommerce_product_loop_start();					
					if( swg_woocommerce_version_check( '3.3' ) ){
						echo apply_filters( 'bestshop_custom_category', $html = '' );
					}else{
						woocommerce_product_subcategories(); 
					}
					woocommerce_product_loop_end(); 
				?>
				<div class="product-nav-wrapper">
					<?php
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
					?>
					<div class="filter-mobile clearfix">
						<?php if (is_active_sidebar('filter-mobile')) {?>
							<?php dynamic_sidebar('filter-mobile'); ?>
						<?php }?>
					</div>
				</div>
				<?php if (is_active_sidebar('banner-mobile') ) { ?>
				<div class="banner-category theme-clearfix">
						<?php dynamic_sidebar('banner-mobile'); ?>
				</div>	
				<?php } ?>						
				
				
				<div class="clear"></div>
				<ul class="products-loop grid clearfix">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php global $post, $product; ?>
					<li <?php post_class( 'item' ); ?>>
						<div class="products-entry item-wrap clearfix">
							<div class="item-detail">
								<div class="item-img products-thumb">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<div class="product-thumb-hover">
											<?php swg_label_sales(); ?>
											<?php the_post_thumbnail( 'shop_catalog' ); ?>
										</div>
									</a>
								</div>
								<div class="item-content products-content">
										<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>		
										<!-- rating -->
										<?php wc_get_template_part( 'loop/rating' ); ?>
										<!-- Price -->
										<?php if ( $price_html = $product->get_price_html() ) : ?>
											<span class="item-price"><?php echo sprintf( '%s', $price_html ); ?></span>
										<?php endif; ?>	
										<!-- Description -->
										<div class="item-description">
											<?php echo wp_trim_words( $post->post_excerpt, 15); ?>
										</div>
										<?php if( swg_options( 'mobile_addcart' ) ) : ?>
											<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
										<?php endif; ?>
								</div>
							</div>
						</div>
					</li>
					<?php endwhile; // end of the loop. ?>
				</ul>
				<div class="clear"></div>			
				<?php do_action( 'woocommerce_after_shop_loop' ); ?>
			<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

				<?php wc_get_template( 'loop/no-products-found.php' ); ?>

			<?php endif; ?>
		</div>
		<?php
			/**
			 * woocommerce_after_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action('woocommerce_after_main_content');
		?>
	</div>
</div>
<?php get_template_part('footer'); ?>
