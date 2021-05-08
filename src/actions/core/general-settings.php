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

add_action( 'presets_apply_meta', 'presets_core_general_settings_apply_meta' );
