<?php

/**
 * Create taxonomy 'Presets Tags'
 *
 * @return void
 */
function wppresets_tags() {

	$labels = array(
		'name'                       => _x( 'Tags', 'Taxonomy General Name', 'wppresets' ),
		'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'wppresets' ),
		'menu_name'                  => __( 'Tags', 'wppresets' ),
		'all_items'                  => __( 'All Items', 'wppresets' ),
		'parent_item'                => __( 'Parent Item', 'wppresets' ),
		'parent_item_colon'          => __( 'Parent Item:', 'wppresets' ),
		'new_item_name'              => __( 'New Item Name', 'wppresets' ),
		'add_new_item'               => __( 'Add New Item', 'wppresets' ),
		'edit_item'                  => __( 'Edit Item', 'wppresets' ),
		'update_item'                => __( 'Update Item', 'wppresets' ),
		'view_item'                  => __( 'View Item', 'wppresets' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'wppresets' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'wppresets' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wppresets' ),
		'popular_items'              => __( 'Popular Items', 'wppresets' ),
		'search_items'               => __( 'Search Items', 'wppresets' ),
		'not_found'                  => __( 'Not Found', 'wppresets' ),
		'no_terms'                   => __( 'No items', 'wppresets' ),
		'items_list'                 => __( 'Items list', 'wppresets' ),
		'items_list_navigation'      => __( 'Items list navigation', 'wppresets' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'wppresets_tags', array( 'wppresets_presets' ), $args );

}
add_action( 'init', 'wppresets_tags', 0 );
