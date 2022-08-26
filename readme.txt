=== Presets ===
Contributors: allysonsouza, felipeloureirosantos
Tags: tests, debug
Requires at least: 5.0
Tested up to: 5.8
Requires PHP: 7.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

The Presets plugin allows you to fill your WordPress with specific predefined settings in just a few seconds.

== Description ==

The Presets plugin allows you to fill your WordPress installation with previously defined settings in just a few seconds, allowing you to test it without the need to change the settings every time manually.

Currently, you can change WordPress core general settings, define plugins to be activated/deactivate, and WooCommerce initial support with some basic settings when a preset is triggered. The goal will be to bring more WordPress settings. Also, we hope to make it easy in the long term to extend and bring more plugin settings.

This plugin hasn't been developed to be working on production sites, and it's mostly for testing plugins that require you to change the settings all the time.

== Installation ==

1. Upload the plugin to the `/wp-content/plugins/` directory or the plugin zip on the WP Admin panel (Plugins > Add New > Upload Plugin)
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Should I use this plugin? =

That plugin is not for production sites. It means that it won't probably make sense if you want to use it on your live site. It was created mostly with support teams or developers in mind that need to test things quickly and changing specific settings is required for that.

= How can I make donations for the Presets plugin? =

We don't take donations currently, but you can help one of these projects instead as these are really important when it comes to making a better WordPress community:

* WordPress Foundation: https://wordpressfoundation.org/donate/
* The Big Orange Heart Foundation: https://www.bigorangeheart.org/donate/

= I'm a developer and I would like to help with the plugin development. How can I do that? =

That's great! Thank you for getting involved. :)

You can see the repository here: https://github.com/felipelousantos/wp-presets


== Changelog ==

= 2.1.0 =
- Fix release issues

= 2.0.0 =
- Recreated the code to OOP.
- Removed the core user meta feature.
- Removed the Plugins module settings.

= 1.0.0 =
Added notes feature.

= 0.3.0 =
Added some of the WordPress General Settings and WooCommerce main settings.

= 0.2.0 =
Added the Plugins Module allowing you to activate/deactivate plugins when the preset is triggered.

= 0.1.0 =
Beta version. 