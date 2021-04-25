<?php

add_shortcode( 'cm_page_title', 'comet_page_title' );

function comet_page_title( $atts ) {
  extract( shortcode_atts( array(
    'title' => '',
    'subtitle' => '',
    'tag' => 'h2',
    'border' => '',
    'text_align' => 'center',
    'text_align_sm' => '',
    'text_align_xs' => '',
    'text_transform' => '',
    'title_dot'  => '1',
    'title_style' => '',
    'subtitle_style' => '',
    'horizontal_rule' => '1',
    'show_icon' => '',
    'icon_type' => 'etline',
    'icon_etline'  => '',
    'icon_themify'  => '',
    'hr_color' => ''
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

  $class_array = array('title');

  if (empty($text_align_sm) && empty($text_align_xs) && $text_align != 'left') {
    $class_array[] = $text_align;
  } elseif ($text_align != 'left') {
    $class_array[] = 'txt-md-'.$text_align;
  }
  
  if (!empty($text_align_xs)) {
    $class_array[] = 'txt-xs-'.$text_align_xs;
  }

  if (!empty($text_align_sm)) {
    $class_array[] = 'txt-sm-'.$text_align_sm;
  }

  $text_class = $text_transform;
  if ($title_style) {
    $text_class .= ' '.$title_style;
  }

  $output = '<div class="'.implode(' ', $class_array).'">';
  if ($show_icon == 'yes') {
    $output .= '<i class="'.$icon.'"></i>';
  }
  if ($subtitle_style == 'cursive' && $subtitle) {
    $output .= '<h2 class="cursive mb-0">'. esc_attr($subtitle) .'</h2>';
  } elseif($subtitle) {
    $output .= '<h4 class="upper '.$subtitle_style.'">'. esc_attr($subtitle) .'</h4>';
  }
  $output .= '<'.$tag . ' class="'.$text_class .'">' . esc_attr($title);
  if ($title_dot == '1') {
    $output .= '<span class="red-dot"></span>';
  }
  $output .= '</'.$tag.'>';
  if ($horizontal_rule == '1') {
    $hr_class = (!empty($hr_color) && $hr_color == 'black') ? ' class="black"': '';
    $output .= '<hr'.$hr_class.'>';
  }
  $output .= '</div>';

  return $output;
}
