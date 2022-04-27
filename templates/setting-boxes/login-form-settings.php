<?php
/**
 * Login form settings template.
 *
 * @package Custom_Login_Dashboard
 */

defined( 'ABSPATH' ) || die( "Can't access directly" );

/**
 * Display login form settings template.
 *
 * @param array $settings The plugin settings.
 */
return function ( $settings ) {

	$form_width     = isset( $settings['dashboard_login_width'] ) && ! empty( $settings['dashboard_login_width'] ) ? $settings['dashboard_login_width'] : '';
	$border_radius  = isset( $settings['dashboard_login_radius'] ) && ! empty( $settings['dashboard_login_radius'] ) ? $settings['dashboard_login_radius'] : '';
	$border_width   = isset( $settings['dashboard_border_thick'] ) && ! empty( $settings['dashboard_border_thick'] ) ? $settings['dashboard_border_thick'] : '';
	$border_style   = isset( $settings['dashboard_login_border'] ) && ! empty( $settings['dashboard_login_border'] ) ? $settings['dashboard_login_border'] : '';
	$border_color   = isset( $settings['dashboard_border_color'] ) && ! empty( $settings['dashboard_border_color'] ) ? $settings['dashboard_border_color'] : '';
	$bg_color       = isset( $settings['dashboard_login_bg'] ) && ! empty( $settings['dashboard_login_bg'] ) ? $settings['dashboard_login_bg'] : '';
	$bg_opacity     = isset( $settings['dashboard_login_bg_opacity'] ) ? $settings['dashboard_login_bg_opacity'] : 1; // 0 is allowed here.
	$bg_image_url   = isset( $settings['login_bg_image'] ) && ! empty( $settings['login_bg_image'] ) ? $settings['login_bg_image'] : '';
	$bg_repeat      = isset( $settings['login_bg_repeat'] ) && ! empty( $settings['login_bg_repeat'] ) ? $settings['login_bg_repeat'] : '';
	$horizontal_pos = isset( $settings['login_bg_xpos'] ) && ! empty( $settings['login_bg_xpos'] ) ? $settings['login_bg_xpos'] : '';
	$vertical_pos   = isset( $settings['login_bg_ypos'] ) && ! empty( $settings['login_bg_ypos'] ) ? $settings['login_bg_ypos'] : '';
	?>

	<div class="heatbox dashboard-settings-box">
		<h2>
			<?php _e( 'Form Settings', 'erident-custom-login-and-dashboard' ); ?>
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

			<div class="field is-horizontal">
				<div class="field-label">
					<label for="dashboard_login_bg" class="label">
						<?php _e( 'Background Color', 'erident-custom-login-and-dashboard' ); ?>
						<p class="description">
							The form background color.
						</p>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="text" name="dashboard_login_bg" id="dashboard_login_bg" value="<?php echo esc_attr( $bg_color ); ?>" class="color-picker-field general-setting-field" data-alpha="true" data-default-color="<?php echo esc_attr( $bg_color ); ?>">
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div class="field-label">
					<label for="dashboard_login_bg_opacity" class="label">
						<?php _e( 'Background Opacity', 'erident-custom-login-and-dashboard' ); ?>
						<p class="description">
							The form transparency.
							<a href="https://wordpress.org/plugins/erident-custom-login-and-dashboard/#faq" target="_blank">More info</a>
						</p>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="number" min="0" max="1" step="0.1" name="dashboard_login_bg_opacity" id="dashboard_login_bg_opacity" value="<?php echo esc_attr( $bg_opacity ); ?>" class="general-setting-field is-tiny">
						</div>
					</div>
				</div>
			</div>

			<hr>

			<div class="field is-horizontal">
				<div class="field-label">
					<label for="login_bg_image" class="label">
						<?php _e( 'Background Image URL', 'erident-custom-login-and-dashboard' ); ?>
						<p class="description">
							Leave blank if you don't need background image.
						</p>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="text" id="login_bg_image" name="login_bg_image" value="<?php echo esc_url( $bg_image_url ); ?>" class="general-setting-field is-small cldashboard-form-bg-image-field">
							<button type="button" class="button-secondary cldashboard-upload-button">
								<?php _e( 'Add Background Image', 'erident-custom-login-and-dashboard' ); ?>
							</button>
							<button type="button" class="button-secondary cldashboard-clear-button">x</button>
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal">
				<div class="field-label">
					<label for="login_bg_repeat" class="label">
						<?php _e( 'Background Repeat', 'erident-custom-login-and-dashboard' ); ?>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<?php
							$bg_repeat_opts = [
								'no-repeat',
								'repeat',
								'repeat-x',
								'repeat-y',
							];
							?>
							<select name="login_bg_repeat" id="login_bg_repeat" class="general-setting-field is-tiny">
								<?php foreach ( $bg_repeat_opts as $bg_repeat_opt ) : ?>
									<option value="<?php echo esc_attr( $bg_repeat_opt ); ?>" <?php selected( $bg_repeat_opt, $bg_repeat ); ?>>
										<?php echo esc_attr( $bg_repeat_opt ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal" data-hide-if-field="login_bg_repeat" data-hide-if-value="repeat">
				<div class="field-label">
					<label for="login_bg_xpos" class="label">
						<?php _e( 'Background Horizontal Position', 'erident-custom-login-and-dashboard' ); ?>
						<p class="description">
							The horizontal position of the background image. Possible value: <code>left</code>, or <code>center</code>, or <code>right</code>, or numeric value.
							If you use numeric value, you can use <code>px</code>, or <code>em</code>, or <code>%</code>, or other unit as the suffix.
							<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/background-position-x" target="_blank">More info</a>
						</p>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="text" name="login_bg_xpos" id="login_bg_xpos" value="<?php echo esc_attr( $horizontal_pos ); ?>" class="general-setting-field is-tiny">
						</div>
					</div>
				</div>
			</div>

			<div class="field is-horizontal" data-hide-if-field="login_bg_repeat" data-hide-if-value="repeat">
				<div class="field-label">
					<label for="login_bg_ypos" class="label">
						<?php _e( 'Background Vertical Position', 'erident-custom-login-and-dashboard' ); ?>
						<p class="description">
							The vertical position of the background image. Possible value: <code>top</code>, or <code>center</code>, or <code>bottom</code>, or numeric value.
							If you use numeric value, you can use <code>px</code>, or <code>em</code>, or <code>%</code>, or other unit as the suffix.
							<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/background-position-y" target="_blank">More info</a>
						</p>
					</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control">
							<input type="text" name="login_bg_ypos" id="login_bg_ypos" value="<?php echo esc_attr( $vertical_pos ); ?>" class="general-setting-field is-tiny">
						</div>
					</div>
				</div>
			</div>

			<hr>

		</div>
	</div>

	<?php
};
