<?php

function presets_core_general_settings_apply_meta() {

	$prefix = 'core_general_settings_';

	$fields = array(
		'blogname',
		'blogdescription',
		'admin_email',
		'users_can_register',
		'WPLANG',
	);

	function testing() {
		return 'pt_br';
	}

	foreach ( $fields as $field ) {

		$meta = get_presets_meta( $prefix, $field );

		if ( ! empty( $meta ) ) {

			update_option( $field, $meta );

		}
	}

}

add_action( 'presets_apply_meta', 'presets_core_general_settings_apply_meta' );
