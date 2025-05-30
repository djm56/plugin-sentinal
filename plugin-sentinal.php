<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://pluginsentinal.com
 * @since             1.0.0
 * @package           Plugin_Sentinal
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin Sentinal
 * Plugin URI:        https://pluginsentinal.com
 * Description:       Plugin Sentinel specializes in preemptive threat mitigation through cryptographic validation of core plugin files against WordPress.org repositories, addressing a gap in proactive plugin maintenance.
 * Version:           1.0.0
 * Author:            Plugin Sentinal
 * Author URI:        https://pluginsentinal.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-sentinal
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_SENTINAL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-sentinal-activator.php
 */
function activate_plugin_sentinal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-sentinal-activator.php';
	Plugin_Sentinal_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-sentinal-deactivator.php
 */
function deactivate_plugin_sentinal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-sentinal-deactivator.php';
	Plugin_Sentinal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_sentinal' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_sentinal' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin-sentinal.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_sentinal() {

	$plugin = new Plugin_Sentinal();
	$plugin->run();

}
run_plugin_sentinal();
