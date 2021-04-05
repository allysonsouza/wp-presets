<?php

/**
 * Create CPT 'presets'
 *
 * @return void
 */
function presets_cpt() {

	$labels = array(
		'name'                    => _x( 'Presets', 'Post Type General Name', 'presets' ),
		'singular_name'           => _x( 'Preset', 'Post Type Singular Name', 'presets' ),
		'menu_name'               => __( 'Presets', 'presets' ),
		'name_admin_bar'          => __( 'Preset', 'presets' ),
		'archives'                => __( 'Preset Archives', 'presets' ),
		'attributes'              => __( 'Preset Attributes', 'presets' ),
		'parent_Preset_colon'     => __( 'Parent Preset:', 'presets' ),
		'all_Presets'             => __( 'All Presets', 'presets' ),
		'add_new_Preset'          => __( 'Add New Preset', 'presets' ),
		'add_new'                 => __( 'Add New', 'presets' ),
		'new_Preset'              => __( 'New Preset', 'presets' ),
		'edit_Preset'             => __( 'Edit Preset', 'presets' ),
		'update_Preset'           => __( 'Update Preset', 'presets' ),
		'view_Preset'             => __( 'View Preset', 'presets' ),
		'view_Presets'            => __( 'View Presets', 'presets' ),
		'search_Presets'          => __( 'Search Preset', 'presets' ),
		'not_found'               => __( 'Not found', 'presets' ),
		'not_found_in_trash'      => __( 'Not found in Trash', 'presets' ),
		'featured_image'          => __( 'Featured Image', 'presets' ),
		'set_featured_image'      => __( 'Set featured image', 'presets' ),
		'remove_featured_image'   => __( 'Remove featured image', 'presets' ),
		'use_featured_image'      => __( 'Use as featured image', 'presets' ),
		'insert_into_Preset'      => __( 'Insert into Preset', 'presets' ),
		'uploaded_to_this_Preset' => __( 'Uploaded to this Preset', 'presets' ),
		'Presets_list'            => __( 'Presets list', 'presets' ),
		'Presets_list_navigation' => __( 'Presets list navigation', 'presets' ),
		'filter_Presets_list'     => __( 'Filter Presets list', 'presets' ),
	);
	$args   = array(
		'label'               => __( 'Preset', 'presets' ),
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'taxonomies'          => array(),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 2,
		'menu_icon'           => 'dashicons-admin-settings',
		'show_in_admin_bar'   => false,
		'show_in_nav_menus'   => false,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'page',
	);
	register_post_type( 'presets', $args );

}
add_action( 'init', 'presets_cpt', 0 );
