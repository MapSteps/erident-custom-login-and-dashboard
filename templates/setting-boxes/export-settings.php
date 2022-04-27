<?php
/**
 * Export settings template.
 *
 * @package Custom_Login_Dashboard
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );
?>

<div class="heatbox export-widgets-box">
	<form method="post" action="<?php menu_page_url( 'erident-custom-login-and-dashboard', true ); ?>">
		<input type="hidden" name="er_action" value="export_settings" />
		<?php wp_nonce_field( 'er_export_nonce', 'er_export_nonce' ); ?>

		<h2><?php _e( 'Export', 'erident-custom-login-and-dashboard' ); ?></h2>
		<div class="heatbox-content">
			<p>
				<?php _e( 'Export the plugin settings for this site as a .json file. This allows you to easily import the configuration into another site.', 'erident-custom-login-and-dashboard' ); ?>
			</p>
			<?php submit_button( __( 'Export Settings', 'erident-custom-login-and-dashboard' ), 'primary', 'submit_export' ); ?>
		</div>
	</form>
</div>
