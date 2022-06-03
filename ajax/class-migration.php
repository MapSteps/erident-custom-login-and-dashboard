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
	public function validate() {

		// Check if nonce is incorrect.
		if ( ! check_ajax_referer( 'cldashboard_nonce_migration', 'nonce', false ) ) {
			wp_send_json_error( __( 'Invalid token', 'erident-custom-login-and-dashboard' ), 401 );
		}

		// Check against old plugin basename existence.
		if ( ! isset( $_POST['old_plugin_basename'] ) || empty( $_POST['old_plugin_basename'] ) ) {
			wp_send_json_error( __( 'Old plugin basename is not specified', 'erident-custom-login-and-dashboard' ), 401 );
		}

		$this->old_plugin_basename = sanitize_text_field( $_POST['old_plugin_basename'] );
	}

	/**
	 * Migrate to Ultimate Dashboard.
	 */
	public function migrate() {

		if ( ! file_exists( WP_PLUGIN_DIR . '/' . $this->old_plugin_basename ) ) {
			wp_send_json_error( __( 'Erident Custom Login & Dashboard plugin is not found', 'erident-custom-login-and-dashboard' ), 403 );
		}

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

}
