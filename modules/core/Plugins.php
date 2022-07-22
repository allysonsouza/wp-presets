<?php

class Plugins extends ActionBase {

	private function getAvaliablePlugins() {

		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
	
		$plugins = get_plugins(); // All installed plugins.
	
		$avaliable_plugins = array(); // Plugins that can be activated.
	
		foreach ( $plugins as $plugin => $meta ) {
	
			if ( presets_plugin_filename() !== $plugin && ! in_array( $plugin, presets_get_option_skipped_plugins(), true ) ) {
				$avaliable_plugins[ $plugin ] = $meta['Name'];
			}
		}
	
		return $avaliable_plugins;
	
	}

	public function createFields($metabox, $group) {


	$prefix_meta = 'presets_core_plugins_';

	/**
	 * Initiate the metabox
	 */

	$cmb = new_cmb2_box(
		array(
			'id'           => $prefix_meta . 'metabox',
			'title'        => __( 'Installed plugins', 'presets' ),
			'object_types' => array( 'presets' ), // Post type
			'context'      => 'normal',
			'priority'     => 'low',
			'show_names'   => true, // Show field names on the left
		)
	);

	$cmb->add_field(
		array(
			'name'    => __( 'Activate Plugins', 'presets' ),
			'desc'    => __( 'Select the plugins that should get activated when this preset gets triggered. If the plugin is not selected, it is going to be deactivated. You are able to <a href="edit.php?post_type=presets&page=presets_advanced_settings">skip specific plugins from being deactivated/activated on the plugin settings</a>.', 'presets' ),
			'id'      => $prefix_meta . 'activate',
			'type'    => 'multicheck',
			'options' => presets_get_avaliable_plugins(),
		),
	);

		$classes = $this->slug . ' hide';

		$metabox->add_group_field( 
			$group,
			array(
			'name' => __( 'Site Title', 'presets' ),
			'id'   => $this->slug . '_blogname',
			'type' => 'text',
			'classes' => $classes,
			)
		);

		$metabox->add_group_field( $group,
			array(
				'name' => __( 'Tagline', 'presets' ),
				'id'   => $this->slug . '_blogdescription',
				'type' => 'text',
				'classes' => $classes,
			)
		);

		$metabox->add_group_field( $group,
			array(
			'name' => __( 'Administration Email Address', 'presets' ),
			'id'   => $this->slug . '_admin_email',
			'type' => 'text_email',
			'classes' => $classes,
		)
		);

		$metabox->add_group_field( $group,
			array(
			'name'             => __( 'Anyone can register', 'presets' ),
			'id'               => $this->slug . '_users_can_register',
			'type'             => 'select',
			'show_option_none' => ' ',
			'default'          => 'custom',
			'options'          => array(
				0 => __( 'No', 'presets' ),
				1 => __( 'Yes', 'presets' ),
			),
			'classes' => $classes,
		)
		);

		$metabox->add_group_field( $group,
			array(
			'name'             => __( 'Site Language', 'presets' ),
			'id'               => $this->slug . '_WPLANG',
			'type'             => 'select',
			'show_option_none' => ' ',
			'default'          => 'custom',
			'options'          => $this->languageOptions(),
			'classes' => $classes,
		)
		);

	}

	public function applyAction($id) {

		$entries = get_post_meta( $id, 'preset_actions_repeat_group', true );

		error_log(print_r($entries, true));

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

$obj = new CoreGeneralSettings(
	'core-plugins',
	__( '[Core] Plugins', 'presets' ),
	__( 'Plugins to activate/deactivate for the site', 'presets' )
);