<?php

namespace Presets\Actions;

class Fields {
	/**
     * Constructor
     */
    public function __construct() {
		add_action('cmb2_admin_init', array( $this, 'createFields' ), 10);
	}

	/**
	 * Create metabox and fields.
	 *
	 * Create the base metabox with new_cmb2_box function, and creates a group
	 * field to wrap all actions fields.
	 *
	 * @return void
	 */
	public function createFields() {

		$metabox = new_cmb2_box(
			array(
				'id'           => 'metabox_presets_actions',
				'title'        => __('Generates reusable form entries', 'presets'),
				'object_types' => array( 'presets' ), // Post type
				'context'      => 'normal',
				'priority'     => 'high',
			)
		);

		$group = $metabox->add_field(array(
			'id'          => 'preset_actions_repeat_group',
			'type'        => 'group',
			'options'     => array(
				'group_title'       => __('Action {#}', 'cmb2'), // since version 1.1.4, {#} gets replaced by row number
				'add_button'        => __('Add Another Action', 'cmb2'),
				'remove_button'     => __('Remove Action', 'cmb2'),
				'sortable'          => true,
				// 'closed'         => true, // true to have the groups closed by default
				'remove_confirm'    => esc_html__('Are you sure you want to remove this action?', 'presets'), // Performs confirmation before removing group.
			),
		));

		$metabox->add_group_field(
            $group,
			array(
				'name'             => __('Action', 'presets'),
				'id'               => 'action_type',
				'type'             => 'select',
				'show_option_none' => ' ',
				'default'          => 'custom',
				'options'          => apply_filters(
					'presets_action_select',
					array()
				),
				'classes' => 'preset-action-options',
			)
		);

		/**
		 * presets_create_metabox hook.
		 *
		 * Trigger presets_create_metabox action hook.
		 *
		 * It can be used to create new fields with $metabox object, attaching then
		 * to group field using the $group slug.
		 *
		 * @param object $metabox  CMB2 metabox object.
		 * @param string $group    Actions metabox group field slug.
		 *
		 */
		do_action('presets_create_metabox', $metabox, $group);
	}
}
