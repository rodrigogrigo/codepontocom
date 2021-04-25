<?php

add_shortcode( 'cm_clients', 'comet_clients' );

function comet_clients( $atts ) {
  extract( shortcode_atts( array(
    'column_width' => 'col-sm-4 col-xs-6',
    'images' => ''
  ), $atts ) );

  $clients = vc_param_group_parse_atts($images);

  $output = '<div class="boxes clients">';
  $output .= '<div class="row">';
  if ($clients) {
    foreach ($clients as $client) {
      
      $column_class = $column_width;
      if (isset($client['borders'])) {
        $column_class .= ' ' . str_replace(',', ' ', $client['borders']);
      }

      $output .= '<div class="'.$column_class.'">';
      $output .= '<img class="client-image" src="'.esc_url(wp_get_attachment_url($client['image'])).'" data-animated="true" alt="">';
      $output .= '</div>';

    }
  }
  $output .= '</div>';
  $output .= '</div>';

  return $output;

}
