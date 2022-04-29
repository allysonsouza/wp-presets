<?php

class CoreGeneralSettings extends ActionBase {

	private function languageOptions() {

		require_once ABSPATH . 'wp-admin/includes/translation-install.php';
	
		$translations = wp_get_available_translations();
	
		$options = array();
	
		$options['en_US'] = 'English (United States)';
	
		foreach ( $translations as $translation_id => $translation_meta ) {
	
			$options[ $translation_id ] = $translation_meta['english_name'];
	
		}
		
		asort($options);

		return $options;

	}

	public function createFields($metabox, $group) {

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
		
						wp_download_language_pack( $entry[$prefix . 'WPLANG'] );
		
					}
		
					if ( 'en_US' === $entry[$prefix . 'WPLANG'] && 'WPLANG' === $field ) {
		
						update_option( $field, '' );
		
					} else {
		
						update_option( $field, $entry[$prefix . $field] );
		
					}
				}
			}
		}
	}
}

$obj = new CoreGeneralSettings(
	'core-general-settings',
	__( '[Core] General Settings ABC', 'presets' ),
	__( 'General settings for the site', 'presets' )
);