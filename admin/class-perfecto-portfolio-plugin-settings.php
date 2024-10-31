<?php

/**
 * The settings of the plugin.
 *
 * @link       www.lehelmatyus.com/
 * @since      1.0.0
 *
 * @package    Perfecto_Portfolio
 * @subpackage Perfecto_Portfolio/admin
 */

/**
 * Class WordPress_Plugin_Template_Settings
 *
 */
class Perfecto_Portfolio_Admin_Settings {

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
	 * This function introduces the theme options into the 'Settings' menu and into a top-level
	 * 'Perfecto Portfolio' menu.
	 */
	public function setup_plugin_options_menu() {
        add_submenu_page(
            'options-general.php',
			'Perfecto Portfolio Settings', 					// The title to be displayed in the browser window for this page.
			'Perfecto Portfolio',					        // The text to be displayed for this menu item
            'manage_options',					            // Which type of users can see this menu item
            'perfecto_portfolio_options',			        // The unique ID - that is, the slug - for this menu item
			array( $this, 'render_settings_page_content')	// The name of the function to call when rendering this menu's page
		);
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
	 * Renders a simple page to display for the theme menu defined above.
	 */
	public function render_settings_page_content( $active_tab = '' ) {
		?>
		<!-- Create a header in the default WordPress 'wrap' container -->
		<div class="wrap">

			<h2><?php esc_html_e( 'Perfecto Portfolio Options', 'perfecto-portfolio' ); ?></h2>
			<?php settings_errors(); ?>

			<?php if( isset( $_GET[ 'tab' ] ) ) {
				$active_tab = $_GET[ 'tab' ];
			} else if( $active_tab == 'input_examples' ) {
				$active_tab = 'input_examples';
			} else {
				$active_tab = 'display_options';
			} // end if/else ?>

			<h2 class="nav-tab-wrapper">
				<a href="?page=perfecto_portfolio_options&tab=display_options" class="nav-tab <?php echo $active_tab == 'display_options' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Display Options', 'perfecto-portfolio' ); ?></a>
				<a href="?page=perfecto_portfolio_options&tab=input_examples" class="nav-tab <?php echo $active_tab == 'input_examples' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Advanced Options', 'perfecto-portfolio' ); ?></a>
			</h2>

			<form method="post" action="options.php">
				<?php

				if( $active_tab == 'display_options' ) {

					include_once( 'partials/perfecto-shortcode-options-table.php' );

				} else {

					settings_fields( 'perfecto_portfolio_advanced_options' );
					do_settings_sections( 'perfecto_portfolio_advanced_options' );

					submit_button();

				} // end if/else

				?>
            </form>
            <?php
                /**
                 * Print Shortcode options 
                 */
            ?>

		</div><!-- /.wrap -->
	<?php
	}


	/**
	 * This function provides a simple description for the General Options page.
	 *
	 * It's called from the 'wppb-demo_initialize_theme_options' function by being passed as a parameter
	 * in the add_settings_section function.
	 */
	public function general_options_callback() {
		$options = get_option('perfecto_portfolio_display_options');
		// var_dump($options);
		echo '<p>' . esc_html__( 'Build your own <b>[perfecto-portfolio]</b> shortcode. See all available options.', 'perfecto-portfolio' ) . '</p>';
	} // end general_options_callback

	/**
	 * This function provides a simple description for the Advanced Options page.
	 *
	 * It's called from the 'wppb-demo_theme_initialize_advanced_options_options' function by being passed as a parameter
	 * in the add_settings_section function.
	 */
	public function adcanced_options_callback() {
		$options = get_option('perfecto_portfolio_advanced_options');
		// var_dump($options);
		echo '<p>' . esc_html__( 'Refine these options to optimize how front-end resources such as CSS and JavaScript get loaded. Changing these options may break the layout of the portfolio grids. If you are not sure what you are doing just leave these options as default.', 'perfecto-portfolio' ) . '</p>';
	} // end general_options_callback


	/**
	 * Initializes the theme's display options page by registering the Sections,
	 * Fields, and Settings.
	 *
	 * This function is registered with the 'admin_init' hook.
	 */
	public function initialize_display_options() {

	} 
	// end wppb-demo_initialize_theme_options


	/**
	 * Initializes the theme's input example by registering the Sections,
	 * Fields, and Settings. This particular group of options is used to demonstration
	 * validation and sanitization.
	 *
	 * This function is registered with the 'admin_init' hook.
	 */
	public function initialize_advanced_options() {

		// delete_option('perfecto_portfolio_advanced_options');

		if( false == get_option( 'perfecto_portfolio_advanced_options' ) ) {
			$default_array = $this->default_advanced_options();
			update_option( 'perfecto_portfolio_advanced_options', $default_array );
		} // end if

		add_settings_section(
			'advanced_settings_section',
			esc_html__( 'Advanced Options', 'perfecto-portfolio' ),
			array( $this, 'adcanced_options_callback'),
			'perfecto_portfolio_advanced_options'
		);

		add_settings_field(
			'Load front-end CSS and Javascript on',
			esc_html__( 'Load front-end CSS and Javascript on', 'perfecto-portfolio' ),
			array( $this, 'asset_load_select_element_callback'),
			'perfecto_portfolio_advanced_options',
			'advanced_settings_section'
		);

		register_setting(
			'perfecto_portfolio_advanced_options',
			'perfecto_portfolio_advanced_options',
			array( $this, 'validate_advanced_options')
		);
	}

	public function asset_load_select_element_callback() {

		$options = get_option( 'perfecto_portfolio_advanced_options' );

		$html = '<select id="asset_load_options" name="perfecto_portfolio_advanced_options[asset_load_options]">';
		$html .= '<option value="default">' . esc_html__( 'Select a time option...', 'perfecto-portfolio' ) . '</option>';
		$html .= '<option value="all"' . selected( $options['asset_load_options'], 'all', false) . '>' . esc_html__( 'All Website - default', 'perfecto-portfolio' ) . '</option>';
		$html .= '<option value="single-pages"' . selected( $options['asset_load_options'], 'single-pages', false) . '>' . esc_html__( 'Single Pages', 'perfecto-portfolio' ) . '</option>';	
		$html .= '</select>';
		$html .= '<p>'. esc_html__( '"All website" - makes shortcode available universally throughout the website, including widget areas, listing pages etc. ') .'</p>';
		$html .= '<p>'. esc_html__( '"Single Pages" - makes it ony available on Posts and Pages.' ) .'</p>';
		$html .= '<p>'. esc_html__( 'Making this selection as narrow as possible will increase your site\'s overall performance.', 'perfecto-portfolio' ) .'</p>';

		echo $html;

	} // end select_element_callback


	/**
	 * Sanitization callback for the advanced options. Since each of the advanced options are text inputs,
	 * this function loops through the incoming option and strips all tags and slashes from the value
	 * before serializing it.
	 *
	 * @params	$input	The unsanitized collection of options.
	 *
	 * @returns			The collection of sanitized values.
	 */
	public function sanitize_advanced_options( $input ) {

		// Define the array for the updated options
		$output = array();

		// Loop through each of the options sanitizing the data
		foreach( $input as $key => $val ) {

			if( isset ( $input[$key] ) ) {
				$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
			} // end if

		} // end foreach

		// Return the new collection
		return apply_filters( 'sanitize_advanced_options', $output, $input );

	} // end sanitize_advanced_options

	public function validate_advanced_options( $input ) {

		// Create our array for storing the validated options
		$output = array();

		// Loop through each of the incoming options
		foreach( $input as $key => $value ) {

			// Check to see if the current option has a value. If so, process it.
			if( isset( $input[$key] ) ) {

				// Strip all HTML and PHP tags and properly handle quoted strings
				$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );

			} // end if

		} // end foreach

		// Return the array processing any additional functions filtered by this action
		return apply_filters( 'validate_advanced_options', $output, $input );

	} // end validate_advanced_options

}