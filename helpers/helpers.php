<?php
/** Custom Login Dashboard's helper functions.
 *
 * @package Custom_Login_Dashboard
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Get field data types.
 */
function cldashboard_get_field_data_types() {

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
		'dashboard_login_bg_opacity'  => 'float', // Deprecated.
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
 * Get field default values.
 */
function cldashboard_get_field_default_values() {

	return [
		'dashboard_data_left'         => 'Powered by YourWebsiteName',
		'dashboard_data_right'        => '&copy; 2022 All Rights Reserved',
		'dashboard_image_logo'        => CUSTOM_LOGIN_DASHBOARD_PLUGIN_URL . '/assets/images/default-logo.png',
		'dashboard_image_logo_width'  => '274',
		'dashboard_image_logo_height' => '63',
		'dashboard_power_text'        => 'Powered by YourWebsiteName',
		'dashboard_login_width'       => '350',
		'dashboard_login_radius'      => '10',
		'dashboard_login_border'      => 'solid',
		'dashboard_border_thick'      => '4',
		'dashboard_border_color'      => '#0069A0',
		'dashboard_login_bg'          => '#dbdbdb',
		'dashboard_login_bg_opacity'  => '1', // Deprecated.
		'dashboard_text_color'        => '#000000',
		'dashboard_input_text_color'  => '#555555',
		'dashboard_label_text_size'   => '14',
		'dashboard_input_text_size'   => '24',
		'dashboard_link_color'        => '#21759B',
		'dashboard_check_shadow'      => 'Yes',
		'dashboard_link_shadow'       => '#ffffff',
		'dashboard_check_form_shadow' => 'Yes',
		'dashboard_check_lost_pass'   => 'No',
		'dashboard_check_backtoblog'  => 'No',
		'dashboard_form_shadow'       => '#C8C8C8',
		'dashboard_button_color'      => '#5E5E5E',
		'dashboard_button_text_color' => '#FFFFFF',
		'top_bg_color'                => '#f9fad2',
		'top_bg_image'                => CUSTOM_LOGIN_DASHBOARD_PLUGIN_URL . '/assets/images/top_bg.jpg',
		'top_bg_repeat'               => 'repeat',
		'top_bg_xpos'                 => 'left',
		'top_bg_ypos'                 => 'top',
		'login_bg_image'              => CUSTOM_LOGIN_DASHBOARD_PLUGIN_URL . '/assets/images/form_bg.jpg',
		'login_bg_repeat'             => 'repeat',
		'login_bg_xpos'               => 'left',
		'login_bg_ypos'               => 'top',
		'top_bg_size'                 => 'auto',
		'dashboard_delete_db'         => 'No',
	];

}
