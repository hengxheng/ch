<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Calendar_Strip extends Widget_Base {

	public function get_name() {
		return 'calendar_strip';
	}

	public function get_title() {
		return 'Calendar Strip';
	}

	public function get_icon() {
		return 'fa fa-puzzle-piece';
	}

	public function get_categories() {
		return [ 'custom' ];
	}

	// public function get_script_depends() {
	// 	return [ 
    //         'elementor-custome-widget-lity',
	// 	];
  	// }
  
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

		$this->add_control(
			'link',
			[
				'label' => 'Link',
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
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
		$this->add_inline_editing_attributes( 'content', 'advanced' );
		?>
		<div class="calendar-strip-widget">
			<div class="calendar-strip-strap" style="background:url(<?= $settings['image']['url'] ?>) no-repeat center center; background-size: cover;">
				<div class="calendar-strip-wrapper">
				<div class="calendar-strip-inner">
					<i class="fa fa-calendar"></i>
					<div class="calendar-text">
						<?= $settings['content']  ?>
					</div>
					<div class="calendar-cta">
						<a href="<?= $settings['link'] ?>" class="w-btn">View Course Calendar</a>
					</div>
					
				</div>
				</div>
			</div>
		</div>
		<?php
	}
}
