<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Woo_Bundle extends Widget_Base {

	public function get_name() {
		return 'woo_bundle';
	}

	public function get_title() {
		return 'Woo Bundle';
	}

	public function get_icon() {
        return 'eicon-products';
    }

    public function get_keywords() {
        return ['products', 'product', 'woocommerce', 'ecommerce'];
    }

	public function get_categories() {
		return [ 'custom' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => 'Content',
			]
		);
		
		$this->add_control(
			'section-class',
			[
				'label' => 'Section Class',
				'type'  => Controls_Manager::TEXT,
				'description' => 'For special styling, do not change it'
			]
		);

		$this->add_control(
            'full_width',
            [
              'label'        => 'Full Width',
              'type'         => Controls_Manager::SWITCHER,
              'label_on'     => 'ON',
              'label_off'    => 'OFF',
              'return_value' => 1,
              'default'      => 1,
            ]
		);
		  
		$this->add_control(
            'image',
            [
              'label'   => 'Background Image',
              'type'    => Controls_Manager::MEDIA,
              'default' => [
                'url' => Utils::get_placeholder_image_src(),
              ],
            ]
        );

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$args = array( 
			'post_type' 	 => 'product', 
			'posts_per_page' => 1, 
			'product_tag' 	 => "Bundle"
		);

		$bunde_product = new \WP_Query( $args );
		$this->add_inline_editing_attributes( 'content', 'advanced' );
		?>

		<?php if( $bunde_product->post_count > 0 ) : ?>
		<div class="woo-bundle-widget <?= $settings['section-class'] ?>">
			<div class="content-inner withPadding">
				<div class="woo-bundle-strap <?= !$settings['full_width']?"content-inner":"" ?>" >
				<?php while ( $bunde_product->have_posts() ) : 
					$bunde_product->the_post(); 
					global $product; 
					$product_id = $product->get_id();
				?>
					<div class="col2">
						<div class="placeholder-block">
							<img src="<?= $settings['image']['url'] ?>" alt="img"/>	
						</div>
					</div>
					<div class="col2">
						<div class="text-wrapper">
							<div class="product-name">
								<?= $product->get_title() ?>
							</div>
							<div class="product-desc text-wysiwyg">
								<?= wpautop($product->get_short_description()) ?>
							</div>
							<div class="product-price">
								<h2 class="price">ONLY $<?=  $product->get_regular_price(); ?> USD</h2>
								<?php  if( $product->is_on_sale() ): ?>
									<strong class="sale-price">WAS $<?= $product->get_sale_price(); ?> USD - SAVE $<?= (int)$product->get_regular_price() - (int)$product->get_sale_price() ?> </strong>
								<?php endif; ?>
							</div>
							<div class="bundle-form">
								<a href="<?= do_shortcode('[add_to_cart_url id="'.$product_id.'"]'); ?>" data-quantity="1" data-product_id="<?= $product_id ?>" class="add-to-cart-btn w-btn">BUY NOW</a>
								<a href="<?= get_permalink($product_id); ?>" class="learn-more w-btn">LEARN MORE <i class="fa fa-play-circle"></i></a>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
		<?php
			endif;
	}
}
