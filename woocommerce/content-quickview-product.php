<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>
<div id="quickview-container-<?php the_ID(); ?>">
	<div class="quickview-container woocommerce">
		<?php
        global $product;
            /**
             * woocommerce_before_single_product hook
             *
             * @hooked woocommerce_show_messages - 10
             */
             do_action( 'woocommerce_before_single_product' );
        ?>
        <div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class("product single-product"); ?>>
				<div class="product_detail">
					<div class="col-lg-12 col-md-12">							
						<div class="slider_img_productd">
						<?php 
							global $post, $woocommerce, $product;
							$bestshop_direction 		= swg_options( 'direction' );
							$attachments 		= array();
							$bestshop_featured_video = get_post_meta( $post->ID, 'featured_video_product', true );
						?>
							<div id="product_img_<?php echo esc_attr( $post->ID ); ?>" class="woocommerce-product-gallery woocommerce-product-gallery--with-images images product-images loading" data-rtl="<?php echo ( is_rtl() || $bestshop_direction == 'rtl' )? 'true' : 'false';?>">
								<figure class="woocommerce-product-gallery__wrapper">
								<div class="product-images-container clearfix thumbnail-bottom">
									<?php 
										if( has_post_thumbnail() ){ 
											$attachments = ( swg_woocommerce_version_check( '3.0' ) ) ? $product->get_gallery_image_ids() : $product->get_gallery_attachment_ids();
											$image_id 	 = get_post_thumbnail_id();
											array_unshift( $attachments, $image_id );				
									?>
									<!-- Image Slider -->
									<div class="slider product-responsive">
										<?php if( $bestshop_featured_video != '' ) { ?>
											<div data-type="video" data-video="https://www.youtube.com/embed/<?php echo esc_attr( $bestshop_featured_video ); ?>" class="woocommerce-product-gallery__image item-video">
												<a href="<?php the_permalink(); ?>">
												<div class="video-wrapper">
													<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_attr( $bestshop_featured_video ); ?>" frameborder="0" allowfullscreen></iframe>
												</div>
												</a>
											</div>
										<?php 
											}
											foreach ( $attachments as $key => $attachment ) { 
										?>
									<div class="woocommerce-product-gallery__image">	
										<a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $attachment, 'shop_single', false ); ?></a>
										<?php swg_label_sales(); ?>
									</div>
										<?php } ?>
									</div>
									<!-- Thumbnail Slider -->
									<div class="slider product-responsive-thumbnail" id="product_thumbnail_<?php echo esc_attr( $post->ID ); ?>">
										<?php if( $bestshop_featured_video != '' ) { ?>
										<div class="item-thumbnail-product">
											<div class="thumbnail-wrapper item-video-thumb">
												<img src="http://img.youtube.com/vi/<?php echo esc_attr( $bestshop_featured_video ); ?>/2.jpg" alt="<?php echo esc_attr( $post->post_title ); ?>"/>
											</div>
										</div>
									<?php }
										foreach ( $attachments as $attachment_id ) { 
									?>
										<div class="item-thumbnail-product">
											<div class="thumbnail-wrapper">
											<?php	echo wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), false, array( 'class' => 'slick-current' ) );	?>
											</div>
										</div>
										<?php
										}
									?>
									</div>
									<?php }else{ ?>
										<div class="single-img-product">
												<?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'bestshop' ) ), $post->ID ); ?>
										</div>
									<?php } ?>
								</div>
								</figure>
							</div>
						</div>							
					</div>
					<div class="col-lg-12 col-md-12">
						<div class="content_product_detail">
							<!-- woocommerce_template_single_title - 5 -->
							<!-- woocommerce_template_single_rating - 10 -->
							<!-- woocommerce_template_single_price - 20 -->
							<!-- woocommerce_template_single_excerpt - 30 -->
							<!-- woocommerce_template_single_add_to_cart 40 -->
							<?php
								/**
								 * woocommerce_single_product_summary hook
								 *
								 * @hooked woocommerce_template_single_title - 5
								 * @hooked woocommerce_template_single_price - 10
								 * @hooked woocommerce_template_single_excerpt - 20
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 * @hooked woocommerce_template_single_meta - 40
								 * @hooked woocommerce_template_single_sharing - 50
								 */
								do_action( 'woocommerce_single_product_summary' );
							?>
					</div>
				</div>
			</div><!-- .summary -->
		</div>
        
        <?php do_action( 'woocommerce_after_single_product' ); ?>
        <div class="clearfix"></div>
    </div>
</div>