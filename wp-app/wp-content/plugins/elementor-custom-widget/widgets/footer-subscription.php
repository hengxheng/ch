<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Footer_Subscription extends Widget_Base {

	public function get_name() {
		return 'footer_subscription';
	}

	public function get_title() {
		return 'Footer Subscription';
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
            'image1',
            [
              'label'   => 'Background Image 1',
              'type'    => Controls_Manager::MEDIA,
              'default' => [
                'url' => Utils::get_placeholder_image_src(),
              ],
            ]
		);
		
		$this->add_control(
            'image2',
            [
              'label'   => 'Background Image 2',
              'type'    => Controls_Manager::MEDIA,
              'default' => [
                'url' => Utils::get_placeholder_image_src(),
              ],
            ]
        );

		$this->add_control(
			'content',
			[
				'label' => 'Content',
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
		$this->add_inline_editing_attributes( 'content', 'advanced' );
		?>
		<div class="footer-subscription-widget">
			<div class="footer-subscription-wrapper">
				<div class="content-inner">
				<div class="fs-inner" style="background:url(<?= $settings['image2']['url'] ?>) no-repeat center center; background-size: cover;">
					<div class="fs-image">
						<img src="<?= $settings['image1']['url'] ?>" alt="img"/>	
					</div>
					<div class="fs-content">
						<div class="fs-content-inner">
							<div class="text-wysiwyg">
								<?= wpautop( $settings['content'] ) ?>
							</div>
							<div class="subcription-form">
								<form action="">
									<div class="form-row">
										<label for="">Email</label>
										<input type="text" name='sub-email'/>
									</div>
									<div class="form-row">
										<input type="submit" class="w-btn" value="SIGN UP NOW">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
		<?php
	}
}
