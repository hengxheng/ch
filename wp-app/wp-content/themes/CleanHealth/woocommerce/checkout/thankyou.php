<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>
<style>
.page-header-widget, .partner-list{
	display:none;
}
.elementor-widget{
	margin: 0 !important;
}
</style>
<div class="thankyou-header">
	<div class="content-inner withPadding">
		<div class="thankyou-header-inner">
			<div class="col2">
				<div class="ty-header-content">
					<div class="ty-sign"><i class="fa fa-check-circle"></i></div>
					<h3>Thank you for your<br/>purchase!</h3>
					<p>Order Number: <?= $order->get_order_number(); ?></p>
				</div>
			</div>
			<div class="col2">
				<div class="ty-newsletter">
					<div class="ty-newsletter-box">
						<h3>Join our newsletter</h3>
						<p>Be the first to readour new articles, stay up to date with health & nutrition news and receive special offers!</p>
						<form action="">
							<div class="form-row">
								<input type="email" placeholder="Type your email address here" />
							</div>
							<div class="form-row">
								<input type="submit" value="SIGN UP NOW" class="w-btn"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="woocommerce-order">
	<div class="content-inner withPadding">
	<?php if ( $order ) : ?>
	<div class="woocommerce-order-inner">
		<div class="wc-order-left">
			<div class="wc-order-col-title">Order details</div>
			<div class="wc-order-col-content">
				<?php do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>
				
				<?php if ( $order->has_status( 'failed' ) ) : ?>
					<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

					<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
						<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
						<?php if ( is_user_logged_in() ) : ?>
							<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
						<?php endif; ?>
					</p>
				<?php else : ?>
					<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

					<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

						<li class="woocommerce-order-overview__order order">
							<span><?php esc_html_e( 'Order number:', 'woocommerce' ); ?></span>
							<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
						</li>

						<li class="woocommerce-order-overview__date date">
							<span><?php esc_html_e( 'Date:', 'woocommerce' ); ?></span>
							<strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
						</li>

						<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
							<li class="woocommerce-order-overview__email email">
								<span><?php esc_html_e( 'Email:', 'woocommerce' ); ?></span>
								<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
							</li>
						<?php endif; ?>

						<li class="woocommerce-order-overview__total total">
							<span><?php esc_html_e( 'Total:', 'woocommerce' ); ?></span>
							<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
						</li>

						<?php if ( $order->get_payment_method_title() ) : ?>
							<li class="woocommerce-order-overview__payment-method method">
								<span><?php esc_html_e( 'Payment method:', 'woocommerce' ); ?></span>
								<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
							</li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>			
			</div>

			<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
			<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
		</div>
		<div class="wc-order-right">
			<div class="wc-order-col-title">RETURN POLICY</div>
			<div class="wc-order-col-content">
				<?php echo do_shortcode('[widget id="custom_html-5"]'); ?>
			</div>
		</div>
	</div>
	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>
	</div>
</div>
