<?php
/**
 * Plugin Name:     Presets
 * Description:     Fill your WordPress installation with previously defined settings in just a few seconds.
 * Author:          Presets contributors
 * Author URI:      https://github.com/felipelousantos/wp-presets/graphs/contributors
 * Text Domain:     presets
 * Version:         1.0.0
 *
 * @package Presets
 */

require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

use Presets\Notes;
use Presets\Taxonomy;
use Presets\PostTypes;
use Presets\Actions;
use Presets\Triggers;

/**
 * Function outputs the plugin directory with the root file name.
 *
 */
function presets_plugin_filename() {
	return str_replace( plugin_dir_path( __DIR__ ), '', $dir = plugin_dir_path( __FILE__ ) ) . 'presets.php';
}

// Settings
require_once plugin_dir_path( __FILE__ ) . 'src/settings/advanced-settings.php';
require_once plugin_dir_path( __FILE__ ) . 'src/settings/helpers.php';

// Actions
require_once plugin_dir_path( __FILE__ ) . 'src/actions/ActionBase.php';

// Modules
require_once plugin_dir_path( __FILE__ ) . 'modules/modules.php';

// Object creation
new Notes\Notes();
new Taxonomy\Tags();
new PostTypes\Presets();
new Actions\Fields();
new Actions\Implementation();
$admin_bar = new WP_Admin_Bar;
new Triggers\WPAdminBar($admin_bar);

/**
 * Enqueue the plugin scripts and styles on admin.
 */
function presets_admin_scripts() {
	wp_enqueue_style( 'presets_admin_css', plugin_dir_url( __FILE__ ) . 'assets/css/admin.css' );
	wp_enqueue_script( 'presets_admin_js', plugin_dir_url( __FILE__ ) . 'assets/js/admin.js' );
}
add_action( 'admin_enqueue_scripts', 'presets_admin_scripts' );
