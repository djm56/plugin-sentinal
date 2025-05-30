<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://pluginsentinal.com
 * @since      1.0.0
 *
 * @package    Plugin_Sentinal
 * @subpackage Plugin_Sentinal/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Plugin_Sentinal
 * @subpackage Plugin_Sentinal/includes
 * @author     Plugin Sentinal <info@pluginsentinal.com>
 */
class Plugin_Sentinal_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'plugin-sentinal',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
