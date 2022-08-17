<?php

namespace Presets\Modules;

use Presets\Modules\Core;
use Presets\Modules\WooCommerce;

class LoadModules {
	public function __construct() {
		new Core\Module();
		new WooCommerce\Module();
	}
}
