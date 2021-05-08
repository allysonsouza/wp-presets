<?php

/**
 * Adding 'cmb2' vendor.
 * https://github.com/CMB2/CMB2
 */
if ( file_exists( dirname( __FILE__ ) . '/../../vendors/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/../../vendors/cmb2/init.php';
}

include_once plugin_dir_path( __FILE__ ) . 'core/user.php';
include_once plugin_dir_path( __FILE__ ) . 'core/general-settings.php';
include_once plugin_dir_path( __FILE__ ) . 'core/plugins.php';

/**
 * Create metabox.
 */
function presets_options() {

	$prefix = 'presets_';

	/**
	 * presets_create_metabox hook.
	 *
	 * @hooked presets_core_user_create_metabox
	 * @hooked presets_core_general_settings_metabox
	 * @hooked presets_core_plugins_create_metabox
	 */
	do_action( 'presets_create_metabox' );

}

add_action( 'cmb2_admin_init', 'presets_options' );
