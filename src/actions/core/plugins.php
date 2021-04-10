<?php

function presets_core_plugin_apply_meta() {
	$prefix = 'core_plugin_';

	$plugindata = array(
		'ID' => get_current_plugin_id(),
	);

	$fields = array(
		'plugins',
	);

	foreach ( $fields as $field ) {
		$meta = get_presets_meta( $prefix, $field );
		if ( ! empty( $meta ) ) {
			$plugindata[ $field ] = $meta;
		}
	}

	wp_update_plugin( wp_slash( $plugindata ) );

}

// add_action( 'presets_apply_meta', 'presets_core_plugin_apply_meta' );
