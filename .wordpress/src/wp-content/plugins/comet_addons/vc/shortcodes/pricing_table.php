<?php

add_shortcode('cm_pricing_table', 'comet_pricing_table');

function comet_pricing_table($atts){
  extract( shortcode_atts( array(
    'icon_type' => 'etline',
    'icon_etline'  => '',
    'icon_themify'  => '',
    'title' => '',
    'price' => '',
    'currency' => '$',
    'interval' => 'm',
    'style' => '',
    'features' => '',
    'button' => '',
    'button_color' => 'color'
  ), $atts ) );

  $lines = vc_param_group_parse_atts($features);

  $icon = '';
  switch ($icon_type) {
    case 'themify':
      $icon = $icon_themify;
      break;
    default:
      $icon = $icon_etline;
      break;
  }

  $output = '<div class="pricing-table '.$style.'">';
  
  $output .= '<div class="pricing-head">';
  $output .= '<i class="'.esc_attr($icon).'"></i>';
  $output .= '<h4 class="upper">'.esc_attr($title).'</h4>';
  $output .= '</div>';
  
  $output .= '<div class="price">';
  $output .= '<h2>';
  $output .= '<span>'.esc_attr($currency).'</span>';
  $output .= esc_attr($price);
  if ($interval) {
    $output .= '<span>/'.esc_attr($interval).'</span>';
  }
  $output .= '</h2>';
  $output .= '</div>';

  if ($lines) {
    $output .= '<ul class="features nav">';
    foreach ($lines as $line) {
      $output .= '<li><span>'.$line['text'].'</span></li>';
    }
    $output .= '</ul>';
  }

  if ($button){
    $link = vc_build_link($button);
    $target = (!empty($link['target'])) ? 'target="'.$link['target'].'"' : '';

    $output .= '<div class="pricing-footer">';    
    $output .= '<a class="btn btn-'.$button_color.'" '.$target.' href="'.esc_url($link['url']).'">'.esc_attr($link['title']).'</a>';
    $output .= '</div>';
  }

  $output .= '</div>';
  
  return $output;
}
