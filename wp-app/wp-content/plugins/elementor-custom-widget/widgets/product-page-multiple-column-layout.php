<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Product_Page_Multiple_Column_Layout extends Widget_Base {

	public function get_name() {
		return 'product-page-multiple-column-layout';
	}

	public function get_title() {
		return 'Product Page Multiple Column Layout';
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
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => 'Yes',
				'label_off'    => 'No',
				'return_value' => 1,
				'default'      => 1,
			]
		);
        
		$this->add_control(
			'section-header',
			[
				'label' => 'Section Header',
				'type'  => Controls_Manager::WYSIWYG,
			]
		);

		$this->add_control(
			'section-footer',
			[
				'label' => 'Section Footer',
				'type'  => Controls_Manager::WYSIWYG,
			]
		);

		$this->add_control(
            'show_add_to_cart_btn',
            [
              'label'        => 'Bug now button',
              'type'         => Controls_Manager::SWITCHER,
              'label_on'     => 'ON',
              'label_off'    => 'OFF',
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
			  'default' => [
				'url' => Utils::get_placeholder_image_src(),
			  ],
			]
		);
		
		$repeater->add_control(
			'column-text',
			[
				'label' => 'Column Text',
				'type'  => Controls_Manager::WYSIWYG,
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
	}

	protected function render() {
		global $product;
		$product_id = $product->get_id();

		$settings = $this->get_settings_for_display();
        
        $columns = $settings['columns'];
        $count_culumns = count($columns);

        $column_width = 100;
        if($count_culumns >1 ){
            $column_width = intval($column_width/$count_culumns);
        }

        $heading = $settings['heading'];
        
	?>
        <div class="product-page-multiple-column-layout-widget <?= $settings['section-class'] ?>">
			<div class="product-page-multiple-column-layout <?= !$settings['full-width']?'content-inner':'' ?>">
				<div class="mcl-header text-wysiwyg">
					<?= $settings['section-header'] ?>
				</div>
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

								<?php if($item['column-text']): ?>
                                    <div class="mcl-col-text text-wysiwyg">
                                       <?= $item['column-text'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
						</div>
					<?php endforeach; ?>
                <?php endif; ?>
				</div>
				<?php if($settings['section-footer']): ?>
					<div class="mcl-footer text-wysiwyg">
						<?= $settings['section-footer'] ?>
					</div>
				<?php endif;?>
				<?php if($settings['show_add_to_cart_btn']): ?>
					<div class="mcl-footer text-wysiwyg">
						<a href="<?= do_shortcode('[add_to_cart_url id="'.$product_id.'"]'); ?>" data-quantity="1" data-product_id="<?= $product_id ?>" class="add-to-cart-btn b-btn">BUY NOW</a>	
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php
	}
}
