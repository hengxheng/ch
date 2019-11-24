<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Home_Qualified extends Widget_Base {

	public function get_name() {
		return 'home-qualified';
	}

	public function get_title() {
		return 'Home Qualified';
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
			'section-title',
			[
				'label' => 'Section Title',
				'type'  => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'website_link',
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

		$this->add_control(
            'image',
            [
              'label'   => 'Image',
              'type'    => Controls_Manager::MEDIA,
              'default' => [
                'url' => Utils::get_placeholder_image_src(),
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
		<div class="home-gualified-widget">
			<div class="content-inner">
				<div class="section-header">
					<?= $settings['section-title'] ?>
				</div>
				<div class="home-qualified-wrapper">
					<div class="home-qualified-inner">
						<a href="<?= $settings['website_link']["url"] ?>">
							<img src="<?= $settings['image']['url'] ?>" alt="Image">
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
