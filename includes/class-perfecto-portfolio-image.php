<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.lehelmatyus.com/
 * @since      1.0.0
 *
 * @package    Perfecto_Portfolio
 * @subpackage Perfecto_Portfolio/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Perfecto_Portfolio
 * @subpackage Perfecto_Portfolio/admin
 * @author     Lehel Matyus <contact@lehelmatyus.com>
 */
class Perfecto_Portfolio_Image {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Adds post types
	 *
	 * @since    1.0.0
	 */
	public function add_image_sizes() {
        add_image_size( 'perfecto_portfolio_thumb', 350, 350, true );
        add_image_size( 'perfecto_portfolio_thumb_lg', 650, 650, true );
    }
    



}
