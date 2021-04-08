<?php

require_once plugin_dir_path( __FILE__ ) . 'core/user.php';

function get_presets_meta( $prefix, $field ) {
	$selected_presets_id = filter_var( $_GET['presets-trigger'], FILTER_SANITIZE_NUMBER_INT );
	return get_post_meta( $selected_presets_id, 'presets_' . $prefix . $field, true );
}

function presets_admin_notice__success() {    ?>
	<div class="notice notice-success is-dismissible">
		<p><?php _e( 'The settings were applied as expected! ', 'presets' ); ?></p>
	</div>
	<?php
}

function apply_presets() {

	if ( ! isset( $_GET['presets-trigger'] ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$selected_presets_id = filter_var( $_GET['presets-trigger'], FILTER_SANITIZE_NUMBER_INT );

	if ( get_post_type( $selected_presets_id ) !== 'presets' ) {
		return;
	}

	presets_core_user_apply_meta();

	add_action( 'admin_notices', 'presets_admin_notice__success' );

}

add_action( 'admin_head', 'apply_presets' );
