<?php

function presets_modules_notes_general_settings_actions() {

	$prefix = 'modules_notes_general_settings_';

	$preset_id = filter_var( $_GET['presets-applied'], FILTER_SANITIZE_NUMBER_INT );

	echo wpautop( get_post_meta( $preset_id, 'presets_' . $prefix . 'notes', true ) );

}

add_action( 'presets_admin_notice_sucess', 'presets_modules_notes_general_settings_actions' );
