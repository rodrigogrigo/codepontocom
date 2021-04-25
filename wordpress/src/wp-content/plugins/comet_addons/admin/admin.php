<?php

// Load Redux and config
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '//ReduxCore/framework.php' ) ) {
  require_once( dirname( __FILE__ ) . '//ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/config.php' ) ) {
  require_once( dirname( __FILE__ ) . '/config.php' );
}

// Call Less compiler
require_once( dirname( __FILE__ ) . '/wp-less.php' );

// Enqueue theme less file
add_action('wp_enqueue_scripts', 'comet_enqueue_less', 12);
if ( ! function_exists('comet_enqueue_less') ) {
  function comet_enqueue_less(){
    wp_enqueue_style( 'theme-less', get_template_directory_uri() . '/assets/css/theme.less' );
  }
}

// pass variables into all .less files
add_filter( 'less_vars', 'comet_less_vars', 10, 2 );
function comet_less_vars( $vars, $handle ) {

  $primary    = (comet_options('primary_color') != '') ? comet_options('primary_color') : '#EF2D56';
  $black_bg   = (comet_options('dark_color') != '') ? comet_options('dark_color') : '#191b1c';
  $black      = (comet_options('text_color') != '') ? comet_options('text_color') : '#191b1d';

  $op_primary_font  = comet_options('primary_font');
  $op_heading_font  = comet_options('heading_font');
  $op_serif_font    = comet_options('serif_font');
  $op_cursive_font  = comet_options('cursive_font');

  $primary_font = (isset($op_primary_font['font-family']) && ($op_primary_font['font-family']) != '') ? $op_primary_font['font-family']  : 'Raleway';
  $heading_font = (isset($op_heading_font['font-family']) && ($op_heading_font['font-family']) != '') ? $op_heading_font['font-family']  : 'Montserrat';
  $serif_font   = (isset($op_serif_font['font-family']) && ($op_serif_font['font-family']) != '') ? $op_serif_font['font-family'] : 'Halant';
  $cursive_font = (isset($op_cursive_font['font-family']) && ($op_cursive_font['font-family']) != '')  ? $op_cursive_font['font-family']  : 'Tangerine';

  $vars[ 'primary' ] = esc_attr($primary);
  $vars[ 'black_bg' ] = esc_attr($black_bg);
  $vars[ 'black' ] = esc_attr($black);
  $vars[ 'primary_font' ] = '"'.esc_attr($primary_font).'"';
  $vars[ 'heading_font' ] = '"'.esc_attr($heading_font).'"';
  $vars[ 'serif_font' ] = '"'.esc_attr($serif_font).'"';
  $vars[ 'cursive_font' ] = '"'.esc_attr($cursive_font).'"';
  return $vars;
}
