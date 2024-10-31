<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.salonmanager.com/
 * @since             1.0.0
 * @package           Salon_Manager_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       Salon Manager Widgets
 * Plugin URI:        https://www.salonmanager.com/myplugin
 * Description:       Salon Manager Widget is a complete and easy tool for your customers to schedule appointments, see service prices & promotions, buy eGift Cards, see business hours, view service pictures & reviews in your salon website.

You can control all features from Salon Manager iPad app right in your salon. You don't need a webmaster or web developer to update your website whenever you need to update information about your business..
 * Version:           1.0.0
 * Author:            Salon Manager
 * Author URI:        https://www.salonmanager.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       salon-manager-widget
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
define( 'SALON_MANAGER_WIDGET_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-salon-manager-widget-activator.php
 */
function activate_salon_manager_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-salon-manager-widget-activator.php';
	Salon_Manager_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-salon-manager-widget-deactivator.php
 */
function deactivate_salon_manager_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-salon-manager-widget-deactivator.php';
	Salon_Manager_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_salon_manager_widget' );
register_deactivation_hook( __FILE__, 'deactivate_salon_manager_widget' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-salon-manager-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function smwp_myscript() {
$options = get_option('salon-manager-widget');
$sal_widget_key = $options['sal_widget_key'];
$urlforjs= 'https://widgets.salonmanager.com/loader.js';
wp_enqueue_script('Salonmanagerjs', $urlforjs, $deps, $ver, true );
}
//add_action('wp_footer', 'myscript');
add_action( 'init', 'smwp_myscript' );
add_filter('script_loader_tag', 'smwp_add_data_attribute', 10, 2); 
function smwp_add_data_attribute($tag, $handle) {
	$options = get_option('salon-manager-widget');
	$sal_widget_key = $options['sal_widget_key'];
	$myvariable="data-sm='".$sal_widget_key."' src";
	if ( 'Salonmanagerjs' !== $handle )
		return $tag;

	return str_replace('src',$myvariable, $tag );
}
function run_salon_manager_widget() {

	$plugin = new Salon_Manager_Widget();
	$plugin->run();

}
run_salon_manager_widget();