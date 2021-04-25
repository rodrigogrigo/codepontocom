<?php

add_shortcode( 'cm_text_rotator', 'comet_text_rotator' );

function comet_text_rotator( $atts ) {
  extract( shortcode_atts( array(
    'text_transform' => '',
    'headings' => ''
  ), $atts ) );

  $titles = vc_param_group_parse_atts($headings);

  $output = '<div id="text-rotator" class="flexslider">';
  $output .= '<ul class="slides">';
  if ($titles) {
    foreach ($titles as $title) {
      $output .= '<li>';
      $output .= '<h1 class="'.$text_transform.'">';
      $output .= esc_attr($title['heading']);
      $output .= '<span class="red-dot"></span>';
      $output .= '</h1>';
      $output .= '</li>';

    }
  }
  $output .= '</ul>';
  $output .= '</div>';

  return $output;
}
