<?php

add_shortcode( 'cm_photo_gallery', 'comet_photo_gallery' );

function comet_photo_gallery( $atts ) {
  extract( shortcode_atts( array(
    'photos' => ''
  ), $atts ) );

  $galleries = vc_param_group_parse_atts($photos);

  $output = '<ul class="photo-gallery">';
  if ($galleries) {
    foreach ($galleries as $gallery) {

      $css_class = (isset($gallery['size']) && $gallery['size'] == 'half') ? ' class="half"': '';

      $output .= '<li '.$css_class.'>';
      $output .= '<div class="gallery-item">';
      $output .= '<a href="'.esc_url(wp_get_attachment_url($gallery['pic'])).'">';
      $output .= '<img src="'.esc_url(wp_get_attachment_url($gallery['pic'])).'" alt="">';
      $output .= '</a>';
      $output .= '</div>';
      if (!empty($gallery['caption'])) {
        $output .= '<div class="gallery-item">';
        $output .= '<h4 class="serif">'.esc_attr($gallery['caption']).'</h4>';
        $output .= '</div>';
      }
      $output .= '</li>';

    }
  }
  $output .= '</ul>';

  return $output;

}
