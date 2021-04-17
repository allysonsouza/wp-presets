<?php

include_once plugin_dir_path( __FILE__ ) . 'wp-admin-bar/trigger.php';

function presets_get_ids() {

	return get_posts(
		array(
			'fields'         => 'ids',
			'posts_per_page' => -1,
			'post_type'      => 'presets',
		)
	);

}

function presets_get_current_url( $id ) {

	return add_query_arg( 'presets-trigger', $id, $_SERVER['REQUEST_URI'] );

}
