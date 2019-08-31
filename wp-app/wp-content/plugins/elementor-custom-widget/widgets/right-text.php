<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Right_Text extends Widget_Base {

	public function get_name() {
		return 'right_text';
	}

	public function get_title() {
		return 'Right Text';
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
              'label'   => 'Left Background Image',
              'type'    => Controls_Manager::MEDIA,
              'default' => [
                'url' => Utils::get_placeholder_image_src(),
              ],
            ]
        );

		$this->add_control(
			'content',
			[
				'label' => 'Left Content',
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
		<div class="right-text-widget">
			<div class="right-text-strap" >
				<div class="col2">
					<div class="placeholder-block">
						<img src="<?= $settings['image']['url'] ?>" alt="img"/>	
					</div>
				</div>
				<div class="col2">
					<div class="right-text-wrapper">
						<div class="text-wysiwyg">
							<?= wpautop( $settings['content'] ) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
