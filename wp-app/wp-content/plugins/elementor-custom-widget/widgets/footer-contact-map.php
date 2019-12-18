<?php
namespace ElementorCustomWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Footer_Contact_Map extends Widget_Base {

	public function get_name() {
		return 'footer_contact_map';
	}

	public function get_title() {
		return 'Footer Contact Map';
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
			'content',
			[
				'label' => 'Content',
				'type' => Controls_Manager::WYSIWYG,
			]
		);


		$this->add_control(
			'google_map_key',
			[
				'label' => 'Google Map API key',
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'google_map_address',
			[
				'label' => 'Google Map API Address',
				'type' => Controls_Manager::TEXT,
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="footer-contact-map-widget">
			<!-- <div class="content-inner withPadding"> -->
			<div class="footer-contact-strap">
				<div class="col2">
					<div class="footer-contact-content">
						<div class="fc-title">
							<?= $settings['content'] ?>
						</div>
						<div class="fc-form">
							<?php //echo do_shortcode('[contact-form-7 id="52" title="Footer Contact"]'); ?>
							<!--[if lte IE 8]>
							<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
							<![endif]-->
							<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
							<script>
								hbspt.forms.create({
									portalId: "5113772",
									formId: "733f59b0-fb94-4a09-8abd-65988c2e0ac7"
								});
							</script>
						</div>
					</div>
				</div>
				<div class="col2 gm-block">
					<?php echo do_shortcode('[pw_map address="'.$settings['google_map_address'].'" width="100%" height="100%" disablecontrols="true" key="'.$settings['google_map_key'].'"]'); ?>
				</div>
			</div>
			<!-- </div> -->
		</div>
		<?php
	}
}
