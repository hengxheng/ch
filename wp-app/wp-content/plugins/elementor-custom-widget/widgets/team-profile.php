<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Team_Profile extends Widget_Base {

	public function get_name() {
		return 'team-profile';
	}

	public function get_title() {
		return 'Team Profile';
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
            'full_width',
            [
              'label'        => 'Full Width',
              'type'         => Controls_Manager::SWITCHER,
              'label_on'     => 'ON',
              'label_off'    => 'OFF',
              'return_value' => 1,
              'default'      => 0,
            ]
          );


		$repeater->add_control(
			'image',
			[
			  'label'   => 'Profile Image',
			  'type'    => Controls_Manager::MEDIA,
			  'default' => [
				'url' => Utils::get_placeholder_image_src(),
			  ],
			]
        );
        
        $repeater->add_control(
			'name',
			[
				'label' => 'Name',
				'type' => Controls_Manager::TEXT,
			]
        );

        $repeater->add_control(
			'title',
			[
				'label' => 'Title',
				'type' => Controls_Manager::TEXT,
			]
        );
        
        $repeater->add_control(
			'description',
			[
				'label' => 'Description',
				'type' => Controls_Manager::TEXTAREA,
			]
        );

        $repeater->add_control(
            'team_member',
            [
                'label' => 'Select a team member',
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => $this->getPostsForSelect()
            ]
        );

		$this->add_control(
			'team_members',
			[
				'label'  => 'Team Members',
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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
    

    //helper
    public function getPostsForSelect( $args = null ) {
        $posts = get_posts();
        $select_posts = [];
        foreach( $posts as $post ) {
            $select_posts[$post->ID] = ucfirst( $post->post_title );
        }
        return $select_posts;
    }
}
