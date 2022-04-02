<?php

class CoreGeneralSettings {

	public $slug;
	public $name;
	public $description;

	/**
     * Constructor
     */
    public function __construct($slug, $name, $description) {
        add_action( 'presets_create_metabox', array( $this, 'createFields' ), 10, 2 );
		add_action( 'presets_apply_meta', array( $this, 'createAction' ) );
		add_filter( 'presets_action_select', array( $this, 'createSelectOption' ), 10, 1 );

		$this->slug = $slug;
		$this->name = $name;
		$this->description = $description;
    }

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

		$metabox->add_group_field( $group,
			array(
			'name' => __( 'Site Title', 'presets' ),
			'id'   => $this->slug . 'blogname',
			'type' => 'text',
			'classes' => $classes,
			)
		);

		$metabox->add_group_field( $group,
			array(
				'name' => __( 'Tagline', 'presets' ),
				'id'   => $this->slug . 'blogdescription',
				'type' => 'text',
				'classes' => $classes,
			)
		);

		$metabox->add_group_field( $group,
			array(
			'name' => __( 'Administration Email Address', 'presets' ),
			'id'   => $this->slug . 'admin_email',
			'type' => 'text_email',
			'classes' => $classes,
		)
		);

		$metabox->add_group_field( $group,
			array(
			'name'             => __( 'Anyone can register', 'presets' ),
			'id'               => $this->slug . 'users_can_register',
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
			'id'               => $this->slug . 'WPLANG',
			'type'             => 'select',
			'show_option_none' => ' ',
			'default'          => 'custom',
			'options'          => $this->languageOptions(),
			'classes' => $classes,
		)
		);

	}

	public function createAction() {

		$prefix = 'core_general_settings_';

		$fields = array(
			'blogname',
			'blogdescription',
			'admin_email',
			'users_can_register',
			'WPLANG',
		);
	
		foreach ( $fields as $field ) {
	
			$meta = get_presets_meta( $prefix, $field );
	
			if ( array_key_exists( 'presets_' . $prefix . $field, get_presets_meta() ) ) {
	
				// Download the lang pack first if the site language is not yet installed.
				if ( 'WPLANG' === $field ) {
	
					wp_download_language_pack( $meta );
	
				}
	
				if ( 'en_US' === $meta && 'WPLANG' === $field ) {
	
					update_option( $field, '' );
	
				} else {
	
					update_option( $field, $meta );
	
				}
			}
		}
	}

	public function createSelectOption($actions) {
		$actions[$this->slug] = $this->name;
		return $actions;
	}
}

$obj = new CoreGeneralSettings(
	'core-general-settings',
	__( '[Core] General Settings', 'presets' ),
	__( 'General settings for the site', 'presets' )
);