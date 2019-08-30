<?php
namespace ElementorCustomWidget;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'elementor-custome-widget-js', plugins_url( '/assets/js/widgets.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'elementor-custome-widget-slick', plugins_url( '/assets/js/slick-1.8.1/slick/slick.min.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/partner-list.php' );
		require_once( __DIR__ . '/widgets/inline-editing.php' );
		require_once( __DIR__ . '/widgets/slider.php' );
		require_once( __DIR__ . '/widgets/multiple-column-layout.php' );
		require_once( __DIR__ . '/widgets/story-line.php' );
		require_once( __DIR__ . '/widgets/team-profile.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Partner_List() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Inline_Editing() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Custom_El_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Multiple_Column_Layout() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Story_Line() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Profile() );
	}

	function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'custom',
			[
				'title' => __( 'Clean Health', 'plugin-name' ),
				'icon' => 'fa fa-plug',
			]
		);
	}
	

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// custom widget category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();
