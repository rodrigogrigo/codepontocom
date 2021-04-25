<?php

add_shortcode('cm_counter', 'comet_counter');

function comet_counter($atts){
  extract( shortcode_atts( array(    
    'text' => '',
    'number' => '',
    'icon_type' => 'etline',
    'icon_etline'  => '',
    'icon_themify'  => '',
    'icon_position' => '',
    'font_style' => ''
  ), $atts ) );

  $icon = '';
  switch ($icon_type) {
    case 'themify':
      $icon = $icon_themify;
      break;
    default:
      $icon = $icon_etline;
      break;
  }

  $output = '<div class="counter '.$icon_position.'">';
  $output .= '<div class="counter-icon">';
  $output .= '<i class="'.$icon.'"></i>';
  $output .= '</div>';
  $output .= '<div class="counter-content">';
  $output .= '<h5 class="'.$font_style.'"><span class="number-count" data-count="'.esc_attr($number).'">'.esc_attr($number).'</span><span class="red-dot"></span></h5>';
  $output .= '<span>'.esc_attr($text).'</span>';
  $output .= '</div>';
  $output .= '</div>';

  return $output;

}
