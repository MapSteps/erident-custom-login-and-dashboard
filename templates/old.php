<?php
function wp_erident_dashboard_html_page() {
	?>

	<div class="wrap">
		<div id="icon-options-general" class="icon32"><br></div>
		
		<h2><?php _e( 'Erident Custom Login and Dashboard Settings', 'erident-custom-login-and-dashboard' ); ?></h2>
		
		<p><i><?php _e( 'Plugin Loads default values for all below entries. Please change the values to yours.', 'erident-custom-login-and-dashboard' ); ?></i><br/><span style="background: #f9ff0a;"><?php _e( 'Click on the header of each block to open it.', 'erident-custom-login-and-dashboard' ); ?></span></p>
		
		<form class="wp-erident-dashboard" method="post">

			<?php
			if ( isset( $_POST['er_update_settings'] ) ) {
				if ( ! empty( $_POST ) && check_admin_referer( 'er_nonce_form', 'er_total_nonce' ) ) {
					$_POST          = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );
					$er_new_options = $_POST['er_options_up'];
					update_option( 'plugin_erident_settings', $er_new_options );
					echo '<div id="message" class="updated fade"><p><strong>' . __( 'Settings saved.' ) . '</strong></p></div>';
				}
			}

			/*Get all options from db */
			$er_options = get_option( 'plugin_erident_settings' );
			?>

			<div class="postbox">
				<h3 class="hndle" title="Click to toggle"><span><?php _e( 'Dashboard Settings', 'erident-custom-login-and-dashboard' ); ?></span>

				<span class="postbox-title-action"><?php _e( '(These settings will be reflected when a user/admin logins to the WordPress Dashboard)', 'erident-custom-login-and-dashboard' ); ?></span>
				</h3>

				<div class="inside">
					<table border="0">
						<tr valign="top">
						<th scope="row"><?php _e( 'Enter the text for dashboard left side footer:', 'erident-custom-login-and-dashboard' ); ?></th>
						<td>
						<input class="er-textfield" name="er_options_up[dashboard_data_left]" type="text" id="wp_erident_dashboard_data_left"
					value="<?php echo esc_html( stripslashes( $er_options['dashboard_data_left'] ) ); ?>" placeholder="Text for dashboard left side footer" />
						<br />
						<span class="description"><?php _e( 'This will replace the default "Thank you for creating with WordPress" on the bottom left side of dashboard', 'erident-custom-login-and-dashboard' ); ?></span>
						</td>
						</tr>
						<tr valign="top">
						<th scope="row"><?php _e( 'Enter the text for dashboard right side footer:', 'erident-custom-login-and-dashboard' ); ?></th>
						<td><input class="er-textfield" name="er_options_up[dashboard_data_right]" type="text" id="wp_erident_dashboard_data_right"
					value="<?php echo esc_html( stripslashes( $er_options['dashboard_data_right'] ) ); ?>" placeholder="Text for dashboard left right footer"  />
						<br />
						<span class="description"><?php _e( 'This will replace the default "WordPress Version" on the bottom right side of dashboard. Keep it as empty field for disabling this feature. Refresh the page again to see the result after saving.', 'erident-custom-login-and-dashboard' ); ?></span>
						</td>
						</tr>
					</table>
				</div><!-- end inside -->
			</div><!-- end postbox -->

			<div class="postbox">
			<h3 class="hndle" title="Click to toggle"><span><?php _e( 'Login Screen Background', 'erident-custom-login-and-dashboard' ); ?></span>
			<span class="postbox-title-action"><?php _e( '(The following settings will be reflected on the "wp-login.php" page)', 'erident-custom-login-and-dashboard' ); ?></span>
			</h3>
			<div class="inside">
				<table border="0">
					<tr valign="top">
					<th scope="row"><?php _e( 'Login Screen Background Color:', 'erident-custom-login-and-dashboard' ); ?></th>
					<td>
					<input class="er-textfield-small" type="text" id="wp_erident_top_bg_color" name="er_options_up[top_bg_color]" value="<?php echo $er_options['top_bg_color']; ?>" />
					<div id="ilctabscolorpicker4"></div>
					<br />
					<span class="description"><?php _e( 'Click the box to select a color.', 'erident-custom-login-and-dashboard' ); ?></span>
					</td>
					</tr>

					<tr valign="top">
					<th scope="row"><?php _e( 'Login Screen Background Image:', 'erident-custom-login-and-dashboard' ); ?></th>
					<td><input class="er-textfield" name="er_options_up[top_bg_image]" type="text" id="wp_erident_top_bg_image"
				value="<?php echo $er_options['top_bg_image']; ?>" /><button class="set_custom_images button"><?php _e( 'Add Background Image', 'erident-custom-login-and-dashboard' ); ?></button>
					<br />
					<span class="description"><?php _e( 'Add your own pattern/image url for the screen background. Leave blank if you don\'t need any images.', 'erident-custom-login-and-dashboard' ); ?></span>
					</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e( 'Login Screen Background Repeat', 'erident-custom-login-and-dashboard' ); ?></th>
						<td>
						<?php
						switch ( $er_options['top_bg_repeat'] ) {
							case 'none':
								$er_screen_a = 'selected="selected"';
								$er_screen_b = $er_screen_c = $er_screen_d = '';
								break;

							case 'repeat':
								$er_screen_b = 'selected="selected"';
								$er_screen_a = $er_screen_c = $er_screen_d = '';
								break;

							case 'repeat-x':
								$er_screen_c = 'selected="selected"';
								$er_screen_a = $er_screen_b = $er_screen_d = '';
								break;

							case 'repeat-y':
								$er_screen_d = 'selected="selected"';
								$er_screen_a = $er_screen_b = $er_screen_c = '';
								break;

							default:
								$er_screen_a = $er_screen_b = $er_screen_c = $er_screen_d = '';
								break;
						}
						?>
						<select class="er-textfield-small" name="er_options_up[top_bg_repeat]" id="wp_erident_top_bg_repeat">
							<option value="no-repeat" <?php echo $er_screen_a; ?>>No Repeat</option>
							<option value="repeat" <?php echo $er_screen_b; ?>>Repeat</option>
							<option value="repeat-x" <?php echo $er_screen_c; ?>>Repeat-x</option>
							<option value="repeat-y" <?php echo $er_screen_d; ?>>Repeat-y</option>
						</select>

						<br />
						<span class="description"><?php _e( 'Select an image repeat option from dropdown.', 'erident-custom-login-and-dashboard' ); ?></span>
						</td>
						</tr>
						<tr valign="top">
						<th scope="row"><?php _e( 'Background Position:', 'erident-custom-login-and-dashboard' ); ?></th>
						<td><?php _e( 'Horizontal Position: ', 'erident-custom-login-and-dashboard' ); ?> <input class="er-textfield-small" name="er_options_up[top_bg_xpos]" type="text" id="wp_erident_top_bg_xpos"
					value="<?php echo $er_options['top_bg_xpos']; ?>" />
						Vertical Position: <input class="er-textfield-small" name="er_options_up[top_bg_ypos]" type="text" id="wp_erident_top_bg_ypos"
					value="<?php echo $er_options['top_bg_ypos']; ?>" />
						<br />
						<span class="description"><?php _e( 'The background-position property sets the starting position of a background image. If you entering the value in "pixels" or "percentage", add "px" or "%" at the end of value. This will not show any changes if you set the Background Repeat option as "Repeat". <a href="http://www.w3schools.com/cssref/pr_background-position.asp" target="_blank">More Info</a>', 'erident-custom-login-and-dashboard' ); ?></span>
						</td>
						</tr>

						<tr valign="top">
						<th scope="row"><?php _e( 'Background Size:', 'erident-custom-login-and-dashboard' ); ?></th>
						<td><input class="er-textfield-small" name="er_options_up[top_bg_size]" type="text" id="wp_erident_top_bg_size"
					value="<?php echo $er_options['top_bg_size']; ?>" />
						<br />
						<span class="description"><?php _e( 'The background-size property specifies the size of a background image. If you entering the value in "pixels" or "percentage", add "px" or "%" at the end of value. Possible values: auto, length, percentage, cover, contain. <a href="http://www.w3schools.com/cssref/css3_pr_background-size.asp" target="_blank">More Info</a>', 'erident-custom-login-and-dashboard' ); ?></span>
						</td>
						</tr>

					</table>
				</div><!-- end inside -->
			</div><!-- end postbox -->


<div class="postbox">
<h3 class="hndle" title="Click to toggle"><span><?php _e( 'Login Screen Logo', 'erident-custom-login-and-dashboard' ); ?></span>
<span class="postbox-title-action"><?php _e( '(Change the default WordPress logo and powered by text)', 'erident-custom-login-and-dashboard' ); ?></span>
</h3>
<div class="inside openinside">
<table>
	<tr valign="top">
	<th scope="row"><?php _e( 'Logo Url:', 'erident-custom-login-and-dashboard' ); ?></th>
	<td><input class="er-textfield" name="er_options_up[dashboard_image_logo]" type="text" id="wp_erident_dashboard_image_logo"
value="<?php echo $er_options['dashboard_image_logo']; ?>" class="regular-text process_custom_images" max="" min="1" step="1" /> <button class="set_custom_images button"><?php _e( 'Add Logo', 'erident-custom-login-and-dashboard' ); ?></button>
	<br />
	<span class="description"><?php _e( '(URL path to image to replace default WordPress Logo. (You can upload your image with the WordPress media uploader)', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>

	<tr valign="top">
	<th scope="row"><?php _e( 'Logo Width:', 'erident-custom-login-and-dashboard' ); ?></th>
	 <td><input class="er-textfield-small" name="er_options_up[dashboard_image_logo_width]" type="text" id="wp_erident_dashboard_image_logo_width"
value="<?php echo $er_options['dashboard_image_logo_width']; ?>" />px
	<br />
	<span class="description"><?php _e( 'Your Logo width(Enter in pixels). Default: 274px', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Logo Height:', 'erident-custom-login-and-dashboard' ); ?></th>
	 <td><input class="er-textfield-small" name="er_options_up[dashboard_image_logo_height]" type="text" id="wp_erident_dashboard_image_logo_height"
value="<?php echo $er_options['dashboard_image_logo_height']; ?>" />px
	<br />
	<span class="description"><?php _e( 'Your Logo Height(Enter in pixels). Default: 63px', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>

	<tr valign="top">
	<th scope="row"><?php _e( 'Powered by Text:', 'erident-custom-login-and-dashboard' ); ?></th>
	<td><input class="er-textfield" name="er_options_up[dashboard_power_text]" type="text" id="wp_erident_dashboard_power_text"
value="<?php echo stripslashes( $er_options['dashboard_power_text'] ); ?>" />
	<br />
	<span class="description"><?php _e( 'Show when mouse hover over custom Login logo', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
</table>
</div><!-- end inside -->
</div><!-- end postbox -->


<div class="postbox">
<h3 class="hndle" title="Click to toggle"><span><?php _e( 'Login Form Settings', 'erident-custom-login-and-dashboard' ); ?></span>
<span class="postbox-title-action"><?php _e( '(The following settings will change the Login Form style)', 'erident-custom-login-and-dashboard' ); ?></span>
</h3>
<div class="inside">
<table>
	<tr valign="top">
	<th scope="row"><?php _e( 'Login form width:', 'erident-custom-login-and-dashboard' ); ?></th>
	<td><input class="er-textfield-small" name="er_options_up[dashboard_login_width]" type="text" id="wp_erident_dashboard_login_width"
value="<?php echo $er_options['dashboard_login_width']; ?>" />px
	<br />
	<span class="description"><?php _e( 'Total Form width(Enter in pixels). Default: 350px', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Form Border Radius:', 'erident-custom-login-and-dashboard' ); ?></th>
	<td><input class="er-textfield-small" name="er_options_up[dashboard_login_radius]" type="text" id="wp_erident_dashboard_login_radius"
value="<?php echo $er_options['dashboard_login_radius']; ?>" />px
	<br />
	<span class="description"><?php _e( 'Border Radius of Login Form. This is the option to make the corners rounded.(Enter in pixels)', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Border Style', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<?php
	switch ( $er_options['dashboard_login_border'] ) {
		case 'none':
			$er_a = 'selected="selected"';
			$er_b = $er_c = $er_d = $er_e = '';
			break;

		case 'solid':
			$er_b = 'selected="selected"';
			$er_a = $er_c = $er_d = $er_e = '';
			break;

		case 'dotted':
			$er_c = 'selected="selected"';
			$er_a = $er_b = $er_d = $er_e = '';
			break;

		case 'dashed':
			$er_d = 'selected="selected"';
			$er_a = $er_b = $er_c = $er_e = '';
			break;

		case 'double':
			$er_e = 'selected="selected"';
			$er_a = $er_b = $er_c = $er_d = '';
			break;

		default:
			$er_a = $er_b = $er_c = $er_d = $er_e = '';
			break;
	}
	?>
	<select class="er-textfield-small" name="er_options_up[dashboard_login_border]" id="wp_erident_dashboard_login_border">
		<option value="none" <?php echo $er_a; ?>>None</option>
		<option value="solid" <?php echo $er_b; ?>>Solid</option>
		<option value="dotted" <?php echo $er_c; ?>>Dotted</option>
		<option value="dashed" <?php echo $er_d; ?>>Dashed</option>
		<option value="double" <?php echo $er_e; ?>>Double</option>
	</select>

	<br />
	<span class="description"><?php _e( 'Select a Border Style option from dropdown.', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Border Thickness:', 'erident-custom-login-and-dashboard' ); ?></th>
	<td><input class="er-textfield-small" name="er_options_up[dashboard_border_thick]" type="text" id="wp_erident_dashboard_border_thick"
value="<?php echo $er_options['dashboard_border_thick']; ?>" />px
	<br />
	<span class="description"><?php _e( 'Thickness of Border (Enter value in pixels)', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Border Color:', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<input class="er-textfield-small" type="text" id="wp_erident_dashboard_border_color" name="er_options_up[dashboard_border_color]" value="<?php echo $er_options['dashboard_border_color']; ?>" />
	<div id="ilctabscolorpicker"></div>
	<br />
	<span class="description"><?php _e( 'Click the box to select a color.', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Form Background Color:', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<input class="er-textfield-small" type="text" id="wp_erident_dashboard_login_bg" name="er_options_up[dashboard_login_bg]" value="<?php echo $er_options['dashboard_login_bg']; ?>" />
	<div id="ilctabscolorpicker2"></div>
	<?php _e( 'Background Opacity: ', 'erident-custom-login-and-dashboard' ); ?> <input class="er-textfield-small" name="er_options_up[dashboard_login_bg_opacity]" type="number" step="0.1" min="0" max="1"  id="wp_erident_dashboard_login_bg_opacity" value="<?php echo $er_options['dashboard_login_bg_opacity']; ?>" />
	<br />
	<span class="description"><?php _e( 'Click the box to select a color. Background Opacity will helps you to put transparent color over a background image. Possible values 0 to 1. Example: 0.5 means 50% transparency. Default: 1 <a href="https://wordpress.org/plugins/erident-custom-login-and-dashboard/faq/" target="_blank">More Info</a>', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Form Background Image:', 'erident-custom-login-and-dashboard' ); ?></th>
	<td><input class="er-textfield" name="er_options_up[login_bg_image]" type="text" id="wp_erident_login_bg_image" value="<?php echo $er_options['login_bg_image']; ?>" /><button class="set_custom_images button"><?php _e( 'Add Background Image', 'erident-custom-login-and-dashboard' ); ?></button>
	<br />
	<span class="description"><?php _e( 'Add your own pattern/image url to the form background. Leave blank if you don\'t need any images.', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Form Background Repeat', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<?php
	switch ( $er_options['login_bg_repeat'] ) {
		case 'none':
			$er_login_a = 'selected="selected"';
			$er_login_b = $er_login_c = $er_login_d = '';
			break;

		case 'repeat':
			$er_login_b = 'selected="selected"';
			$er_login_a = $er_login_c = $er_login_d = '';
			break;

		case 'repeat-x':
			$er_login_c = 'selected="selected"';
			$er_login_a = $er_login_b = $er_login_d = '';
			break;

		case 'repeat-y':
			$er_login_d = 'selected="selected"';
			$er_login_a = $er_login_b = $er_login_c = '';
			break;

		default:
			$er_login_a = $er_login_b = $er_login_c = $er_login_d = '';
			break;
	}
	?>
	<select class="er-textfield-small" name="er_options_up[login_bg_repeat]" id="wp_erident_login_bg_repeat">
		<option value="no-repeat" <?php echo $er_login_a; ?>>No Repeat</option>
		<option value="repeat" <?php echo $er_login_b; ?>>Repeat</option>
		<option value="repeat-x" <?php echo $er_login_c; ?>>Repeat-x</option>
		<option value="repeat-y" <?php echo $er_login_d; ?>>Repeat-y</option>
	</select>

	<br />
	<span class="description"><?php _e( 'Select an image repeat option from dropdown.', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>

	<tr valign="top">
	<th scope="row"><?php _e( 'Background Position:', 'erident-custom-login-and-dashboard' ); ?></th>
	<td><?php _e( 'Horizontal Position: ', 'erident-custom-login-and-dashboard' ); ?><input class="er-textfield-small" name="er_options_up[login_bg_xpos]" type="text" id="wp_erident_login_bg_xpos"
value="<?php echo $er_options['login_bg_xpos']; ?>" />
	<?php _e( 'Vertical Position: ', 'erident-custom-login-and-dashboard' ); ?><input class="er-textfield-small" name="er_options_up[login_bg_ypos]" type="text" id="wp_erident_login_bg_ypos"
value="<?php echo $er_options['login_bg_ypos']; ?>" />
	<br />
	<span class="description"><?php _e( 'The background-position property sets the starting position of a background image. If you entering the value in "pixels" or "percentage", add "px" or "%" at the end of value. This will not show any changes if you set the Background Repeat option as "Repeat". <a href="http://www.w3schools.com/cssref/pr_background-position.asp" target="_blank">More Info</a>', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>

	<tr valign="top">
	<th scope="row"><?php _e( 'Login Form Label Text Color', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<input class="er-textfield-small" type="text" id="wp_erident_dashboard_text_color" name="er_options_up[dashboard_text_color]" value="<?php echo $er_options['dashboard_text_color']; ?>" />
	<div id="ilctabscolorpicker3"></div>
	<br />
	<span class="description"><?php _e( 'Click the box to select a color. This will change the color of label Username/Password', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Form Label Text Size:', 'erident-custom-login-and-dashboard' ); ?></th>
	<td><input class="er-textfield-small" name="er_options_up[dashboard_label_text_size]" type="text" id="wp_erident_dashboard_label_text_size" value="<?php echo $er_options['dashboard_label_text_size']; ?>" />px
	<br />
	<span class="description"><?php _e( 'Font Size of Label Username/Password(Enter value in pixels)', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Form Input Text Color', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<input class="er-textfield-small" type="text" id="wp_erident_dashboard_input_text_color" name="er_options_up[dashboard_input_text_color]" value="<?php echo $er_options['dashboard_input_text_color']; ?>" />
	<div id="ilctabscolorpicker8"></div>
	<br />
	<span class="description"><?php _e( 'Click the box to select a color. This will change the color of text inside text box.', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Form Input Text Size:', 'erident-custom-login-and-dashboard' ); ?></th>
	<td><input class="er-textfield-small" name="er_options_up[dashboard_input_text_size]" type="text" id="wp_erident_dashboard_input_text_size" value="<?php echo $er_options['dashboard_input_text_size']; ?>" />px
	<br />
	<span class="description"><?php _e( 'Font Size of text inside text box(Enter value in pixels)', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Form Link Color', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<input class="er-textfield-small" type="text" id="wp_erident_dashboard_link_color" name="er_options_up[dashboard_link_color]" value="<?php echo $er_options['dashboard_link_color']; ?>" />
	<div id="ilctabscolorpicker5"></div>
	<br />
	<span class="description"><?php _e( 'Click the box to select a color.', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>

	<tr valign="top">
	<th scope="row"><?php _e( 'Enable link shadow?', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<?php
	$check_sh = $er_options['dashboard_check_shadow'];
	if ( $check_sh == 'Yes' ) {
		$sx = 'checked';
		$sy = '';
	} else {
		$sy = 'checked';
		$sx = ''; }
	?>

		<label>
		<input type="radio" name="er_options_up[dashboard_check_shadow]" value="Yes" id="wp_erident_dashboard_check_shadow_0" <?php echo $sx; ?>  onclick="jQuery('#hide-this').show('normal')" />
		<?php _e( 'Yes', 'erident-custom-login-and-dashboard' ); ?></label>

		<label>
		<input type="radio" name="er_options_up[dashboard_check_shadow]" value="No" id="wp_erident_dashboard_check_shadow_1" <?php echo $sy; ?> onclick="jQuery('#hide-this').hide('normal')" />
		<?php _e( 'No', 'erident-custom-login-and-dashboard' ); ?></label>
	<br />
	<span class="description"><?php _e( '(Check an option)', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top" id="hide-this">
	<th scope="row"><?php _e( 'Login Form Link Shadow Color', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<input class="er-textfield-small" type="text" id="wp_erident_dashboard_link_shadow" name="er_options_up[dashboard_link_shadow]" value="<?php echo $er_options['dashboard_link_shadow']; ?>" />
	<div id="ilctabscolorpicker6"></div>
	<br />
	<span class="description"><?php _e( 'Click the box to select a color.', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>

	<!-- Form Shadow -->
	<tr valign="top">
	<th scope="row"><?php _e( 'Enable form shadow?', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<?php
	$check_fsh = $er_options['dashboard_check_form_shadow'];
	if ( $check_fsh == 'Yes' ) {
		$fsx = 'checked';
		$fsy = '';
	} else {
		$fsy = 'checked';
		$fsx = ''; }
	?>

		<label>
		<input type="radio" name="er_options_up[dashboard_check_form_shadow]" value="Yes" id="wp_erident_dashboard_check_form_shadow_0" <?php echo $fsx; ?>  onclick="jQuery('#hide-this2').show('normal')" />
		<?php _e( 'Yes', 'erident-custom-login-and-dashboard' ); ?></label>

		<label>
		<input type="radio" name="er_options_up[dashboard_check_form_shadow]" value="No" id="wp_erident_dashboard_check_form_shadow_1" <?php echo $fsy; ?> onclick="jQuery('#hide-this2').hide('normal')" />
		<?php _e( 'No', 'erident-custom-login-and-dashboard' ); ?></label>
	<br />
	<span class="description"><?php _e( '(Check an option)', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<tr valign="top" id="hide-this2">
	<th scope="row"><?php _e( 'Login Form Shadow Color', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<input class="er-textfield-small" type="text" id="wp_erident_dashboard_form_shadow" name="er_options_up[dashboard_form_shadow]" value="<?php echo $er_options['dashboard_form_shadow']; ?>" />
	<div id="ilctabscolorpicker7"></div>
	<br />
	<span class="description"><?php _e( 'Click the box to select a color.', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<!-- end Form shadow -->

	<!-- Login Button Color -->
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Button Color', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<input class="er-textfield-small" type="text" id="wp_erident_dashboard_button_color" name="er_options_up[dashboard_button_color]" value="<?php echo $er_options['dashboard_button_color']; ?>" />
	<div id="ilctabscolorpicker9"></div>
	<br />
	<span class="description"><?php _e( 'Click the box to select a color.', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>

	<!-- Login Button Text Color -->
	<tr valign="top">
	<th scope="row"><?php _e( 'Login Button Text Color', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<input class="er-textfield-small" type="text" id="wp_erident_dashboard_button_text_color" name="er_options_up[dashboard_button_text_color]" value="<?php echo isset( $er_options['dashboard_button_text_color'] ) ? $er_options['dashboard_button_text_color'] : '#ffffff'; ?>" />
	<div id="ilctabscolorpicker10"></div>
	<br />
	<span class="description"><?php _e( 'Click the box to select a color.', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>

	<!-- Lost Password -->
	<tr valign="top">
	<th scope="row"><?php _e( 'Hide Register | Lost your password link', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<?php
	$check_lsp = $er_options['dashboard_check_lost_pass'];
	if ( $check_lsp == 'Yes' ) {
		$lspy = 'checked';
		$lspn = '';
	} else {
		$lspn = 'checked';
		$lspy = ''; }
	?>

		<label>
		<input type="radio" name="er_options_up[dashboard_check_lost_pass]" value="Yes" id="wp_erident_dashboard_check_lost_pass_0" <?php echo $lspy; ?>  />
		<?php _e( 'Yes', 'erident-custom-login-and-dashboard' ); ?></label>

		<label>
		<input type="radio" name="er_options_up[dashboard_check_lost_pass]" value="No" id="wp_erident_dashboard_check_lost_pass_1" <?php echo $lspn; ?> />
		<?php _e( 'No', 'erident-custom-login-and-dashboard' ); ?></label>
	<br />
	<span class="description"><?php _e( '(Check an option)', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<!-- end Lost Password -->

	<!-- Back to Blog -->
	<tr valign="top">
	<th scope="row"><?php _e( 'Hide Back to your website link', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<?php
	$check_btb = $er_options['dashboard_check_backtoblog'];
	if ( $check_btb == 'Yes' ) {
		$btby = 'checked';
		$btbn = '';
	} else {
		$btbn = 'checked';
		$btby = ''; }
	?>

		<label>
		<input type="radio" name="er_options_up[dashboard_check_backtoblog]" value="Yes" id="wp_erident_dashboard_check_btb_0" <?php echo $btby; ?>  />
		<?php _e( 'Yes', 'erident-custom-login-and-dashboard' ); ?></label>

		<label>
		<input type="radio" name="er_options_up[dashboard_check_backtoblog]" value="No" id="wp_erident_dashboard_check_btb_1" <?php echo $btbn; ?> />
		<?php _e( 'No', 'erident-custom-login-and-dashboard' ); ?></label>
	<br />
	<span class="description"><?php _e( '(Check an option)', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
	<!-- end Back to Blog -->

</table>
</div><!-- end inside -->
</div><!-- end postbox -->


<div class="postbox">
<h3 class="hndle" title="Click to toggle"><span><?php _e( 'Plugin Un-install Settings', 'erident-custom-login-and-dashboard' ); ?></span>
</h3>
<div class="inside">
<table border="0">
	<tr valign="top">
	<th scope="row"><?php _e( 'Delete custom settings upon plugin deactivation?', 'erident-custom-login-and-dashboard' ); ?></th>
	<td>
	<?php
	$check = $er_options['dashboard_delete_db'];
	if ( $check == 'Yes' ) {
		$x = 'checked';
		$y = '';
	} else {
		$y = 'checked';
		$x = ''; }
	?>

		<label>
		<input type="radio" name="er_options_up[dashboard_delete_db]" value="Yes" id="wp_erident_dashboard_delete_db_0" <?php echo $x; ?> />
		<?php _e( 'Yes', 'erident-custom-login-and-dashboard' ); ?></label>

		<label>
		<input type="radio" name="er_options_up[dashboard_delete_db]" value="No" id="wp_erident_dashboard_delete_db_1" <?php echo $y; ?> />
		<?php _e( 'No', 'erident-custom-login-and-dashboard' ); ?></label>
	<br />
	<span class="description"><?php _e( '(If you set "Yes" all custom settings will be deleted from database upon plugin deactivation)', 'erident-custom-login-and-dashboard' ); ?></span>
	</td>
	</tr>
</table>
</div><!-- end inside -->
</div><!-- end postbox -->

<p>
<input type="submit" name="er_update_settings" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
</p>
	<?php wp_nonce_field( 'er_nonce_form', 'er_total_nonce' ); ?>
</form>

<div class="postbox">
	<h3 class="hndle" title="Click to toggle"><span><?php _e( 'Export Settings', 'erident-custom-login-and-dashboard' ); ?></span></h3>
	<div class="inside">
		<p><?php _e( 'Export the plugin settings for this site as a .json file. This allows you to easily import the configuration into another site.', 'erident-custom-login-and-dashboard' ); ?></p>
		<form method="post">
			<p><input type="hidden" name="er_action" value="export_settings" /></p>
			<p>
				<?php wp_nonce_field( 'er_export_nonce', 'er_export_nonce' ); ?>
				<?php submit_button( __( 'Export' ), 'secondary', 'submit', false ); ?>
			</p>
		</form>
	</div><!-- .inside -->
</div><!-- .postbox -->

<div class="postbox">
	<h3 class="hndle" title="Click to toggle"><span><?php _e( 'Import Settings', 'erident-custom-login-and-dashboard' ); ?></span></h3>
	<div class="inside">
		<p><?php _e( 'Import the plugin settings from a .json file. This file can be obtained by exporting the settings on another site using the form above.', 'erident-custom-login-and-dashboard' ); ?></p>
		<form method="post" enctype="multipart/form-data">
			<p>
				<input type="file" name="import_file"/>
			</p>
			<p>
				<input type="hidden" name="er_action" value="import_settings" />
				<?php wp_nonce_field( 'er_import_nonce', 'er_import_nonce' ); ?>
				<?php submit_button( __( 'Import' ), 'secondary', 'submit', false ); ?>
			</p>
		</form>
	</div><!-- .inside -->
</div><!-- .postbox -->

<div class="bottom-notices">
	<div class="er_notice2">
		<h3><?php _e( 'Quick Links', 'erident-custom-login-and-dashboard' ); ?></h3>
		<ul>
			<li class="login-page"><a href="<?php bloginfo( 'wpurl' ); ?>/wp-login.php" target="_blank"><?php _e( 'Open Your WP Login Page in a New Tab', 'erident-custom-login-and-dashboard' ); ?></a></li>
			<li><a href="http://wordpress.org/extend/plugins/erident-custom-login-and-dashboard/" target="_blank"><?php _e( 'Plugin Documentation', 'erident-custom-login-and-dashboard' ); ?></a></li>
			<li><a href="http://wordpress.org/support/plugin/erident-custom-login-and-dashboard" target="_blank"><?php _e( 'Plugin Support Page', 'erident-custom-login-and-dashboard' ); ?></a></li>
			<li class="green"><a href="http://wordpress.org/support/view/plugin-reviews/erident-custom-login-and-dashboard" target="_blank"><?php _e( 'Got some Love? Give us a 5 star rating!', 'erident-custom-login-and-dashboard' ); ?></a></li>
		</ul>
	</div><!-- end .er_notice2 -->
	<div class="er_notice2 orange">
		<h3>Donate</h3>
	<p>Erident Custom Login and Dashboard is a free plugin offering a bunch of options to completely customize the look of your WordPress login page. I'm always working hard to add new options while keeping the plugin FREE to use. Support the plugin by offering a donation.</p>
	<a href="https://www.paypal.me/LibinVBabu/25" class="button-primary" target="_blank">Donate Now</a>
	</div>
	<div class="clearfix"></div>
	<div class="er_notice">
		<h3><?php _e( 'Hire Me', 'erident-custom-login-and-dashboard' ); ?></h3>
		<p><?php _e( 'Hey, I\'m Libin, a professional Front End Engineer/WordPress Developer. You can hire me for freelancing projects.<br/><br/>Email me: <a href="mailto:libin@libin.in">libin@libin.in</a> <br/>Online Portfolio: <a href="http://www.libin.in" target="_blank">www.libin.in</a>', 'erident-custom-login-and-dashboard' ); ?></p>
	</div>
	<div class="er_notice2 orange">
		<h3><?php _e( 'Translation Credits', 'erident-custom-login-and-dashboard' ); ?></h3>
		<ul>
			<li><?php _e( 'Spanish by <a href="http://www.linkedin.com/in/adrifolio" target="_blank">Adriana De La Cuadra</a>', 'erident-custom-login-and-dashboard' ); ?></li>
			<li><?php _e( 'French by <a href="https://www.linkedin.com/pub/vaslin-guillaume/38/35a/5aa" target="_blank">Guillaume Vaslin</a>', 'erident-custom-login-and-dashboard' ); ?></li>
			<li><?php _e( 'German by <a href="http://www.starsofvietnam.net/" target="_blank">Peter Kaulfuss</a>', 'erident-custom-login-and-dashboard' ); ?></li>
			<li><?php _e( 'Turkish by <a href="https://www.linkedin.com/profile/view?id=335577895" target="_blank">Muhammet Küçük</a>', 'erident-custom-login-and-dashboard' ); ?></li>
			<li><?php _e( 'Persian by <a href="https://about.me/reza.heydari" target="_blank">Reza Heydari</a>', 'erident-custom-login-and-dashboard' ); ?></li>
			<li><?php _e( 'Portuguese-Brazil by <a href="https://www.facebook.com/samuel.desconsi" target="_blank">Samuel Desconsi </a>', 'erident-custom-login-and-dashboard' ); ?></li>
		</ul>
		<p><?php _e( 'Do you wants to translate this plugin to your language? Email me!', 'erident-custom-login-and-dashboard' ); ?></p>
	</div><!-- end .er_notice -->
</div>

</div>
<script type="text/javascript">

	jQuery(document).ready(function() {
	jQuery('#ilctabscolorpicker').hide();
	jQuery('#ilctabscolorpicker').farbtastic("#wp_erident_dashboard_border_color");
	jQuery("#wp_erident_dashboard_border_color").click(function(){jQuery('#ilctabscolorpicker').slideDown()});
	jQuery("#wp_erident_dashboard_border_color").blur(function(){jQuery('#ilctabscolorpicker').slideUp()});

	jQuery('#ilctabscolorpicker2').hide();
	jQuery('#ilctabscolorpicker2').farbtastic("#wp_erident_dashboard_login_bg");
	jQuery("#wp_erident_dashboard_login_bg").click(function(){jQuery('#ilctabscolorpicker2').slideDown()});
	jQuery("#wp_erident_dashboard_login_bg").blur(function(){jQuery('#ilctabscolorpicker2').slideUp()});

	jQuery('#ilctabscolorpicker3').hide();
	jQuery('#ilctabscolorpicker3').farbtastic("#wp_erident_dashboard_text_color");
	jQuery("#wp_erident_dashboard_text_color").click(function(){jQuery('#ilctabscolorpicker3').slideDown()});
	jQuery("#wp_erident_dashboard_text_color").blur(function(){jQuery('#ilctabscolorpicker3').slideUp()});

	jQuery('#ilctabscolorpicker4').hide();
	jQuery('#ilctabscolorpicker4').farbtastic("#wp_erident_top_bg_color");
	jQuery("#wp_erident_top_bg_color").click(function(){jQuery('#ilctabscolorpicker4').slideDown()});
	jQuery("#wp_erident_top_bg_color").blur(function(){jQuery('#ilctabscolorpicker4').slideUp()});

	jQuery('#ilctabscolorpicker5').hide();
	jQuery('#ilctabscolorpicker5').farbtastic("#wp_erident_dashboard_link_color");
	jQuery("#wp_erident_dashboard_link_color").click(function(){jQuery('#ilctabscolorpicker5').slideDown()});
	jQuery("#wp_erident_dashboard_link_color").blur(function(){jQuery('#ilctabscolorpicker5').slideUp()});

	jQuery('#ilctabscolorpicker6').hide();
	jQuery('#ilctabscolorpicker6').farbtastic("#wp_erident_dashboard_link_shadow");
	jQuery("#wp_erident_dashboard_link_shadow").click(function(){jQuery('#ilctabscolorpicker6').slideDown()});
	jQuery("#wp_erident_dashboard_link_shadow").blur(function(){jQuery('#ilctabscolorpicker6').slideUp()});

	jQuery('#ilctabscolorpicker7').hide();
	jQuery('#ilctabscolorpicker7').farbtastic("#wp_erident_dashboard_form_shadow");
	jQuery("#wp_erident_dashboard_form_shadow").click(function(){jQuery('#ilctabscolorpicker7').slideDown()});
	jQuery("#wp_erident_dashboard_form_shadow").blur(function(){jQuery('#ilctabscolorpicker7').slideUp()});

	jQuery('#ilctabscolorpicker8').hide();
	jQuery('#ilctabscolorpicker8').farbtastic("#wp_erident_dashboard_input_text_color");
	jQuery("#wp_erident_dashboard_input_text_color").click(function(){jQuery('#ilctabscolorpicker8').slideDown()});
	jQuery("#wp_erident_dashboard_input_text_color").blur(function(){jQuery('#ilctabscolorpicker8').slideUp()});

	jQuery('#ilctabscolorpicker9').hide();
	jQuery('#ilctabscolorpicker9').farbtastic("#wp_erident_dashboard_button_color");
	jQuery("#wp_erident_dashboard_button_color").click(function(){jQuery('#ilctabscolorpicker9').slideDown()});
	jQuery("#wp_erident_dashboard_button_color").blur(function(){jQuery('#ilctabscolorpicker9').slideUp()});

	jQuery('#ilctabscolorpicker10').hide();
	jQuery('#ilctabscolorpicker10').farbtastic("#wp_erident_dashboard_button_text_color");
	jQuery("#wp_erident_dashboard_button_text_color").click(function(){jQuery('#ilctabscolorpicker10').slideDown()});
	jQuery("#wp_erident_dashboard_button_text_color").blur(function(){jQuery('#ilctabscolorpicker10').slideUp()});

	jQuery( ".postbox .hndle" ).on( "mouseover", function() {
		jQuery( this ).css( "cursor", "pointer" );
	});

	/* Sliding the panels */
	jQuery(".postbox").on('click', '.handlediv', function(){
		jQuery(this).siblings(".inside").slideToggle();
	});
	jQuery(".postbox").on('click', '.hndle', function(){
		jQuery(this).siblings(".inside").slideToggle();
	});

	if (jQuery('.set_custom_images').length > 0) {
	if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
		jQuery('.wrap').on('click', '.set_custom_images', function(e) {
			e.preventDefault();
			var button = jQuery(this);
			var id = button.prev();
			wp.media.editor.send.attachment = function(props, attachment) {
				id.val(attachment.url);
			};
			wp.media.editor.open(button);
			return false;
		});
	}
	};

	});

</script>
	<?php
}
