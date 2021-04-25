<?php

add_shortcode( 'cm_icon_box', 'comet_icon_box' );

function comet_icon_box( $atts ) {
  extract( shortcode_atts( array(
    'top_text' => 'Item No.',
    'number' => '',
    'title' => '',
    'text' => '',
    'box_style' => 'small',
    'icon_type' => 'etline',
    'icon_etline'  => '',
    'icon_themify'  => '',
    'small_style' => '',
    'back_icon' => 'yes',
    'horizontal_rule' => 'yes',
    'icon_color' => '',
    'icon_border' => ''
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

  $icon_clr = (!empty($icon_color)) ? 'style="color: '.$icon_color.'"': '';
  $icon_bd_clr = (!empty($icon_color)) ? 'style="border-color: '.$icon_color.'"': '';

  $output = '';

  switch ($box_style) {
    case 'text_box':
      $output = '<div class="text-box">';
      $output .= '<h4 class="upper small-heading">' . esc_attr($title) . '</h4>';
      $output .= '<p>' . wpb_js_remove_wpautop($text) . '</p>';
      $output .= '</div>';
      break;

    case 'number_box':
      $output = '<div class="number-box">';
      $output .= '<span>' . esc_attr($top_text) . '</span>';
      $output .= '<h2>' . esc_attr($number) . '<span class="red-dot"></span></h2>';
      $output .= '<h4>' . esc_attr($title) . '</h4>';
      $output .= '<p>' . esc_attr($text) . '</p>';
      $output .= '</div>';
      break;
    
    case 'basic':
      $output .= '<div class="icon-box-basic">';
      $output .= '<i class="'.$icon.'" '.$icon_clr.'></i>';
      $output .= '<h4>' . esc_attr($title) . '</h4>';
      $output .= '<p>' . wpb_js_remove_wpautop($text) . '</p>';
      $output .= '</div>';
      break;
    case 'simple':
      $output .= '<div class="icon-box-simple">';
      $output .= '<i class="'.$icon.' mb-15" '.$icon_clr.'></i>';
      $output .= '<span>' . esc_attr($title) . '</span>';
      $output .= '</div>';
      break;
    case 'circular':
      $output .= '<div class="icon-box-circular">';
      $output .= '<div class="ib-icon" '.$icon_bd_clr.'>';
      $output .= '<i class="'.$icon.' mb-15" '.$icon_clr.'></i>';
      $output .= '</div>';
      $output .= '<div class="ib-content">';
      if ($title) {
        $output .= '<h4>' . esc_attr($title) . '</h4>';
      }
      $output .= '<p>' . esc_attr($text) . '</p>';
      $output .= '</div>';
      $output .= '</div>';
      break;
    default:
      $output .= '<div class="icon-box-small '.str_replace(',', ' ', $small_style).'">';
      if ($icon_border == 'yes') {
        $output .= '<div class="ib-icon">';
      }
      $output .= '<i class="'.$icon.'" '.$icon_clr.'></i>';
      if (!empty($back_icon)) {
        $output .= '<span class="back-icon"><i class="'.$icon.'"></i></span>';
      }
      if ($icon_border == 'yes') {
        $output .= '</div>';
      }
      if ($horizontal_rule == 'yes') {
        $output .= '<hr>';
      }
      $output .= '<h4>' . esc_attr($title) . '</h4>';
      $output .= '<p>' . wpb_js_remove_wpautop($text) . '</p>';
      $output .= '</div>';
      break;
  }

  return $output;

}
