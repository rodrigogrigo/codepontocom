<?php

add_shortcode('cm_carousel', 'comet_carousel');

function comet_carousel($atts, $content = null){
  extract( shortcode_atts( array(
    'items' => '4',
    'margin' => '10',
    'loop' => '1',
    'autoplay' => '1',
    'controls' => '',
    'md_items' => '',
    'sm_items' => '',
    'xs_items' => '',
    'css' => ''
  ), $atts ) );

  $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'cm_carousel', $atts );

  $options =  array();
  $options[] = '"items": ' . $items;
  $options[] = '"margin": ' . $margin;
  if (empty($loop)) {
    $options[] = '"loop": false';
  }
  if (!empty($autoplay)) {
    $options[] = '"autoplay": true';
  }
  if (!empty($controls)) {
    $options[] = '"dots": true';
  }
  if (!empty($md_items)) {
    $options[] = '"mdItems": ' . $md_items;
  }
  if (!empty($sm_items)) {
    $options[] = '"smItems": ' . $sm_items;
  }
  if (!empty($xs_items)) {
    $options[] = '"xsItems": ' . $xs_items;
  }

  $output = '';
  if (!empty($css)) {
    $output .= '<div class="'.$css_class.'">';
  }
  $output .= '<div class="owl-carousel" data-options="{'.htmlentities(implode(', ', $options)).'}">'.wpb_js_remove_wpautop($content).'</div>';
  if (!empty($css)) {
    $output .= '</div>';
  }

  return $output;
}
