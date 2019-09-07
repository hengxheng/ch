<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Related_Team_Members extends Widget_Base {

	public function get_name() {
		return 'related_team_members';
	}

	public function get_title() {
		return 'Related Team Members';
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
			'section-class',
			[
				'label' => 'Section Class',
				'type'  => Controls_Manager::TEXT,
				'description' => 'For special styling, do not change it'
			]
		);

		$this->add_control(
			'content',
			[
				'label' => 'Content',
				'type' => Controls_Manager::WYSIWYG,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
		'image',
			[
				'label'   => 'Photo',
				'type'    => Controls_Manager::MEDIA,
				'default' => [
				'url' => Utils::get_placeholder_image_src(),
				],
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
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'content', 'advanced' );
		?>
		<div class="team-related-widget">
			<div class="content-inner withPadding">
				<div class="team-related-top text-wysiwyg">
					<?= $settings['content'] ?>
				</div>
				<div class="team-related-strap">
					<?php foreach ( $settings['team_members'] as $index => $item ) : ?>
						<?php 
							$member = get_post($item['team_member']); 
							$name = $member->post_title;
							$title = get_post_meta($item['team_member'], 'title');
						?>
						<a href="<?= get_post_permalink($member->ID) ?>" class="tm-block">
							<div class="tm-image">
								<img src="<?= $item['image']['url'] ?>" alt="Image">
							</div>
							<div class="tm-content">
								<div class="tm-name"><?= $name ?></div>
								<div class="tm-title"><?= $title[0] ?></div>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php
	}
}
