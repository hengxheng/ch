<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$product_id = $product->get_id();
?>
<li <?php wc_product_class( '', $product ); ?>>
	<div class="product-box">
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
?>
	<div class="product-name">
		<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
	</div>
	<div class="product-desc">
		<?= wp_trim_words($product->get_short_description(), 30); ?>
	</div>
	<div class="product-price">
		<span class="price">ONLY $<?=  $product->get_regular_price(); ?> USD</span>
		<?php  if( $product->is_on_sale() ): ?>
			<span class="sale-price">WAS $<?= $product->get_sale_price(); ?> USD - SAVE $<?= (int)$product->get_regular_price() - (int)$product->get_sale_price() ?> </span>
		<?php endif; ?>
	</div>
	<a href="<?= do_shortcode('[add_to_cart_url id="'.$product_id.'"]'); ?>" data-quantity="1" data-product_id="<?= $product_id ?>" class="add-to-cart-btn b-btn">BUY NOW</a>
	<a href="<?= get_permalink($product_id); ?>" class="learn-more">LEARN MORE <i class="fa fa-play-circle"></i></a>
</div>
</li>
