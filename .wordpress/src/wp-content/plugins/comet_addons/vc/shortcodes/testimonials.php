<?php

add_shortcode( 'cm_testimonials', 'comet_testimonials' );

function comet_testimonials( $atts ) {
  extract( shortcode_atts( array(
    'clients' => ''
  ), $atts ) );

  $clients = vc_param_group_parse_atts($clients);

  $output = '<div id="testimonials-slider" data-options=\'{"animation": "slide", "directionNav": true}\' class="flexslider nav-outside">';
  $output .= '<ul class="slides">';
  if ($clients) {
    foreach ($clients as $client) {

      $output .= '<li>';
      $output .= '<blockquote>';
      if (isset($client['client_comment'])) {
        $output .= '<p>"'.esc_attr($client['client_comment']).'"</p>';
      }
      if (isset($client['client_name'])) {
        $output .= '<footer>'.esc_attr($client['client_name']).'</footer>';
      }
      $output .= '</blockquote>';
      $output .= '</li>';

    }
  }
  $output .= '</ul>';
  $output .= '</div>';

  return $output;

}
