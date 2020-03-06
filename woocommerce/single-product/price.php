<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$wc_price = ( function_exists( 'wc_get_price_to_display' ) ) ? wc_get_price_to_display( $product ) : $product->get_display_price();

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price"><?php echo sprintf( '%s', $product->get_price_html() ); ?></p>

	<meta itemprop="price" content="<?php echo esc_attr( $wc_price ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo esc_attr( $product->is_in_stock() ? 'InStock' : 'OutOfStock' ); ?>" />

</div>
<?php $stock = ( $product->is_in_stock() )? 'in-stock' : 'out-stock' ; ?>
<div class="product-info product_meta">
	<div class="product-stock <?php echo esc_attr( $stock ); ?>">
		<span class="in-out"><?php echo esc_attr( $product->is_in_stock() )? esc_html__( 'in stock', 'bestshop' ) : esc_html__( 'Out stock', 'bestshop' ); ?></span>
	</div>
</div>
<?php if( !bestshop_mobile_check() ) :?>
	<div class="product-info product_meta">
		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<span class="sku_wrapper"><?php esc_html_e( 'Product Code:', 'bestshop' ); ?> <span class="sku" itemprop="sku"><?php echo sprintf( ( $sku = $product->get_sku() ) ? '%s' : esc_html__( 'N/A', 'bestshop' ), $sku ); ?></span></span>
	<?php endif; ?>
</div>
<?php endif; ?>