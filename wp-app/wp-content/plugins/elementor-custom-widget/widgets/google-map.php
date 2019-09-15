<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Google_Map extends Widget_Base {

	public function get_name() {
		return 'google_map';
	}

	public function get_title() {
		return 'Google Map';
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
			'google_map_height',
			[
				'label' => 'Google Map Height',
				'type' => Controls_Manager::TEXT,
				'default' => '400px'
			]
		);


		$this->add_control(
			'google_map_key',
			[
				'label' => 'Google Map API key',
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'google_map_address',
			[
				'label' => 'Google Map API Address',
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="hz-google-map-widget" style="height: <?= $settings['google_map_height']; ?>">
			<?php echo do_shortcode('[pw_map address="'.$settings['google_map_address'].'" width="100%" height="100%" disablecontrols="true" key="'.$settings['google_map_key'].'"]'); ?>
		</div>
		<?php
	}
}
