<?php

namespace Presets\Taxonomy;

class Tags {

	/**
     * Constructor
     */
    public function __construct() {
		add_action( 'init', array( $this, 'createTaxonomy' ) );
	}

	/**
	 * Create taxonomy 'Tags' for the Presets CPT.
	 *
	 * @return void
	 */
	public function createTaxonomy() {

		$labels = array(
			'name'                       => _x( 'Tags', 'Taxonomy General Name', 'presets' ),
			'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'presets' ),
			'menu_name'                  => __( 'Tags', 'presets' ),
			'all_items'                  => __( 'All tags', 'presets' ),
			'parent_item'                => __( 'Parent tag', 'presets' ),
			'parent_item_colon'          => __( 'Parent tag:', 'presets' ),
			'new_item_name'              => __( 'New tag name', 'presets' ),
			'add_new_item'               => __( 'Add new tag', 'presets' ),
			'edit_item'                  => __( 'Edit tag', 'presets' ),
			'update_item'                => __( 'Update tag', 'presets' ),
			'view_item'                  => __( 'View tag', 'presets' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'presets' ),
			'add_or_remove_items'        => __( 'Add or remove tags', 'presets' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'presets' ),
			'popular_items'              => __( 'Popular tags', 'presets' ),
			'search_items'               => __( 'Search tags', 'presets' ),
			'not_found'                  => __( 'Not found', 'presets' ),
			'no_terms'                   => __( 'No tags', 'presets' ),
			'items_list'                 => __( 'Tags list', 'presets' ),
			'items_list_navigation'      => __( 'Tags list navigation', 'presets' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => false,
		);
		register_taxonomy( 'presets_tags', array( 'presets' ), $args );

	}
}