<?php

function apply_presets() {

    if ( isset( $_GET['wppresets-trigger'] ) && current_user_can( 'manage_options' ) ) {
        
        include_once plugin_dir_path( __FILE__ ) . 'core/user.php';

        function wppresets_admin_notice__success() {
            ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e( 'Done! ', 'wppresets' ); ?></p>
            </div>
            <?php
        }
        add_action( 'admin_notices', 'wppresets_admin_notice__success' );
    }

}

add_action( 'admin_footer', 'apply_presets' );