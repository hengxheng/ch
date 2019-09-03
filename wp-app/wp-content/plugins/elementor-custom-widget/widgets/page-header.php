<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Page_Header extends Widget_Base {

	public function get_name() {
		return 'page_header';
	}

	public function get_title() {
		return 'Page Header';
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
			'title',
			[
				'label' => 'Menu Title',
				'type' => Controls_Manager::TEXT,
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

		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="page-header-widget" style="background:url(<?= $settings['image']['url'] ?>) no-repeat center center;background-size:cover">
			<div class="content-inner withPadding">
				<div class="p-title">
					<?= $settings['title'] ?>
				</div>
				<div class="p-breadcrumbs">
					<?php 
						if(function_exists('bcn_display')){
							bcn_display();
						}
					?>
				</div>
			</div>
		</div>
		<?php
	}
}
