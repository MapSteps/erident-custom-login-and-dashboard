<?php
/*
Plugin Name: Custom Login and Dashboard
Plugin URI: https://ultimatedashboard.io/
Description: Customize completely your WordPress Login Screen and Dashboard. Add your company logo to login screen, change background colors, styles, button color etc. Customize your Dashboard footer text also for complete branding.
Text Domain: erident-custom-login-and-dashboard
Domain Path: /languages
Version: 3.5.9
Author: David Vongries
Author URI: https://davidvongries.com/
License: GPL-3.0

@package Custom_Login_Dashboard
*/

// Helper constants.
define( 'CUSTOM_LOGIN_DASHBOARD_PLUGIN_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'CUSTOM_LOGIN_DASHBOARD_PLUGIN_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
define( 'CUSTOM_LOGIN_DASHBOARD_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'CUSTOM_LOGIN_DASHBOARD_PLUGIN_VERSION', '3.5.9' );

load_plugin_textdomain( 'erident-custom-login-and-dashboard', false, basename( dirname( __FILE__ ) ) . '/languages/' );

// Helper classes.
require __DIR__ . '/helpers/helpers.php';
require __DIR__ . '/helpers/class-export.php';
require __DIR__ . '/helpers/class-import.php';

// Required classes.
require __DIR__ . '/class-setup.php';
require __DIR__ . '/ajax/class-save-settings.php';
require __DIR__ . '/ajax/class-reset-settings.php';
require __DIR__ . '/class-output.php';

/**
 * Function to run on plugin activation.
 */
function cldashboard_activation_script() {

	$settings = array(
		'dashboard_data_left'         => 'Powered by YourWebsiteName',
		'dashboard_data_right'        => '&copy; 2022 All Rights Reserved',
		'dashboard_image_logo'        => plugins_url( 'assets/images/default-logo.png', __FILE__ ),
		'dashboard_image_logo_width'  => '274',
		'dashboard_image_logo_height' => '63',
		'dashboard_power_text'        => 'Powered by YourWebsiteName',
		'dashboard_login_width'       => '350',
		'dashboard_login_radius'      => '10',
		'dashboard_login_border'      => 'solid',
		'dashboard_border_thick'      => '4',
		'dashboard_border_color'      => '#0069A0',
		'dashboard_login_bg'          => '#dbdbdb',
		'dashboard_login_bg_opacity'  => '1',
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
		'top_bg_image'                => plugins_url( 'assets/images/top_bg.jpg', __FILE__ ),
		'top_bg_repeat'               => 'repeat',
		'top_bg_xpos'                 => 'left',
		'top_bg_ypos'                 => 'top',
		'login_bg_image'              => plugins_url( 'assets/images/form_bg.jpg', __FILE__ ),
		'login_bg_repeat'             => 'repeat',
		'login_bg_xpos'               => 'left',
		'login_bg_ypos'               => 'top',
		'top_bg_size'                 => 'auto',
		'dashboard_delete_db'         => 'No',
	);

	update_option( 'plugin_erident_settings', $settings );

}
register_activation_hook( __FILE__, 'cldashboard_activation_script' );

/**
 * Function to run on plugin deactivation.
 */
function cldashboard_deactivation_script() {

	$settings = get_option( 'plugin_erident_settings', [] );

	if ( isset( $settings['dashboard_delete_db'] ) && 'Yes' === $settings['dashboard_delete_db'] ) {
		delete_option( 'plugin_erident_settings' );
	}

}
register_deactivation_hook( __FILE__, 'cldashboard_deactivation_script' );

CustomLoginDashboard\Setup::init();
CustomLoginDashboard\Output::init();
