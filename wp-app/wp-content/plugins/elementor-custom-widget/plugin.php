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
		wp_register_script( 'elementor-custome-widget-lity', plugins_url( '/assets/js/lity-2.4.0/dist/lity.min.js', __FILE__ ), [ 'jquery' ], false, true );
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
		
		$widgets = [
			'page-header',
			'html-content',
			'multiple-column-layout',
			'side-menu',
			'right-text',
			'left-text',
			'text-with-image-bg',
			'partner-list',
			'home-banner',
			'left-right-fullwidth',
			'home-slider',
			'testimonial-slider',
			'story-line',			
			'team-member-block',
			'team-first',
			'team-second',
			'team-gallery',
			'related-team-members',
			'enroll-strip',				
			'contact-page-main',
			'article-page-main',
			'article-single-page-body',
			'education-banner',
			'get-qualified-strip',
			'video-list',
			'google-map',
			'calendar-strip',
			'footer-contact-map',
			'footer-subscription',
			'footer-contact',
			'footer-video',
			'woo-products',
			'woo-bundle',
			//product page widget
			'product-page-header',
			'product-page-gallery',
			'product-page-cta',
			'product-page-multiple-column-layout',
			'product-page-banner',
        ];

        foreach ( $widgets as $widget ) {
            require( __DIR__ . '/widgets/' . $widget . '.php' );

            $class_name = str_replace(' ', '_', ucwords(str_replace( '-', ' ', $widget )));
            $class_name = __NAMESPACE__.'\Widgets\\' . $class_name;
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class_name() );
		}
	}

	function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'custom',
			[
				'title' => __( 'Clean Health', 'plugin-name' ),
				'icon' => 'fa fa-plug',
			]
		);

		$elements_manager->add_category(
			'product_page',
			[
				'title' => __( 'Product Page', 'plugin-name' ),
				'icon' => 'fa fa-plug',
			]
		);
	}
	
	public function includes() {
        require( __DIR__ . '/inc/functions.php' );
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

		$this->includes();

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// custom widget category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

		add_shortcode( 'pw_map', 'pw_map_shortcode' );
	}
}

// Instantiate Plugin Class
Plugin::instance();
