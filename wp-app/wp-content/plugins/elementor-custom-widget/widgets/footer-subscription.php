<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Footer_Subscription extends Widget_Base {

	public function get_name() {
		return 'footer_subscription';
	}

	public function get_title() {
		return 'Footer Subscription';
	}

	public function get_icon() {
		return 'fa fa-puzzle-piece';
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
            'image1',
            [
              'label'   => 'Background Image 1',
              'type'    => Controls_Manager::MEDIA,
              'default' => [
                'url' => Utils::get_placeholder_image_src(),
              ],
            ]
		);
		
		$this->add_control(
            'image2',
            [
              'label'   => 'Background Image 2',
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
		<div class="footer-subscription-widget">
			<div class="footer-subscription-wrapper">
				<div class="fs-inner" style="background:url(<?= $settings['image2']['url'] ?>) no-repeat center center; background-size: cover;">
					<div class="fs-image">
						<img src="<?= $settings['image1']['url'] ?>" alt="img"/>	
					</div>
					<div class="fs-content">
						<div class="fs-content-inner">
							<div class="text-wysiwyg">
								<?= wpautop( $settings['content'] ) ?>
							</div>
							<div class="subcription-form">
								<!--[if lte IE 8]>
								<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
								<![endif]-->
								<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
								<script>
									hbspt.forms.create({
										portalId: "5113772",
										formId: "a8beac2e-8fd0-4dc5-aea0-3a5d60e34c1a"
									});
								</script>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
