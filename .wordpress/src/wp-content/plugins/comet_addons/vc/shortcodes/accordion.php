<?php

add_shortcode( 'cm_accordion', 'comet_accordion' );

function comet_accordion( $atts ) {
  extract( shortcode_atts( array(
    'behavior' => '',
    'items' => ''
  ), $atts ) );

  $accordions = vc_param_group_parse_atts($items);
  $multiple = (isset($behavior) && $behavior == 'multiple') ? 'data-multiple="true"' : '' ;

  $output = '<ul '.$multiple.' class="accordion nav">';
  if ($accordions) {
    foreach ($accordions as $accordion) {

      $output .= '<li>';
      $output .= '<div class="accordion-title">';
      $output .= '<h4>'.esc_attr($accordion['title']).'</h4>';
      $output .= '</div>'; 
      $output .= '<div class="accordion-content">';
      $output .= '<p>'.esc_attr($accordion['text']).'</p>';
      $output .= '</div>';      
      $output .= '</li>';

    }
  }
  $output .= '</ul>';

  return $output;

}
