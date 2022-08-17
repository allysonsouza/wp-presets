<?php

namespace Presets\Modules\Core;

class Module {
	public function __construct() {
		add_action('init', [ $this, 'presetsModuleCoreActivate' ]);
	}

	/**
	 * Instantiate the module actions.
	 *
	 * @return void
	 */
	public function presetsModuleCoreActivate() {

		new GeneralSettings(
			'core-general-settings',
			__('[Core] General Settings', 'presets'),
			__('General settings for the site', 'presets')
		);

		new Plugins(
			'core-plugins',
			__('[Core] Plugins', 'presets'),
			__('Plugins to activate/deactivate for WordPress', 'presets')
		);
	}
}
