( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	var WidgetHelloWorldHandler = function( $scope, $ ) {
		console.log('partner-list');
		console.log( $scope );
	};

	var WidgetSliderHanlder = function( $scope, $ ) {
		console.log('this is from slider');
		console.log( $scope );
	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/partner-list.default', WidgetHelloWorldHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/slider.default', WidgetSliderHanlder );
		// elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', WidgetSliderHanlder );
	} );
} )( jQuery );
