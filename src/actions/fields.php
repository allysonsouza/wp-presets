<?php

/**
 * Adding 'cmb2' vendor.
 * https://github.com/CMB2/CMB2
 */
if ( file_exists( dirname( __FILE__ ) . '/../../vendors/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/../../vendors/cmb2/init.php';
}

/**
 * Create metabox.
 */
function presets_options() {

	$metabox = new_cmb2_box(
		array(
			'id'           => 'metabox_presets_actions',
			'title'        => __( 'Generates reusable form entries', 'presets' ),
			'object_types' => array( 'presets' ), // Post type
			'context'      => 'normal',
			'priority'     => 'high',
		)
	);

	$group = $metabox->add_field( array(
		'id'          => 'preset_actions_repeat_group',
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

	$metabox->add_group_field( $group,
		array(
			'name'             => __( 'Action', 'presets' ),
			'id'               => 'action_type',
			'type'             => 'select',
			'show_option_none' => ' ',
			'default'          => 'custom',
			'options'          => apply_filters( 
				'presets_action_select', 
				array(
					'abc' => __( 'Abc', 'presets' ),
				)
			),
			'classes' => 'preset-action-options',
		)
	);
	
	/**
	 * presets_create_metabox hook.
	 */
	do_action( 'presets_create_metabox', $metabox, $group );

}

add_action( 'cmb2_admin_init', 'presets_options' );
