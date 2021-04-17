<?php

/**
 * Funtion to hook code that should be applied for the plugin module when a preset get triggered.
 */

function presets_core_plugin_apply_meta() {

	$selected_plugins = get_presets_meta( 'core_plugins_', 'activate' );

	if ( '' === $selected_plugins ) {

		$selected_plugins = array();

	}
	$manually_skipped_plugins = cmb2_get_option( 'presets_advanced_settings', 'skip_plugins', true );

	if ( false === is_array( $manually_skipped_plugins ) ) {
		$manually_skipped_plugins = array();
	}

	// Variable with a filter of plugins that should be deactivated. Presets goes on the filter as default.

	$skip_deactivate_plugins = array_merge( array( presets_plugin_filename() ), $selected_plugins, $manually_skipped_plugins );

	$deactivate_plugins = array_diff( get_option( 'active_plugins' ), $skip_deactivate_plugins );

	deactivate_plugins( $deactivate_plugins );

	$skip_activate_plugins = array_merge( array( presets_plugin_filename() ), $manually_skipped_plugins );

	$activate_plugins = array_diff( $selected_plugins, $skip_activate_plugins );

	activate_plugins( $activate_plugins );
}

add_action( 'presets_apply_meta', 'presets_core_plugin_apply_meta' );
