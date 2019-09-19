<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Education_Banner extends Widget_Base {

	public function get_name() {
		return 'education-banner';
	}

	public function get_title() {
		return 'Education Banner';
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
            'full_width',
            [
              'label'        => 'Full Width',
              'type'         => Controls_Manager::SWITCHER,
              'label_on'     => 'ON',
              'label_off'    => 'OFF',
              'return_value' => 1,
              'default'      => 0,
            ]
		);

		$repeater = new Repeater();

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
			'content',
			[
				'label' => 'Content',
				'type' => Controls_Manager::WYSIWYG,
			]
		);

		$this->add_control(
			'banners',
			[
			  'label'  => 'Banners',
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
		$this->add_inline_editing_attributes( 'content', 'advanced' );
		?>
		<div class="education-banner-widget">
			<?php foreach ($settings['banners'] as $key => $item): ?>
			<div class="banner-inner <?= ($settings['full_width'])?'':'content-inner narrow' ?>" style="background:url(<?= $item['image']['url'] ?>) no-repeat center center;background-size:cover">
				<div class="banner-text-wrapper">
					<div class="banner-text text-wysiwyg">
						<?= wpautop( $item['content'] ) ?>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
