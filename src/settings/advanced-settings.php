<?php

/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function presets_register_advanced_settings() {

	/**
	 * Registers options page menu item and form.
	 */
	$cmb_options = new_cmb2_box(
		array(
			'id'           => 'presets_advanced_settings_metabox',
			'title'        => esc_html__( 'Advanced Settings', 'presets' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => 'presets_advanced_settings', // The option key and admin menu page slug.
			'menu_title'   => esc_html__( 'Settings', 'presets' ), // Falls back to 'title' (above).
			'parent_slug'  => 'edit.php?post_type=presets', // Make options page a submenu item of the themes menu.
			'capability'   => 'manage_options', // Cap required to view options-page.
		)
	);

	/*
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
	 */

	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	$plugins = get_plugins();

	$options = array();

	foreach ( $plugins as $plugin => $meta ) {

		if ( presets_plugin_filename() !== $plugin ) {
			$options[ $plugin ] = $meta['Name'];
		}
	}

	$cmb_options->add_field(
		array(
			'name'    => __( 'Skip Plugins', 'presets' ),
			'desc'    => __( 'Select the plugins that should be skipped. These plugins won\'t be activated, deactivated, or even show as option when you run the plugins activation on a preset. Have in mind that the plugin Presets is skipped as default, so you will not see it on this list.', 'presets' ),
			'id'      => 'skip_plugins',
			'type'    => 'multicheck',
			'options' => $options,
		),
	);
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function presets_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( 'presets_advanced_settings', $key, $default );
	}

	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'presets_options', $default );

	$val = $default;

	if ( 'all' === $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}

	return $val;
}

add_action( 'cmb2_admin_init', 'presets_register_advanced_settings' );
