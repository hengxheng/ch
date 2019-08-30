<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Multiple_Column_Layout extends Widget_Base {

	public function get_name() {
		return 'multiple-column-layout';
	}

	public function get_title() {
		return 'Multiple Column Layout';
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
			]
        );
        
		$this->add_control(
			'section-header',
			[
				'label' => 'Section Header',
				'type'  => Controls_Manager::TEXTAREA,
			]
		);

        $this->add_control(
			'section-footer',
			[
				'label' => 'Section Footer',
				'type'  => Controls_Manager::TEXTAREA,
			]
		);
        
		$repeater = new Repeater();

        $repeater->add_control(
			'column-header',
			[
				'label' => 'Column Header',
				'type'  => Controls_Manager::TEXTAREA,
			]
        );
        
		$repeater->add_control(
			'column-image',
			[
			  'label'   => 'Column Image',
			  'type'    => Controls_Manager::MEDIA,
			//   'default' => [
			// 	'url' => Utils::get_placeholder_image_src(),
			//   ],
			]
        );
        
        $repeater->add_control(
			'column-footer',
			[
				'label' => 'Column Footer',
				'type'  => Controls_Manager::TEXTAREA,
			]
        );

		$this->add_control(
			'columns',
			[
				'label'  => 'Columns',
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
        
        $columns = $settings['columns'];
        $count_culumns = count($columns);

        $column_width = 100;
        if($count_culumns >1 ){
            $column_width = intval($column_width/$count_culumns);
        }

		$padding = '10px';
		if($settings['padding']){
			$padding = $settings['padding'];
		}

        $heading = $settings['heading'];
        
	?>
        <div class="multiple-column-layout <?= $settings['section-class'] ?>">
			<div class="content-inner">
				<div class="mcl-header"><?= $settings['section-header'] ?></div>
				<div class="mcl-content">
                <?php if($count_culumns): ?>
					<?php foreach ( $columns as $index => $item ) :?> 
						<div class="mcl-col" style="width: <?= $column_width?>%">
                            <div class="mcl-col-inner"> 
                                <?php if($item['column-header']): ?>
                                    <div class="mcl-col-header">
                                       <?= $item['column-header'] ?>
                                    </div>
                                <?php endif; ?>

                                <?php if($item['column-image']['url']): ?>
                                    <div class="mcl-col-image">
                                        <img src="<?= $item['column-image']['url'] ?>" alt="Image">
                                    </div>
                                <?php endif; ?>

                                <?php if($item['column-footer']): ?>
                                    <div class="mcl-col-footer">
                                        <?= $item['column-footer'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
						</div>

					<?php endforeach; ?>
                <?php endif; ?>
				</div>
                <div class="mcl-footer"><?= $settings['section-footer'] ?></div>
			</div>
		</div>
	<?php
	}
}
