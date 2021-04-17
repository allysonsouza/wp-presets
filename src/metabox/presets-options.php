<?php

/**
 * Adding 'cmb2' vendor.
 */
if ( file_exists( dirname( __FILE__ ) . '/../../vendors/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/../../vendors/cmb2/init.php';
}


include_once plugin_dir_path( __FILE__ ) . 'core/user.php';
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
	 * @hooked presets_core_plugins_create_metabox
	 */
	do_action( 'presets_create_metabox' );

}

add_action( 'cmb2_admin_init', 'presets_options' );
