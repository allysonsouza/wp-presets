<?php

function presets_module_core_activate() {

	require_once plugin_dir_path( __FILE__ ) . 'GeneralSettings.php';

}

add_action( 'init', 'presets_module_core_activate' );
