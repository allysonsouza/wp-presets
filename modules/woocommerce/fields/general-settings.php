<?php

function presets_modules_woocommerce_general_settings_metabox() {

	$prefix_meta = 'presets_modules_woocommerce_general_settings_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box(
		array(
			'id'           => $prefix_meta . 'metabox',
			'title'        => __( '[WooCommerce] General Settings', 'presets' ),
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
			'name' => __( 'Address Line 1', 'presets' ),
			'id'   => $prefix_meta . 'woocommerce_store_address',
			'type' => 'text',
		)
	);

}

add_action( 'presets_create_metabox', 'presets_modules_woocommerce_general_settings_metabox' );
