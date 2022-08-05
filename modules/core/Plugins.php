<?php

use Presets\Actions\ActionBase;

class CorePlugins extends ActionBase {

	/**
	 * Get all the installed plugins and return a formated array.
	 * 
	 * @return array $avaliable_plugins Array of plugins with the plugin slug as the key and the plugin name as the value.
	 */
	private function getAvaliablePlugins() {

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
	
		$plugins = get_plugins(); // All installed plugins.
	
		$avaliable_plugins = array(); // Plugins that can be activated.
	
		foreach ( $plugins as $plugin => $meta ) {
	
		//	if ( presets_plugin_filename() !== $plugin && ! in_array( $plugin, presets_get_option_skipped_plugins(), true ) ) {
				$avaliable_plugins[ $plugin ] = $meta['Name'];
	//		}
		}
	
		return $avaliable_plugins;
	
	}

	/**
	 * Create fields for selecting the plugins to activate/deactivate.
	 * 
	 * @param  object $metabox The CMB2 metabox object.
	 * @param  string $group    The slug of the repeater group with all the fields.
	 * 
	 * @return void
	 */
	public function createFields($metabox, $group) {

		$classes = $this->slug . ' hide';

		$metabox->add_group_field( 
			$group,
			array(
				'name'    => __( 'Deactivate Plugins', 'presets' ),
				'desc'    => __( 'Select the plugins that should get deactivated when this preset gets triggered.', 'presets' ),
				'id'      => $this->slug . '_deactivate',
				'type'    => 'multicheck',
				'options' => $this->getAvaliablePlugins(),
				'classes' => $classes,
			),
		);

		$metabox->add_group_field( 
			$group,
			array(
				'name'    => __( 'Activate Plugins', 'presets' ),
				'desc'    => __( 'Select the plugins that should get activated when this preset gets triggered.', 'presets' ),
				'id'      => $this->slug . '_activate',
				'type'    => 'multicheck',
				'options' => $this->getAvaliablePlugins(),
				'classes' => $classes,
			),
		);

	}

	/**
	 * Deactivate the selected plugins.
	 */
	function deactivatePlugins() {

		// The Presets plugin, the plugins that were skipped on the plugins settings, and the plugins that were selected to be activated should be skipped on the filter as default.
		// $skip_deactivate_plugins = array_merge( array( presets_plugin_filename() ), presets_selected_plugins(), presets_get_option_skipped_plugins() );

		// Deactivate only the ones that are currenly activated.
		$deactivate_plugins = array_diff( get_option( 'active_plugins' ), $skip_deactivate_plugins );

		deactivate_plugins( $deactivate_plugins );

	}

	/**
	 * Activate/Deactivate plugins.
	 * 
	 * @param  int $id The preset post ID.
	 */
	public function applyAction($id) {

		$entries = get_post_meta( $id, 'preset_actions_repeat_group', true ); // Get all the entries values for this post ID.

		foreach ( (array) $entries as $entry ) {
			
			if ( empty( $entry['action_type'] ) || $entry['action_type'] != $this->slug ) {
				return;
			}

			$prefix = $this->slug . "_";

			// Action fields slugs.
			$fields = array(
				'activate',
				'deactivate',
			);
		
			// Loop through all the fields and activate/deactivate the plugins.
			foreach ( $fields as $field ) {

				if (empty($entry[$prefix . $field])) {
					continue;
				}
			
				if ( array_key_exists( $prefix . $field, $entry ) ) {

					if ( 'activate' === $field ) {
						activate_plugins( $entry[$prefix . $field] );
					}
						
					if ( 'deactivate' === $field ) {
						deactivate_plugins( $entry[$prefix . $field] );
					}
				}
			}
		}
	}
}

$obj = new CorePlugins(
	'core-plugins',
	__( '[Core] Plugins', 'presets' ),
	__( 'Plugins to activate/deactivate for WordPress', 'presets' )
);