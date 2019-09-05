<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Team_Second extends Widget_Base {

	public function get_name() {
		return 'team_second';
	}

	public function get_title() {
		return 'Team Second';
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
            'image',
            [
              'label'   => 'Left Image',
              'type'    => Controls_Manager::MEDIA,
              'default' => [
                'url' => Utils::get_placeholder_image_src(),
              ],
            ]
        );

		$this->add_control(
			'content',
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
		<div class="team-second-widget">
			<div class="team-second-strap" >		
				<div class="text-wrapper">
					<div class="text-wysiwyg">
						<?= wpautop( $settings['content'] ) ?>
					</div>
				</div>
				<div class="image-wrapper" style="background:url(<?= $settings['image']['url'] ?>) no-repeat center center;background-size:cover">
				</div>
			</div>
		</div>
		<?php
	}
}
