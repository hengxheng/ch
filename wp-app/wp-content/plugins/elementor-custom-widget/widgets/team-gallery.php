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

	public function get_script_depends() {
		return [ 
            'elementor-custome-widget-js' 
          ];
  	}
  

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => 'Content'
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'main-image',
			[
			  'label'   => 'Main Image',
			  'type'    => Controls_Manager::MEDIA,
			  'default' => [
				'url' => Utils::get_placeholder_image_src(),
			  ],
			]
		);

		$repeater->add_control(
			'image1',
			[
			  'label'   => 'Image1',
			  'type'    => Controls_Manager::MEDIA,
			  'default' => [
				'url' => Utils::get_placeholder_image_src(),
			  ],
			]
		);

		$repeater->add_control(
			'image2',
			[
			  'label'   => 'Image2',
			  'type'    => Controls_Manager::MEDIA,
			  'default' => [
				'url' => Utils::get_placeholder_image_src(),
			  ],
			]
		);


		$repeater->add_control(
			'image3',
			[
			  'label'   => 'Image3',
			  'type'    => Controls_Manager::MEDIA,
			  'default' => [
				'url' => Utils::get_placeholder_image_src(),
			  ],
			]
		);

		$repeater->add_control(
			'content',
			[
			  'label'   => 'Content',
			  'type'    => Controls_Manager::WYSIWYG,
			]
		);


		$this->add_control(
			'gallery',
			[
				'label'  => 'Gallery',
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	
		if(!empty($settings['gallery'])):
	?>
        <div class="gallery-list-widget">
			<div class="gallery-wrapper">
				<?php foreach ( $settings['gallery'] as $index => $item ) : ?>
					<div class="gallery-item">
						<img src="<?= $item['main-image']['url'] ?>" alt="Image">
						<div class="gellery-content-wrapper">
							<div class="gallery-content-bg"></div>
							<div class="gallery-content">
								<div class="gc-content-inner">
									<div class="gc-images">
										<div class="gc-img">
											<img src="<?= $item['image1']['url'] ?>" alt="">
										</div>
										<div class="gc-img">
											<img src="<?= $item['image2']['url'] ?>" alt="">
										</div>
										<div class="gc-img">
											<img src="<?= $item['image3']['url'] ?>" alt="">
										</div>
									</div>
									<div class="gc-text text-wysiwyg">
										<?= $item['content']; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php
		endif;
	}
}
