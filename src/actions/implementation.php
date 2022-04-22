<?php

function presets_add_loading_actions($slug, $entry) {

	$core_general_settings = new CoreGeneralSettings(
		'core-general-settings',
		__( '[Core] General Settings ABC', 'presets' ),
		__( 'General settings for the site', 'presets' )
	);

	$actions = array(
		'core-general-settings' => $core_general_settings,
	);

	$actions[$slug]->applyAction($entry);

}

add_action( 'presets_apply_actions', 'presets_add_loading_actions', 10, 2 );

function apply_presets() {

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
//	do_action( 'presets_apply_meta', $preset_id );

	$entries = get_post_meta( $id, 'preset_actions_repeat_group', true );

	foreach ( (array) $entries as $key => $entry ) {
		$slug = $entry['preset_actions_slug'];

		do_action( 'presets_apply_actions', $slug , $entry );

	}

}

add_action( 'admin_init', 'apply_presets' );

/**
 * Redirect after presets have been applied.
 */
function presets_apply_redirection() {

	if ( ! isset( $_GET['presets-trigger'] ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$preset_id = filter_var( $_GET['presets-trigger'], FILTER_SANITIZE_NUMBER_INT );

	$redirect_url = add_query_arg( 'presets-applied', $preset_id, remove_query_arg( 'presets-trigger', $_SERVER['REQUEST_URI'] ) );

	wp_safe_redirect( $redirect_url );
	exit;

}

add_action( 'admin_init', 'presets_apply_redirection', 20 );

/**
 * Display notice after action confirmation.
 */
function presets_admin_notice__success() {

	if ( ! isset( $_GET['presets-applied'] ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	?>
		<div class="notice notice-success is-dismissible">
		<p><?php _e( 'The settings were applied as expected! ' ); ?></p>
		<?php do_action( 'presets_admin_notice_sucess' ); ?>
		</div>
	<?php
}

add_action( 'admin_notices', 'presets_admin_notice__success' );
