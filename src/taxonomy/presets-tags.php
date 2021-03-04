<?php

/**
 * Create taxonomy 'Presets Tags'
 *
 * @return void
 */
function prewoo_tags() {

	$labels = array(
		'name'                       => _x( 'Tags', 'Taxonomy General Name', 'presets-for-woocommerce' ),
		'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'presets-for-woocommerce' ),
		'menu_name'                  => __( 'Tags', 'presets-for-woocommerce' ),
		'all_items'                  => __( 'All Items', 'presets-for-woocommerce' ),
		'parent_item'                => __( 'Parent Item', 'presets-for-woocommerce' ),
		'parent_item_colon'          => __( 'Parent Item:', 'presets-for-woocommerce' ),
		'new_item_name'              => __( 'New Item Name', 'presets-for-woocommerce' ),
		'add_new_item'               => __( 'Add New Item', 'presets-for-woocommerce' ),
		'edit_item'                  => __( 'Edit Item', 'presets-for-woocommerce' ),
		'update_item'                => __( 'Update Item', 'presets-for-woocommerce' ),
		'view_item'                  => __( 'View Item', 'presets-for-woocommerce' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'presets-for-woocommerce' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'presets-for-woocommerce' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'presets-for-woocommerce' ),
		'popular_items'              => __( 'Popular Items', 'presets-for-woocommerce' ),
		'search_items'               => __( 'Search Items', 'presets-for-woocommerce' ),
		'not_found'                  => __( 'Not Found', 'presets-for-woocommerce' ),
		'no_terms'                   => __( 'No items', 'presets-for-woocommerce' ),
		'items_list'                 => __( 'Items list', 'presets-for-woocommerce' ),
		'items_list_navigation'      => __( 'Items list navigation', 'presets-for-woocommerce' ),
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
	register_taxonomy( 'prewoo_tags', array( 'prewoo_presets' ), $args );

}
add_action( 'init', 'prewoo_tags', 0 );
