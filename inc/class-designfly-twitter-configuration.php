<?php
/**
 * Custom settings page for twitter widget's configurations.
 *
 * @package DESIGNfly
 */

/**
 * Adds DESIGNfly Twitter Settings page.
 */
class DESIGNfly_Twitter_Configuration {
	/**
	 * Twitter Oauth URL with return url.
	 *
	 * @var string
	 */
	private $twitter_oauth_url = 'https://api.smashballoon.com/twitter-login.php?return_uri=';

	/**
	 * Constructor, registering hooks.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_init', array( $this, 'options_page_init' ) );
	}

	/**
	 * Add top level menu on wp-admin.
	 */
	public function add_menu() {
		add_menu_page(
			'DESIGNfly Twitter',
			'DESIGNfly Twitter',
			'manage_options',
			'designfly-twitter-configuration',
			array( $this, 'create_options_page' ),
			'',
			99
		);
	}

	/**
	 * Content for settings page.
	 */
	public function create_options_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		echo '<div class="wrap">';
        // phpcs:disable
        // PHPCS is disabled because it gives nonce verification error.
        // The settings section/field already adds a nonce so there's no point of adding another one.

		if ( isset( $_GET['settings-updated'] ) ) {
			// Add settings saved message with the class of "updated".
			add_settings_error( 'designfly_messages', 'designfly_messages', __( 'Settings Saved', 'designfly' ), 'updated' );
		}

		// Show error/update messages.
		settings_errors( 'designfly_messages' );

        
		?>
		<form action="options.php" method="post">
            <?php
			// output security fields for the registered setting "wporg".
			settings_fields( 'designfly-twitter-configuration' );
			// output setting sections and their fields.
			// (sections are registered for "wporg", each field is registered to a specific section).
			do_settings_sections( 'designfly-twitter-configuration' );
			// output save settings button.
			submit_button( 'Save Settings' );
			?>
        </form>
        <?php
		// phpcs:enable
		echo '</div>';
	}

	/**
	 * Hooked to admin_init action hook.
	 * Registers settings, sections and setting fields.
	 */
	public function options_page_init() {
		$page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
		if ( 'designfly-twitter-configuration' === $page ) {
			$oauth_token        = filter_input( INPUT_GET, 'oauth_token', FILTER_SANITIZE_STRING );
			$oauth_token_secret = filter_input( INPUT_GET, 'oauth_token_secret', FILTER_SANITIZE_STRING );

			if ( ! empty( $oauth_token_secret ) && ! empty( $oauth_token ) ) {
				if ( get_option( 'oauth_token' ) === $oauth_token && get_option( 'oauth_token_secret' ) === $oauth_token_secret ) {
					wp_safe_redirect( admin_url( 'admin.php?page=designfly-twitter-configuration' ) );
					exit;
				}
			}
		}

		$args = array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
		);

		register_setting( 'designfly-twitter-configuration', 'oauth_token', $args );
		register_setting( 'designfly-twitter-configuration', 'oauth_token_secret', $args );
		register_setting( 'designfly-twitter-configuration', 'screen_name', $args );

		add_settings_section( 'designfly-twitter-configuration', __( 'Twitter Configuration', 'designfly' ), array( $this, 'section_callback' ), 'designfly-twitter-configuration' );

		$setting = 'oauth_token';
		add_settings_field( $setting, __( 'Access Token', 'designfly' ), array( $this, 'field_callback' ), 'designfly-twitter-configuration', 'designfly-twitter-configuration', array( 'setting' => $setting ) );
		$setting = 'oauth_token_secret';
		add_settings_field( $setting, __( 'Access Token Secret', 'designfly' ), array( $this, 'field_callback' ), 'designfly-twitter-configuration', 'designfly-twitter-configuration', array( 'setting' => $setting ) );
		$setting = 'screen_name';
		add_settings_field( $setting, __( 'Screen Name', 'designfly' ), array( $this, 'field_callback' ), 'designfly-twitter-configuration', 'designfly-twitter-configuration', array( 'setting' => $setting ) );
	}

	/**
	 * Callback function for registered section - designfly-twitter-configuration.
	 */
	public function section_callback() {
		$this->retrive_access_token_secret();
	}

	/**
	 * HTML for automatic access token and secret retrieval button.
	 */
	private function retrive_access_token_secret() {
		$oauth_token = filter_input( INPUT_GET, 'oauth_token', FILTER_SANITIZE_STRING );
		$error       = filter_input( INPUT_GET, 'error', FILTER_SANITIZE_STRING );

		?>
		<div id="designfly-twitter-token-generation">

			<?php if ( ! empty( $error ) && empty( $oauth_token ) ) : ?>
				<p class="ctf_notice"><?php esc_html_e( 'There was an error with retrieving your access tokens. Please <a href="https://smashballoon.com/custom-twitter-feeds/token/" target="_blank">use this tool</a> to get your access token and secret.', 'designfly' ); ?></p><br>
			<?php endif; ?>
			<a target="_blank" href="<?php echo esc_url( $this->twitter_oauth_url . admin_url( 'admin.php?page=designfly-twitter-configuration' ) ); ?>" id="ctf-get-token">
				<span class="dashicons dashicons-twitter"></span>
				<?php esc_html_e( 'Log in to Twitter and get my Access Token and Secret', 'designfly' ); ?>
				<h3 class="designfly-hidden-notice"><?php echo esc_html__( '  (This will overwrite existing configurations.)', 'designfly' ); ?></h3>
			</a>

		</div>
		<?php

		if ( ! empty( $oauth_token ) ) {
			?>
			<h3 class="designfly-config-warning"><?php echo esc_html__( 'Please save the settings.', 'designfly' ); ?></h3>
			<?php
		}
	}

	/**
	 * Callback function for all setting fields.
	 *
	 * @param Array $args Arguments passed while registering settings field.
	 */
	public function field_callback( $args ) {
		$setting = filter_input( INPUT_GET, $args['setting'], FILTER_SANITIZE_STRING );

		if ( empty( $setting ) ) {
			$setting = get_option( $args['setting'] );
		}

		?>
		<input size="57" type="text" name="<?php echo esc_attr( $args['setting'] ); ?>" value="<?php echo ( empty( $setting ) ? '' : esc_attr( $setting ) ); ?>">
		<?php
	}


}
