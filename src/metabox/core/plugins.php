<?php

function presets_core_plugins_create_metabox() {

	$prefix_meta = 'presets_core_plugins_';

	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	$plugins = get_plugins();

	$options = array();

	foreach ( $plugins as $plugin => $meta ) {

		global $presets_plugin_file_name;

		if ( $presets_plugin_file_name !== $plugin ) {
			$options[ $plugin ] = $meta['Name'];
		}
	}

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box(
		array(
			'id'           => $prefix_meta . 'metabox',
			'title'        => __( 'Installed plugins', 'presets' ),
			'object_types' => array( 'presets' ), // Post type
			'context'      => 'normal',
			'priority'     => 'low',
			'show_names'   => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
		)
	);

	$cmb->add_field(
		array(
			'name'    => __( 'Activate Plugins', 'presets' ),
			'desc'    => __( 'Select the plugins', 'presets' ),
			'id'      => $prefix_meta . 'activate',
			'type'    => 'multicheck',
			'options' => $options,
		),
	);

}

add_action( 'presets_create_metabox', 'presets_core_plugins_create_metabox' );
