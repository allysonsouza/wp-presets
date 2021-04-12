<?php

function presets_core_plugin_apply_meta() {

	$selected_plugins = get_presets_meta( 'core_plugins_', 'activate' );

	if ( '' === $selected_plugins ) {

		$selected_plugins = array();

	}
	$manually_skipped_plugins = cmb2_get_option( 'presets_advanced_settings', 'skip_plugins', true );

	if ( false === is_array( $manually_skipped_plugins ) ) {
		$manually_skipped_plugins = array();
	}

	global $presets_plugin_file_name;

	// Variable with a filter of plugins that should be deactivated. Presets goes on the filter as default.

	$skip_deactivate_plugins = array_merge( array( $presets_plugin_file_name ), $selected_plugins, $manually_skipped_plugins );

	$deactivate_plugins = array_diff( get_option( 'active_plugins' ), $skip_deactivate_plugins );

	// var_dump( $deactivate_plugins );

	deactivate_plugins( $deactivate_plugins );

	//wp_update_plugin( wp_slash( $plugindata ) );
	//$activate_plugins = array_diff($selected_plugins);

	$skip_activate_plugins = array_merge( array( $presets_plugin_file_name ), $manually_skipped_plugins );

	$activate_plugins = array_diff( $selected_plugins, $skip_activate_plugins );

	activate_plugins( $activate_plugins );
}

add_action( 'presets_apply_meta', 'presets_core_plugin_apply_meta' );
