<?php
/**
 * Login form layout settings template.
 *
 * @package Custom_Login_Dashboard
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Display login form layout settings template.
 *
 * @param array $settings The plugin settings.
 */
return function ( $settings ) {

	$form_width    = isset( $settings['dashboard_login_width'] ) && ! empty( $settings['dashboard_login_width'] ) ? $settings['dashboard_login_width'] : '';
	$border_radius = isset( $settings['dashboard_login_radius'] ) && ! empty( $settings['dashboard_login_radius'] ) ? $settings['dashboard_login_radius'] : '';
	$border_width  = isset( $settings['dashboard_border_thick'] ) && ! empty( $settings['dashboard_border_thick'] ) ? $settings['dashboard_border_thick'] : '';
	$border_style  = isset( $settings['dashboard_login_border'] ) && ! empty( $settings['dashboard_login_border'] ) ? $settings['dashboard_login_border'] : '';
	$border_color  = isset( $settings['dashboard_border_color'] ) && ! empty( $settings['dashboard_border_color'] ) ? $settings['dashboard_border_color'] : '';
	?>

	<div class="heatbox dashboard-settings-box">
		<h2>
			<?php _e( 'Form Layout Settings', 'erident-custom-login-and-dashboard' ); ?>
		</h2>
		<div class="setting-fields">

			<div class="field is-horizontal">
				<div class="field-label">
					<label for="dashboard_login_width" class="label">
						Form Width
						<p class="description">
							The form width in pixel. Default to 350px.
						</p>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="number" name="dashboard_login_width" id="dashboard_login_width" class="general-setting-field is-tiny" value="<?php echo esc_attr( $form_width ); ?>">
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div class="field-label">
					<label for="dashboard_login_radius" class="label">
						Border Radius
						<p class="description">
							The form's border radius in pixel. This is the option to make the corners rounded.
						</p>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="number" name="dashboard_login_radius" id="dashboard_login_radius" class="general-setting-field is-tiny" value="<?php echo esc_attr( $border_radius ); ?>">
						</div>
					</div>
				</div>
			</div>

			<hr>

			<div class="field is-horizontal">
				<div class="field-label">
					<label for="dashboard_border_thick" class="label">
						Border Width
						<p class="description">
							The form's border width in pixel.
							<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/border-width" target="_blank">More info</a>
						</p>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="number" name="dashboard_border_thick" id="dashboard_border_thick" class="general-setting-field is-tiny" value="<?php echo esc_attr( $border_width ); ?>">
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div class="field-label">
					<label for="dashboard_login_border" class="label">
						<?php _e( 'Border Style', 'erident-custom-login-and-dashboard' ); ?>
						<p class="description">
							The form's border style.
							<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/border-style" target="_blank">More info</a>
						</p>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<?php
							$form_border_styles = [
								'none',
								'solid',
								'dotted',
								'dashed',
								'double',
							];
							?>
							<select name="dashboard_login_border" id="dashboard_login_border" class="general-setting-field is-tiny">
								<?php foreach ( $form_border_styles as $form_border_style ) : ?>
									<option value="<?php echo esc_attr( $form_border_style ); ?>" <?php selected( $form_border_style, $border_style ); ?>>
										<?php echo esc_attr( $form_border_style ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div class="field-label">
					<label for="dashboard_border_color" class="label">
						<?php _e( 'Border Color', 'erident-custom-login-and-dashboard' ); ?>
						<p class="description">
							The form's border color.
							<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/border-color" target="_blank">More info</a>
						</p>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="text" name="dashboard_border_color" id="dashboard_border_color" value="<?php echo esc_attr( $border_color ); ?>" class="color-picker-field general-setting-field" data-alpha="true" data-default-color="<?php echo esc_attr( $border_color ); ?>">
						</div>
					</div>
				</div>
			</div>

			<hr>

		</div>
	</div>

	<?php
};
