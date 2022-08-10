<?php

namespace Presets\Modules\Core;

use Presets\Actions\ActionBase;

class GeneralSettings extends ActionBase {

	/**
	 * Get all the language options avaliable on WordPress and return a formated array.
	 * 
	 * @return array $options  Array of language with the language slug as the key and the language name as the value.
	 */
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

	/**
	 * Create fields for selecting the language to activate.
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
				'name'    => __( 'Site Title', 'presets' ),
				'id'      => $this->prefix . 'blogname',
				'type'    => 'text',
				'classes' => $this->field_element_classes,
			)
		);

		$metabox->add_group_field( $group,
			array(
				'name'    => __( 'Tagline', 'presets' ),
				'id'      => $this->prefix . 'blogdescription',
				'type'    => 'text',
				'classes' => $this->field_element_classes,
			)
		);

		$metabox->add_group_field( $group,
			array(
			'name'    => __( 'Administration Email Address', 'presets' ),
			'id'      => $this->prefix . 'admin_email',
			'type'    => 'text_email',
			'classes' => $this->field_element_classes,
		)
		);

		$metabox->add_group_field( $group,
			array(
				'name'             => __( 'Anyone can register', 'presets' ),
				'id'               => $this->prefix . 'users_can_register',
				'type'             => 'select',
				'show_option_none' => ' ',
				'default'          => 'custom',
				'options'          => array(
					0 => __( 'No', 'presets' ),
					1 => __( 'Yes', 'presets' ),
				),
				'classes'          => $this->field_element_classes,
			)
		);

		$metabox->add_group_field( $group,
			array(
				'name'             => __( 'Site Language', 'presets' ),
				'id'               => $this->prefix . 'WPLANG',
				'type'             => 'select',
				'show_option_none' => ' ',
				'default'          => 'custom',
				'options'          => $this->languageOptions(),
				'classes'          => $this->field_element_classes,
			)
		);

	}

	/**
	 * Save fields.
	 * 
	 * @param  array $entry Preset entry with action type and action data.
	 * 
	 * @return void
	 */
	public function applyAction($entry) {

		$fields = array(
			'blogname',
			'blogdescription',
			'admin_email',
			'users_can_register',
			'WPLANG',
		);
	
		foreach ( $fields as $field ) {

			if ( empty($entry[$this->prefix . $field])) {
				continue;
			}
		
			if ( array_key_exists( $this->prefix . $field, $entry ) ) {
		
				// Download the lang pack first if the site language is not yet installed.
				if ( 'WPLANG' === $field ) {
	
					if ( 'en_US' === $entry[$this->prefix . 'WPLANG'] ) {
						update_option( $field, '' );
					} else {
						wp_download_language_pack( $entry[$this->prefix . 'WPLANG'] );
						update_option( $field, $entry[$this->prefix . 'WPLANG'] );
					}
				
				} else {
					update_option( $field, $entry[$this->prefix . $field] );
				}
			}
		}
	}
}