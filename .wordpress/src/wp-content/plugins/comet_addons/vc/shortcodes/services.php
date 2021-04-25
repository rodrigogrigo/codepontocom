<?php

add_shortcode( 'cm_services', 'comet_services' );

function comet_services( $atts, $content ) {
  extract( shortcode_atts( array(
    'content'   => !empty($content)? $content : ''
  ), $atts ) );

  $output = '<div class="services">';
  $output .= wpb_js_remove_wpautop($content);
  $output .= '</div>';
  
  return $output;
}

add_shortcode( 'cm_single_service', 'comet_single_service' );

function comet_single_service( $atts ) {
  extract( shortcode_atts( array(
    'title' => '',
    'text'  => '',
    'icon_type' => 'etline',
    'icon_etline'  => '',
    'icon_themify'  => '',
    'borders' => '',
    'column_width' => 'vc_col-md-6',
    'column_width_sm' => 'vc_col-sm-6',
    'column_width_xs' => 'vc_col-xs-12',
    'add_link' => '',
    'link' => '',
  ), $atts ) );

  $borders_array = explode(',', $borders);
  $column_class = implode(' ', array($column_width, $column_width_sm, $column_width_xs, implode(' ', $borders_array)));  
  $icon = '';

  switch ($icon_type) {
    case 'themify':
      $icon = $icon_themify;
      break;
    default:
      $icon = $icon_etline;
      break;
  }

  $service_link = vc_build_link($link);
  $target = (!empty($service_link['target'])) ? 'target="'.$service_link['target'].'"' : '';

  $output = '<div class="'.$column_class.'">';
  $output .= '<div class="service">';
  if ($icon) {
    $output .= '<i class="'.esc_attr($icon).'"></i>';
    $output .= '<span class="back-icon"><i class="'.esc_attr($icon).'"></i></span>';
  }
  $output .= '<h4>'.esc_attr($title).'</h4>';
  $output .= '<hr>';
  $output .= '<p class="alt-paragraph">'.esc_attr($text).'</p>';
  $output .= '</div>';
  if ($add_link == 'yes') {
    $output .= '<a class="service-link" '.$target.' href="'.esc_url($service_link['url']).'" title="'.esc_attr($service_link['title']).'"></a>';
  }
  $output .= '</div>';
  
  return $output;
}


?>
