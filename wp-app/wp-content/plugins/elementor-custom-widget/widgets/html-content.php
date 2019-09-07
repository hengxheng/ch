<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class HTML_Content extends Widget_Base {

	public function get_name() {
		return 'html_content';
	}

	public function get_title() {
		return 'HTML Content';
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
			'content',
			[
				'label' => 'Content',
				'type' => Controls_Manager::WYSIWYG,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => 'Style',
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content-width',
			[
				'label' => 'Content Width',
				'type' => Controls_Manager::TEXT,
				'default' => '100%',
			]
		);

		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="html-content-widget">
			<div class="content-inner">
				<div class="text-wysiwyg" style="width: <?= $settings['content-width'] ?>;margin: 0 auto;">
					<?= $settings['content'] ?>
				</div>
			</div>
		</div>
		<?php
	}
}
