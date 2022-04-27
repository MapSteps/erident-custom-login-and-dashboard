<?php
/**
 * Dashboard settings template.
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

	$left_side_text  = isset( $settings['dashboard_data_left'] ) ? stripslashes( $settings['dashboard_data_left'] ) : '';
	$right_side_text = isset( $settings['dashboard_data_right'] ) ? stripslashes( $settings['dashboard_data_right'] ) : '';
	?>

	<div class="heatbox dashboard-settings-box">
		<h2>
			<?php _e( 'Dashboard Settings', 'erident-custom-login-and-dashboard' ); ?>
		</h2>
		<div class="setting-fields">

			<div class="field is-horizontal">
				<div class="field-label">
					<label for="dashboard_data_left" class="label">
						Left side footer text
						<p class="description">
							This will replace the default "Thank you for creating with WordPress" on the footer left side of admin area.
						</p>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="text" name="dashboard_data_left" id="dashboard_data_left" class="general-setting-field" value="<?php echo esc_attr( $left_side_text ); ?>">
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div class="field-label">
					<label for="dashboard_data_right" class="label">
						Right side footer text
						<p class="description">
							This will replace the default "WordPress Version" on the footer right side of admin area.
						</p>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="text" name="dashboard_data_right" id="dashboard_data_right" class="general-setting-field" value="<?php echo esc_attr( $right_side_text ); ?>">
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<?php
};
