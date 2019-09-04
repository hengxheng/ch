<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Side_Menu extends Widget_Base {

	public function get_name() {
		return 'side_menu';
	}

	public function get_title() {
		return 'Side Menu';
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

		$repeater = new Repeater();

		$repeater->add_control(
			'menu-item',
			[
			  'label'   => 'Menu Item',
			  'type'    => Controls_Manager::TEXT,
			]
		);

		
		$repeater->add_control(
            'menu-link',
            [
                'label' => 'Page',
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => $this->getPageForSelect()
            ]
		);

		$repeater->add_control(
            'highlight',
            [
              'label'        => 'Highlight',
              'type'         => Controls_Manager::SWITCHER,
              'label_on'     => 'ON',
              'label_off'    => 'OFF',
              'return_value' => 1,
              'default'      => 0,
            ]
		);
		
		$this->add_control(
			'menu-list',
			[
				'label'  => 'Menu List',
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();
	}

	//helper
    public function getPageForSelect( $args = null ) {
        $pages = get_posts(array(
			'post_type' => 'page',
			'posts_per_page' => -1
		));
		$select_pages = [];
        foreach( $pages as $p ) {
			
            $select_posts[$p->ID] = ucfirst( $p->post_title );
        }
        return $select_posts;
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="side-menu-widget">
			<div class="side-menu-inner">
				<div class="sidemenu-title">
					<?= $settings['title'] ?>
				</div>
				<div class="sidemnu-content">
					<ul>
						<?php foreach($settings['menu-list'] as $item):?>
							<li <?= $item['highlight']?'class="actived"':'' ?>>
								<a href="<?= get_post_permalink($item['menu-link']); ?>"><?= $item['menu-item'] ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		<?php
	}
}
