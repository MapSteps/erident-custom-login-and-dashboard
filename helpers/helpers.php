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
