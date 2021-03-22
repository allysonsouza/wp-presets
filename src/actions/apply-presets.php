<?php

include_once plugin_dir_path( __FILE__ ) . 'core/user.php';

function get_presets_meta( $prefix , $field ) {
    $selected_presets_id = $_GET['wppresets-trigger'];
    
    return get_post_meta( $selected_presets_id, 'wppresets_' . $prefix . $field, true );
}

function wppresets_admin_notice__success() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Done! ', 'wppresets' ); ?></p>
    </div>
    <?php
}

function apply_presets() {

    if ( isset( $_GET['wppresets-trigger'] ) && current_user_can( 'manage_options' ) ) {
        
        wppresets_core_user_apply_meta();

        add_action( 'admin_notices', 'wppresets_admin_notice__success' );

    }

}

add_action( 'admin_head', 'apply_presets' );