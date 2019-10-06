<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Product_Page_Cta extends Widget_Base {

	public function get_name() {
		return 'product-page-cta';
	}

	public function get_title() {
		return 'Product Page CTA';
	}

	public function get_icon() {
		return 'fa fa-puzzle-piece';
	}

	public function get_categories() {
		return [ 'product_page' ];
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
			'content',
			[
				'label' => 'Content',
				'type' => Controls_Manager::WYSIWYG,
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
		global $product;
		$product_id = $product->get_id();
		$settings = $this->get_settings_for_display();
	?>
		<div class="product-page-cta-widget <?= $settings['section-class']?>">
			<div class="product-page-cta content-inner withPadding">
				<div class="text-wrapper">
					<div class="text-wysiwyg">
						<?= wpautop( $settings['content'] ) ?>
					</div>
					<a href="<?= do_shortcode('[add_to_cart_url id="'.$product_id.'"]'); ?>" data-quantity="1" data-product_id="<?= $product_id ?>" class="add-to-cart-btn b-btn">BUY NOW</a>
				</div>
			</div>
		</div>
		<?php
	}
}
