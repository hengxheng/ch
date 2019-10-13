<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="woocommerce-order-downloads">
	<div class="wc-order-col-title">Download your ebooks here!</div>
	<div class="wc-order-col-content">
		<ul class="order_details download_details">
		<?php foreach ( $downloads as $download ) : ?>
			<li>
				<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
						<?php
							switch ( $column_id ) {
								case 'download-product':
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id($download['product_id']), 'single-post-thumbnail' );
									if ( $download['product_url'] ) {
										echo '<img src="'.$image_url[0].'" /><span><a href="' . esc_url( $download['product_url'] ) . '">' . esc_html( $download['product_name'] ) . '</a></span>';
									} else {
										echo esc_html( $download['product_name'] );
									}
									break;
								case 'download-file':
									echo '<span><a href="' . esc_url( $download['download_url'] ) . '" class="woocommerce-MyAccount-downloads-file g-btn">DOWNLOAD</a></span>';
									break;
								// case 'download-remaining':
								// 	echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : esc_html__( '&infin;', 'woocommerce' );
								// 	break;
								// case 'download-expires':
								// 	if ( ! empty( $download['access_expires'] ) ) {
								// 		echo '<time datetime="' . esc_attr( date( 'Y-m-d', strtotime( $download['access_expires'] ) ) ) . '" title="' . esc_attr( strtotime( $download['access_expires'] ) ) . '">' . esc_html( date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ) ) . '</time>';
								// 	} else {
								// 		esc_html_e( 'Never', 'woocommerce' );
								// 	}
								// 	break;
							}
						?>
				<?php endforeach; ?>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
</section>
