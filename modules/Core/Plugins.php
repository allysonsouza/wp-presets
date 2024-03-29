<?php

namespace Presets\Modules\Core;

use Presets\Actions\ActionBase;

class Plugins extends ActionBase {
	/**
	 * Get all the installed plugins and return a formated array.
	 *
	 * @return array $avaliable_plugins Array of plugins with the plugin slug as the key and the plugin name as the value.
	 */
	private function getAvaliablePlugins() {

		if (! function_exists('get_plugins')) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$plugins = get_plugins(); // All installed plugins.

		$avaliable_plugins = array(); // Plugins that can be activated.

		foreach ($plugins as $plugin => $meta) {
			if (presets_plugin_filename() !== $plugin) {
				$avaliable_plugins[ $plugin ] = $meta['Name'];
			}
		}

		return $avaliable_plugins;
	}

	/**
	 * Create fields for selecting the plugins to activate/deactivate.
	 *
	 * @param  object $metabox The CMB2 metabox object.
	 * @param  string $group    The slug of the repeater group that has all the fields.
	 *
	 * @return void
	 */
	public function createFields($metabox, $group) {

		$metabox->add_group_field(
			$group,
			array(
				'name'    => __('Deactivate Plugins', 'presets'),
				'desc'    => __('Select the plugins that should get deactivated when this preset gets triggered.', 'presets'),
				'id'      => $this->fieldID('deactivate'),
				'type'    => 'multicheck',
				'options' => $this->getAvaliablePlugins(),
				'classes' => $this->field_classes,
			),
		);

		$metabox->add_group_field(
			$group,
			array(
				'name'    => __('Activate Plugins', 'presets'),
				'desc'    => __('Select the plugins that should get activated when this preset gets triggered.', 'presets'),
				'id'      => $this->fieldID('activate'),
				'type'    => 'multicheck',
				'options' => $this->getAvaliablePlugins(),
				'classes' => $this->field_classes,
			),
		);
	}

	/**
	 * Activate/Deactivate plugins.
	 *
	 * @param  array $entry Preset entry with action type and action data.
	 *
	 * @return void
	 */
	public function applyAction($entry) {

		// Loop through all the fields and activate/deactivate the plugins.
		foreach ($this->fields as $field) {
			if (empty($entry[$this->prefix . $field])) {
				continue;
			}

			if (array_key_exists($this->prefix . $field, $entry)) {
				if ('activate' === $field) {
					activate_plugins($entry[$this->prefix . $field]);
				}

				if ('deactivate' === $field) {
					deactivate_plugins($entry[$this->prefix . $field]);
				}
			}
		}
	}
}
