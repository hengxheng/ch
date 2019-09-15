<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Contact_Page_Main extends Widget_Base {

	public function get_name() {
		return 'contact_page_main';
	}

	public function get_title() {
		return 'Contact Page Main';
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
		<div class="contact-main-widget">
				<div class="contact-main-strap">
					<div class="contact-content">
						<div class="contact-content-inner">
							<div class="text-wysiwyg">
								<?= $settings['content'] ?>
							</div>
							<div class="contact-list">
								<?php echo do_shortcode('[widget id="custom_html-3"]'); ?>
							</div>
							<div class="text-wysiwyg">
								<hr/>
							</div>
							<div class="text-wysiwyg">
								<h4>Find us on social media: </h4>
							</div>
							<div class="social-list">
								<?php echo do_shortcode('[widget id="custom_html-4"]'); ?>
							</div>
						</div>
					</div>
					<div class="contact-form">
						<div class="fc-form">
							<h3>Advance your career in health & fitness</h3>
							<?php echo do_shortcode('[contact-form-7 id="52" title="Footer Contact"]'); ?>
						</div>
					</div>
				</div>
		</div>
		<?php
	}
}
