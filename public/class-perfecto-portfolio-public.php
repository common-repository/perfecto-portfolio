<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.lehelmatyus.com/
 * @since      1.0.0
 *
 * @package    Perfecto_Portfolio
 * @subpackage Perfecto_Portfolio/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Perfecto_Portfolio
 * @subpackage Perfecto_Portfolio/public
 * @author     Lehel Matyus <contact@lehelmatyus.com>
 */
class Perfecto_Portfolio_Public {

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
	 * Asset Load options
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      Array    $advanced_options    Option saved at the settings page
	 */
	private $advanced_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$get_advanced_options = get_option( 'perfecto_portfolio_advanced_options' );
		if( false ==  $get_advanced_options) {
			$this->advanced_options = $this->default_advanced_options();
		}else{
			$this->advanced_options = $get_advanced_options;
		}

	}

	/**
	 * Provides default values for the Input Options.
	 *
	 * @return array
	 */
	public function default_advanced_options() {

		$defaults = array(
			'asset_load_options'	=>	'all-pages',
		);

		return $defaults;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Perfecto_Portfolio_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Perfecto_Portfolio_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// Plugins Specific
		wp_register_style( $this->plugin_name . "-styles", plugin_dir_url( __FILE__ ) . 'css/perfecto-portfolio-public.css', array(), $this->version, 'all' );

		// Front-End Library
		wp_register_style( $this->plugin_name . "-uikit", plugin_dir_url( __FILE__ ) . 'lib/uikit-3.2.0/css/uikit.min.css', array(), $this->version, 'all' );


		// Plugins Specific
		wp_enqueue_style( $this->plugin_name . "-styles" );		

		// Front-End Library
		switch ($this->advanced_options['asset_load_options']) {
			case 'single-pages':
				if ( is_singular() ){
					wp_enqueue_style( $this->plugin_name . "-uikit" );
				}
				break;
			
			default:
				# "all-pages" -- default
				wp_enqueue_style( $this->plugin_name . "-uikit" );
				break;
		}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Perfecto_Portfolio_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Perfecto_Portfolio_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// Plugins Specific
		wp_register_script( $this->plugin_name . "-script",  plugin_dir_url( __FILE__ ) . 'js/perfecto-portfolio-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name . "-styles" );		


		// Front-End Library
		switch ($this->advanced_options['asset_load_options']) {
			case 'single-pages':
				if ( is_singular() ){
					wp_register_script( $this->plugin_name . '-uikit', plugin_dir_url( __FILE__ ) . 'lib/uikit-3.2.0/js/uikit.min.js', array( 'jquery' ), $this->version, false );
					wp_enqueue_script( $this->plugin_name . "-uikit" );
				}
				break;
			
			default:
				# "all-pages" -- default
					wp_register_script( $this->plugin_name . '-uikit', plugin_dir_url( __FILE__ ) . 'lib/uikit-3.2.0/js/uikit.min.js', array( 'jquery' ), $this->version, false );
					wp_enqueue_script( $this->plugin_name . "-uikit" );
				break;
		}

	}

}
