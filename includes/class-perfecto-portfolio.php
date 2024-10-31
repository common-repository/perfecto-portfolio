<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       www.lehelmatyus.com/
 * @since      1.0.0
 *
 * @package    Perfecto_Portfolio
 * @subpackage Perfecto_Portfolio/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Perfecto_Portfolio
 * @subpackage Perfecto_Portfolio/includes
 * @author     Lehel Matyus <contact@lehelmatyus.com>
 */
class Perfecto_Portfolio {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Perfecto_Portfolio_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PERFECTO_PORTFOLIO_VERSION' ) ) {
			$this->version = PERFECTO_PORTFOLIO_VERSION;
		} else {
			$this->version = '1.0.1';
		}
		$this->plugin_name = 'perfecto-portfolio';

		$this->load_dependencies();
		$this->set_locale();
		$this->add_image_sizes();
		$this->add_portfolio_features();
		$this->add_portfolio_shortcodes();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Perfecto_Portfolio_Loader. Orchestrates the hooks of the plugin.
	 * - Perfecto_Portfolio_i18n. Defines internationalization functionality.
	 * - Perfecto_Portfolio_Admin. Defines all hooks for the admin area.
	 * - Perfecto_Portfolio_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-perfecto-portfolio-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-perfecto-portfolio-i18n.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-perfecto-portfolio-post-types.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-perfecto-portfolio-image.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-perfecto-portfolio-admin.php';

		/**
		 * The class responsible for Adding the shortcodes.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-perfecto-portfolio-shortcodes.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-perfecto-portfolio-public.php';

		$this->loader = new Perfecto_Portfolio_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Perfecto_Portfolio_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Perfecto_Portfolio_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Create Perfecto Portfolio content type and Taxonomies
	 *
	 * prfct_portfolio and prfct_portfolio_tags
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function add_portfolio_features() {

		$plugin_post_types = new Perfecto_Portfolio_PostType( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'init', $plugin_post_types, 'add_post_types' );
		$this->loader->add_action( 'init', $plugin_post_types, 'add_tags' );
	}

	/**
	 * Create Image sizes
	 *
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function add_image_sizes() {

		$plugin_image = new Perfecto_Portfolio_Image( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'init', $plugin_image, 'add_image_sizes' );
	}
	/**
	 * Create Perfecto Portfolio Shortcodes
	 *
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function add_portfolio_shortcodes() {

		$this->loader->add_action( 'init', 'Prfct_Shortcodes', 'prfct_init_shortcodes' );

	}
	

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Perfecto_Portfolio_Admin( $this->get_plugin_name(), $this->get_version() );
		$plugin_settings = new Perfecto_Portfolio_Admin_Settings( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );


		$this->loader->add_action( 'admin_menu', $plugin_settings, 'setup_plugin_options_menu' );
		$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_display_options' );
		$this->loader->add_action( 'admin_init', $plugin_settings, 'initialize_advanced_options' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Perfecto_Portfolio_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Perfecto_Portfolio_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
