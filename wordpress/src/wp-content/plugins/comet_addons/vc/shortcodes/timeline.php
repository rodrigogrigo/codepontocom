<?php

add_shortcode( 'cm_timeline', 'comet_timeline' );

function comet_timeline( $atts ) {
  extract( shortcode_atts( array(
    'items' => ''
  ), $atts ) );

  $timeline_items = vc_param_group_parse_atts($items);

  $output = '<ul class="timeline">';
  if ($timeline_items) {
    foreach ($timeline_items as $item) {
      $output .= '<li>';
      $output .= '<div class="timeline-item">';
      $output .= '<h4>'.esc_attr($item['place']).'</h4>';
      $output .= '<span>'.esc_attr($item['date']).'</span>';
      $output .= '</div>';
      $output .= '<div class="timeline-description">';
      $output .= '<h4>'.esc_attr($item['title']).'</h4>';
      $output .= '<p>'.esc_attr($item['text']).'</p>';
      $output .= '</div>';
      $output .= '</li>';
    }
  }
  $output .= '</ul>';

  return $output;

}
