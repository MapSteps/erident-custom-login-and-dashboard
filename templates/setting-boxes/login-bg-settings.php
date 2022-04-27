<?php
/**
 * Login background settings template.
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

	$bg_color = isset( $settings['top_bg_color'] ) && ! empty( $settings['top_bg_color'] ) ? $settings['top_bg_color'] : '';
	?>

	<div class="heatbox login-bg-settings-box">
		<h2>
			<?php _e( 'Background Settings', 'erident-custom-login-and-dashboard' ); ?>
		</h2>
		<div class="setting-fields">

			<div class="field is-horizontal">
				<div class="field-label">
					<label for="top_bg_color" class="label">
						<?php _e( 'Background Color', 'erident-custom-login-and-dashboard' ); ?>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="text" name="top_bg_color" id="top_bg_color" value="<?php echo esc_attr( $bg_color ); ?>" class="color-picker-field general-setting-field" data-alpha="true" data-default-color="<?php echo esc_attr( $bg_color ); ?>">
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

	<?php
};
