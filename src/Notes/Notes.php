<?php

namespace Presets\Notes;

class Notes {
	/**
     * Constructor
     */
    public function __construct() {
        add_action('presets_create_metabox', array( $this, 'createNotesMetaBox' ));
		add_action('presets_admin_notice_success', array( $this, 'displayNotes' ));
    }

	/**
	 * Create notes meta box
	 *
	 * @return void
	 */
	public function createNotesMetaBox() {

		$prefix_meta = 'presets_modules_notes_general_settings_';

		/**
		 * Initiate the metabox
		 */
		$cmb = new_cmb2_box(
			array(
				'id'           => $prefix_meta . 'metabox',
				'title'        => __('Notes', 'presets'),
				'object_types' => array( 'presets' ), // Post type
				'context'      => 'side',
				'priority'     => 'low',
				'show_names'   => false, // Show field names on the left
			)
		);

		$cmb->add_field(
			array(
				'name' => __('Notes', 'notes'),
				'id'   => $prefix_meta . 'notes',
				'type' => 'wysiwyg',
			)
		);
	}

	/**
	 * Display note when preset is applied.
	 *
	 * Check if the preset is applied trough the $_GET parameter, and then display the according
	 * notice.
	 *
	 * @return void
	 */
	public function displayNotes() {

		$prefix = 'modules_notes_general_settings_';

		$preset_id = filter_var($_GET['presets-applied'], FILTER_SANITIZE_NUMBER_INT);

		echo wpautop(get_post_meta($preset_id, 'presets_' . $prefix . 'notes', true));
	}
}
