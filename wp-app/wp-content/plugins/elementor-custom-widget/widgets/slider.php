<?
namespace ElementorCustomWidget\Widgets;

defined( 'ABSPATH' ) or exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

class Custom_El_Slider extends Widget_Base {
  public function get_name() {
    return 'Custom Slider';
  }

  public function get_title() {
    return 'Slider';
  }

  public function get_icon() {
    return 'fa fa-puzzle-piece';
  }

  public function get_categories() {
    return [ 'custom' ];
  }

  protected function _register_controls() {
    $this->start_controls_section(
      'content_section',
      [
        'label' => 'Content',
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'use_image',
      [
        'label'        => __( 'Use Image <img> tag', 'plugin-domain' ),
        'description'  => 'Set to No if you have different image sizes',
        'type'         => Controls_Manager::SWITCHER,
        'label_on'     => __( 'Yes', 'your-plugin' ),
        'label_off'    => __( 'No', 'your-plugin' ),
        'return_value' => 'yes',
        'default'      => 'yes',
      ]
    );

    $repeater = new Repeater();

    $repeater->add_control(
      'image',
      [
        'label'   => __( 'Choose Image', 'kawai' ),
        'type'    => Controls_Manager::MEDIA,
        'default' => [
          'url' => Utils::get_placeholder_image_src(),
        ],
      ]
    );

    $repeater->add_control(
      'content',
      [
        'label'      => __( 'Content', 'kawai' ),
        'type'       => Controls_Manager::WYSIWYG,
        'show_label' => false,
      ]
    );

    $this->add_control(
      'list',
      [
        'label'  => __( 'Repeater List', 'kawai' ),
        'type'   => Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
      ]
    );

    $this->end_controls_section();
  }

  protected function render() {
    $settings = $this->get_settings_for_display();
    $uid      = uniqid( 'slider-' );

    if ( ! empty( $settings['list'] ) ) : ?>
      <div class="section-slider">
        <div id="<?= $uid ?>">
          <div class="slider <?= empty( $settings['list'][0]['content'] ) ? 'bg-white' : 'bg-black white' ?> carousel">
            <? foreach ( $settings['list'] as $index => $item ) : ?>
              <div class="slide carousel-item <?= 0 == $index ? 'active' : '' ?>">
                <div class="row no-gutters align-items-center">
                  <div class="col-lg-<?= empty( $item['content'] ) ? '12' : '6' ?>">
                    <? if ( 'yes' == $settings['use_image'] ) : ?>
                      <img src="<?= $item['image']['url'] ?>" alt="Image">
                    <? else: ?>
                      <div class="embed-responsive <?= ! empty( $item['content'] ) ? 'embed-responsive-1by1' : 'embed-responsive-16by9' ?>">
                        <div class="embed-responsive-item bg-center" style="background-image:url('<?= $item['image']['url'] ?>');"></div>
                      </div>
                    <? endif; ?>
                  </div>

                  <? if ( ! empty( $item['content'] ) ) : ?>
                    <div class="col-lg-6">
                      <div class="px-3 px-xl-5 py-4">
                        <?= wpautop( $item['content'] ) ?>
                      </div>
                    </div>
                  <? endif; ?>
                </div>
              </div>
            <? endforeach; ?>
          </div>

          <div class="nav py-2 justify-content-end align-items-center <?= count( $settings['list'] ) > 1 ? 'd-flex' : 'd-none' ?>">
            <a href="#" class="arrow left"><img src="<? the_assets_path( 'images/arrow-left.svg' ) ?>" alt="Left" class="img-fluid" width="25"></a>

            <div class="slide-number px-3"><span class="current-slide">1</span>/<?= count( $settings['list'] ) ?></div>

            <a href="#" class="arrow right"><img src="<? the_assets_path( 'images/arrow-right.svg' ) ?>" alt="Right" class="img-fluid" width="25"></a>
          </div>
        </div>

        <script>
          jQuery(document).ready(function($) {
            var sliderWrapper = $('#<?=$uid?>');
            var slider = sliderWrapper.find('.slider');
            slider.slick({
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: false,
              arrows: true,
              adaptiveHeight: true,
              prevArrow: sliderWrapper.find('.arrow.left'),
              nextArrow: sliderWrapper.find('.arrow.right'),
              responsive: [
                {
                  breakpoint: 576,
                  settings: {}
                }
              ]
            });

            slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
              sliderWrapper.find('.current-slide').text(nextSlide + 1);
            });
          });
        </script>
      </div>
    <? endif;
  }
}
