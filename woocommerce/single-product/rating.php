<?php
/*
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.6.0
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}
	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();
?>

<div class="reviews-content">
	<div class="star">
		<?php echo '<span style="width:'. ( $average*13 ) .'px"></span>'; ?>		
	</div>
		<?php if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf( _n( '%s Review', '%s Review(s)', $rating_count, 'bestshop' ), '<span class="count">' . $rating_count . '</span>' ); ?></a><?php endif; ?>
		<div class="review-text"><?php echo esc_html__('Add Your Review','bestshop'); ?></div>
</div>