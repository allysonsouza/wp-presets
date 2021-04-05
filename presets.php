<?php
/**
 * Plugin Name:     Presets
 * Description:     The Presets plugin allows you to fill your WordPress with demo data in just a few seconds allowing you to test it without the need to manually change the settings every time.
 * Author:          Presets contributors
 * Author URI:      https://github.com/felipelousantos/presets/graphs/contributors
 * Text Domain:     presets
 * Version:         0.1.0
 *
 * @package Presets
 */

require_once plugin_dir_path( __FILE__ ) . 'src/cpt/presets.php';
require_once plugin_dir_path( __FILE__ ) . 'src/taxonomy/presets-tags.php';
require_once plugin_dir_path( __FILE__ ) . 'src/metabox/presets-options.php';
require_once plugin_dir_path( __FILE__ ) . 'src/triggers/triggers.php';
require_once plugin_dir_path( __FILE__ ) . 'src/actions/apply-presets.php';
