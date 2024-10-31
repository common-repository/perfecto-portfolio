<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.lehelmatyus.com/
 * @since      1.0.0
 *
 * @package    Perfecto_Portfolio
 * @subpackage Perfecto_Portfolio/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Perfecto_Portfolio
 * @subpackage Perfecto_Portfolio/includes
 * @author     Lehel Matyus <contact@lehelmatyus.com>
 */
class Perfecto_Portfolio_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'perfecto-portfolio',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
