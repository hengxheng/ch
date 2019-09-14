<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Enroll_Strip extends Widget_Base {

	public function get_name() {
		return 'enroll_strip';
	}

	public function get_title() {
		return 'Enroll Strip';
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
			'section-class',
			[
				'label' => 'Section Class',
				'type'  => Controls_Manager::TEXT,
				'description' => 'For special styling, do not change it'
			]
		);


		$this->add_control(
			'left-content',
			[
				'label' => 'Left Content',
				'type' => Controls_Manager::WYSIWYG,
			]
		);

		$this->add_control(
			'right-content',
			[
				'label' => 'Right Content',
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
		<div class="enroll-strip-widget">
			<div class="enroll-strap content-inner withPadding">
				<div class="col2">
					<div class="col-wrapper">
						<div class="text-wysiwyg">
							<?= wpautop( $settings['left-content'] ) ?>
						</div>
					</div>
				</div>
				<div class="col2">
					<div class="col-wrapper">
						<div class="text-wysiwyg">
							<?= wpautop( $settings['right-content'] ) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
