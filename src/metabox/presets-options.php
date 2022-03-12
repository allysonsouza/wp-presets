<?php

/**
 * Adding 'cmb2' vendor.
 * https://github.com/CMB2/CMB2
 */
if ( file_exists( dirname( __FILE__ ) . '/../../vendors/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/../../vendors/cmb2/init.php';
}

include_once plugin_dir_path( __FILE__ ) . 'core/general-settings.php';

/**
 * Create metabox.
 */
function presets_options() {

	$prefix = 'presets_';
	$prefix_meta = 'presets_core_general_settings_';

	$cmb = new_cmb2_box(
		array(
			'id'           => 'metabox_wiki_test_repeat_group',
			'title'        => __( 'Generates reusable form entries', 'presets' ),
			'object_types' => array( 'presets' ), // Post type
			'context'      => 'normal',
			'priority'     => 'high',
		)
	);

	$group_field_id = $cmb->add_field( array(
		'id'          => 'wiki_test_repeat_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'       => __( 'Entry {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
			'add_button'        => __( 'Add Another Entry', 'cmb2' ),
			'remove_button'     => __( 'Remove Entry', 'cmb2' ),
			'sortable'          => true,
			// 'closed'         => true, // true to have the groups closed by default
			// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
		),
	) );

	$group_field_id = $cmb->add_field( array(
		'id'          => 'wiki_test_repeat_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'       => __( 'Entry {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
			'add_button'        => __( 'Add Another Entry', 'cmb2' ),
			'remove_button'     => __( 'Remove Entry', 'cmb2' ),
			'sortable'          => true,
			// 'closed'         => true, // true to have the groups closed by default
			// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
		),
	) );

	$cmb->add_group_field( $group_field_id,
		array(
			'name'             => __( 'Action', 'presets' ),
			'id'               => 'action_type',
			'type'             => 'select',
			'show_option_none' => ' ',
			'default'          => 'custom',
			'options'          => array(
				'core-general-settings' => __( 'Core - General Settings', 'presets' ),
				'abc' => __( 'Abc', 'presets' ),
			),
			'classes' => 'preset-action-options',
		)
	);

	$cmb->add_group_field( $group_field_id,
		array(
			'name' => __( 'Site Title', 'presets' ),
			'id'   => $prefix_meta . 'blogname',
			'type' => 'text',
			'classes' => 'core-general-settings hide',
		)
	);

	$cmb->add_group_field( $group_field_id,
		array(
			'name' => __( 'Tagline', 'presets' ),
			'id'   => $prefix_meta . 'blogdescription',
			'type' => 'text',
			'classes' => 'core-general-settings hide',
		)
	);

	$cmb->add_group_field( $group_field_id,
		array(
			'name' => __( 'Administration Email Address', 'presets' ),
			'id'   => $prefix_meta . 'admin_email',
			'type' => 'text_email',
			'classes' => 'core-general-settings hide',
		)
	);

	$cmb->add_group_field( $group_field_id,
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
			'classes' => 'core-general-settings hide',
		)
	);

	$cmb->add_group_field( $group_field_id,
		array(
			'name'             => __( 'Site Language', 'presets' ),
			'id'               => $prefix_meta . 'WPLANG',
			'type'             => 'select',
			'show_option_none' => ' ',
			'default'          => 'custom',
			'options'          => presets_core_general_settings_language_options(),
			'classes' => 'core-general-settings hide',
		)
	);
	
	/**
	 * presets_create_metabox hook.
	 */
	do_action( 'presets_create_metabox' );

}

add_action( 'cmb2_admin_init', 'presets_options' );
