<?php

add_shortcode( 'cm_button', 'comet_button' );

function comet_button( $atts ) {
  extract( shortcode_atts( array(
    'text'  => '',
    'link'  => '',
    'style' => 'color',
    'alignment' => 'inline-btn-container',
    'shape' => '',
    'size'  => '',
    'show_icon' => '',
    'icon_type' => 'etline',
    'icon_etline'  => '',
    'icon_themify'  => '',
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

  $btn_link = vc_build_link($link);

  $btn_class =  array(
    'btn',
    'btn-'.$style,
    $shape,
  );

  if ($size != 'normal') {
    $btn_class[] = $size;
  }

  $btn_target = (!empty($btn_link['target'])) ? 'target="'.$btn_link['target'].'"' : '';

  $output =  '<div class="btn-container '.$alignment.'">';
  $output .= '<a href="'.esc_url($btn_link['url']).'" class="'.implode(' ', $btn_class).'" '.$btn_target.'>';
  $output .= esc_attr($text);
  if ($show_icon == 'yes') {
    $output .= '<i class="'.$icon.'"></i>';
  }
  $output .= '</a>';
  $output .= '</div>';

  return $output;

}
