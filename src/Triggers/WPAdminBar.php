<?php

namespace Presets\Triggers;

class WPAdminBar {
	/**
     * Constructor
     */
    public function __construct() {
		add_action('admin_bar_menu', array( $this, 'addAdminBarMenu' ), 100);
	}

	public function addAdminBarMenu(\WP_Admin_Bar $wp_admin_bar) {

		if (! current_user_can('manage_options')) {
			return;
		}

		$wp_admin_bar->add_menu(
			array(
				'id'     => 'presets-trigger',
				'parent' => null,
				'group'  => null,
				'title'  => 'Presets', // you can use img tag with image link. it will show the image icon Instead of the title.
				'href'   => admin_url('edit.php?post_type=presets'),
				'meta'   => array(
					'title' => __('Presets', 'textdomain'), // This title will show on hover.
				),
			)
		);

		foreach ($this->getAllPresets() as $id) {
			$wp_admin_bar->add_menu(
				array(
					'id'     => 'presets-trigger_' . $id,
					'parent' => 'presets-trigger',
					'group'  => null,
					'title'  => get_the_title($id), // you can use img tag with image link. it will show the image icon Instead of the title.
					'href'   => $this->getCurrentURL($id),
					'meta'   => array(
						'title' => get_the_title($id), // This title will show on hover.
					),
				)
			);
		}
	}

	private function getAllPresets() {

		return get_posts(
			array(
				'fields'         => 'ids',
				'posts_per_page' => -1,
				'post_type'      => 'presets',
			)
		);
	}

	private function getCurrentURL($id) {

		return add_query_arg('presets-trigger', $id, $_SERVER['REQUEST_URI']);
	}
}
