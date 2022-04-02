<?php

class GeneralSettings {

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

		$prefix = $this->getInfo('slug');

		$fields = array(
			'woocommerce_store_address',
			'woocommerce_store_address_2',
			'woocommerce_store_city',
			'woocommerce_default_country',
			'woocommerce_store_postcode',
			'woocommerce_currency',
			'woocommerce_currency_pos',
			'woocommerce_price_thousand_sep',
			'woocommerce_price_decimal_sep',
			'woocommerce_price_num_decimals',
		);

		foreach ( $fields as $field ) {

			$meta = get_presets_meta( $prefix, $field );

			if ( array_key_exists( 'presets_' . $prefix . $field, get_presets_meta() ) ) {

				update_option( $field, $meta );

			}
		}
	}

	public function createSelectOption($actions) {
		$actions[$this->slug] = $this->name;
		return $actions;
	}
}

$obj = new GeneralSettings(
	'core-general-settings_2',
	__( '[Core] General Settings 2', 'presets' ),
	__( 'General settings for the site', 'presets' )
);