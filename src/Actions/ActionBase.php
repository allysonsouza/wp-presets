<?php

namespace Presets\Actions;

abstract class ActionBase {
	public $slug;
	public $prefix;
	public $name;
	public $description;
	public $field_classes;
	public $fields;

	/**
     * Constructor
     */
    public function __construct($slug, $name, $description) {

		$this->slug = $slug;
		$this->prefix = 'presets_' . $slug . '_';
		$this->field_classes = $slug . ' hide';
		$this->name = $name;
		$this->description = $description;

        add_action('presets_create_metabox', array( $this, 'createFields' ), 10, 2);
		add_action('presets_apply_action_' . $slug, array( $this, 'applyAction' ), 10, 1);
		add_filter('presets_action_select', array( $this, 'createSelectOption' ), 10, 1);
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

	/**
	 * Adding the field slugs to the array of fields.
	 *
	 * @param string $field  Field slug.
	 *
	 * @return void
	 */
	public function addField($field) {
		$this->fields[] = $field;
	}

	/**
	 * Return the prefixed field slug and run the method addField.
	 *
	 * @param string $id  Field slug.
	 *
	 * @return string		The prefixed Field ID.
	 */
	public function fieldID($id) {
		$this->addField($id);
		return $this->prefix . $id;
	}
}
