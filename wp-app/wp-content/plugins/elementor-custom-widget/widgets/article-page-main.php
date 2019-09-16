<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Article_Page_Main extends Widget_Base {

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
		return 'article-page-main';
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
		return 'Article Page Main';
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
            'perPage',
            [
                'label' => 'How many articles per page',
                'type' => Controls_Manager::SELECT,
                'default' => 6,
                'options' => [
					6 => 6,
					9 => 9,
					12 => 12
				]
			]
		);


		$this->end_controls_section();

		//style tab
		$this->start_controls_section(
			'section_style',
			[
				'label' => 'Style',
				'tab' => Controls_Manager::TAB_STYLE,
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
		global $wp;
		$settings = $this->get_settings_for_display();

		$articleType = $_GET['type'] ? $_GET['type'] : '';
		$paged = $_GET['paged'] ? $_GET['paged'] : 0;
		$perPage = $settings['perPage'];
		$categories = get_categories(['hide_empty' => false]);
		$offset = $paged*$perPage;

		$args = array(
			'posts_per_page' => $perPage,
			'offset' => $offset,
			'category_name' => $articleType,
			'orderby' => 'date',
			'order' => 'DESC',
			'post_type' => 'post',
			'post_status' => 'publish'
		);

		$posts_array = get_posts( $args ); 
		$post_count = count($posts_array);
		?>
		<div class="post-list-widget">
			<div class="content-inner withPadding">
			<div class="post-category-block">
				<ul id="post-category-nav">
					<li <?= ($articleType)?'':'class="actived"' ?>><a href="<?= home_url( $wp->request ); ?>">ALL POSTS</a></li>
					<?php foreach($categories as $cat): ?>
						<li <?= ($articleType == $cat->slug)?'class="actived"': '' ?>><a href="<?= home_url( $wp->request )."?type=".$cat->slug; ?>"><?= $cat->name; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="post-list-block">
				<div class="post-list-tools">
					<?php if($post_count>0): 
						$totalPage = ceil($post_count/$perPage)-1; 
						if($articleType){
							$type_query = 'type='.$articleType.'&';
						}
						else{
							$type_query = '';
						}

						
						if($paged == 0){
							$prev = 0;
						}	
						else{
							$prev = $paged-1;
						}

						if($paged == $totalPage){
							$next = $totalPage;
						}
						else{
							$next = $paged+1;
						}
					?>
					<div class="post-pagination">					
						<ul>
							<li><a href="<?= home_url( $wp->request ).'?'.$type_query.'paged='.$prev; ?>"><i class="fa fa-arrow-left"></i></a></li>
							<?php for($i=0;$i<=$totalPage;$i++): ?>
								<li><a href="<?= home_url( $wp->request ).'?'.$type_query.'paged='.$i; ?>" <?= ($i==$paged)?'class="actived"':'' ?>><?= $i+1 ?></a></li>
							<?php endfor; ?>
							<li><a href="<?= home_url( $wp->request ).'?'.$type_query.'paged='.$next; ?>"><i class="fa fa-arrow-right"></i></a></li>
						</ul>	
					</div>
					<?php endif; ?>
				</div>
				<div class="post-list-body">
					<?php if($post_count>0):  ?>
						<?php 
							$featured = false;
							foreach ($posts_array as $p){
								if(get_field('fetured', $p->ID)){
									$featured = $p;
									break;
								}
							} 
						?>
						
						<?php if($featured): ?>
							<div class="post-featured">
								<div class="item-img">
									<img src="<?= get_the_post_thumbnail_url($featured->ID) ?>" alt="">
								</div>
								<div class="item-content">
									<div class="featured-label">Featured</div>
									<h3 class="post-title">
										<?= $featured->post_title; ?>
									</h3>
									<h4 class="post-subtitle">
										<?= get_field('sub_title', $featured->ID) ?>
									</h4>
									<div class="post-excerpt">
										<?= wp_trim_words($featured->post_excerpt, 100) ?>
									</div>
									<div class="post-cta">
										<a href="<?= get_permalink($featured->ID) ?>" class="w-btn">READ ARTICLE</a>
										<a href="#"><i class="fa fa-share-alt"></i> SHARE</a>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<div class="post-list">			
							<?php foreach ($posts_array as $p): ?>
							<div class="post-item">
								<div class="item-img">
									<img src="<?= get_the_post_thumbnail_url($p->ID) ?>" alt="">
								</div>
								<div class="item-content">
									<h3 class="post-title">
										<?= $p->post_title; ?>
									</h3>
									<h4 class="post-subtitle">
										<?= get_field('sub_title', $p->ID) ?>
									</h4>
									<div class="post-excerpt">
										<?= wp_trim_words($p->post_excerpt, 100) ?>
									</div>
									<div class="post-cta">
										<a href="<?= get_permalink($p->ID) ?>" class="b-btn">READ ARTICLE</a>
										<a href="#"><i class="fa fa-share-alt"></i> SHARE</a>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					<?php else: ?>
						<p class="no-article">No article found</p>
					<?php endif; ?>
				</div>
				<div class="post-list-tools">
					<?php if($post_count>0): 
						$totalPage = ceil($post_count/$perPage)-1; 
						if($articleType){
							$type_query = 'type='.$articleType.'&';
						}
						else{
							$type_query = '';
						}

						
						if($paged == 0){
							$prev = 0;
						}	
						else{
							$prev = $paged-1;
						}

						if($paged == $totalPage){
							$next = $totalPage;
						}
						else{
							$next = $paged+1;
						}
					?>
					<div class="post-pagination">					
						<ul>
							<li><a href="<?= home_url( $wp->request ).'?'.$type_query.'paged='.$prev; ?>"><i class="fa fa-arrow-left"></i></a></li>
							<?php for($i=0;$i<=$totalPage;$i++): ?>
								<li><a href="<?= home_url( $wp->request ).'?'.$type_query.'paged='.$i; ?>" <?= ($i==$paged)?'class="actived"':'' ?>><?= $i+1 ?></a></li>
							<?php endfor; ?>
							<li><a href="<?= home_url( $wp->request ).'?'.$type_query.'paged='.$next; ?>"><i class="fa fa-arrow-right"></i></a></li>
						</ul>	
					</div>
					<?php endif; ?>
				</div>
			</div>
			</div>
		</div>
		<?php
	}
}
