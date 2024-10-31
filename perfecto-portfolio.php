<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.lehelmatyus.com/
 * @since             1.0.0
 * @package           Perfecto_Portfolio
 *
 * @wordpress-plugin
 * Plugin Name:       Perfecto Portfolio
 * Plugin URI:        https://www.lehelmatyus.com/wp-plugins/perfecto-portfolio
 * Description:       Perfecto Portfolio is a lightweight plugin that will add a filterable image grid gallery capability to your website available through a highly customizable short-code. It supports different modes on how to display the Portfolio items including a modal mode or separate page mode.
 * Version:           1.0.1
 * Author:            Lehel Matyus
 * Author URI:        www.lehelmatyus.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       perfecto-portfolio
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
define( 'PERFECTO_PORTFOLIO_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-perfecto-portfolio-activator.php
 */
function activate_perfecto_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-perfecto-portfolio-activator.php';
	Perfecto_Portfolio_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-perfecto-portfolio-deactivator.php
 */
function deactivate_perfecto_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-perfecto-portfolio-deactivator.php';
	Perfecto_Portfolio_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_perfecto_portfolio' );
register_deactivation_hook( __FILE__, 'deactivate_perfecto_portfolio' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-perfecto-portfolio.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_perfecto_portfolio() {

	$plugin = new Perfecto_Portfolio();
	$plugin->run();

}
run_perfecto_portfolio();
