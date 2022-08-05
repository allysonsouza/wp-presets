<?php

namespace Presets\Actions;

abstract class ActionBase {

	public $slug;
	public $name;
	public $description;

	/**
     * Constructor
     */
    public function __construct($slug, $name, $description) {
        add_action( 'presets_create_metabox', array( $this, 'createFields' ), 10, 2 );
		add_action( 'presets_apply_meta', array( $this, 'applyAction' ), 10, 1 );
		add_filter( 'presets_action_select', array( $this, 'createSelectOption' ), 10, 1 );

		$this->slug = $slug;
		$this->name = $name;
		$this->description = $description;
    }

	/**
	 * Create action fields.
	 * 
	 * Create action fields from $metabox CMB2 object, adding then to the $group.
	 * All fields are attached to the same group.
	 *
	 * @param object $metabox
	 * @param string $group
	 */
	abstract public function createFields($metabox, $group);

	/**
	 * Apply module action.
	 * 
	 * Given the preset post ID, apply the module action.
	 *
	 * @param int $id  Preset post ID.
	 */
	abstract public function applyAction($id);

	/**
	 * Create select option for the action.
	 * 
	 * Create select option for the metabox given the action slug and name.
	 *
	 * @param array $actions  Array of existent actions.
	 */
	public function createSelectOption($actions) {
		$actions[$this->slug] = $this->name;
		return $actions;
	}
}