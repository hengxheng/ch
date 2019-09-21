<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Text_With_Image_Bg extends Widget_Base {

	public function get_name() {
		return 'text_with_image_bg';
	}

	public function get_title() {
		return 'Text With Image Background';
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
              'label'   => 'Background Image',
              'type'    => Controls_Manager::MEDIA,
              'default' => [
                'url' => Utils::get_placeholder_image_src(),
              ],
            ]
        );

		$this->add_control(
            'text_align',
            [
                'label' => 'Text Align',
                'type' => Controls_Manager::SELECT,
                'default' => 'center;',
                'options' => [
					'text-center' => 'Center',
					'text-left' => 'Left',
					'text-right' => 'Right'
				]
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
		<div class="text-with-image-bg-widget <?= $settings['section-class'] ?>">
			<div class="text-with-image-bg-strap" style="background:url(<?= $settings['image']['url'] ?>) no-repeat center center;background-size:cover">
				<div class="content-inner withPadding">	
					<div class="text-wrapper <?= $settings['text_align'] ?>">
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
