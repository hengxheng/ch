<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<?php the_content(); ?>
</div>

<div class="product-single-overlay" style="display:none;"></div>
<div class="product-single-msg" style="display:none;">
	<a href="#" class="psm-close"><i class="fa fa-times-circle"></i></a>
	<div class="psg-inner">
		<p>The product is added to cart successfully.</p>
		<a href="<?php echo get_site_url() ?>/products" class="g-btn">Continue Shopping</a>
		<a href="<?php echo get_site_url() ?>/cart" class="g-btn">View Cart</a>
	</div>
</div>
<div class="product-single-error-msg" style="display:none;">
<a href="#" class="psm-close"><i class="fa fa-times-circle"></i></a>
	<div class="psg-inner">
		<p>The product is not available. Please refresh and try again.</p>
		<a href="<?php echo get_site_url() ?>/products" class="g-btn">Continue Shopping</a>
	</div>
</div>
	<?php 
		// echo $product->get_price();
		// echo $product->get_regular_price(); 
		// echo $product->get_sale_price();
		// echo $product->get_name();

	?>
<?php do_action( 'woocommerce_after_single_product' ); ?>
