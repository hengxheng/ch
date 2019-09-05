<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Team_Member_Block extends Widget_Base {

	public function get_name() {
		return 'team-member-block';
	}

	public function get_title() {
		return 'Team Member Block';
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
                'options' => $this->getTeamMemberForSelect()
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
	
		if(!empty($settings['team_members'])):
	?>
        <div class="team-member-strip">
			<div class="content-inner">
				<div class="tm-wrapper">
					<?php foreach ( $settings['team_members'] as $index => $item ) : ?>
						<?php 
							$member = get_post($item['team_member']); 
							$name = $member->post_title;
							$title = get_post_meta($item['team_member'], 'title');
						?>
						
						<?php if($item['full_width']): ?>
							<div class="tm-block-fullwidth">
								<div class="tmf-image">
									<img src="<?= $item['image']['url'] ?>" alt="Image">
								</div>
								<div class="tmf-content">
									<div class="tmf-name"><?= $name ?></div>
									<div class="tmf-title"><?= $title[0] ?></div>
									<div class="tmf-desc"><?= $item['description'] ?></div>
									<div class="tmf-cta">
										<a href="<?= get_post_permalink($member->ID) ?>" class="w-btn">VIEW PROFILE</a>
									</div>
								</div>
							</div>
						<?php else: ?>
							<div class="tm-block">
								<div class="tmf-image">
									<img src="<?= $item['image']['url'] ?>" alt="Image">
								</div>
								<div class="tmf-name"><?= $name ?></div>
								<div class="tmf-title"><?= $title[0] ?></div>
								<div class="tmf-cta">
									<a href="<?= get_post_permalink($member->ID) ?>" class="b-btn">VIEW PROFILE</a>
								</div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php
		endif;
    }
    

    //helper
    public function getTeamMemberForSelect( $args = null ) {
        $pages = get_posts(array(
			'post_type' => 'coach',
			'posts_per_page' => -1
		));
		$select_pages = [];
        foreach( $pages as $p ) {
			
            $select_posts[$p->ID] = ucfirst( $p->post_title );
        }
        return $select_posts;
    }
}
