<?php

function comet_bs_attribute_map($str, $att = null) {
  $res = array();
  $return = array();
  $reg = get_shortcode_regex();
  preg_match_all('~'.$reg.'~',$str, $matches);
  foreach($matches[2] as $key => $name) {
    $parsed = shortcode_parse_atts($matches[3][$key]);
    $parsed = is_array($parsed) ? $parsed : array();
      $res[$name] = $parsed;
      $return[] = $res;
    }
  return $return;
}

/**
* Bootstrap Tabs
*/

class CometTabs{
  
  function __construct(){
    add_shortcode( 'cm_tabs', array($this, 'comet_tabs'));
    add_shortcode( 'cm_single_tab', array($this, 'comet_single_tab'));
  }

  function comet_tabs($atts, $content = null){
    if( isset( $GLOBALS['tabs_count'] ) )
      $GLOBALS['tabs_count']++;
    else
      $GLOBALS['tabs_count'] = 0;

    $GLOBALS['tabs_default_count'] = 0;

    $atts = shortcode_atts( array(
      'style'   => '',
      'alignment' => ''
    ), $atts );

    $ul_class  = 'nav nav-tabs';
    $ul_class .= ( $atts['style'] == 'outline' ) ? ' outline' : '';
    $ul_class .= ( isset($atts['alignment']) && $atts['alignment'] != 'left' ) ? ' '. $atts['alignment'] : '';
      
    $div_class = 'tab-content';
    
    $atts_map = comet_bs_attribute_map( $content );
    
    // Extract the tab titles for use in the tab widget.
    if ( $atts_map ) {
      $tabs = array();
      $GLOBALS['tabs_default_active'] = true;
      foreach( $atts_map as $check ) {
        if( !empty($check["cm_single_tab"]["active"]) ) {
          $GLOBALS['tabs_default_active'] = false;
        }
      }
      $i = 0;
      foreach( $atts_map as $tab ) {
        
        $class  ='';
        $class .= ( !empty($tab["cm_single_tab"]["active"]) || ($GLOBALS['tabs_default_active'] && $i == 0) ) ? 'active' : '';
        $class .= ( !empty($tab["cm_single_tab"]["xclass"]) ) ? ' ' . $tab["cm_single_tab"]["xclass"] : '';
        
        $tabs[] = sprintf(
          '<li%s><a href="#%s" data-toggle="tab">%s</a></li>',
          ( !empty($class) ) ? ' class="' . $class . '"' : '',
          $tab["cm_single_tab"]["tab_id"],
          $tab["cm_single_tab"]["title"]
        );
        $i++;
      }
    }
    return sprintf( 
      '<ul class="%s">%s</ul><div class="%s">%s</div>',
      esc_attr( $ul_class ),
      ( $tabs )  ? implode( $tabs ) : '',
      esc_attr( $div_class ),
      wpb_js_remove_wpautop( $content )
    );
  }

  function comet_single_tab($atts, $content = null){
    
      $atts = shortcode_atts( array(
        'title'   => false,
        'tab_id'  => false,
        'active'  => false,
        'fade'    => true,
      ), $atts );
      
      if( $GLOBALS['tabs_default_active'] && $GLOBALS['tabs_default_count'] == 0 ) {
        $atts['active'] = true;
      }
      $GLOBALS['tabs_default_count']++;

      $class  = 'tab-pane';
      $class .= ( $atts['fade']   == 'true' )                            ? ' fade' : '';
      $class .= ( $atts['active'] == 'true' )                            ? ' active' : '';
      $class .= ( $atts['active'] == 'true' && $atts['fade'] == 'true' ) ? ' in' : '';

      return sprintf( 
        '<div id="%s" class="%s">%s</div>',
        esc_attr( $atts['tab_id'] ),
        esc_attr( $class ),
        wpb_js_remove_wpautop( $content )
      );
  }
}

new CometTabs();
