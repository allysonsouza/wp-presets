<?php
/**
 * Plugin Name:     Presets for WooCommerce
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     presets-for-woocommerce
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Presets_For_Woocommerce
 */

include_once plugin_dir_path( __FILE__ ) . 'src/cpt/presets.php';
include_once plugin_dir_path( __FILE__ ) . 'src/taxonomy/presets-tags.php';
include_once plugin_dir_path( __FILE__ ) . 'src/metabox/presets-options.php';

