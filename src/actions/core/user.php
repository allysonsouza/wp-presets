<?php


function get_presets_meta($field) {
    $selected_presets_id = $_GET['wppresets-trigger'];
    //$field_value = get_post_meta( $selected_presets_id, "wppresets_core_user_$field" )[0];
    if ( isset( get_post_meta( $selected_presets_id, "wppresets_core_user_$field" )[0] ) ) {
        return get_post_meta( $selected_presets_id, "wppresets_core_user_$field" )[0];
    } else {
        return 'Blank';
    }
}


$userdata = array(
    'ID'                    => get_current_user_id(),    //(int) User ID. If supplied, the user will be updated.
    //'user_url'              => get_presets_meta( 'user_url' ),   //(string) The user URL.
    //'user_email'            => get_presets_meta( 'user_email' ),   //(string) The user email address.
    //'display_name'          => get_presets_meta( 'display_name' ),   //(string) The user's display name. Default is the user's username.
    'first_name'            => get_presets_meta( 'first_name' ),   //(string) The user's first name. For new users, will be used to build the first part of the user's display name if $display_name is not specified.
    'last_name'             => get_presets_meta( 'last_name' ),   //(string) The user's last name. For new users, will be used to build the second part of the user's display name if $display_name is not specified.
    //'description'           => get_presets_meta( 'description' ),   //(string) The user's biographical description.
    // 'admin_color'           => '',   //(string) Admin color scheme for the user. Default 'fresh'.
    // 'locale'                => '',   //(string) User's locale. Default empty.
);

wp_update_user( wp_slash( $userdata ) );