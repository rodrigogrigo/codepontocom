<?php

/*-----------------------------------------------------------------------------------*/
/*  Define variables
/*-----------------------------------------------------------------------------------*/

define('COMET_THEME_URI', get_template_directory_uri());
define('COMET_THEME_DIR', get_template_directory());
define('COMET_CSS_URI', COMET_THEME_URI . '/assets/css');
define('COMET_JS_URI', COMET_THEME_URI . '/assets/js');
define('COMET_FW_DIR', COMET_THEME_DIR . '/framework');

/*-----------------------------------------------------------------------------------*/
/*  Theme Setup
/*-----------------------------------------------------------------------------------*/

add_action('after_setup_theme', 'comet_theme_setup');

if ( ! function_exists('comet_theme_setup') ) {
  function comet_theme_setup(){

    /* Load scripts and styles */
    add_action('wp_enqueue_scripts', 'comet_enqueue_assets');

    /* Load admin scripts and styles */
    add_action('admin_enqueue_scripts', 'comet_admin_assets');

    /* Load Text Domain*/
    load_theme_textdomain('comet-wp', get_template_directory() . '/languages');

    // add_editor_style( LIB_DIR . '/admin/css/admin-style.css' );

    /* Set the content width */
    if (!isset($content_width)){ $content_width = 1170; }

    /* Register menu */
    add_action('init', 'comet_menu_init');

    /* Add thumbnails support */
    add_theme_support( 'post-thumbnails' );

    /* Add WooCommerce Support */
    add_theme_support( 'woocommerce' );

    /* Add images sizes*/
    add_image_size('comet_medium', 960);
    add_image_size('comet_small', 550);

    // Post formats
    add_theme_support('post-formats', array('audio', 'video', 'quote', 'image', 'gallery', 'link'));

    add_theme_support( 'custom-background', array('default-color' => 'ffffff') );
    add_theme_support( 'automatic-feed-links' );

    if ( function_exists( '_wp_render_title_tag' ) ) {
      add_theme_support( 'title-tag' );
    }
  }
}

/* Register Fonts */

function comet_fonts_url() {
  $font_url = '';

  $primary_font = comet_options('primary_font');
  $heading_font = comet_options('heading_font');
  $serif_font   = comet_options('serif_font');
  $cursive_font = comet_options('cursive_font');

  /* Translators: If there are characters in your language that are not
  * supported by Raleway, translate this to 'off'. Do not translate
  * into your own language.
  */
  $raleway = _x( 'on', 'Raleway font: on or off', 'comet-wp' );

  /* Translators: If there are characters in your language that are not
  * supported by Montserrat, translate this to 'off'. Do not translate
  * into your own language.
  */
  $montserrat = _x( 'on', 'Montserrat font: on or off', 'comet-wp' );

  /* Translators: If there are characters in your language that are not
  * supported by Halant, translate this to 'off'. Do not translate
  * into your own language.
  */
  $halant = _x( 'on', 'Halant font: on or off', 'comet-wp' );

  /* Translators: If there are characters in your language that are not
  * supported by Tangerine, translate this to 'off'. Do not translate
  * into your own language.
  */
  $tangerine = _x( 'on', 'Tangerine font: on or off', 'comet-wp' );

  if ( 'off' !== $raleway || 'off' !== $montserrat || 'off' !== $halant || 'off' !== $tangerine ) {
    $font_families = array();
  }

  if ('off' !== $raleway && empty($primary_font['font-family']) || $primary_font['font-family'] == 'Raleway') {
    $font_families[] = 'Raleway:300,400,500';
  }
  if ('off' !== $montserrat && empty($heading_font['font-family']) || $heading_font['font-family'] == 'Montserrat') {
    $font_families[] = 'Montserrat:400,700';
  }
  if ('off' !== $halant && empty($serif_font['font-family']) || $serif_font['font-family'] == 'Halant') {
    $font_families[] = 'Halant:300,400';
  }
  if ('off' !== $tangerine && empty($cursive_font['font-family']) || $cursive_font['font-family'] == 'Tangerine') {
    $font_families[] = 'Tangerine:400';
  }

  $font_url = add_query_arg( 'family', urlencode( implode($font_families, '|') ), "//fonts.googleapis.com/css" );

  return esc_url_raw($font_url);

}

/*-----------------------------------------------------------------------------------*/
/* Enqueue scripts and styles */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists('comet_enqueue_assets') ) {
  function comet_enqueue_assets(){

    // Styles
    wp_register_style('bundle-css', COMET_CSS_URI . '/bundle.css');
    wp_enqueue_style('bundle-css');

    wp_enqueue_style('style', get_stylesheet_uri(), '');

    if (!class_exists('wp_less')) {
      wp_enqueue_style('theme', COMET_CSS_URI . '/theme.css', '');
    }

    wp_enqueue_style( 'comet-fonts', comet_fonts_url(), array(), '1.0.0' );

    // Scripts
    if (comet_options('google_maps_api_key')) {
      wp_enqueue_script('google-maps', 'https://maps.google.com/maps/api/js?key='.comet_options('google_maps_api_key'), '', false, true);
    }
    wp_enqueue_script( 'bundle', COMET_JS_URI . '/bundle.js', array('jquery'), false, true );

    wp_enqueue_script('main', COMET_JS_URI . '/main.js', array('jquery'), false, true);

    if (comet_options('smooth_scroll')) {
      wp_enqueue_script('smooth-scroll', COMET_JS_URI . '/SmoothScroll.js', array('jquery'), false, true);
    }

    $script_variables = array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
      'template_dir' => get_stylesheet_directory_uri()
    );

    wp_localize_script('main', 'comet_var', $script_variables );

    if (is_single()) {
      wp_enqueue_script('comment-reply');
    }

  }
}

/*-----------------------------------------------------------------------------------*/
/* Enqueue admin scripts and styles */
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists('comet_admin_assets') ) {
  function comet_admin_assets(){

    wp_enqueue_media();

    wp_enqueue_style('comet_themify', COMET_CSS_URI . '/lib/themify-icons.css');
    wp_enqueue_style('comet_etline', COMET_CSS_URI . '/lib/et-line-icons.css');

    wp_enqueue_style('comet_admin_style', COMET_THEME_URI.'/framework/admin/css/admin.css');

    wp_enqueue_script('comet_bs_js', COMET_JS_URI.'/lib/bootstrap.js');
    wp_enqueue_script('comet_admin_script', COMET_THEME_URI.'/framework/admin/js/admin.js');

  }
}

/*-----------------------------------------------------------------------------------*/
/* Register nav menus */
/*-----------------------------------------------------------------------------------*/
if (! function_exists('comet_menu_init') ) {
  function comet_menu_init(){
    register_nav_menus(
      array(
        'primary'   =>  esc_html__('Header Navigation', 'comet-wp'),
      )
    );
  }
}

/*-----------------------------------------------------------------------------------*/
/*  Call the framework
/*-----------------------------------------------------------------------------------*/

require_once COMET_FW_DIR . '/framework.php';
