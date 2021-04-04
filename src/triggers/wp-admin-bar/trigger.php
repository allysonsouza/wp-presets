<?php

add_action( 'muplugins_loaded', 'wppresets_query' );

function wppresets_admin_bar_item( WP_Admin_Bar $admin_bar ) {

	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$admin_bar->add_menu(
		array(
			'id'     => 'presets-trigger',
			'parent' => null,
			'group'  => null,
			'title'  => 'Presets', // you can use img tag with image link. it will show the image icon Instead of the title.
			'href'   => admin_url( 'edit.php?post_type=wppresets' ),
			'meta'   => array(
				'title' => __( 'Presets', 'textdomain' ), // This title will show on hover.
			),
		)
	);

	$presets_ids = get_posts(
		array(
			'fields'         => 'ids',
			'posts_per_page' => -1,
			'post_type'      => 'wppresets',
		)
	);

	foreach ( $presets_ids as $id ) {

		$admin_bar->add_menu(
			array(
				'id'     => 'presets-trigger_' . $id,
				'parent' => 'presets-trigger',
				'group'  => null,
				'title'  => get_the_title( $id ), // you can use img tag with image link. it will show the image icon Instead of the title.
				'href'   => admin_url( 'edit.php?post_type=wppresets&wppresets-trigger=' . $id ),
				'meta'   => array(
					'title' => get_the_title( $id ), // This title will show on hover.
				),
			)
		);

	}

}

add_action( 'admin_bar_menu', 'wppresets_admin_bar_item', 100 );
