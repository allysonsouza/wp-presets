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

		$manually_skipped_plugins = cmb2_get_option( 'presets_advanced_settings', 'skip_plugins', true );

		if ( false === is_array( $manually_skipped_plugins ) ) {
			$manually_skipped_plugins = array();
		}

		if ( $presets_plugin_file_name !== $plugin && ! in_array( $plugin, $manually_skipped_plugins, true ) ) {
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
			'desc'    => __( 'Select the plugins that should get activated when this preset gets triggered. If the plugin is not selected, it is going to be deactivated. You are able to <a href="edit.php?post_type=presets&page=presets_advanced_settings">skip specific plugins from being deactivated/activated on the plugin settings</a>.', 'presets' ),
			'id'      => $prefix_meta . 'activate',
			'type'    => 'multicheck',
			'options' => $options,
		),
	);

}

add_action( 'presets_create_metabox', 'presets_core_plugins_create_metabox' );
