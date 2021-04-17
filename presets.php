<?php
/**
 * Plugin Name:     Presets
 * Description:     The Presets plugin allows you to fill your WordPress with specific predefined settings in just a few seconds.
 * Author:          Presets contributors
 * Author URI:      https://github.com/felipelousantos/wp-presets/graphs/contributors
 * Text Domain:     presets
 * Version:         0.2.0
 *
 * @package Presets
 */


/**
 * Function outputs the plugin directory with the root file name.
 *
 */
function presets_plugin_filename() {
	return str_replace( plugin_dir_path( __DIR__ ), '', $dir = plugin_dir_path( __FILE__ ) ) . 'presets.php';
}

require_once plugin_dir_path( __FILE__ ) . 'src/cpt/presets.php';
require_once plugin_dir_path( __FILE__ ) . 'src/taxonomy/presets-tags.php';
require_once plugin_dir_path( __FILE__ ) . 'src/settings/advanced-settings.php';
require_once plugin_dir_path( __FILE__ ) . 'src/settings/helpers.php';
require_once plugin_dir_path( __FILE__ ) . 'src/metabox/presets-options.php';
require_once plugin_dir_path( __FILE__ ) . 'src/triggers/triggers.php';
require_once plugin_dir_path( __FILE__ ) . 'src/actions/apply-presets.php';
