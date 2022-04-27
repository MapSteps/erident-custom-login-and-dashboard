<?php
/** Custom Login Dashboard's helper functions.
 *
 * @package Custom_Login_Dashboard
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Get available fields.
 */
function cldashboard_get_available_fields() {

	return [
		'dashboard_data_left'         => 'string',
		'dashboard_data_right'        => 'string',
		'dashboard_image_logo'        => 'string',
		'dashboard_image_logo_width'  => 'int',
		'dashboard_image_logo_height' => 'int',
		'dashboard_power_text'        => 'string',
		'dashboard_login_width'       => 'int',
		'dashboard_login_radius'      => 'int',
		'dashboard_login_border'      => 'string',
		'dashboard_border_thick'      => 'int',
		'dashboard_border_color'      => 'string',
		'dashboard_login_bg'          => 'string',
		'dashboard_login_bg_opacity'  => 'float',
		'dashboard_text_color'        => 'string',
		'dashboard_input_text_color'  => 'string',
		'dashboard_label_text_size'   => 'int',
		'dashboard_input_text_size'   => 'int',
		'dashboard_link_color'        => 'string',
		'dashboard_check_shadow'      => 'bool',
		'dashboard_link_shadow'       => 'string',
		'dashboard_check_form_shadow' => 'bool',
		'dashboard_check_lost_pass'   => 'bool',
		'dashboard_check_backtoblog'  => 'bool',
		'dashboard_form_shadow'       => 'string',
		'dashboard_button_color'      => 'string',
		'dashboard_button_text_color' => 'string',
		'top_bg_color'                => 'string',
		'top_bg_image'                => 'string',
		'top_bg_repeat'               => 'string',
		'top_bg_xpos'                 => 'string',
		'top_bg_ypos'                 => 'string',
		'login_bg_image'              => 'string',
		'login_bg_repeat'             => 'string',
		'login_bg_xpos'               => 'string',
		'login_bg_ypos'               => 'string',
		'top_bg_size'                 => 'string',
		'dashboard_delete_db'         => 'bool',
	];

}

/**
 * Convert hex to rgb.
 *
 * @param string $color Hex color.
 * @return array The r,g,b array.
 */
function cldashboard_hex2rgb( $color ) {

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
