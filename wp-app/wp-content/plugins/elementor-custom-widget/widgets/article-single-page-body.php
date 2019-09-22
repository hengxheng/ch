<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Article_Single_Page_Body extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'article-single-page-body';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Article Single Page Body';
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-puzzle-piece';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'custom' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => 'Content',
			]
		);

		$this->add_control(
			'content',
			[
				'label' => 'Article Content',
				'type' => Controls_Manager::WYSIWYG,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$postId = get_the_ID();
		$categories = get_categories(['hide_empty' => false]);
		$postCategory = get_the_category();
		?>
		<div class="post-single-widget">
			<div class="content-inner withPadding">
			<div class="post-category-block">
				<ul id="post-category-nav">
					<li><a href="<?= get_site_url(null, '/articles' ); ?>">ALL POSTS</a></li>
					<?php foreach($categories as $cat): ?>
						<li <?= ($postCategory[0]->slug == $cat->slug)?'class="actived"': '' ?>>
							<a href="<?= get_site_url(null, '/articles' )."?type=".$cat->slug; ?>"><?= $cat->name; ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="post-single-body">
				<div class="content-inner withPadding">	
					<div class="post-single-inner">
						<div class="post-single-toolbar">
							<div class="tb-left">
								<a href="<?= get_site_url(null, '/articles' )."?type=".$postCategory[0]->slug; ?>"><i class="fa fa-arrow-left"></i> GO BACK</a>
							</div>
							<div class="tb-right">
							<?php				
								the_post_navigation(
									array(
										'next_text' => '<span class="meta-nav" aria-hidden="true">Next <i class="fa fa-arrow-right"></i></span>',
										'prev_text' => '<span class="meta-nav" aria-hidden="true">Previous <i class="fa fa-arrow-left"></i></span>',
									)
								);
							?>
							</div>
						</div>
						<div class="post-body text-wysiwyg">
							<?= $settings['content']; ?>
						</div>
						<div class="post-share">
							<a href="#" class="b-btn">SHARE</a>
							<ul class="post-social">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-linkedin"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest-p"></i></a>
								</li>
							</ul>
						</div>
					

					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}	
					?>
					</div>
				</div>
			</div>
			</div>
		</div>
		<?php
	}
}
