<?php


function wppresets_admin_bar_item ( WP_Admin_Bar $admin_bar ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    $admin_bar->add_menu( array(
        'id'    => 'presets-trigger',
        'parent' => null,
        'group'  => null,
        'title' => 'Presets', //you can use img tag with image link. it will show the image icon Instead of the title.
        'href'  => admin_url('edit.php?post_type=wppresets'),
        'meta' => [
            'title' => __( 'Presets', 'textdomain' ), //This title will show on hover
        ]
    ) );

    $args = array(
        'post_type'              => array( 'wppresets' ),
        'post_status'            => array( 'publish' ),
    );

    $presets = new WP_Query( $args );

	if ( $presets->have_posts() ) :
		while ( $presets->have_posts() ) :
			$presets->the_post();

            $admin_bar->add_menu( array(
                'id'    => 'presets-trigger_' . get_the_ID(),
                'parent' => 'presets-trigger',
                'group'  => null,
                'title' => get_the_title(), //you can use img tag with image link. it will show the image icon Instead of the title.
                'href'  => admin_url( 'edit.php?post_type=wppresets&wppresets-trigger=' . get_the_ID() ),
                'meta' => [
                    'title' => get_the_title(), //This title will show on hover
                ]
            ) );
        
		endwhile;
        wp_reset_query();
	endif;


}
add_action( 'admin_bar_render', 'wppresets_admin_bar_item', 100 );