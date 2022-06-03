<?php
/**
 * Change widget order.
 *
 * @package Swift_Control
 */

namespace CustomLoginDashboard\Ajax;

/**
 * Class to manage ajax request of migration to UDB.
 */
class Migration {

	/**
	 * The old plugin slug.
	 *
	 * @var string
	 */
	private $old_plugin_basename = '';

	/**
	 * Class constructor.
	 */
	public function __construct() {

		add_action( 'wp_ajax_cldashboard_migration', [ $this, 'handler' ] );

	}

	/**
	 * The request handler.
	 */
	public function handler() {

		$this->validate();
		$this->migrate();

	}

	/**
	 * Validate the data.
	 */
	private function validate() {

		// Check if nonce is incorrect.
		if ( ! check_ajax_referer( 'cldashboard_nonce_migration', 'nonce', false ) ) {
			wp_send_json_error( __( 'Invalid token', 'erident-custom-login-and-dashboard' ), 401 );
		}

		// Check against old plugin basename existence.
		if ( ! isset( $_POST['old_plugin_basename'] ) || empty( $_POST['old_plugin_basename'] ) ) {
			wp_send_json_error( __( 'Old plugin basename is not specified', 'erident-custom-login-and-dashboard' ), 401 );
		}

		if (
			defined( 'ULTIMATE_DASHBOARD_PLUGIN_VERSION' )
			|| file_exists( WP_CONTENT_DIR . '/plugins/ultimate-dashboard/ultimate-dashboard.php' )
		) {
			wp_send_json_error(
				__(
					'You already have Ultimate Dashboard installed. You might want to uninstall it manually and then run the migration again. Make sure the "Remove Data on Uninstall" option in Ultimate Dashboard is NOT checked so that your existing Ultimate Dashboard data will stay.',
					'erident-custom-login-and-dashboard'
				),
				401
			);
		}

		$this->old_plugin_basename = sanitize_text_field( $_POST['old_plugin_basename'] );
	}

	/**
	 * Migrate to Ultimate Dashboard.
	 */
	private function migrate() {

		if ( ! file_exists( WP_PLUGIN_DIR . '/' . $this->old_plugin_basename ) ) {
			wp_send_json_error( __( 'Erident Custom Login & Dashboard plugin is not found', 'erident-custom-login-and-dashboard' ), 403 );
		}

		$this->migrate_settings();

		deactivate_plugins( $this->old_plugin_basename );

		$deletion = delete_plugins( [ $this->old_plugin_basename ] );

		if ( $deletion && ! is_wp_error( $deletion ) ) {
			wp_send_json_success( __( 'Erident Custom Login & Dashboard plugin has been removed', 'erident-custom-login-and-dashboard' ) );
		} elseif ( is_wp_error( $deletion ) ) {
			wp_send_json_error( $deletion->get_error_message(), 403 );
		} elseif ( null === $deletion ) {
			wp_send_json_error( __( 'Filesystem credentials are required', 'erident-custom-login-and-dashboard' ), 403 );
		} else {
			wp_send_json_error( __( 'Erident Custom Login & Dashboard plugin is not specified', 'erident-custom-login-and-dashboard' ), 401 );
		}

	}

	/**
	 * Migrate Erident Custom Login & Dashboard settings to Ultimate Dashboard settings.
	 */
	private function migrate_settings() {

		$this->migrate_general_settings();
		$this->migrate_login_settings();

	}

	/**
	 * Migrate general settings.
	 */
	private function migrate_general_settings() {

		$udb_general_options  = get_option( 'udb_settings', [] );
		$udb_branding_options = get_option( 'udb_branding', [] );
		$erident_options      = get_option( 'plugin_erident_settings', [] );

		if ( empty( $erident_options ) ) {
			return;
		}

		$is_general_changed  = false;
		$is_branding_changed = false;

		$clean_deactivation = isset( $erident_options['dashboard_delete_db'] ) ? $erident_options['dashboard_delete_db'] : 0;
		$clean_deactivation = 'yes' === strtolower( $clean_deactivation ) ? 1 : $clean_deactivation;
		$clean_deactivation = 'no' === strtolower( $clean_deactivation ) ? 0 : $clean_deactivation;

		if ( $clean_deactivation ) {
			$udb_general_options['remove-on-uninstall'] = 1;

			$is_general_changed = true;
		}

		$footer_text = isset( $erident_options['dashboard_data_left'] ) ? stripslashes( $erident_options['dashboard_data_left'] ) : '';

		if ( $footer_text ) {
			$udb_branding_options['footer_text'] = $footer_text;

			$is_branding_changed = true;
		}

		$version_text = isset( $erident_options['dashboard_data_right'] ) ? stripslashes( $erident_options['dashboard_data_right'] ) : '';

		if ( $version_text ) {
			$udb_branding_options['version_text'] = $version_text;

			$is_branding_changed = true;
		}

		if ( $is_general_changed ) {
			update_option( 'udb_settings', $udb_general_options );
		}

		if ( $is_branding_changed ) {
			update_option( 'udb_branding', $udb_branding_options );
		}

	}

	/**
	 * Migrate login customization settings.
	 *
	 * We don't need to use "is_changed" flag here because
	 * almost all Erident settings are about login customization.
	 */
	private function migrate_login_settings() {

		$udb_login_options = get_option( 'udb_login', [] );
		$erident_options   = get_option( 'plugin_erident_settings', [] );

		if ( empty( $erident_options ) ) {
			return;
		}

		$logo_image_url = isset( $erident_options['dashboard_image_logo'] ) && ! empty( $erident_options['dashboard_image_logo'] ) ? $erident_options['dashboard_image_logo'] : '';

		if ( $logo_image_url ) {
			$udb_login_options['logo_image'] = $logo_image_url;
		}

		$logo_width = isset( $erident_options['dashboard_image_logo_width'] ) && ! empty( $erident_options['dashboard_image_logo_width'] ) ? $erident_options['dashboard_image_logo_width'] : '';

		if ( $logo_width ) {
			// Logo width doesn't exist in UDB login customizer, but let's keep this.
			$udb_login_options['logo_width'] = $logo_width;
		}

		$logo_height = isset( $erident_options['dashboard_image_logo_height'] ) && ! empty( $erident_options['dashboard_image_logo_height'] ) ? $erident_options['dashboard_image_logo_height'] : '';

		if ( $logo_height ) {
			$udb_login_options['logo_height'] = $logo_height;
		}

		$logo_text = isset( $settings['dashboard_power_text'] ) && ! empty( $settings['dashboard_power_text'] ) ? $settings['dashboard_power_text'] : '';

		if ( $logo_text ) {
			$udb_login_options['logo_title'] = $logo_text;
		}

	}

}
