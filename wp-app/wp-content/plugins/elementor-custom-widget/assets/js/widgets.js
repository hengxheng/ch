( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 

	var WidgetSliderHanlder = function( $scope, $ ) {
		// console.log( $scope );
		$(document).ready(function($) {
			var sliderWrapper = $('#home-slider');
			var slider = sliderWrapper.find('.slider');
			slider.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: true,
				arrows: false,
				adaptiveHeight: true,
				responsive: [
				{
					breakpoint: 576,
					settings: {}
				}
				]
			});

			// slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
			// 	sliderWrapper.find('.current-slide').text(nextSlide + 1);
			// });
		});
	};

	var WidgetTestimonialSliderHanlder = function( $scope, $ ) {
		// console.log( $scope );
		$(document).ready(function($) {
			var sliderWrapper = $('#testimonial-slider');
			var slider = sliderWrapper.find('.slider');
			slider.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: true,
				arrows: false,
				adaptiveHeight: true,
				responsive: [
				{
					breakpoint: 576,
					settings: {}
				}
				]
			});
		});
	};

	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/home-slider.default', WidgetSliderHanlder );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/testimonial-slider.default', WidgetTestimonialSliderHanlder );
	} );
} )( jQuery );
