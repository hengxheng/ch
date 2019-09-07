<?
namespace ElementorCustomWidget\Widgets;

defined( 'ABSPATH' ) or exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

class Testimonial_Slider extends Widget_Base {
  public function get_name() {
    return 'testimonial-slider';
  }

  public function get_title() {
    return 'Testimonial Slider';
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
        'label'   => 'Photo',
        'type'    => Controls_Manager::MEDIA,
        'default' => [
          'url' => Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $repeater->add_control(
      'ContentName',
      [
        'label'      => 'Customer Name',
        'type'       => Controls_Manager::TEXT,
      ]
    );

    $repeater->add_control(
      'ContentTitle',
      [
        'label'      => 'Customer Title',
        'type'       => Controls_Manager::TEXTAREA,
      ]
    );

    $repeater->add_control(
      'ContentWords',
      [
        'label'      => 'Customer Words',
        'type'       => Controls_Manager::WYSIWYG,
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

    if ( ! empty( $settings['list'] ) ) : ?>
      <div id="testimonial-slider">
        <div class="content-inner withPadding">
          <div class="slider carousel">
            <?php foreach ( $settings['list'] as $index => $item ) : ?>
              <div class="slide carousel-item <?= 0 == $index ? 'active' : '' ?>">
                <div class="row no-gutters">               
                  <div class="t-slider-content">
                    <div class="t-slider-content-inner">
                      <div class="t-slider-image">
                        <img src="<?= $item['image']['url'] ?>" alt="<?= $item['ContentName'] ?>">
                      </div>
                      <div class="t-slider-text">
                        <?php if($item['ContentName'] ): ?>
                          <div class="ts-name">
                            <?= $item['ContentName'] ?>
                          </div>
                        <?php endif; ?>
                        <?php if($item['ContentTitle'] ): ?>
                          <div class="ts-title">
                            <?= $item['ContentTitle'] ?>
                          </div>
                        <?php endif; ?>
                        <?php if($item['ContentWords'] ): ?>
                          <div class="ts-words">
                            <div class="ts-quote">"</div>
                            <?= $item['ContentWords'] ?>
                            <div class="ts-quote">"</div>
                          </div>
                        <?php endif; ?>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="ts-bottom">
            <a href="#">SEE WHAT INDUSTRY PROFESSIONALS ARE SAYING ABOUT US</a>
          </div>
        </div>
      </div>
    <?php endif;
  }
}
