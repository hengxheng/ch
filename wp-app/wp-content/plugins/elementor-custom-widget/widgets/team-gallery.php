<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Team_Gallery extends Widget_Base {

	public function get_name() {
		return 'team-gallery';
	}

	public function get_title() {
		return 'Team Gallery';
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
				'label' => 'Content'
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => 'Heading',
				'type' => Controls_Manager::TEXT,
				'default' => 'AS FEATURED IN',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
			  'label'   => 'Partner Logo',
			  'type'    => Controls_Manager::MEDIA,
			  'default' => [
				'url' => Utils::get_placeholder_image_src(),
			  ],
			]
		);

		$this->add_control(
			'partners',
			[
				'label'  => 'Partner List',
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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
			'padding',
			[
				'label' => 'Padding',
				'type' => Controls_Manager::TEXT,
				'default' => '10px',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	
		$padding = '10px';
		if($settings['padding']){
			$padding = $settings['padding'];
		}

		$heading = $settings['heading'];
		if(!empty($settings['partners'])):
	?>
        <div class="partner-list">
			<div class="content-inner">
				<div class="partner-list-title"><?= $heading ?></div>
				<div class="partner-list-content">
					<?php foreach ( $settings['partners'] as $index => $item ) : ?>
						<div class="pl-block" style="padding: <?= $padding ?>">
							<img src="<?= $item['image']['url'] ?>" alt="Image">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php
		endif;
	}
}
