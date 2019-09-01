<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Footer_Contact extends Widget_Base {

	public function get_name() {
		return 'footer_contact';
	}

	public function get_title() {
		return 'Footer Contact';
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
		?>
		<div class="footer-contact-widget" style="background:url(<?= $settings['image']['url'] ?>) no-repeat center center; background-size: cover;">
			<div class="content-inner">
			<div class="footer-contact-strap">
				<div class="col2">
					<div class="footer-contact-content">
						<div class="fc-title">
							<?= $settings['content'] ?>
						</div>
						<div class="fc-form">
							<?php echo do_shortcode('[contact-form-7 id="52" title="Footer Contact"]'); ?>
						</div>
					</div>
				</div>
				<div class="col2">
				
				</div>
			</div>
			</div>
		</div>
		<?php
	}
}
