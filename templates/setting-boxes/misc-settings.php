<?php
/**
 * Miscellaneus settings template.
 *
 * @package Custom_Login_Dashboard
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Display dashboard settings template.
 *
 * @param array $settings The plugin settings.
 */
return function ( $settings ) {

	$clean_deactivation = isset( $settings['dashboard_delete_db'] ) ? $settings['dashboard_delete_db'] : 0;
	$clean_deactivation = 'yes' === strtolower( $clean_deactivation ) ? 1 : 0;
	?>

	<div class="heatbox misc-settings-box">
		<h2>
			<?php _e( 'Misc', 'erident-custom-login-and-dashboard' ); ?>
		</h2>
		<div class="setting-fields">

			<div class="field">
				<label for="dashboard_delete_db" class="label checkbox-label">
					<?php _e( 'Remove custom settings upon plugin deactivation', 'erident-custom-login-and-dashboard' ); ?>
					<p class="description">
						If checked, all custom settings will be removed from database upon plugin deactivation.
					</p>
					<input type="checkbox" name="dashboard_delete_db" id="dashboard_delete_db" value="1" class="general-setting-field" <?php checked( $clean_deactivation, 1 ); ?>>
					<div class="indicator"></div>
				</label>
			</div>

		</div>
	</div>

	<?php
};
