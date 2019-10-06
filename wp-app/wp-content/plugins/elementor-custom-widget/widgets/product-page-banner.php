<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Product_Page_Banner extends Widget_Base {

	public function get_name() {
		return 'product-page-banner';
	}

	public function get_title() {
		return 'Product Page Banner';
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
            'full_width',
            [
              'label'        => 'Full Width',
              'type'         => Controls_Manager::SWITCHER,
              'label_on'     => 'ON',
              'label_off'    => 'OFF',
              'return_value' => 1,
              'default'      => 0,
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

		$this->add_control(
			'content',
			[
				'label' => 'Content',
				'type' => Controls_Manager::WYSIWYG,
			]
		);

		$this->add_control(
            'show_add_to_cart_btn',
            [
              'label'        => 'Bug now button',
              'type'         => Controls_Manager::SWITCHER,
              'label_on'     => 'ON',
              'label_off'    => 'OFF',
              'return_value' => 1,
              'default'      => 1,
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
		$this->add_inline_editing_attributes( 'content', 'advanced' );
		?>
		<div class="product-page-banner-widget">
			<div class="product-page-banner">
				<div class="banner-inner <?= ($settings['full_width'])?'':'content-inner narrow' ?>" style="background:url(<?= $settings['image']['url'] ?>) no-repeat center center;background-size:contain;">
					<div class="col-2"></div>
					<div class="col-2">
						<div class="banner-text-wrapper">
							<div class="banner-text text-wysiwyg">
								<?= wpautop( $settings['content'] ) ?>
							</div>
							<?php if($settings['show_add_to_cart_btn']): ?>
								<div class="mcl-footer text-wysiwyg">
									<a href="<?= do_shortcode('[add_to_cart_url id="'.$product_id.'"]'); ?>" data-quantity="1" data-product_id="<?= $product_id ?>" class="add-to-cart-btn w-btn">BUY NOW</a>	
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
