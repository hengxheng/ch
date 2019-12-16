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
class Left_Right_Fullwidth extends Widget_Base {

	public function get_name() {
		return 'left-right-fullwidth';
	}

	public function get_title() {
		return 'Left Right Fullwidth';
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
            'left-title',
            [
              'label'   => 'Left Title',
              'type'    => Controls_Manager::TEXT,
            ]
        );

		$this->add_control(
            'left-image',
            [
              'label'   => 'Left Background Image',
              'type'    => Controls_Manager::MEDIA,
              'default' => [
                'url' => Utils::get_placeholder_image_src(),
              ],
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
			'left-link',
			[
				'label' => 'Left Link',
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
			]
    	);

		$this->add_control(
            'right-title',
            [
              'label'   => 'Right Title',
              'type'    => Controls_Manager::TEXT,
            ]
        );

		$this->add_control(
            'right-image',
            [
              'label'   => 'Right Background Image',
              'type'    => Controls_Manager::MEDIA,
              'default' => [
                'url' => Utils::get_placeholder_image_src(),
              ],
            ]
        );

		$this->add_control(
			'right-content',
			[
				'label' => 'Right Content',
				'type' => Controls_Manager::WYSIWYG,
			]
		);

		$this->add_control(
			'right-link',
			[
				'label' => 'Right Link',
				'type' => Controls_Manager::URL,
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
		?>
		<div class="left-right-fullwidth-widget">
			<div class="col2">
				<div class="lr-block" style="background:url(<?= $settings['left-image']['url'] ?>) no-repeat center center;background-size:cover">
					<div class="lr-block-inner">
						<div class="lr-title">
							<?= $settings['left-title'] ?>
						</div>
						<div class="lr-content text-wysiwyg">
							<?= wpautop( $settings['left-content'] ) ?>
						</div>
						<?php if($settings['left-link']): ?>
							<a href="<?= $settings['left-link']['url'] ?>" class="btn-arrow"><span>LEARN MORE</span></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col2">
				<div class="lr-block" style="background:url(<?= $settings['right-image']['url'] ?>) no-repeat center center;background-size:cover">
					<div class="lr-block-inner">
						<div class="lr-title">
							<?= $settings['right-title'] ?>
						</div>
						<div class="lr-content text-wysiwyg">
							<?= wpautop( $settings['right-content'] ) ?>
						</div>
						<?php if($settings['right-link']): ?>
							<a href="<?= $settings['right-link']['url'] ?>" class="btn-arrow"><span>LEARN MORE</span></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
