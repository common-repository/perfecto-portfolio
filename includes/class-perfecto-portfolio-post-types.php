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
class Perfecto_Portfolio_PostType {

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
	public function add_post_types() {

        $args = array (
            'label' => esc_html__( 'Perfecto Portfolio', 'perfecto-portfolio' ),
            'labels' => array(
                'menu_name' => esc_html__( 'Perfecto Portfolio', 'perfecto-portfolio' ),
                'name_admin_bar' => esc_html__( 'Portfolio Item', 'perfecto-portfolio' ),
                'add_new' => esc_html__( 'Add new', 'perfecto-portfolio' ),
                'add_new_item' => esc_html__( 'Add new Portfolio Item', 'perfecto-portfolio' ),
                'new_item' => esc_html__( 'New Portfolio Item', 'perfecto-portfolio' ),
                'edit_item' => esc_html__( 'Edit Portfolio Item', 'perfecto-portfolio' ),
                'view_item' => esc_html__( 'View Portfolio Item', 'perfecto-portfolio' ),
                'update_item' => esc_html__( 'Update Portfolio Item', 'perfecto-portfolio' ),
                'all_items' => esc_html__( 'All Perfecto Portfolio', 'perfecto-portfolio' ),
                'search_items' => esc_html__( 'Search Perfecto Portfolio', 'perfecto-portfolio' ),
                'parent_item_colon' => esc_html__( 'Parent Portfolio Item', 'perfecto-portfolio' ),
                'not_found' => esc_html__( 'No Perfecto Portfolio found', 'perfecto-portfolio' ),
                'not_found_in_trash' => esc_html__( 'No Perfecto Portfolio found in Trash', 'perfecto-portfolio' ),
                'name' => esc_html__( 'Perfecto Portfolio', 'perfecto-portfolio' ),
                'singular_name' => esc_html__( 'Portfolio Item', 'perfecto-portfolio' ),
            ),
            'public' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'show_in_rest' => true,   // Disables Gutenberg
            'menu_icon' => 'dashicons-grid-view',
            'capability_type' => 'post',
            'hierarchical' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite_no_front' => false,
            'menu_position' => 5,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'rewrite' => array(
                'slug'                  => 'perfecto-portfolio',
                'with_front'            => false,
            ),
        );

        register_post_type( 'prfct_portfolio', $args );

	}

	/**
	 * Adds post types
	 *
	 * @since    1.0.0
	 */
	public function add_tags() {
        $args = array (
            'label' => esc_html__( 'Portfolio Tags', 'perfecto-portfolio' ),
            'labels' => array(
                'menu_name' => esc_html__( 'Portfolio Tags', 'perfecto-portfolio' ),
                'all_items' => esc_html__( 'All Portfolio Tags', 'perfecto-portfolio' ),
                'edit_item' => esc_html__( 'Edit Portfolio Tag', 'perfecto-portfolio' ),
                'view_item' => esc_html__( 'View Portfolio Tag', 'perfecto-portfolio' ),
                'update_item' => esc_html__( 'Update Portfolio Tag', 'perfecto-portfolio' ),
                'add_new_item' => esc_html__( 'Add new Portfolio Tag', 'perfecto-portfolio' ),
                'new_item_name' => esc_html__( 'New Portfolio Tag', 'perfecto-portfolio' ),
                'parent_item' => esc_html__( 'Parent Portfolio Tag', 'perfecto-portfolio' ),
                'parent_item_colon' => esc_html__( 'Parent Portfolio Tag:', 'perfecto-portfolio' ),
                'search_items' => esc_html__( 'Search Portfolio Tags', 'perfecto-portfolio' ),
                'popular_items' => esc_html__( 'Popular Portfolio Tags', 'perfecto-portfolio' ),
                'separate_items_with_commas' => esc_html__( 'Separate Portfolio Tags with commas', 'perfecto-portfolio' ),
                'add_or_remove_items' => esc_html__( 'Add or remove Portfolio Tags', 'perfecto-portfolio' ),
                'choose_from_most_used' => esc_html__( 'Choose most used Portfolio Tags', 'perfecto-portfolio' ),
                'not_found' => esc_html__( 'No Portfolio Tags found', 'perfecto-portfolio' ),
                'name' => esc_html__( 'Portfolio Tags', 'perfecto-portfolio' ),
                'singular_name' => esc_html__( 'Portfolio Tag', 'perfecto-portfolio' ),
            ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            'show_in_quick_edit' => true,
            'show_admin_column' => false,
            'show_in_rest' => true,
            'hierarchical' => false,
            'query_var' => true,
            'sort' => false,
            'rewrite_no_front' => false,
            'rewrite_hierarchical' => false,
            'rewrite' => true,
        );
    
        register_taxonomy( 'prfct_tx_portfolio_tag', array( 'prfct_portfolio' ), $args );

    }

}
