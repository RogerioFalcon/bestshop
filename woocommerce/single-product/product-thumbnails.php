<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version    3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;
$attachment_ids = array();
$attachment_ids = ( swg_woocommerce_version_check( '3.0' ) ) ? $product->get_gallery_image_ids() : $product->get_gallery_attachment_ids();
if ( has_post_thumbnail() ) {
	$image_id = get_post_thumbnail_id();
	array_unshift( $attachment_ids, $image_id );
	$attachment_ids = array_unique( $attachment_ids );
?>
	<div class="slider product-responsive-thumbnail" id="product_thumbnail_<?php echo esc_attr( $post->ID ); ?>">
		<?php 
		foreach ( $attachment_ids as $attachment_id ) { 
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
<?php
}
?>
	
