<?php

add_shortcode( 'cm_progress_bars', 'comet_progress_bars' );

function comet_progress_bars( $atts ) {
  extract( shortcode_atts( array(
    'color' => '',
    'progress_bars' => ''
  ), $atts ) );

  $bars = vc_param_group_parse_atts($progress_bars);

  $output = '';

  if ($bars) {
    foreach ($bars as $bar) {
      $output .= '<div class="skill">';
      $output .= '<span class="skill-name">'.esc_attr($bar['name']).'</span>';
      $output .= '<span class="skill-perc">'.esc_attr($bar['percentage']).'%</span>';
      $output .= '<div class="progress">';
      $output .= '<div role="progressbar" class="progress-bar '.$color.'" data-progress="'.esc_attr($bar['percentage']).'"></div>';
      $output .= '</div>';
      $output .= '</div>';

    }
  }

  return $output;
}
