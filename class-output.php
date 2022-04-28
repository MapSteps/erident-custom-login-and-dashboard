<?php
/**
 * Setup Custom Login Dashboard output.
 *
 * @package Custom_Login_Dashboard
 */

namespace CustomLoginDashboard;

use ariColor;

/**
 * Setup Better Admin Bar output.
 */
class Output {

	/**
	 * The class instance.
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * Get instance of the class.
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;

	}

	/**
	 * Init the class setup.
	 */
	public static function init() {
		self::$instance = new self();

		add_action( 'plugins_loaded', array( self::$instance, 'setup' ) );
	}

	/**
	 * Setup action & filter hooks.
	 */
	public function __construct() {}

	/**
	 * Setup action & filters.
	 */
	public function setup() {

		// Left side of the admin area's footer text.
		add_filter( 'admin_footer_text', [ $this, 'left_footer_text' ] );

		$footer_right_text = $this->right_footer_text();

		// Right side of the admin area's footer text.
		if ( ! empty( $footer_right_text ) ) {
			add_filter( 'update_footer', [ $this, 'right_footer_text' ], 11 );
		}

		add_action( 'login_enqueue_scripts', [ $this, 'login_styles' ] );

		add_filter( 'login_headerurl', [ $this, 'login_logo_url' ] );
		add_filter( 'login_headertext', [ $this, 'login_logo_title' ] );

	}

	/**
	 * Filter the left side text of the admin area's footer.
	 */
	public function left_footer_text() {

		$settings = get_option( 'plugin_erident_settings', [] );
		$text     = isset( $settings['dashboard_data_left'] ) ? $settings['dashboard_data_left'] : '';

		return stripslashes( $text );

	}

	/**
	 * Get the right side texr of the admin area's footer.
	 */
	public function right_footer_text() {

		$settings = get_option( 'plugin_erident_settings', [] );
		$text     = isset( $settings['dashboard_data_right'] ) ? $settings['dashboard_data_right'] : '';

		return stripslashes( $text );

	}

	/**
	 * Custom login styles.
	 */
	public function login_styles() {

		$settings = get_option( 'plugin_erident_settings', [] );

		$login_link_shadow = 'none';

		if ( 'Yes' === $settings['dashboard_check_shadow'] || ( isset( $settings['dashboard_check_shadow'] ) && 'No' !== $settings['dashboard_check_shadow'] ) ) {
			$login_link_shadow = $settings['dashboard_link_shadow'] . ' 0 1px 0';
		}

		$login_form_shadow = 'none';

		if ( 'Yes' === $settings['dashboard_check_form_shadow'] || ( isset( $settings['dashboard_check_form_shadow'] ) && 'No' !== $settings['dashboard_check_form_shadow'] ) ) {
			$login_form_shadow = '0 4px 10px -1px ' . $settings['dashboard_form_shadow'];
		}

		$login_lost_pass = 'block';

		if ( 'Yes' === $settings['dashboard_check_lost_pass'] || ( isset( $settings['dashboard_check_lost_pass'] ) && 'No' !== $settings['dashboard_check_lost_pass'] ) ) {
			$login_lost_pass = 'none';
		}

		$login_backtoblog = 'block';

		if ( 'Yes' === $settings['dashboard_check_backtoblog'] || ( isset( $settings['dashboard_check_backtoblog'] ) && 'No' !== $settings['dashboard_check_backtoblog'] ) ) {
			$login_backtoblog = 'none';
		}

		$btn_hover_color = ariColor::newColor( $settings['dashboard_button_color'] );
		$btn_hover_color = $btn_hover_color->getNew( 'alpha', 0.9 )->toCSS( 'rgba' );
		$login_bg_color  = $settings['dashboard_login_bg'];

		if ( isset( $settings['dashboard_login_bg_opacity'] ) ) {
			// This `dashboard_login_bg_opacity` won't be used anymore since we use colorpicker alpha now.
			$login_default_opacity = '' !== $settings['dashboard_login_bg_opacity'] ? $settings['dashboard_login_bg_opacity'] : 1; // 0 is allowed here.

			if ( false === stripos( $login_bg_color, 'rgba' ) && 1 > $login_default_opacity ) {
				$login_bg_color = ariColor::newColor( $login_bg_color );
				$login_bg_color = $login_bg_color->getNew( 'alpha', $login_default_opacity )->toCSS( 'rgba' );
			}
		}

		?>

		<style type="text/css">
			/* Styles loading from Erident Custom Login and Dashboard Plugin */
			html {
				background: none !important;
			}

			html body.login {
				background: <?php echo $settings['top_bg_color']; ?> url(<?php echo $settings['top_bg_image']; ?>) <?php echo $settings['top_bg_repeat']; ?> <?php echo $settings['top_bg_xpos']; ?> <?php echo $settings['top_bg_ypos']; ?> !important;
				background-size: <?php echo $settings['top_bg_size']; ?> !important;
			}

			body.login div#login h1 a {
				background-image: url(<?php echo $settings['dashboard_image_logo']; ?>) !important;
				padding-bottom: 30px;
				margin: 0 auto;
				background-size: <?php echo $settings['dashboard_image_logo_width']; ?>px <?php echo $settings['dashboard_image_logo_height']; ?>px;
				width: <?php echo $settings['dashboard_image_logo_width']; ?>px;
				height: <?php echo $settings['dashboard_image_logo_height']; ?>px;
			}

			body.login #login {
				width:<?php echo $settings['dashboard_login_width']; ?>px;
			}

			.login form {
				border-radius:<?php echo $settings['dashboard_login_radius']; ?>px !important;
				border:<?php echo $settings['dashboard_border_thick']; ?>px <?php echo $settings['dashboard_login_border']; ?> <?php echo $settings['dashboard_border_color']; ?> !important;
				background: <?php echo esc_html( $login_bg_color ); ?> url(<?php echo $settings['login_bg_image']; ?>) <?php echo $settings['login_bg_repeat']; ?> <?php echo $settings['login_bg_xpos']; ?> <?php echo $settings['login_bg_ypos']; ?> !important;
				-moz-box-shadow:    <?php echo $login_form_shadow; ?> !important;
				-webkit-box-shadow: <?php echo $login_form_shadow; ?> !important;
				box-shadow:         <?php echo $login_form_shadow; ?> !important;
			}

			body.login div#login form label, p#reg_passmail {
				color:<?php echo $settings['dashboard_text_color']; ?> !important;
				font-size:<?php echo $settings['dashboard_label_text_size']; ?>px !important;
			}

			body.login #loginform p.submit .button-primary, body.wp-core-ui .button-primary {
				background: <?php echo $settings['dashboard_button_color']; ?> !important;
				color: <?php echo isset( $settings['dashboard_button_text_color'] ) ? $settings['dashboard_button_text_color'] : '#ffffff'; ?> !important;
				border: none !important;
				text-shadow: <?php echo $login_link_shadow; ?> !important;
			}

			body.login #loginform p.submit .button-primary:hover,
			body.login #loginform p.submit .button-primary:focus,
			body.wp-core-ui .button-primary:hover {
				background: <?php echo esc_html( $btn_hover_color ); ?> !important;
			}

			body.login div#login form .input, .login input[type="text"] {
					color: <?php echo $settings['dashboard_input_text_color']; ?> !important;
					font-size:<?php echo $settings['dashboard_input_text_size']; ?>px !important;
			}

			body.login #nav a, body.login #backtoblog a {
				color: <?php echo $settings['dashboard_link_color']; ?> !important;
			}

			body.login #nav, body.login #backtoblog {
				text-shadow: <?php echo $login_link_shadow; ?> !important;
			}

			.login form .input, .login input[type=text], .wp-core-ui .button-primary:focus {
				box-shadow: none !important;
			}

			body.login #loginform p.submit .button-primary, body.wp-core-ui .button-primary {
				box-shadow: none;
			}

			body.login p#nav {
				display: <?php echo $login_lost_pass; ?> !important;
			}

			body.login #backtoblog {
				display: <?php echo $login_backtoblog; ?> !important;
			}
		</style>

		<?php
	}

	/**
	 * Change login logo URL.
	 */
	public function login_logo_url() {

		return get_bloginfo( 'url' );

	}

	/**
	 * Change login logo title.
	 */
	public function login_logo_title() {

		$settings   = get_option( 'plugin_erident_settings' );
		$logo_title = isset( $settings['dashboard_power_text'] ) ? $settings['dashboard_power_text'] : '';

		return stripslashes( $logo_title );

	}

}
