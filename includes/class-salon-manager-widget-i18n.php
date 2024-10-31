<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.salonmanager.com/
 * @since      1.0.0
 *
 * @package    Salon_Manager_Widget
 * @subpackage Salon_Manager_Widget/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Salon_Manager_Widget
 * @subpackage Salon_Manager_Widget/includes
 * @author     Salon Manager <developer@salonmanager.net >
 */
class Salon_Manager_Widget_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'salon-manager-widget',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
