<?php

namespace Presets\PostTypes;

class Presets {
	/**
     * Constructor
     */
    public function __construct() {
		add_action('init', array( $this, 'createPostPresets' ));
	}

	/**
	 * Create CPT 'presets'.
	 *
	 * @return void
	 */
	public function createPostPresets() {

		$labels = array(
			'name'                  => _x('Presets', 'Post Type General Name', 'presets'),
			'singular_name'         => _x('Preset', 'Post Type Singular Name', 'presets'),
			'menu_name'             => __('Presets', 'presets'),
			'name_admin_bar'        => __('Preset', 'presets'),
			'archives'              => __('Preset Archives', 'presets'),
			'attributes'            => __('Preset Attributes', 'presets'),
			'parent_item_colon'     => __('Parent Preset:', 'presets'),
			'all_items'             => __('All Presets', 'presets'),
			'add_new_item'          => __('Add New Preset', 'presets'),
			'add_new'               => __('Add New', 'presets'),
			'new_item'              => __('New Preset', 'presets'),
			'edit_item'             => __('Edit Preset', 'presets'),
			'update_item'           => __('Update Preset', 'presets'),
			'view_item'             => __('View Preset', 'presets'),
			'view_items'            => __('View Presets', 'presets'),
			'search_items'          => __('Search Presets', 'presets'),
			'not_found'             => __('Not found', 'presets'),
			'not_found_in_trash'    => __('Not found in Trash', 'presets'),
			'featured_image'        => __('Featured Image', 'presets'),
			'set_featured_image'    => __('Set featured image', 'presets'),
			'remove_featured_image' => __('Remove featured image', 'presets'),
			'use_featured_image'    => __('Use as featured image', 'presets'),
			'insert_into_item'      => __('Insert into Preset', 'presets'),
			'uploaded_to_this_item' => __('Uploaded to this Preset', 'presets'),
			'items_list'            => __('Presets list', 'presets'),
			'items_list_navigation' => __('Presets list navigation', 'presets'),
			'filter_items_list'     => __('Filter Presets list', 'presets'),
		);

		$args   = array(
			'label'               => __('Preset', 'presets'),
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

		register_post_type('presets', $args);
	}
}
