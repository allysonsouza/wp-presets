<?php

function presets_module_woocommerce_activate() {

	if ( class_exists( 'woocommerce' ) ) {

		require_once plugin_dir_path( __FILE__ ) . 'GeneralSettings.php';

	}

}

add_action( 'init', 'presets_module_woocommerce_activate' );