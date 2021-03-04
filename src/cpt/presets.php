<?php

/**
 * Create CPT 'prewoo_presets'
 *
 * @return void
 */
function prewoo_presets() {

	$labels = array(
		'name'                  => _x( 'Presets', 'Post Type General Name', 'presets-for-woocommerce' ),
		'singular_name'         => _x( 'Preset', 'Post Type Singular Name', 'presets-for-woocommerce' ),
		'menu_name'             => __( 'Presets', 'presets-for-woocommerce' ),
		'name_admin_bar'        => __( 'Preset', 'presets-for-woocommerce' ),
		'archives'              => __( 'Item Archives', 'presets-for-woocommerce' ),
		'attributes'            => __( 'Item Attributes', 'presets-for-woocommerce' ),
		'parent_item_colon'     => __( 'Parent Item:', 'presets-for-woocommerce' ),
		'all_items'             => __( 'All Items', 'presets-for-woocommerce' ),
		'add_new_item'          => __( 'Add New Item', 'presets-for-woocommerce' ),
		'add_new'               => __( 'Add New', 'presets-for-woocommerce' ),
		'new_item'              => __( 'New Item', 'presets-for-woocommerce' ),
		'edit_item'             => __( 'Edit Item', 'presets-for-woocommerce' ),
		'update_item'           => __( 'Update Item', 'presets-for-woocommerce' ),
		'view_item'             => __( 'View Item', 'presets-for-woocommerce' ),
		'view_items'            => __( 'View Items', 'presets-for-woocommerce' ),
		'search_items'          => __( 'Search Item', 'presets-for-woocommerce' ),
		'not_found'             => __( 'Not found', 'presets-for-woocommerce' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'presets-for-woocommerce' ),
		'featured_image'        => __( 'Featured Image', 'presets-for-woocommerce' ),
		'set_featured_image'    => __( 'Set featured image', 'presets-for-woocommerce' ),
		'remove_featured_image' => __( 'Remove featured image', 'presets-for-woocommerce' ),
		'use_featured_image'    => __( 'Use as featured image', 'presets-for-woocommerce' ),
		'insert_into_item'      => __( 'Insert into item', 'presets-for-woocommerce' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'presets-for-woocommerce' ),
		'items_list'            => __( 'Items list', 'presets-for-woocommerce' ),
		'items_list_navigation' => __( 'Items list navigation', 'presets-for-woocommerce' ),
		'filter_items_list'     => __( 'Filter items list', 'presets-for-woocommerce' ),
	);
	$args = array(
		'label'                 => __( 'Preset', 'presets-for-woocommerce' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-settings',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'prewoo_presets', $args );

}
add_action( 'init', 'prewoo_presets', 0 );
