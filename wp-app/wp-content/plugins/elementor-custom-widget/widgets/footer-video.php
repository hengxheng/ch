<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Footer_Video extends Widget_Base {

	public function get_name() {
		return 'footer_video';
	}

	public function get_title() {
		return 'Footer Video';
	}

	public function get_icon() {
		return 'fa fa-puzzle-piece';
	}

	public function get_categories() {
		return [ 'custom' ];
	}

	public function get_script_depends() {
		return [ 
            'elementor-custome-widget-lity',
		];
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
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => 'Youtube Embed Link',
				'type' => Controls_Manager::TEXT,
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
		<div class="footer-video-widget">
			<div class="footer-video-strap" style="background:url(<?= $settings['image']['url'] ?>) no-repeat center center; background-size: cover;">
				<div class="footer-video-wrapper">
				<div class="footer-video-inner">
					<div class="play-icon">
						<a href="<?= $settings['link'] ?>" data-lity><i class="fa fa-play-circle"></i></a>
					</div>
					<div class="video-text">
						<?= $settings['content']  ?>
					</div>
				</div>
				</div>
			</div>
		</div>
		<?php
	}
}
