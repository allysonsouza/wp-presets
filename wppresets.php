<?php
/**
 * Plugin Name:     WP Presets
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     wp-presets
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         WP_Presets
 */

include_once plugin_dir_path( __FILE__ ) . 'src/cpt/presets.php';
include_once plugin_dir_path( __FILE__ ) . 'src/taxonomy/presets-tags.php';
include_once plugin_dir_path( __FILE__ ) . 'src/metabox/presets-options.php';
include_once plugin_dir_path( __FILE__ ) . 'src/triggers/triggers.php';