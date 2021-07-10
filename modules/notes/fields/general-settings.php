<?php

function presets_modules_notes_general_settings_metabox() {

	$prefix_meta = 'presets_modules_notes_general_settings_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box(
		array(
			'id'           => $prefix_meta . 'metabox',
			'title'        => __( 'Notes', 'presets' ),
			'object_types' => array( 'presets' ), // Post type
			'context'      => 'normal',
			'priority'     => 'low',
			'show_names'   => true, // Show field names on the left
		)
	);

	$cmb->add_field(
		array(
			'name' => __( 'Notes', 'notes' ),
			'id'   => $prefix_meta . 'notes',
			'type' => 'wysiwyg',
		)
	);

}

add_action( 'presets_create_metabox', 'presets_modules_notes_general_settings_metabox' );
