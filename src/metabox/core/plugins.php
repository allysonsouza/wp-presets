<?php

/**
 * Funtion to get all the plugins that can be activated/deactivated on the presets.
 */

function presets_get_avaliable_plugins() {

	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	$plugins = get_plugins(); // All installed plugins.

	$avaliable_plugins = array(); // Plugins that can be activated.

	foreach ( $plugins as $plugin => $meta ) {

		if ( presets_plugin_filename() !== $plugin && ! in_array( $plugin, presets_get_option_skipped_plugins(), true ) ) {
			$avaliable_plugins[ $plugin ] = $meta['Name'];
		}
	}

	return $avaliable_plugins;

}


/**
 * Funtion to hook code that creates the plugin module metabox.
 */

function presets_core_plugins_create_metabox() {

	$prefix_meta = 'presets_core_plugins_';

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
		)
	);

	$cmb->add_field(
		array(
			'name'    => __( 'Activate Plugins', 'presets' ),
			'desc'    => __( 'Select the plugins that should get activated when this preset gets triggered. If the plugin is not selected, it is going to be deactivated. You are able to <a href="edit.php?post_type=presets&page=presets_advanced_settings">skip specific plugins from being deactivated/activated on the plugin settings</a>.', 'presets' ),
			'id'      => $prefix_meta . 'activate',
			'type'    => 'multicheck',
			'options' => presets_get_avaliable_plugins(),
		),
	);

}

add_action( 'presets_create_metabox', 'presets_core_plugins_create_metabox' );
