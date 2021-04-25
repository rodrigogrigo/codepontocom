<?php

add_shortcode('cm_social_icons', 'comet_social_icons');

function comet_social_icons($atts){
  extract( shortcode_atts( array(
    'socials' => '',
    'style' => ''
  ), $atts ) );  

  $links = vc_param_group_parse_atts($socials);  

  $icon_classes = array(
    'facebook' => 'ti-facebook',
    'twitter' => 'ti-twitter-alt',
    'linkedin' => 'ti-linkedin',
    'instagram' => 'ti-instagram',
    'dribbble' => 'ti-dribbble',
    'github' => 'ti-github',
    'flickr' => 'ti-flickr',
    'pinterest' => 'ti-pinterest',
    'youtube' => 'ti-youtube',
    'tumblr' => 'ti-tumblr-alt',
  );
  
  $output = '<ul class="social-list text-center '.$style.'">';
  foreach ($links as $link) {
    $output .= '<li>';
    $output .= '<a href="'.esc_url($link['url']).'" target="_blank">';
    $output .= '<i class="'.$icon_classes[$link['social']].'"></i>';
    $output .= '</a>';
    $output .= '</li>';
  }
  $output .= '</ul>';

  return $output;

}
