<?php

/**
 * Create CPT 'wppresets'
 *
 * @return void
 */
function wppresets_presets() {

	$labels = array(
		'name'                  => _x( 'Presets', 'Post Type General Name', 'wppresets' ),
		'singular_name'         => _x( 'Preset', 'Post Type Singular Name', 'wppresets' ),
		'menu_name'             => __( 'Presets', 'wppresets' ),
		'name_admin_bar'        => __( 'Preset', 'wppresets' ),
		'archives'              => __( 'Item Archives', 'wppresets' ),
		'attributes'            => __( 'Item Attributes', 'wppresets' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wppresets' ),
		'all_items'             => __( 'All Items', 'wppresets' ),
		'add_new_item'          => __( 'Add New Item', 'wppresets' ),
		'add_new'               => __( 'Add New', 'wppresets' ),
		'new_item'              => __( 'New Item', 'wppresets' ),
		'edit_item'             => __( 'Edit Item', 'wppresets' ),
		'update_item'           => __( 'Update Item', 'wppresets' ),
		'view_item'             => __( 'View Item', 'wppresets' ),
		'view_items'            => __( 'View Items', 'wppresets' ),
		'search_items'          => __( 'Search Item', 'wppresets' ),
		'not_found'             => __( 'Not found', 'wppresets' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wppresets' ),
		'featured_image'        => __( 'Featured Image', 'wppresets' ),
		'set_featured_image'    => __( 'Set featured image', 'wppresets' ),
		'remove_featured_image' => __( 'Remove featured image', 'wppresets' ),
		'use_featured_image'    => __( 'Use as featured image', 'wppresets' ),
		'insert_into_item'      => __( 'Insert into item', 'wppresets' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'wppresets' ),
		'items_list'            => __( 'Items list', 'wppresets' ),
		'items_list_navigation' => __( 'Items list navigation', 'wppresets' ),
		'filter_items_list'     => __( 'Filter items list', 'wppresets' ),
	);
	$args = array(
		'label'                 => __( 'Preset', 'wppresets' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 2,
		'menu_icon'             => 'dashicons-admin-settings',
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'wppresets', $args );

}
add_action( 'init', 'wppresets_presets', 0 );
