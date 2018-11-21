<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.jbsimms.co.za
 * @since      1.0.0
 *
 * @package    Sim_Export_Excel
 * @subpackage Sim_Export_Excel/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sim_Export_Excel
 * @subpackage Sim_Export_Excel/includes
 * @author     John Simms <john@jbsimms.co.za>
 */
class Sim_Export_Excel_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sim-export-excel',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
