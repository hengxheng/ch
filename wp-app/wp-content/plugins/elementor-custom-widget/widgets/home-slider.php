<?
namespace ElementorCustomWidget\Widgets;

defined( 'ABSPATH' ) or exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

class Home_Slider extends Widget_Base {
  public function get_name() {
    return 'home-slider';
  }

  public function get_title() {
    return 'Home Slider';
  }

  public function get_icon() {
    return 'fa fa-puzzle-piece';
  }

  public function get_categories() {
    return [ 'custom' ];
  }

  public function get_script_depends() {
		return [ 
            'elementor-custome-widget-slick',
            'elementor-custome-widget-js' 
          ];
  }
  
  protected function _register_controls() {
    $this->start_controls_section(
      'content_section',
      [
        'label' => 'Content',
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'image',
      [
        'label'   => 'Choose Image',
        'type'    => Controls_Manager::MEDIA,
        'default' => [
          'url' => Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $repeater->add_control(
      'content',
      [
        'label'      => 'Content',
        'type'       => Controls_Manager::WYSIWYG,
        'show_label' => false,
      ]
    );

    $repeater->add_control(
      'content-small',
      [
        'label'      => 'Content Small',
        'type'       => Controls_Manager::TEXT,
      ]
    );

    $repeater->add_control(
			'website_link',
			[
				'label' => 'Link',
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
			]
    );
    

    $this->add_control(
      'list',
      [
        'label'  => 'Slider',
        'type'   => Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
      ]
    );

    $this->end_controls_section();
  }

  protected function render() {
    $settings = $this->get_settings_for_display();
    // $uid      = uniqid( 'slider-' );

    if ( ! empty( $settings['list'] ) ) : ?>
      <div id="home-slider">
        <div class="content-inner">
          <div class="slider carousel">
            <?php foreach ( $settings['list'] as $index => $item ) : ?>
              <div class="slide carousel-item <?= 0 == $index ? 'active' : '' ?>">
                <div class="row no-gutters">               
                  <div class="embed-responsive" style="background: url('<?= $item['image']['url'] ?>') no-repeat center top;">
                    <?php if($item['content'] ): ?>
                      <div class="home-slider-content">
                        <div class="home-slider-content-inner">
                          <div class="hs-wrapper">
                            <div class="triangle-strip">
                              <div class="t1"></div>
                              <div class="t2"></div>
                              <div class="t3"></div>
                              <div class="t4"></div>
                            </div>
                            <div class="home-slide-text">
                              <?= wpautop( $item['content'] ) ?>
                              <?php if($item['website_link']): ?>
                                  <br/>
                                  <a href="<?= $item['website_link'] ?>" class="w-btn">LEARN MORE</a>
                              <?php endif; ?>
                            </div>
                          </div>
                          <?php if($item['content-small'] ): ?>
                            <div class="home-slide-small">
                              <?= $item['content-small'] ?>
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endif;
  }
}
