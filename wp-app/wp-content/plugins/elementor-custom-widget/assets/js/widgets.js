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

	var WidgetGalleryHanlder = function( $scope, $ ) {
		$(document).ready(function($) {
			$('body').on('click','.gallery-item>img', function(e){
				var w = $(this).parents('.gallery-item').find('.gellery-content-wrapper');
				if(!w.hasClass('show')){
					w.addClass('show');
				}
			});

			$('body').on('click', '.gellery-content-wrapper', function(e){
				$(this).removeClass('show');
			});
		});
	};

	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/home-slider.default', WidgetSliderHanlder );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/testimonial-slider.default', WidgetTestimonialSliderHanlder );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/team-gallery.default', WidgetGalleryHanlder );
	} );
} )( jQuery );
