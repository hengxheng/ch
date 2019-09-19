<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Video_List extends Widget_Base {

	public function get_name() {
		return 'video_list';
	}

	public function get_title() {
		return 'Video List';
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

		$repeater = new Repeater();

		$repeater->add_control(
			'content',
			[
				'label' => 'Content',
				'type' => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
            'image',
            [
              'label'   => 'Background Image',
              'type'    => Controls_Manager::MEDIA,
              'default' => [
                'url' => Utils::get_placeholder_image_src(),
              ],
            ]
        );

		$repeater->add_control(
			'link',
			[
				'label' => 'Youtube Embed Link',
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'list',
			[
			  'label'  => 'Video List',
			  'type'   => Controls_Manager::REPEATER,
			  'fields' => $repeater->get_controls(),
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
		<div class="video-list-widget">
			<div class="video-list-strap">
			<?php foreach ($settings['list'] as $item): ?>
			<div class="video-box">
				<div class="video-title">
					<?= $item['content']  ?>
				</div>
				<div class="video-list-body" style="background:url(<?= $item['image']['url'] ?>) no-repeat center center; background-size: cover;">
					<div class="video-list-wrapper">
					<div class="video-list-inner">
						<div class="play-icon">
							<a href="<?= $item['link'] ?>" data-lity><i class="fa fa-play-circle"></i></a>
						</div>
					</div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}
