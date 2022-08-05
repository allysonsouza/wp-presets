<?php

namespace Presets\Modules\Core;

class Module {

	public function __construct() {
		add_action( 'init', [ $this, 'presets_module_core_activate' ] );
	}

	public function presets_module_core_activate() {

		new GeneralSettings(
			'core-general-settings',
			__( '[Core] General Settings', 'presets' ),
			__( 'General settings for the site', 'presets' )
		);

		new Plugins(
			'core-plugins',
			__( '[Core] Plugins', 'presets' ),
			__( 'Plugins to activate/deactivate for WordPress', 'presets' )
		);

	}
}