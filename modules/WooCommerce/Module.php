<?php

namespace Presets\Modules\WooCommerce;

class Module {

	public function __construct() {
		add_action( 'init', [ $this, 'presets_module_woocommerce_activate' ] );
	}

	/**
	 * Instantiate the module actions if WooCommerce plugin is activated.
	 * 
	 * @return void
	 */
	public function presets_module_woocommerce_activate() {
		if ( class_exists( '\woocommerce' ) ) {
			new GeneralSettings(
				'woocommerce-general-settings',
				__( '[WooCommerce] General Settings', 'presets' ),
				__( 'General settings for WooCommerce', 'presets' )
			);
		}
	}
}
