<?php

add_shortcode( 'cm_restaurant_menu', 'comet_rs_menu' );

function comet_rs_menu( $atts ) {
  extract( shortcode_atts( array(
    'menu_items' => ''
  ), $atts ) );

  $items = vc_param_group_parse_atts($menu_items);

  $output = '<div class="restaurant-menu">';
  $output .= '<div class="row">';

  foreach ($items as $item) {
    $output .= '<div class="col-md-6">';
    
    $item_class = 'rs-menu ';
    if (isset($item['image_position'])) {
      $item_class .= $item['image_position'];
    }

    $output .= '<div class="'.$item_class.'">';
    
    $output .= '<div class="rs-menu-media">';
    if (isset($item['image'])) {
      $image = wp_get_attachment_image_src($item['image'], 'comet_small');
      $output .= '<img src="'.esc_url($image[0]).'" alt="" class="thumb-placeholder">';
    }
    $output .= '</div>';
    $output .= '<div class="rs-menu-body">';
    if (isset($item['title'])) {
      $output .= '<h2 class="cursive">'.esc_attr($item['title']).'</h2>';
    }
    if (isset($item['text'])) {
      $output .= '<p>'.esc_attr($item['text']).'</p>';
    }
    if (isset($item['infoline'])) {
      $output .= '<h4>'.esc_attr($item['infoline']).'</h4>';
    }
    $output .= '</div>';

    $output .= '</div>';
    $output .= '</div>';
  }

  $output .= '</div>';
  $output .= '</div>';

  return $output;

}
