<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Product_Page_Gallery extends Widget_Base {

	public function get_name() {
		return 'product-page-gallery';
	}

	public function get_title() {
		return 'Product Page Gallery';
	}

	public function get_icon() {
		return 'fa fa-puzzle-piece';
	}

	public function get_categories() {
		return [ 'product_page' ];
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
			'full-width',
			[
				'label'        => 'Full Width',
				'description'  => 'Content width is narrow',
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => 'Yes',
				'label_off'    => 'No',
				'return_value' => 1,
				'default'      => 1,
			]
		);

        
		$repeater = new Repeater();
        
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
        <div class="product-page-gallery-widget <?= $settings['section-class'] ?>">
			<div class="product-page-gallery  <?= !$settings['full-width']?'content-inner':'' ?>">
				<div class="mcl-content">
                <?php if($count_culumns): ?>
						<?php foreach ( $columns as $index => $item ) :?> 
							<div class="mcl-col" style="width: <?= $column_width?>%">
								<div class="mcl-col-inner"> 
									<?php if($item['column-image']['url']): ?>
										<div class="mcl-col-image">
											<img src="<?= $item['column-image']['url'] ?>" alt="Image">
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
                <?php endif; ?>
				</div>
			</div>
		</div>
	<?php
	}
}
