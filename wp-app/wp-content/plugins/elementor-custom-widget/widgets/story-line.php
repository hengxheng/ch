<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Story_Line extends Widget_Base {

	public function get_name() {
		return 'story_line';
	}

	public function get_title() {
		return 'Story Line';
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

		$repeater = new Repeater();

		$repeater->add_control(
			'story-sub-heading',
			[
				'label' => 'Story Heading',
				'type' => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'year',
			[
				'label' => 'Year',
				'type' => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'image',
			[
			  'label'   => 'Profile',
			  'type'    => Controls_Manager::MEDIA,
			  'default' => [
				'url' => Utils::get_placeholder_image_src(),
			  ],
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => 'Description',
				'type' => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'stories',
			[
				'label'  => 'Stories',
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if(!empty($settings['stories'])):
	?>
        <div class="story-line-wrapper">
			<div class="content-inner">
				<?php foreach ( $settings['stories'] as $index => $item ) : ?>
					<?php if($item['story-sub-heading']): ?>
						<div class="story-subheading">
							<h2><?= $item['story-sub-heading'] ?></h2>
						</div>
					<?php endif;?>
					<div class="story-strap">
						<?php if($item['story-sub-heading']): ?>
							<div class="story-year hasYear"><?= $item['year'] ?></div>
						<?php else: ?>
							<div class="story-year"></div>
						<?php endif;?>

						<div class="story-profile-image">
							<img src="<?= $item['image']['url'] ?>" alt="<?= $item['year'] ?>">	
						</div>
						<div class="story-desc">
							<?= $item['description'] ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php
		endif;
	}
}
