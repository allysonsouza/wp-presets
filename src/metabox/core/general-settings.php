<?php

function presets_core_general_settings_language_options() {

	require_once ABSPATH . 'wp-admin/includes/translation-install.php';

	$translations = wp_get_available_translations();

	$options = array();

	$options['en_US'] = 'Default - English (United States)';

	foreach ( $translations as $translation_id => $translation_meta ) {

		$options[ $translation_id ] = $translation_meta['english_name'];

	}

	return $options;
}

function presets_core_general_settings_metabox() {

	$prefix_meta = 'presets_core_general_settings_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box(
		array(
			'id'           => $prefix_meta . 'metabox',
			'title'        => __( '[Core] General Settings', 'presets' ),
			'object_types' => array( 'presets' ), // Post type
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
		)
	);

	$cmb->add_field(
		array(
			'name' => __( 'Site Title', 'presets' ),
			'id'   => $prefix_meta . 'blogname',
			'type' => 'text',
		)
	);

	$cmb->add_field(
		array(
			'name' => __( 'Tagline', 'presets' ),
			'id'   => $prefix_meta . 'blogdescription',
			'type' => 'text',
		)
	);

	$cmb->add_field(
		array(
			'name' => __( 'Administration Email Address', 'presets' ),
			'id'   => $prefix_meta . 'admin_email',
			'type' => 'text_email',
		)
	);

	$cmb->add_field(
		array(
			'name'             => __( 'Anyone can register', 'presets' ),
			'id'               => $prefix_meta . 'users_can_register',
			'type'             => 'select',
			'show_option_none' => ' ',
			'default'          => 'custom',
			'options'          => array(
				0 => __( 'No', 'presets' ),
				1 => __( 'Yes', 'presets' ),
			),
		)
	);

	$cmb->add_field(
		array(
			'name'             => __( 'Site Language', 'presets' ),
			'id'               => $prefix_meta . 'WPLANG',
			'type'             => 'select',
			'show_option_none' => ' ',
			'default'          => 'custom',
			'options'          => presets_core_general_settings_language_options(),
		)
	);
}

add_action( 'presets_create_metabox', 'presets_core_general_settings_metabox' );
