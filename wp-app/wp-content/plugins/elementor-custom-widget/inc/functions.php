<?php
/**
 * Helper functions
 *
 * @package Elementwoo
 */

if ( ! function_exists( 'elementwoo_do_shortcode' ) ) {
    /**
     * Call a shortcode function by tag name.
     *
     * @since  1.0.0
     *
     * @param string $tag     The shortcode whose function to call.
     * @param array  $atts    The attributes to pass to the shortcode function. Optional.
     * @param array  $content The shortcode's content. Default is null (none).
     *
     * @return string|bool False on failure, the result of the shortcode on success.
     */
    function elementwoo_do_shortcode( $tag, array $atts = array(), $content = null ) {
        global $shortcode_tags;
        if ( ! isset( $shortcode_tags[ $tag ] ) ) {
            return false;
        }
        return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
    }
}

if ( ! function_exists( 'elementwoo_bool_from_yn' ) ) {
    function elementwoo_bool_from_yn( $yn ) {
        $yn = strtolower( trim( $yn ) );
        return ( $yn === 'yes' || $yn === 'y' || $yn === 'true' );
    }
}

if ( ! function_exists( 'elementwoo_comma_val_from_array' ) ) {
    function elementwoo_comma_val_from_array( $arr ) {
        return ( ! empty( $arr ) ? implode( ',', $arr ) : '' );
    }
}

if ( ! function_exists( 'elementwoo_get_product_terms' ) ) {
    function elementwoo_get_product_terms($taxonomy = 'product_cat') {
        $args = [
            'taxonomy' => $taxonomy,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false, //can be 1, '1' too
            'fields' => 'all',
        ];
        $terms = get_terms($args);

        if (!empty($terms) && !is_wp_error($terms)) {
            return wp_list_pluck($terms, 'name', 'slug');
        }
        return [];
    }
}

if ( ! function_exists( 'elementwoo_get_product_categories' ) ) {
    function elementwoo_get_product_categories() {
        return elementwoo_get_product_terms('product_cat');
    }
}

if ( ! function_exists( 'elementwoo_get_product_tags' ) ) {
    function elementwoo_get_product_tags() {
        return elementwoo_get_product_terms('product_tag');
    }
}

function pw_map_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'address'           => false,
			'width'             => '100%',
			'height'            => '400px',
			'enablescrollwheel' => 'true',
			'zoom'              => 15,
			'disablecontrols'   => 'false',
			'key'               => ''
		),
		$atts
    );
   

	$address = $atts['address'];

	if( $address):
		$coordinates = pw_map_get_coordinates( $address, false, sanitize_text_field( $atts['key'] ) );
		if( ! is_array( $coordinates ) ) {			
			return;
		}
    
    wp_enqueue_script( 'google-maps-api', '//maps.google.com/maps/api/js?key=' . sanitize_text_field( $atts['key'] ) );
		wp_print_scripts( 'google-maps-api' );

		$map_id = uniqid( 'pw_map_' ); // generate a unique ID for this map

		ob_start(); ?>
		<div class="pw_map_canvas" id="<?php echo esc_attr( $map_id ); ?>" style="height: <?php echo esc_attr( $atts['height'] ); ?>; width: <?php echo esc_attr( $atts['width'] ); ?>"></div>
		<script type="text/javascript">
			var map_<?php echo $map_id; ?>;
            var mapStyle = [
                {
                    "featureType": "administrative",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": "-100"
                        }
                    ]
                },
                {
                    "featureType": "administrative.province",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 65
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": "50"
                        },
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": "-100"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "all",
                    "stylers": [
                        {
                            "lightness": "30"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "all",
                    "stylers": [
                        {
                            "lightness": "40"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "hue": "#ffff00"
                        },
                        {
                            "lightness": -25
                        },
                        {
                            "saturation": -97
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels",
                    "stylers": [
                        {
                            "lightness": -25
                        },
                        {
                            "saturation": -100
                        }
                    ]
                }
            ];

			function pw_run_map_<?php echo $map_id ; ?>(){
				var location = new google.maps.LatLng("<?php echo $coordinates['lat']; ?>", "<?php echo $coordinates['lng']; ?>");
				var map_options = {
					zoom: <?php echo $atts['zoom']; ?>,
					center: location,
                    styles: mapStyle,
					scrollwheel: <?php echo 'true' === strtolower( $atts['enablescrollwheel'] ) ? '1' : '0'; ?>,
					disableDefaultUI: <?php echo 'true' === strtolower( $atts['disablecontrols'] ) ? '1' : '0'; ?>,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				map_<?php echo $map_id ; ?> = new google.maps.Map(document.getElementById("<?php echo $map_id ; ?>"), map_options);
				var marker = new google.maps.Marker({
				position: location,
				map: map_<?php echo $map_id ; ?>
				});
			}
			pw_run_map_<?php echo $map_id ; ?>();
		</script>
		<?php
		return ob_get_clean();
	else :
		return __( 'This Google Map cannot be loaded because the maps API does not appear to be loaded', 'simple-google-maps-short-code' );
	endif;
}

function pw_map_get_coordinates( $address, $force_refresh = false, $api_key = '' ) {

	$address_hash = md5( $address );

	$coordinates = get_transient( $address_hash );

	if ( $force_refresh || $coordinates === false ) {

		$args       = apply_filters( 'pw_map_query_args', array( 'key' => $api_key, 'address' => urlencode( $address ), 'key' => $api_key ) );
		$url        = add_query_arg( $args, 'https://maps.googleapis.com/maps/api/geocode/json' );
		$response 	= wp_remote_get( $url );

		if( is_wp_error( $response ) ) {
			return;
		}

		$data = wp_remote_retrieve_body( $response );

		if( is_wp_error( $data ) ) {
			return;
		}

		if ( $response['response']['code'] == 200 ) {

			$data = json_decode( $data );

			if ( $data->status === 'OK' ) {

				$coordinates = $data->results[0]->geometry->location;

				$cache_value['lat'] 	= $coordinates->lat;
				$cache_value['lng'] 	= $coordinates->lng;
				$cache_value['address'] = (string) $data->results[0]->formatted_address;

				// cache coordinates for 3 months
				set_transient($address_hash, $cache_value, 3600*24*30*3);
				$data = $cache_value;

			} elseif ( $data->status === 'ZERO_RESULTS' ) {
				return __( 'No location found for the entered address.', 'simple-google-maps-short-code' );
			} elseif( $data->status === 'INVALID_REQUEST' ) {
				return __( 'Invalid request. Did you enter an address?', 'simple-google-maps-short-code' );
			} else {
				return __( 'Something went wrong while retrieving your map, please ensure you have entered the short code correctly.', 'simple-google-maps-short-code' );
			}

		} else {
			return __( 'Unable to contact Google API service.', 'simple-google-maps-short-code' );
		}

	} else {
	   // return cached results
	   $data = $coordinates;
	}

	return $data;
}