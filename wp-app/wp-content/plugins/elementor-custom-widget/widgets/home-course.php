<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Home_Course extends Widget_Base {

	public function get_name() {
		return 'home-course';
	}

	public function get_title() {
		return 'Home Course';
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
			'section-class',
			[
				'label' => 'Section Class',
				'type'  => Controls_Manager::TEXT,
				'description' => 'For special styling, do not change it'
			]
		);
		
		$this->add_control(
			'section-title',
			[
				'label' => 'Section Title',
				'type'  => Controls_Manager::TEXT,
			]
		);
        
		$repeater = new Repeater();

        $repeater->add_control(
			'course-color',
			[
				'label' => 'Course Color',
				'type'  => Controls_Manager::COLOR,
			]
        );
        
		$repeater->add_control(
			'course-image',
			[
			  'label'   => 'Course Image',
			  'type'    => Controls_Manager::MEDIA,
			  'default' => [
				'url' => Utils::get_placeholder_image_src(),
			  ],
			]
		);
		
		$repeater->add_control(
			'course-name',
			[
				'label' => 'Course Name',
				'type'  => Controls_Manager::TEXT,
			]
		);
        
        $repeater->add_control(
			'course-icon',
			[
				'label'   => 'Course Icon',
			  	'type'    => Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'course-content',
			[
				'label' => 'Course Content',
				'type'  => Controls_Manager::WYSIWYG,
			]
		);

		$this->add_control(
			'course',
			[
				'label'  => 'Course',
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
				'default' => '0',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        
        $courses = $settings['course'];
        $count_courses = count($courses);

	?>
        <div class="home-course-widget <?= $settings['section-class'] ?>">
			<div class="content-inner ">
				<div class="mcl-header">
					<?= $settings['section-title'] ?>
				</div>
				<div class="mcl-content">
				<?php if($count_courses): ?>
					<?php foreach ( $courses as $index => $item ):
						$courseColor = "#000";
						if($item['course-color']){
							$courseColor = $item['course-color'];
						}	
					?> 
						<div id="course-col-<?=$index ?>"class="course-col">
                            <div class="course-inner">
								<?php if($item['course-image']['url']): ?>
                                    <div class="course-image">
                                        <img src="<?= $item['course-image']['url'] ?>" alt="Image">
                                    </div>
                                <?php endif; ?> 

								<div class="course-header" style="background-color: <?= $courseColor ?>">
									<?php if($item['course-icon']['url']): ?>	
										<img class="ch-icon" src="<?= $item['course-icon']['url'] ?>" alt="Image">
									<?php endif; ?>
									<?php if($item['course-name']): ?>
										<span><?= $item['course-name'] ?></span>
									<?php endif; ?>
								</div>

                                <?php if($item['course-content']): ?>
                                    <div class="course-content text-wysiwyg" >
                                        <?= $item['course-content'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
						</div>
						<style>
							#course-col-<?=$index ?> .course-header::after {					
								content: '';
								position: absolute;
								z-index: 5;
								bottom: -15px;
								left:50%;
								transform: translateX(-50%);
								width: 0;
								height: 0;
								border-style: solid;
								border-width: 15px 15px 0 15px;
								border-color: <?= $courseColor ?> transparent transparent transparent;
							}

							#course-col-<?=$index ?> .course-content.text-wysiwyg ul li:after{
								color: <?= $courseColor ?>;
							}
						</style>
					<?php endforeach; ?>
                <?php endif; ?>
				</div>
                <div class="mcl-footer text-wysiwyg"><?= $settings['section-footer'] ?></div>
			</div>
		</div>
	<?php
	}
}
