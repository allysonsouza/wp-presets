<?php

function presets_modules_woocommerce_general_settings_actions() {

	$prefix = 'modules_woocommerce_general_settings_';

	$fields = array(
		'woocommerce_store_address',
		'woocommerce_store_address_2',
		'woocommerce_store_city',
		'woocommerce_default_country',
		'woocommerce_store_postcode',
	);

	foreach ( $fields as $field ) {

		$meta = get_presets_meta( $prefix, $field );

		if ( ! empty( $meta ) ) {

			update_option( $field, $meta );

		}
	}

}

add_action( 'presets_apply_meta', 'presets_modules_woocommerce_general_settings_actions' );
