<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.jbsimms.co.za
 * @since             0.1
 * @package           Sim_Export_Excel
 *
 * @wordpress-plugin
 * Plugin Name:       Sim Excel Export
 * Plugin URI:        sim-export-excel
 * Description:       Extend existing features of your backend to enable proper Excel exports (not just CSV) of data.
 * Version:           1.0.0
 * Author:            John Simms
 * Author URI:        https://www.jbsimms.co.za
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sim-export-excel
 * Domain Path:       /languages
 */

include('admin/vendor/autoload.php');

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sim-export-excel-activator.php
 */
function activate_sim_export_excel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sim-export-excel-activator.php';
	Sim_Export_Excel_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sim-export-excel-deactivator.php
 */
function deactivate_sim_export_excel() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sim-export-excel-deactivator.php';
	Sim_Export_Excel_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sim_export_excel' );
register_deactivation_hook( __FILE__, 'deactivate_sim_export_excel' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sim-export-excel.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sim_export_excel() {

	$plugin = new Sim_Export_Excel();
	$plugin->run();

}
run_sim_export_excel();
