<?php
/**
 * Custom settings page for twitter widget's configurations.
 *
 * @package DESIGNfly
 */

/**
 * Register service worker scripts with PWA plugin.
 */
class DESIGNfly_Service_Worker_Scripts {
	/**
	 * Constructor, registering hooks.
	 */
	public function __construct() {
		// Register for the frontend service worker.
		add_action( 'wp_front_service_worker', array( $this, 'register_frontend_service_worker_script' ) );
		add_filter( 'web_app_manifest', array( $this, 'web_app_manifest' ) );
	}

	public function register_frontend_service_worker_script( $scripts ) {

		// Register custom service worker script.
		$scripts->register(
			'designfly-frontend-sw', // Handle.
			array(
				'src' => get_template_directory_uri() . '/service-worker.js', // Source.
			)
		);

	}

}
