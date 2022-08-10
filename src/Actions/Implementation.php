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
	 * 
	 * Given the 'presets-trigger' url parameter, apply the according action.
	 * It's expected that 'presets-trigger' is a valid preset ID.
	 * 
	 * @return void
	 */
	public function applyActions() {

		if ( ! isset( $_GET['presets-trigger'] ) || ! current_user_can( 'manage_options' ) ) {
			return;
		}
	
		$preset_id = filter_var( $_GET['presets-trigger'], FILTER_SANITIZE_NUMBER_INT );
	
		if ( get_post_type( $preset_id ) !== 'presets' ) {
			return;
		}

		// Get all the entries values for this preset ID.
		$entries = get_post_meta( $preset_id, 'preset_actions_repeat_group', true );

		foreach ( (array) $entries as $entry ) {
			
			$action_type = $entry['action_type'];

			if ( empty( $action_type ) ) {
				continue;
			}
	
			/**
			 * Trigger presets_apply_action_{$action_type} action hook.
			 * 
			 * This hook can be used by actions to append their routines when the trigger is fired.
			 * 
			 * @param array $entry  Preset entry with action type and action data.
			 */
			do_action( 'presets_apply_action_' . $action_type, $entry );
			
		}
	
	}

	/**
	 * Redirect after presets have been applied.
	 * 
	 * @return void
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
	 * 
	 * @return void
	 */
	public function successAdminNotice() {

		if ( ! isset( $_GET['presets-applied'] ) || ! current_user_can( 'manage_options' ) ) {
			return;
		}

		?>
			<div class="notice notice-success is-dismissible">
			<p><?php _e( 'The settings were applied as expected!' ); ?></p>
			<?php do_action( 'presets_admin_notice_success' ); ?>
			</div>
		<?php
	}

}
