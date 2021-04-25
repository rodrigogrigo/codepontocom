<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $full_width = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
  'vc_row',
  'wpb_row', //deprecated
  'vc_row-fluid',
  $row_bg_color,
  $el_class,
  vc_shortcode_custom_css_class( $css ),
);
$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
  $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
  $wrapper_attributes[] = 'data-vc-full-width="true"';
  $wrapper_attributes[] = 'data-vc-full-width-init="false"';
  if ( 'stretch_row_content' === $full_width ) {
    $wrapper_attributes[] = 'data-vc-stretch-content="true"';
  } elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
    $wrapper_attributes[] = 'data-vc-stretch-content="true"';
    $css_classes[] = 'vc_row-no-padding';
  }
  $after_output .= '<div class="vc_row-full-width"></div>';
}

if ( ! empty( $full_height ) ) {
  $css_classes[] = ' full-height';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );
$video_output = '';

if ( $has_video_bg ) {
  $parallax = $video_bg_parallax;
  $parallax_image = $video_bg_url;
  $css_classes[] = ' vc_video-bg-container';
  $fallback_image_src = wp_get_attachment_image_src( $fallback_image, 'full' );

  if ($video_bg == 'youtube') {
    $div_id = 'video-id-'.substr(md5(vc_extract_youtube_id( $video_bg_url )), 0, 8);
    $video_output .= '<div id="'.$div_id.'" class="video-wrapper" data-fallback-bg="'.esc_url($fallback_image_src[0]).'">';
    $video_output .= '<div data-property="{videoURL:\''.vc_extract_youtube_id( $video_bg_url ).'\', containment:\'#'.$div_id.'\'}" class="player"></div>';
    $video_output .= '</div>';
  } elseif ($video_bg == 'self_hosted' && $self_hosted_video) {
    $video_output .= '<div class="video-wrapper" data-fallback-bg="'.esc_url($fallback_image_src[0]).'">';
    $video_output .= '<video autoplay loop preload playsinline>';
    $video_output .= '<source src="'.esc_url($self_hosted_video).'" type="video/mp4">';
    $video_output .= '</video>';
    $video_output .= '</div>';
  }
}

if ( ! empty( $parallax ) ) { 
  $css_classes[] = 'parallax vc_parallax-' . $parallax;
}

if (!empty($split_row)) {
  $css_classes[] = 'split-row';
}

if ($row_bg_color == 'particles-bg') {
  $css_classes[] = ' dark';
}

$parallax_output = '';

if ( ! empty ( $parallax_image ) ) {
  if ( $has_video_bg ) {
    $parallax_image_src = $parallax_image;
  } else {
    $parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
    $parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
    if ( ! empty( $parallax_image_src[0] ) ) {
      $parallax_image_src = $parallax_image_src[0];
    }
  }
  $parallax_output .= '<div class="row-parallax-bg">
  <div class="parallax-wrapper">
    <div class="parallax-bg-element" style="background-image: url('.$parallax_image_src.');"></div>
  </div>
  </div>';
}


$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<section ' . implode( ' ', $wrapper_attributes ) . '>';

if ($parallax) {
  $output .= $parallax_output;
  $output .= '<div class="parallax-overlay">';
}

if (!empty($content_placement) && $content_placement == 'middle') {
  $output .= '<div class="centrize">';
  $output .= '<div class="v-center">';
}

$output .= $video_output;

if (!$parallax && !empty($split_row)) {
  $holder_class = ($split_title && $split_text_color == 'light') ? 'overlay' : '';
  $output .= '<div class="container-fluid">';
  $output .= '<div class="row">';

  if($split_row_bg_type == 'image') {
    $output .= '<div class="col-md-6 col-sm-4 img-side img-'.$split_bg_position.'">';
    $output .= '<div class="img-holder '.$holder_class.'">';
    $output .= '<img src="'.wp_get_attachment_url( $split_row_bg ).'" alt="" class="bg-img">';
    if ($show_title) {
  
      $title_align = array();
      if (empty($split_text_align_sm) && empty($split_text_align_xs) && $split_text_align != 'left') {
        $title_align[] = $split_text_align;
      } elseif ($split_text_align != 'left') {
        $title_align[] = 'txt-md-'.$split_text_align;
      }
      
      if (!empty($split_text_align_xs)) {
        $title_align[] = 'txt-xs-'.$split_text_align_xs;
      }
  
      if (!empty($split_text_align_sm)) {
        $title_align[] = 'txt-sm-'.$split_text_align_sm;
      }
      
      $headline_class = (!empty($split_text_transform)) ? ' class="upper"' : '';
      $output .= '<div class="centrize">';
      $output .= '<div class="v-center">';
      $output .= '<div class="title '.implode(' ', $title_align).'">';
      $output .= '<h4 class="upper">'.esc_attr($split_subtitle).'</h4>';
      $output .= '<h3'.$headline_class.'>'.esc_attr($split_title).'<span class="red-dot"></span></h3>';
      $output .= '<hr>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
    } else{
      $output .= wpb_js_remove_wpautop( $additional_content );
    }
    $output .= '</div>';
    $output .= '</div>';
  } elseif ($split_row_bg_type == 'map') {
    $lat = ($split_map_lat) ? $split_map_lat : '40.773328';
    $lng = ($split_map_lng) ? $split_map_lng : '-73.960088';
    $output .= '<div class="col-md-6 map-side">';
    $output .= '<div id="map" data-lat="'.$lat.'" data-long="'.$lng.'"></div>';
    $output .= '</div>';
  }

  $output .= '</div>';
  $output .= '</div>';
}

if (!$full_width) {
  $output .= '<div class="container">';
}

$output .= wpb_js_remove_wpautop( $content );

if (!$full_width) {
  $output .= '</div>';
}

if (!empty($content_placement) && $content_placement == 'middle') {
  $output .= '</div>';
  $output .= '</div>';
}

if ($parallax) {
  $output .= '</div>';
}

$output .= '</section>';
$output .= $after_output;

echo $output;
