<?php
/*
Plugin Name: Comet Addons
Plugin URI: https://hody.co
Description: Awesome Addons for Comet Theme.
Version: 1.1.5
Author: HodyLab
Author URI: https://hody.co
*/

define( 'COMET_ADDONS_PATH', plugin_dir_path(__FILE__) );

// don't load directly
if (!defined('ABSPATH')) die('-1');

class CometExtendAddonClass {

  function __construct() {

    require_once(COMET_ADDONS_PATH . '/importer/importer.php');

    require_once(COMET_ADDONS_PATH . '/admin/admin.php');

    add_action('plugins_loaded', array($this, 'load_comet_lang') );

    // We safely integrate with VC with this hook
    add_action( 'vc_before_init', array( $this, 'integrateWithVC' ) );

    add_action( 'vc_before_init', array( $this, 'cometRows' ) );

    add_action( 'vc_before_init', array( $this, 'update_elements' ) );

  }

  public function load_comet_lang(){
    load_plugin_textdomain('comet_addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages');
  }

  public function integrateWithVC() {

    if ( ! defined( 'WPB_VC_VERSION' ) ) {
      add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
      return;
    }

    require_once(COMET_ADDONS_PATH . '/vc/vc_elements.php');
    require_once(COMET_ADDONS_PATH . '/vc/vc_shortcodes.php');
    require_once(COMET_ADDONS_PATH . '/vc/vc_icons.php');
    require_once(COMET_ADDONS_PATH . '/vc/vc_defaults.php');
    vc_add_shortcode_param( 'dropdown_multi', array($this, 'vc_dropdown_multi') );
    vc_add_shortcode_param( 'datepicker', array($this, 'vc_datepicker') );
    vc_add_shortcode_param( 'attach_video', array($this, 'vc_video') );

    vc_disable_frontend();
    vc_set_as_theme();

    // Hook for admin editor.
    add_action( 'vc_build_admin_page', array($this, 'remove_elements'), 11 );
    // Hook for frontend editor.
    add_action( 'vc_load_shortcode', array($this, 'remove_elements'), 11 );

  }

  function update_elements(){
    $wp_el = array('vc_wp_search', 'vc_wp_meta', 'vc_wp_recentcomments', 'vc_wp_calendar', 'vc_wp_pages', 'vc_wp_tagcloud', 'vc_wp_custommenu', 'vc_wp_text', 'vc_wp_posts', 'vc_wp_categories', 'vc_wp_archives', 'vc_wp_rss');

    foreach ($wp_el as $key => $value) {
      vc_map_update($value, array('icon' => 'ti-wordpress'));
    }

    $woo_el = array('woocommerce_cart', 'woocommerce_checkout', 'woocommerce_order_tracking', 'woocommerce_my_account', 'recent_products', 'featured_products', 'product', 'products', 'add_to_cart', 'add_to_cart_url', 'product_page', 'product_category', 'product_categories', 'sale_products', 'best_selling_products', 'top_rated_products', 'product_attribute');

    if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
      foreach ($woo_el as $key => $value) {
        vc_map_update($value, array('icon' => 'ti-shopping-cart'));
      }
    }

    $vc_el = array(
      'contact-form-7' => 'ti-email',
      'vc_row' => 'ti-layout-tab-window',
      'vc_section' => 'ti-layout-tab-window',
      'vc_column_text' => 'ti-text',
      'vc_separator' => 'ti-arrows-horizontal',
      'vc_text_separator' => 'ti-more',
      'vc_single_image' => 'ti-image',
      'vc_gallery' => 'ti-gallery',
      'vc_custom_heading' => 'ti-uppercase',
      'vc_widget_sidebar' => 'ti-layout-sidebar-left',
      'vc_video' => 'ti-video-camera',
      'vc_raw_html' => 'ti-html5',
      'vc_flickr' => 'ti-flickr',
      'vc_pie' => 'ti-pie-chart',
      'vc_line_chart' => 'ti-bar-chart',
      'vc_empty_space' => 'ti-arrows-vertical',
      'vc_tta_pageable' => 'ti-layout-slider-alt',
      'vc_round_chart' => 'ti-control-record',
      'vc_zigzag' => 'ti-bolt-alt',
      'vc_hoverbox' => 'ti-widget',
      'vc_tta_accordion' => 'ti-layout-accordion-separated',
    );

    foreach ($vc_el as $key => $value) {
      vc_map_update($key, array('icon' => $value));
    }
  }

  function remove_elements() {

    $elements = array( 'icon', 'masonry_media_grid', 'masonry_grid', 'basic_grid', 'media_grid', 'tta_tabs', 'tta_tour', 'btn', 'toggle', 'cta', 'facebook', 'tweetmeme', 'googleplus', 'pinterest', 'tabs', 'tour', 'accordion', 'button', 'button2', 'cta_button', 'cta_button2', 'message', 'progress_bar', 'gmaps', 'posts_slider', 'image_carousel', 'raw_js', 'images_carousel');

    foreach ( $elements as $key) {
      vc_remove_element( 'vc_'.$key );
    }

  }

  function vc_datepicker( $settings, $value ) {
    $value = htmlspecialchars( $value );

    return '<input name="' . $settings['param_name']
           . '" class="wpb_vc_param_value wpb-textinput '
           . $settings['param_name'] . ' ' . $settings['type']
           . '" type="date" value="' . $value . '"/>';
  }

  function vc_video( $settings, $value ) {
    $value = htmlspecialchars( $value );

    return '<input name="' . $settings['param_name']
         . '" class="wpb_vc_param_value wpb-textinput '
         . $settings['param_name'] . ' ' . $settings['type']
         . '" type="text" value="' . $value . '" style="width: 75%;">
        <button style="height: 35px;" class="button upload_video_button" type="button">'.__('Browse Videos', 'comet_addons') .'</button>';
  }

  function vc_dropdown_multi( $settings, $value ) {
    $output = '';
    $css_option = str_replace( '#', 'hash-', vc_get_dropdown_option( $settings, $value ) );
    $output .= '<select name="'
               . $settings['param_name']
               . '" multiple="true" class="wpb_vc_param_value wpb-input wpb-select '
               . $settings['param_name']
               . ' ' . $settings['type']
               . ' ' . $css_option
               . '" data-option="' . $css_option . '">';
    if ( is_array( $value ) ) {
      $value = isset( $value['value'] ) ? $value['value'] : array_shift( $value );
    }
    if ( ! empty( $settings['value'] ) ) {
      foreach ( $settings['value'] as $index => $data ) {
        if ( is_numeric( $index ) && ( is_string( $data ) || is_numeric( $data ) ) ) {
          $option_label = $data;
          $option_value = $data;
        } elseif ( is_numeric( $index ) && is_array( $data ) ) {
          $option_label = isset( $data['label'] ) ? $data['label'] : array_pop( $data );
          $option_value = isset( $data['value'] ) ? $data['value'] : array_pop( $data );
        } else {
          $option_value = $data;
          $option_label = $index;
        }
        $selected = '';
        $option_value_string = (string) $option_value;
        $current_value = strlen( $value ) > 0 ? explode( ',', $value ) : array();
        if ( count( $current_value ) > 0 && in_array( $option_value_string, $current_value ) ) {
          $selected = ' selected="selected"';
        }
        $option_class = str_replace( '#', 'hash-', $option_value );
        $output .= '<option class="' . esc_attr( $option_class ) . '" value="' . esc_attr( $option_value ) . '"' . $selected . '>'
                   . htmlspecialchars( $option_label ) . '</option>';
      }
    }
    $output .= '</select>';

    return $output;
  }

  /*
  Show notice if your plugin is activated but Visual Composer is not
  */
  public function showVcVersionNotice() {
    $plugin_data = get_plugin_data(__FILE__);
    echo '
    <div class="updated">
      <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
    </div>';
  }

  public function cometRows(){

    vc_remove_param('vc_row', 'columns_placement');
    vc_remove_param('vc_row', 'gap');
    vc_remove_param('vc_row', 'equal_height');
    vc_remove_param('vc_row', 'video_bg_parallax');
    vc_remove_param('vc_row', 'video_bg_url');
    vc_remove_param('vc_row', 'el_id');
    vc_remove_param('vc_row', 'el_class');
    vc_remove_param('vc_row', 'parallax_speed_video');
    vc_remove_param('vc_row', 'css_animation');

    vc_add_param('vc_column_text', array(
      'type' => 'dropdown',
      'value' => array(
        'Default'    => '',
        'Serif'  => 'serif',
        'Cursive'   => 'cursive'
      ),
      'heading' => __('Font Style', 'comet_addons'),
      'param_name' => 'font_style',
      'std' => '',
    ));

    vc_add_params('vc_row', array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Use video background?', 'comet_addons' ),
        'param_name' => 'video_bg',
        'description' => __( 'If checked, video will be used as row background.', 'comet_addons' ),
        'value' => array(
          'No' => '',
          'Yes, from YouTube' => 'youtube',
          'Yes, self hosted video' => 'self_hosted'
        ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'YouTube link', 'comet_addons' ),
        'param_name' => 'video_bg_url',
        'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
        'description' => __( 'Add YouTube link.', 'comet_addons' ),
        'dependency' => array(
          'element' => 'video_bg',
          'value' => 'youtube',
        ),
      ),
      array(
        'type' => 'attach_image',
        'value' => '',
        'heading' => __('Fallback Image for mobile devices. (YouTube videos don\'t work on mobile.)', 'comet'),
        'param_name' => 'fallback_image',
        'dependency' => array(
          'element' => 'video_bg',
          'value' => array('youtube', 'self_hosted'),
        ),
      ),
      array(
        'type' => 'attach_video',
        'heading' => __( 'Self Hosted Video', 'comet_addons' ),
        'param_name' => 'self_hosted_video',
        'value' => '',
        'description' => __( 'Select or upload a video.', 'comet_addons' ),
        'dependency' => array(
          'element' => 'video_bg',
          'value' => 'self_hosted',
        ),
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Parallax', 'comet_addons' ),
        'param_name' => 'parallax',
        'value' => array(
          __( 'No', 'comet_addons' ) => '',
          __( 'Yes', 'comet_addons' ) => 'content-moving',
        ),
        'description' => __( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'comet_addons' ),
        'dependency' => array(
          'element' => 'video_bg',
          'is_empty' => true,
        ),
      ),
      array(
        'type' => 'checkbox',
        'heading' => __( 'Full height row?', 'comet_addons' ),
        'param_name' => 'full_height',
        'description' => __( 'If checked row will be set to full height.', 'comet_addons' ),
        'value' => array( __( 'Yes', 'comet_addons' ) => 'yes' ),
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Content position', 'comet_addons' ),
        'param_name' => 'content_placement',
        'value' => array(
          __( 'Default', 'comet_addons' ) => '',
          __( 'Middle', 'comet_addons' ) => 'middle',
        ),
        'description' => __( 'Select content position within columns.', 'comet_addons' ),
      ),
      array(
        'type' => 'el_id',
        'heading' => __( 'Row ID', 'comet_addons' ),
        'param_name' => 'el_id',
        'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'comet_addons' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Extra class name', 'comet_addons' ),
        'param_name' => 'el_class',
        'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'comet_addons' ),
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Row Background Color', 'comet_addons'),
        'param_name' => 'row_bg_color',
        'value' => array(
          'Default' => '',
          'Dark' => 'dark',
          'Colored Overlay' => 'splash',
          'Animated Canvas' => 'particles-bg'
        ),
        "group" => __( "Comet Options", 'comet_addons' ),
        'std' => ''
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Split Row?', 'comet_addons'),
        'param_name' => 'split_row',
        'value' => array( 'No' => '', 'Yes' => 'yes' ),
        'description' => __("Use as split row with background image or a map.", "comet"),
        "group" => __( "Comet Options", 'comet_addons' ),
        'std' => ''
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Split Row Background', 'comet_addons'),
        'param_name' => 'split_row_bg_type',
        'value' => array( 'Image' => 'image', 'Map' => 'map' ),
        "group" => __( "Comet Options", 'comet_addons' ),
        'dependency' => array(
          'element' => 'split_row',
          'value' => array('yes')
        ),
        'std' => ''
      ),
      array(
        'type' => 'attach_image',
        'value' => '',
        'heading' => __('Split Row Background Image', 'comet_addons'),
        'param_name' => 'split_row_bg',
        "group" => __( "Comet Options", 'comet_addons' ),
        'dependency' => array(
          'element' => 'split_row_bg_type',
          'value' => array('image')
        )
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Background Image Position', 'comet_addons'),
        'param_name' => 'split_bg_position',
        'value' => array('Left' => 'left', 'Right' => 'right'),
        "group" => __( "Comet Options", 'comet_addons' ),
        'dependency' => array(
          'element' => 'split_row_bg_type',
          'value' => array('image')
        )
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Show Title?', 'comet_addons'),
        'param_name' => 'show_title',
        'value' => array( 'No' => '', 'Yes' => 'yes' ),
        "group" => __( "Comet Options", 'comet_addons' ),
        'std' => '',
        'dependency' => array(
          'element' => 'split_row_bg_type',
          'value' => array('image')
        )
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Section Title', 'comet_addons'),
        'param_name' => 'split_title',
        "group" => __( "Comet Options", 'comet_addons' ),
        'dependency' => array(
          'element' => 'show_title',
          'value' => array('yes')
        )
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Section Subtitle', 'comet_addons'),
        'param_name' => 'split_subtitle',
        "group" => __( "Comet Options", 'comet_addons' ),
        'dependency' => array(
          'element' => 'show_title',
          'value' => array('yes')
        )
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Dark'    => '',
          'Light'  => 'light',
        ),
        'heading' => 'Text Color',
        'param_name' => 'split_text_color',
        'std' => '',
        "group" => __( "Comet Options", 'comet_addons' ),
        'dependency' => array(
          'element' => 'show_title',
          'value' => array('yes')
        )
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Left'    => 'left',
          'Center'  => 'center',
          'Right'   => 'right'
        ),
        'heading' => 'Text Align',
        'param_name' => 'split_text_align',
        'std' => 'center',
        "group" => __( "Comet Options", 'comet_addons' ),
        'dependency' => array(
          'element' => 'show_title',
          'value' => array('yes')
        )
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          '' => '',
          'Left'    => 'left',
          'Center'  => 'center',
          'Right'   => 'right'
        ),
        'heading' => 'Text Align (Tablet)',
        'param_name' => 'split_text_align_sm',
        'std' => '',
        "group" => __( "Comet Options", 'comet_addons' ),
        'dependency' => array(
          'element' => 'show_title',
          'value' => array('yes')
        )
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          '' => '',
          'Left'    => 'left',
          'Center'  => 'center',
          'Right'   => 'right'
        ),
        'heading' => 'Text Align (Smartphone)',
        'param_name' => 'split_text_align_xs',
        'std' => '',
        "group" => __( "Comet Options", 'comet_addons' ),
        'dependency' => array(
          'element' => 'show_title',
          'value' => array('yes')
        )
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'None' => '',
          'Uppercase'   => 'upper',
        ),
        'heading' => 'Text Transform',
        'param_name' => 'split_text_transform',
        'std' => '',
        "group" => __( "Comet Options", 'comet_addons' ),
        'dependency' => array(
          'element' => 'show_title',
          'value' => array('yes')
        )
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Additional Content', 'comet_addons'),
        'param_name' => 'additional_content',
        'description' => __('You can add an overlay here. Example: [cm_overlay][cm_play_button url="IFRAME_URL_HERE"][/cm_overlay] ', 'comet_addons'),
        "group" => __( "Comet Options", 'comet_addons' ),
        'dependency' => array(
          'element' => 'show_title',
          'value' => array('')
        )
      ),
      array(
        'type' => 'textfield',
        'value' => '40.773328',
        'heading' => __('Map Latitude', 'comet_addons'),
        'param_name' => 'split_map_lat',
        "group" => __( "Comet Options", 'comet_addons' ),
        'description' => __('Find your Latitude and Longitude <a target="blank" href="http://www.latlong.net/">here</a>', 'comet_addons'),
        'dependency' => array(
          'element' => 'split_row_bg_type',
          'value' => array('map')
        )
      ),
      array(
        'type' => 'textfield',
        'value' => '-73.960088',
        'heading' => __('Map Longitude', 'comet_addons'),
        'param_name' => 'split_map_lng',
        "group" => __( "Comet Options", 'comet_addons' ),
        'description' => __('Find your Latitude and Longitude <a target="blank" href="http://www.latlong.net/">here</a>', 'comet_addons'),
        'dependency' => array(
          'element' => 'split_row_bg_type',
          'value' => array('map')
        )
      ),
    ));
  }
}

new CometExtendAddonClass();

/* Register Portfolio Post Type */
function comet_portfolio_init(){
  register_post_type(
    'portfolio',
    array(
      'labels' => array(
        'name'          => 'Portfolio',
        'singular_name' => 'Portfolio'
      ),
      'public'      => true,
      'has_archive' => true,
      'supports'    => array('title','thumbnail','editor')
    )
  );

  register_taxonomy(
    'portfolio_category',
    'portfolio',
    array(
      'hierarchical' => true,
      'label'        => 'Categories',
      'query_var'    => true,
      'rewrite'      => true
    )
  );
}

add_action('init', 'comet_portfolio_init');
