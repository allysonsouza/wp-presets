<?php

function presets_get_option_skipped_plugins() {

	$skipped_plugins = cmb2_get_option( 'presets_advanced_settings', 'skip_plugins', true ); // These plugins were skipped on the Presets advanced settings.

	if ( false === is_array( $skipped_plugins ) ) {
		$skipped_plugins = array();
	}

	return $skipped_plugins;
}
