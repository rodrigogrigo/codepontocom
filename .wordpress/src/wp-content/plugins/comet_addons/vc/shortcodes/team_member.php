<?php

add_shortcode('cm_team_member', 'comet_team_member');

function comet_team_member($atts){
  extract( shortcode_atts( array(
    'image' => '',
    'name' => '',
    'role' => '',
    'description' => '',
    'socials' => ''
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

  $output = '<div class="team-member">';
  if ($image) {
    $output .= '<div class="team-image">';
    $image_src = wp_get_attachment_image_src($image, 'comet_small');
    $output .= '<img src="'.esc_url($image_src[0]).'" alt="'.esc_attr($name).'">';
    $output .= '</div>';
  }
  $output .= '<div class="team-info">';
  $output .= '<h3>'.esc_attr($name).'</h3>';
  $output .= '<span>'.esc_attr($role).'</span>';
  if ($description) {
    $output .= '<p>'.wp_kses($description, array('br' => array()) ).'</p>';
  }
  $output .= '</div>';
  if ($socials) {
    $output .= '<div class="team-social">';
    $output .= '<ul>';
    foreach ($links as $link) {
      $output .= '<li>';
      if (isset($link['url'])) {
        $output .= '<a href="'.esc_url($link['url']).'" target="_blank">';
        $output .= '<i class="'.$icon_classes[$link['social']].'"></i>';
        $output .= '</a>';
      }
      $output .= '</li>';
    }
    $output .= '</ul>';
    $output .= '</div>';
  }
  $output .= '</div>';

  return $output;

}
