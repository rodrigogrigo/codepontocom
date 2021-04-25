<?php

add_shortcode( 'cm_home_slider', 'comet_home_slider' );

function comet_home_slider( $atts, $content ) {
  extract( shortcode_atts( array(
    'animated' => '',
    'content'   => !empty($content)? $content : ''
  ), $atts ) );

  $output = '<div id="home-slider" class="flexslider '.$animated.'">';
  $output .= '<ul class="slides">';
  $output .= wpb_js_remove_wpautop($content);
  $output .= '</ul>';
  $output .= '</div>';
  
  return $output;
}

add_shortcode( 'cm_home_slide', 'comet_home_slide' );

function comet_home_slide( $atts ) {
  extract( shortcode_atts( array(
    'image' => '',
    'headline' => '',
    'subtitle' => '',
    'buttons' => '',
    'headline_dot' => '1',
    'text_align' => 'center',
    'font_size' => 'medium',
    'text_transform' => '',
    'subtitle_position' => 'bottom',
    'font_style' => ''
  ), $atts ) );

  $buttons = vc_param_group_parse_atts( $buttons );

  $align_text = ($text_align != 'center') ? 'text-'.$text_align : '';
  $bold_text =  ($font_size == 'big') ? 'bold-text' : '';
  
  $heading_class_arr = array();
  if ($text_transform == 'upper') {
    $heading_class_arr[] = 'upper';
  }
  if ($font_size == 'small') {
    $heading_class_arr[] = 'smaller';
  }
  $heading_class = ($text_transform == 'upper' || $font_size == 'small') ? implode(' ', $heading_class_arr) : '';

  $output = '<li>';
  if ($image) {
    $output .= '<div class="slide-image" style="background-image: url('.esc_attr(wp_get_attachment_url($image)).');"></div>';
  }
  $output .= '<div class="slide-wrap">';
  $output .= '<div class="slide-content '.$align_text.' '.$bold_text.'">';
  $output .= '<div class="container">';
  if ($font_style == 'cursive') {
    if ($subtitle_position == 'top') {
      $output .= '<h1 class="cursive m-0">'.esc_attr($subtitle).'</h1>';
    }
    $heading_class .= ' mt-0';
    $output .= '<h2 class="'.$heading_class.'">'.esc_attr($headline);
    if ($headline_dot == '1') {
      $output .= '<span class="red-dot"></span>';
    }
    $output .= '</h2>';
    if ($subtitle_position == 'bottom') {
      $output .= '<h1 class="cursive">'.esc_attr($subtitle).'</h6>';
    }
  } else{
    if ($subtitle_position == 'top') {
      $output .= '<h6 class="mb-15">'.esc_attr($subtitle).'</h6>';
    }
    $output .= '<h1 class="'.$heading_class.'">'.esc_attr($headline);
    if ($headline_dot == '1') {
      $output .= '<span class="red-dot"></span>';
    }
    $output .= '</h1>';
    if ($subtitle_position == 'bottom') {
      $output .= '<h6>'.esc_attr($subtitle).'</h6>';
    }
  }
  if ($buttons) {
    $output .= '<p>';
    foreach ($buttons as $button) {
      if (isset($button['link'])) {

        if (isset($button['show_icon'])) {
          $icon = '';
          switch ($button['icon_type']) {
            case 'themify':
              $icon = $button['icon_themify'];
              break;
            default:
              $icon = $button['icon_etline'];
              break;
          }
        }

        $button_link = vc_build_link($button['link']);

        $btn_target = (!empty($button_link['target'])) ? 'target="'.trim($button_link['target']).'"' : '';
        $shape = (isset($button['shape'])) ? $button['shape'] : '';
        $output .= '<a class="btn btn-'.$button['color']. ' ' .$shape. '" href="'.esc_url($button_link['url']).'" '.$btn_target.'>'.esc_attr($button_link['title']);
        if (isset($button['show_icon']) && $button['show_icon'] != '') {
          if ($button_link['title'] == '') {
            $output .= '<span>';
          }
          $output .= '<i class="'.$icon.'"></i>';
          if (isset($button_link['show_icon']) && $button['show_icon'] != '') {
            $output .= '</span>';
          }
        }
        $output .= '</a>';

      }
    }
    $output .= '</p>';
  }
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</li>';

  return $output;
}
?>
