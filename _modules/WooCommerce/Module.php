<?php

namespace Presets\Modules\WooCommerce;

class Module {

	public function __construct() {
		add_action( 'init', [ $this, 'presets_module_woocommerce_activate' ] );
	}

	public function presets_module_woocommerce_activate() {
		if ( class_exists( '\woocommerce' ) ) {
			new GeneralSettings;
		}
	}
}
