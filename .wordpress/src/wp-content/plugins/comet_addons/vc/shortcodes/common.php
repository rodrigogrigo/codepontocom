<?php

/* Overlay */
add_shortcode('cm_overlay', 'comet_overlay');
function comet_overlay($atts, $content = null){
  $output = '<div class="holder-container">';
  $output .= '<div class="centrize">';
  $output .= '<div class="v-center">';
  $output .= wpb_js_remove_wpautop($content);
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';

  return $output;
}

/* Play Button */
add_shortcode( 'cm_play_button', 'comet_play_button' );
function comet_play_button( $atts ) {
  extract( shortcode_atts( array(
    'url'  => '',
  ), $atts ) );

  return '<div data-src="'.esc_url($url).'" class="play-button"><i class="ti-control-play"></i></div>';
}

/* Map */
add_shortcode( 'cm_map', 'comet_map' );
function comet_map( $atts ) {
  extract( shortcode_atts( array(
    'lat'  => '40.773328',
    'lng'  => '-73.960088'
  ), $atts ) );

  return '<div id="map" class="full-width" data-lat="'.esc_attr($lat).'" data-long="'.esc_attr($lng).'"></div>';
}

/* Job Offer */
add_shortcode( 'cm_job_offer', 'comet_job_offer' );

function comet_job_offer( $atts ) {
  extract( shortcode_atts( array(
    'title' => '',
    'category' => '',
    'location' => '',
    'text' => '',
    'link' => '',
  ), $atts ) );

  $button = vc_build_link($link);

  $output = '<div class="job-offer">';

  $output .= '<div class="job-info">';
  $output .= '<div class="row">';

  $output .= '<div class="col-sm-8">';
  $output .= '<span class="upper">'.esc_attr($category).'</span>';
  $output .= '<h3>'.esc_attr($title).'</h3>';
  $output .= '<small class="upper">'.esc_attr($location).'</small>';
  $output .= '</div>';

  $output.= '<div class="col-sm-4 txt-sm-right txt-md-right">';
  $output.= '<a href="'.$button['url'].'" class="btn btn-color btn-sm">'.$button['title'].'</a>';
  $output.= '</div>';

  $output .= '</div>';
  $output .= '</div>';

  $output .= '<div class="job-content">';
  $output .= '<p>'.esc_attr($text).'</p>';
  $output.= '<a href="'.$button['url'].'" class="upper small-link">'.__('Read More', 'comet_addons').'</a>';
  $output .= '</div>';

  $output .= '</div>';

  return $output;
}


/* Countdown */
add_shortcode( 'cm_countdown', 'comet_countdown' );
function comet_countdown( $atts ) {
  extract( shortcode_atts( array(
    'alignment'  => '',
    'date'       => ''
  ), $atts ) );

  $datetime = strftime('%m/%d/%Y %H:%M:%S', strtotime($date));

  $output = '<ul class="nav countdown '.$alignment.'" data-date="'.esc_attr($datetime).'">';
  $output .='<li><span class="days">00</span>'.__('Days', 'comet_addons').'</li>';
  $output .='<li><span class="hours">00</span>'.__('Hours', 'comet_addons').'</li>';
  $output .='<li><span class="minutes">00</span>'.__('Minutes', 'comet_addons').'</li>';
  $output .='<li><span class="seconds">00</span>'.__('Seconds', 'comet_addons').'</li>';
  $output .= '</ul>';

  return $output;
}

/* Newsletter Form */
add_shortcode( 'cm_newsletter_form', 'comet_newsletter_form' );
function comet_newsletter_form( $atts ) {
  extract( shortcode_atts( array(
    'url'  => '',
  ), $atts ) );


  $output = '<form data-mailchimp="true" class="inline-form" data-url="'.esc_url($url).'">';
  $output .= '<div class="input-group">';
  $output .= '<input type="email" name="email" placeholder="'.__('Your Email Address', 'comet_addons').'" class="form-control">';
  $output .= '<span class="input-group-btn">';
  $output .= '<button type="submit" class="btn btn-color">'.__('Subscribe', 'comet_addons').'</button>';
  $output .= '</span>';
  $output .= '</div>';
  $output .= '</form>';

  return $output;
}

/* Alerts */
add_shortcode( 'cm_alert', 'comet_alert' );
function comet_alert( $atts ) {
  extract( shortcode_atts( array(
    'color'   => 'alert-success',
    'style'   => 'alert-outline',
    'text'    => ''
  ), $atts ) );


  $output = '<div role="alert" class="alert '.$color.' alert-dismissible '.$style.'">';
  $output .= '<button type="button" data-dismiss="alert" aria-label="Close" class="close"><i class="ti-close"></i></button>';
  $output .= esc_attr( $text );
  $output .= '</div>';

  return $output;
}
