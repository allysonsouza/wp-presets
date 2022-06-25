<?php

namespace Presets\Actions;

class Implementation {

	/**
     * Constructor
     */
    public function __construct() {
		add_action( 'admin_init', array( $this, 'applyActions' ), 10 );
		add_action( 'admin_init', array( $this, 'redirectSuccess' ), 20 );
		add_action( 'admin_notices', array( $this, 'successAdminNotice' ) );
	}

	/**
	 * Apply actions.
	 */
	public function applyActions() {

		if ( ! isset( $_GET['presets-trigger'] ) || ! current_user_can( 'manage_options' ) ) {
			return;
		}
	
		$preset_id = filter_var( $_GET['presets-trigger'], FILTER_SANITIZE_NUMBER_INT );
	
		if ( get_post_type( $preset_id ) !== 'presets' ) {
			return;
		}
	
		/**
		 * presets_apply_meta hook.
		 */
		do_action( 'presets_apply_meta', $preset_id );
	
	}

	/**
	 * Redirect after presets have been applied.
	 */
	public function redirectSuccess() {

		if ( ! isset( $_GET['presets-trigger'] ) || ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$preset_id = filter_var( $_GET['presets-trigger'], FILTER_SANITIZE_NUMBER_INT );

		$redirect_url = add_query_arg( 'presets-applied', $preset_id, remove_query_arg( 'presets-trigger', $_SERVER['REQUEST_URI'] ) );

		wp_safe_redirect( $redirect_url );
		exit;

	}

	/**
	 * Display notice after action confirmation.
	 */
	public function successAdminNotice() {

		if ( ! isset( $_GET['presets-applied'] ) || ! current_user_can( 'manage_options' ) ) {
			return;
		}

		?>
			<div class="notice notice-success is-dismissible">
			<p><?php _e( 'The settings were applied as expected!' ); ?></p>
			<?php do_action( 'presets_admin_notice_sucess' ); ?>
			</div>
		<?php
	}

}