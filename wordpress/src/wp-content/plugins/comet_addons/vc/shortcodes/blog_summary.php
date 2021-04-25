<?php

add_shortcode( 'cm_blog_summary', 'comet_blog_summary' );

function comet_blog_summary( $atts ) {
  extract( shortcode_atts( array(
    'posts_to_show' => '4',
  ), $atts ) );

  $args = array('post_type' => 'post', 'orderby'=> 'date', 'posts_per_page' => $posts_to_show);
  $mainquery = new WP_query($args);
  $output = '';
    
    if( $mainquery->have_posts()) :
      while ($mainquery->have_posts()) : $mainquery->the_post();
        $output .= '<div id="post-'.get_the_id().'" class="blog-post '.implode(' ', get_post_class()).'">';
        $output .= '<div class="post-body">';
        $output .= '<h3 class="serif"><a href="'.get_the_permalink().'">'.esc_attr(get_the_title()).'</a></h3>';
        $output .= '<hr>';
        $output .= '<p class="serif">'.comet_excerpt(30).'</p>';
        $output .= '<div class="post-info upper">';
        $output .= '<a href="'.get_the_permalink().'">'.__('Read More', 'comet_addons').'</a>';
        $output .= '<span class="pull-right black-text">'.get_the_time('F d, Y').'</span>';
        $output .= '</div>';        
        $output .= '</div>';
        $output .= '</div>';
      endwhile;
    
    endif;
  wp_reset_postdata();

  return $output;

}
