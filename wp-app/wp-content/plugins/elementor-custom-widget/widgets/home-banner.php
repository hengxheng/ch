<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Home_Banner extends Widget_Base {

	public function get_name() {
		return 'home-banner';
	}

	public function get_title() {
		return 'Home Banner';
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

		// $this->add_control(
		// 	'button-text',
		// 	[
		// 		'label' => 'Button Text',
		// 		'type' => Controls_Manager::TEXT,
		// 	]
		// );

		// $this->add_control(
		// 	'button-link',
		// 	[
		// 		'label' => 'Link',
		// 		'type' => Controls_Manager::URL,
		// 		'placeholder' => 'https://your-link.com',
		// 		'show_external' => true,
		// 		'default' => [
		// 			'url' => '',
		// 			'is_external' => false,
		// 			'nofollow' => false,
		// 		],
		// 	]
    	// );


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
		<div class="home-banner-widget <?= $settings['section-class'] ?>">
			<div class="banner-inner <?= ($settings['full_width'])?'':'content-inner' ?>" style="background:url(<?= $settings['image']['url'] ?>) no-repeat center center;background-size:cover">
			<?php if($settings['full_width']): ?>
				<div class="content-inner">
			<?php endif; ?>
				<div class="banner-text-wrapper">
					<div class="banner-text text-wysiwyg">
						<?= wpautop( $settings['content'] ) ?>
					</div>
				</div>
			<?php if($settings['full_width']): ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
