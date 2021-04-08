<?php

require_once plugin_dir_path( __FILE__ ) . 'core/user.php';

function get_presets_meta( $prefix, $field ) {
	$selected_presets_id = $_GET['presets-trigger'];

	return get_post_meta( $selected_presets_id, 'presets_' . $prefix . $field, true );
}

function presets_admin_notice__success() {    ?>
	<div class="notice notice-success is-dismissible">
		<p><?php _e( 'The settings were applied as expected!', 'presets' ) . var_dump( get_post_meta( $_GET['presets-applied'] ) ); ?></p>
	</div>
	<?php
}

function apply_presets() {
	if ( isset( $_GET['presets-trigger'] ) && current_user_can( 'manage_options' ) ) {

		presets_core_user_apply_meta();
		wp_redirect( 'edit.php?post_type=presets&presets-applied=' . $_GET['presets-trigger'], 301 );
		exit;

	}

}

function presets_confirmation() {
	if ( isset( $_GET['presets-applied'] ) ) {

			add_action( 'admin_notices', 'presets_admin_notice__success' );

	}

}

add_action( 'admin_head', 'apply_presets' );
add_action( 'admin_head', 'presets_confirmation' );
