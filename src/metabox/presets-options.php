<?php

/**
 * Adding 'cmb2' vendor
 */
if ( file_exists( dirname( __FILE__ ) . '/../../vendors/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/../../vendors/cmb2/init.php';
}

function presets_options() {

	$prefix = 'presets_';

	include_once plugin_dir_path( __FILE__ ) . 'core/user.php';

}

add_action( 'cmb2_admin_init', 'presets_options' );
