<?php

function get_countries_states_list() {

	$wc_countries = new WC_Countries();

	$countries = $wc_countries->get_countries();

	$countries_states_list = array();

	foreach ( $countries as $country_id => $country_value ) {

		$states = $wc_countries->get_states( $country_id );

		if ( false === $states || array() === $states ) {

			$countries_states_list[ $country_id ] = $country_value;

		} else {

			foreach ( $states as $state_id => $state_value ) {

				$countries_states_list[ $country_id . ':' . $state_id ] = $country_value . ' - ' . $state_value;

			}
		}
	}

	return $countries_states_list;

}

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
			'name' => __( 'Address line 1', 'woocommerce' ),
			'id'   => $prefix_meta . 'woocommerce_store_address',
			'type' => 'text',
		)
	);

	$cmb->add_field(
		array(
			'name' => __( 'Address line 2', 'woocommerce' ),
			'id'   => $prefix_meta . 'woocommerce_store_address_2',
			'type' => 'text',
		)
	);

	$cmb->add_field(
		array(
			'name' => __( 'City', 'woocommerce' ),
			'id'   => $prefix_meta . 'woocommerce_store_city',
			'type' => 'text',
		)
	);

	$cmb->add_field(
		array(
			'name'             => __( 'Country / State', 'woocommerce' ),
			'id'               => $prefix_meta . 'woocommerce_default_country',
			'type'             => 'select',
			'show_option_none' => ' ',
			'default'          => 'custom',
			'options'          => get_countries_states_list(),
		)
	);

	$cmb->add_field(
		array(
			'name' => __( 'Postcode / ZIP', 'woocommerce' ),
			'id'   => $prefix_meta . 'woocommerce_store_postcode',
			'type' => 'text',
		)
	);
}

add_action( 'presets_create_metabox', 'presets_modules_woocommerce_general_settings_metabox' );
