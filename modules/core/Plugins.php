<?php

class CorePlugins extends ActionBase {

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

	public function createFields($metabox, $group) {

		$classes = $this->slug . ' hide';

		/**
		 * Initiate the metabox
		 */

		$metabox->add_group_field( 
			$group,
			array(
				'name'    => __( 'Deactivate Plugins', 'presets' ),
				'desc'    => __( 'Select the plugins that should get deactivated when this preset gets triggered.', 'presets' ),
				'id'      => $this->slug . 'deactivate',
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
				'id'      => $this->slug . 'activate',
				'type'    => 'multicheck',
				'options' => $this->getAvaliablePlugins(),
				'classes' => $classes,
			),
		);

	}

	public function applyAction($id) {

		$entries = get_post_meta( $id, 'preset_actions_repeat_group', true );

		foreach ( (array) $entries as $key => $entry ) {
			
			if ( empty( $entry['action_type'] ) ) {
				return;
			}
			if ( $entry['action_type'] != $this->slug ) {
				return;
			}

			$prefix = $this->slug . "_";

			$fields = array(
				'blogname',
				'blogdescription',
				'admin_email',
				'users_can_register',
				'WPLANG',
			);
		
			foreach ( $fields as $field ) {

				if ( empty($entry[$prefix . $field])) {
					continue;
				}
			
				if ( array_key_exists( $prefix . $field, $entry ) ) {
			
					// Download the lang pack first if the site language is not yet installed.
					if ( 'WPLANG' === $field ) {
		
						if ( 'en_US' === $entry[$prefix . 'WPLANG'] ) {
		
							update_option( $field, '' );

						} else {
				
							wp_download_language_pack( $entry[$prefix . 'WPLANG'] );
							update_option( $field, $entry[$prefix . 'WPLANG'] );

						}
					
					} else {

						update_option( $field, $entry[$prefix . $field] );
		
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