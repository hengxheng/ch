<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Team_First extends Widget_Base {

	public function get_name() {
		return 'team_first';
	}

	public function get_title() {
		return 'Team First';
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
			'content',
			[
				'label' => 'Left Content',
				'type' => Controls_Manager::WYSIWYG,
			]
		);

		$this->add_control(
			'instagram_link',
			[
				'label' => 'Instagram_Link',
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
		<div class="team-first-widget">
			<div class="">
			<div class="team-first-strap">
				<div class="col2">
					<div class="team-first-image">
						<img src="<?= $settings['image']['url'] ?>" alt="img"/>	
					</div>
				</div>
				<div class="col2">
					<div class="team-first-text-wrapper">
						<div class="text-wysiwyg">
							<?= wpautop( $settings['content'] ) ?>
						</div>
						<a href="<?= $settings['instagram_link'] ?>" class="w-btn">FIND ME ON INSTAGRAM</a>
					</div>
				</div>
			</div>
			</div>
		</div>
		<?php
	}
}
