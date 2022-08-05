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

	abstract public function createFields($metabox, $group);

	abstract public function applyAction($id);

	public function createSelectOption($actions) {
		$actions[$this->slug] = $this->name;
		return $actions;
	}
}