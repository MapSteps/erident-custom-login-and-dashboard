<?php
/** Custom Login Dashboard's helper functions.
 *
 * @package Custom_Login_Dashboard
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Convert hex to rgb.
 *
 * @param string $color Hex color.
 * @return array The r,g,b array.
 */
function custom_login_dashboard_hex2rgb( $color ) {

	if ( '#' === $color[0] ) {
		$color = substr( $color, 1 );
	}

	if ( 6 === strlen( $color ) ) {
		list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( 3 === strlen( $color ) ) {
		list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return [];
	}

	$r = hexdec( $r );
	$g = hexdec( $g );
	$b = hexdec( $b );

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);

}
