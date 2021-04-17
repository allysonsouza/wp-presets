<?php

/**
 * Plugins that were selected on the metabox to be activated.
 */
function presets_selected_plugins() {

	$selected_plugins = get_presets_meta( 'core_plugins_', 'activate' );

	if ( '' === $selected_plugins ) {

		$selected_plugins = array();

	}

	return $selected_plugins;

}

/**
 * Plugins that should be deactivated.
 */
function presets_deactivate_plugins() {

	// The Presets plugin, the plugins that were skipped on the plugins settings, and the plugins that were selected to be activated should be skipped on the filter as default.
	$skip_deactivate_plugins = array_merge( array( presets_plugin_filename() ), presets_selected_plugins(), presets_get_option_skipped_plugins() );

	// Deactivate only the ones that are currenly activated.
	$deactivate_plugins = array_diff( get_option( 'active_plugins' ), $skip_deactivate_plugins );

	deactivate_plugins( $deactivate_plugins );

}

/**
 * Plugins that should be activated.
 */
function presets_activate_plugins() {

	// The Presets plugin and the plugins that were skipped on the plugins settings are skipped and not activated.
	$skip_activate_plugins = array_merge( array( presets_plugin_filename() ), presets_get_option_skipped_plugins() );

	// Activate only the ones that are currenly deactivated.
	$activate_plugins = array_diff( presets_selected_plugins(), $skip_activate_plugins );

	activate_plugins( $activate_plugins );

}

/**
 * Deactivate/Activate plugins for the specific preset that was triggered.
 */
function presets_core_plugin_apply_meta() {

	presets_deactivate_plugins();
	presets_activate_plugins();

}

add_action( 'presets_apply_meta', 'presets_core_plugin_apply_meta' );
