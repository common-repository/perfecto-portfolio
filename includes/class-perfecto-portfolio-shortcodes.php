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

defined( 'ABSPATH' ) || exit;

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
class Prfct_Shortcodes {

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
	 * Adds shortcodes to list content type
	 *
	 * @since    1.0.0
	 */
	public static function prfct_init_shortcodes() {
        add_shortcode( 'perfecto-portfolio', __CLASS__. '::do__prfct_portfolio_shortcode' );
    }

    public static function do__prfct_portfolio_shortcode( $atts ) {

        // Init variables

        $show_all_filter = 0;
        $show_title_in_list = 0;
        $modal = 0;
        $modal_type = 'modal';
        $modal_style = 'default';

        $tags = '';

        // Attributes
        $atts = shortcode_atts(
            array(

                // 'columns' => '3',               // only in Pro :  [1,2,3,4]

                // 'grid-gap' => 'medium'          // only in PRO : small,  medium, large, collapse
   
                'modal' => 1,                      // turns on modal feature
                // 'modal-type' => 'modal',        // only in PRO: [modal, gallery, (lightbox)] 
                // 'modal-style' => 'top-modal',   // only in PRO [top-modal, center-modal, full-modal]
   
                'filters' => 1,                    // print filters
                'filters-alignment' => 'left',     // print filters left, center, right
                'filters-show-all-option' => 1,    // Provides extra filter called "All"
   
                // 'filter-tags' => '',            // only in PRO : Comma separated tag slugs.

                'show-titles' => 0,                // print tiles or not with tiles
                // 'title-style' => 'below',       // only in PRO : below, overlay, hover
   
                // 'sort-controls' => 0,           // only in PRO : [0, 1]  sort buttons with filters
                // 'order-by' => 'publish-date'    // only in PRO : [publish-date, title , order-field]
                // 'sort' => 'ASC'                 // only in PRO : [asc, desc]

            ),
            $atts,
            'perfecto-portfolio'
        );

        /**
         * Process and validate Logical Attributes
         */

        if (!empty($atts['filters-show-all-option'])){
            $show_all_filter = 1;
        }
        if (!empty($atts['show-titles'])){
            $show_title_in_list = 1;
        }
        if (!empty($atts['modal'])){
            $modal = 1;
        }

        /**
         * Get filter alignment
         */

        $filter_alignment = Prfct_Shortcodes::get_modifier__filter_alignment($atts['filters-alignment']) ;

        $args = array(
            'post_type'              => array( 'prfct_portfolio' ),
            'post_status'            => array( 'publish' ),
        );
        
        $html_output = '';

        // The Query
        $prfct_query = new WP_Query( $args );

        if ( $prfct_query->have_posts() ){            

            $html_output .= "<div uk-filter='target: .js-filter'>";

                $html_output .= Prfct_Shortcodes::get_html__filters($tags ,$show_all_filter, $filter_alignment);

                $html_output .= "<ul class='js-filter uk-child-width-1-2 uk-child-width-1-4@m uk-text-center' uk-grid='masonry: true'>";

                while ($prfct_query->have_posts()) {

                    $prfct_query->the_post();
                    $post_title = get_the_title();
                    $ID = get_the_ID();
                    $post_content = "";
                    if ($modal){
                        $post_content = apply_filters( 'the_content', get_the_content() );
                    }

                    // Filter Tags
                    // Tag slugs for this item init as empty
                    $tag_slugs_as_tags = '';

                    // Get Tags for this item
                    $tag_slugs = get_the_terms( $ID, 'prfct_tx_portfolio_tag' );
                    if (!empty($tag_slugs)){
                        $tag_slugs_array = Prfct_Shortcodes::__extract_slugs($tag_slugs);
                        $tag_slugs_as_tags = implode(" ", $tag_slugs_array);
                    }

                    /**
                     * Item Master Template
                     */

                    $html_output .= "<li data-color='blue' data-tags='{$tag_slugs_as_tags}'>";

                        // Modal Trigger BEGIN <a ... >
                        if(!empty($modal)){
                            $html_output .= Prfct_Shortcodes::get_html__modal_wrapper_open_tag($ID, $modal_type, $modal_style);
                        }

                        // Wrapper
                            $html_output .= "<div class='uk-card uk-card-default'>";

                                // Tile image
                                $html_output .="<div class='uk-card-media-top'>";
                                
                                
                                $html_output .="<div class='uk-inline-clip uk-transition-toggle uk-light' tabindex='0'>";
                                    $html_output .= Prfct_Shortcodes::get_html__thumbnail_img($ID);

                                        $html_output .="<div class='uk-overlay-primary uk-position-cover uk-transition-fade'></div>";
                                        $html_output .="<div class='uk-position-center'>";
                                            $html_output .="<div class='uk-transition-slide-bottom-small'><p class='uk-margin-remove uk-text-lead'>{$post_title}</p></div>";
                                        $html_output .="</div>";
                                    $html_output .="</div>";
                                    
                                $html_output .= "</div>";

                                // Title
                                if ($show_title_in_list){
                                    $html_output .= "<div class='uk-card-body'>";
                                        $html_output .= "<div class='uk-text-center'>{$post_title}</div>";
                                    $html_output .= "</div>";
                                }

                            $html_output .= "</div>";

                        // Modal Trigger END </a>
                        if(!empty($modal)){
                            $html_output .= Prfct_Shortcodes::get_html__modal_wrapper_close_tag();
                            $html_output .= "</a>";
                        }

                        // Modal Content
                        if(!empty($modal)){
                            $html_output .= Prfct_Shortcodes::get_html__modal_content($ID, $modal_type, $modal_style, $post_title, $post_content);
                        }

                    $html_output .= "</li>";

                }

                $html_output .= "</ul>";

            $html_output .= "</div>";
        }
        wp_reset_query();

        return $html_output;
    }

    /**
	 * Returns HTML Block of filters based on tags provided
     * 
	 * @since    1.0.0
     * @param string $tags Comma separated tag slugs
	 * @return string 
	 */
    protected static function get_html__filters($tags = '', $show_all_filter = 1, $filter_alignment = 'uk-flex-left'){
        
        $filters = "";
        $filters .= "<ul class='uk-subnav uk-subnav-pill {$filter_alignment}'>";

        if ($show_all_filter){
            $filters .= '<li class="uk-active" uk-filter-control><a href="#">All</a></li>';
        }

        if(!empty($tags)){
            $tags = get_terms( 
                array(
                   'taxonomy' => 'prfct_tx_portfolio_tag',
                   'hide_empty' => false,
                   'include' => $tags,
                ) 
            );

        }else{
            // Get all Terms that are not empty
            $tags = get_terms( 
                array(
                   'taxonomy' => 'prfct_tx_portfolio_tag',
                   'hide_empty' => true,
                ) 
            );
        }

        foreach ($tags as $key => $tag) {
            $filters .= '<li uk-filter-control="[data-tags*=' . $tag->slug . ']"><a href="#">' . $tag->name . '</a></li>';
        }

        $filters .= "</ul>";
        return $filters;
    }


    protected static function get_html__thumbnail_img($post_id = 0, $post_title = '') {
        
        $html_img = "<canvas width='300' height='300'></canvas>";
        if ((!empty($post_id)) && (has_post_thumbnail($post_id))) {
            $header_image =  wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'perfecto_portfolio_thumb');
            $header_image_url = esc_url($header_image[0]);
            $header_image_height = $header_image[2];
            $html_img = "<img data-src='{$header_image_url}' loading='lazy' alt='{$post_title}' height='{$header_image_height}' uk-img>";
        }
        return $html_img;
    }


    /**
     * Generates Modal Trigger Link based on options
     *  
     */    
    protected static function get_html__modal_wrapper_open_tag($post_id = 0, $modal_type = 'modal', $modal_style = ''){
        $html_output = "<a class='' href='#modal-{$post_id}' uk-toggle>";
        return $html_output;

    }

    /**
     * Generates Modal Trigger Link closing tag
     *  
     */    
    protected static function get_html__modal_wrapper_close_tag(){
        $html_output = '</a>';
        return $html_output;
    }

    /**
     * Generates Modal Content based on 
     */
    protected static function get_html__modal_content($post_id = 0, $modal_type = 'modal', $modal_style = '', $post_title='', $post_content = ''){

        // modal_type = [modal, gallery, OR lightbox]
        // modal_style = [top, center, full-modal]

        $html_output = '';
        // $img_url =  esc_url(get_the_post_thumbnail_url($post_id));
        $img =  wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'perfecto_portfolio_thumb_lg');
        $img_url = esc_url($img[0]);

        $is_flex_top = '';
        $is_center_vertical = '';

        switch ($modal_type) {

            case 'gallery':
                // WHEN:     
                // modal_type = gallery

                // break;

            case 'lightbox':
                // WHEN:     
                // modal_type = lightbox

                // break;
            
            default:   
                // WHEN:     
                // modal_type = modal

                switch($modal_style) { 

                    case 'full-modal': {
                        // WHEN:
                        // modal_type = modal
                        // modal_style = full-modal

                            $html_output .= '<div id="modal-'.$post_id.'" class="uk-modal-full" uk-modal>';
                                $html_output .= '<div class="uk-modal-dialog">';
                                    $html_output .= '<button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>';
                                    $html_output .= '<div class="uk-grid-collapse uk-child-width-1-2@s uk-flex-middle" uk-grid>';
                                        if (!empty($img_url)){
                                            $html_output .= "<div class='uk-background-cover' style='background-image: url(\"{$img_url}\");' uk-height-viewport></div>";
                                        }
                                        $html_output .= '<div class="uk-padding-large">';
                                            $html_output .= "<h2>{$post_title}</h2>";
                                            $html_output .= $post_content;
                                        $html_output .= '</div>';
                                    $html_output .= '</div>';
                                $html_output .= '</div>';
                            $html_output .= '</div>';

                        break; 
                    }

                    case 'center-modal':{
                        // WHEN:
                        // modal_type = modal
                        // modal_style = center

                        $is_flex_top = 'uk-flex-top';
                        $is_center_vertical = 'uk-margin-auto-vertical';
                    
                    }

                    default:{
                        // WHEN:
                        // modal_type = modal
                        // modal_style = top-modal

                        $html_output .= "<div id='modal-{$post_id}' class='uk-modal-container  {$is_flex_top}' uk-modal>";
                            $html_output .= "<div class='uk-modal-dialog uk-modal-body uk-modal-container {$is_center_vertical}'>";

                                $html_output .= '<button class="uk-modal-close-default" type="button" uk-close></button>';

                                $html_output .= "<div class='uk-grid-collapse uk-child-width-1-2@s' uk-grid>";

                                    $html_output .= "<div class='uk-card-body'>";
                                        $html_output .= "<div class='uk-card-media-left uk-cover-container uk-card-large'>";
                                            if (!empty($img_url)){
                                                $html_output .= "<img src='{$img_url}' alt='' uk-cover/>";
                                            }
                                            $html_output .= "<canvas width='570' height='570' style='background:rgba(0,0,0,0.1);border:0;'></canvas>";
                                        $html_output .= "</div>";
                                    $html_output .= "</div>";

                                    $html_output .= "<div>";
                                        $html_output .= "<div class='uk-card-body'>";
                                            $html_output .= "<h2 class='uk-margin'>{$post_title}</h2>";
                                            $html_output .= $post_content;
                                        $html_output .= "</div>";
                                    $html_output .= "</div>";

                                $html_output .= "</div>";


                            $html_output .= '</div>';
                        $html_output .= '</div>';

                    } 
                } 

                break;
        }

        return $html_output;
        
    }

    /**
     * Return CSS Class to modify alignment of filters
     */
    protected static function get_modifier__filter_alignment($alignment = 'left') {
        $filter_alignment = 'uk-flex-left';
        switch ($alignment) {
            case 'right':
                $filter_alignment = 'uk-flex-right';
                break;

            case 'center':
                $filter_alignment = 'uk-flex-center';
            break;
        
            default:
                $filter_alignment = 'uk-flex-left';
                break;
        }
        return $filter_alignment;
    }

    /**
     * Return CSS Class to modify gap between tiles
     */
    protected static function get_modifier__grid_gap($alignment = 'medium') {
        // only Available in PRO
    }
        
    protected static function __extract_slugs($array = array()) {
        $slugs = array();
        foreach ($array as $object) {
            $slugs[] = $object->slug;
        }
        return $slugs;
    }

}
