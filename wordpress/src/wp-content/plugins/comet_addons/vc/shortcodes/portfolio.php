<?php

add_shortcode( 'cm_portfolio', 'comet_portfolio' );

function comet_portfolio( $atts ) {
  extract( shortcode_atts( array(
    'items' => 'latest',
    'items_to_show'  => '8',
    'items_ids' => '',
    'show_title' => '0',
    'title' => '',
    'filters' => '1',
    'animate_filters' => '',
    'full_width' => 'wide',
    'columns' => 'two-col',
  ), $atts ) );

  $categories = get_terms('portfolio_category', array( 'hide_empty' => 0 ));

  $filters_out = '<ul id="filters">';
  $filters_out .= '<li data-filter="*" class="active">'.__('All', 'comet_addons').'</li>';
  foreach ($categories as $category) {
    $category_slug = (preg_match('/[^\x{0030}-\x{007f}]/u', $category->slug)) ? 'c-'.md5($category->slug) : $category->slug;
    $filters_out .= '<li data-filter=".'.$category_slug.'">'.$category->name.'</li> ';
  }
  $filters_out .= '</ul>';

  $portfolio_classes = array(str_replace('no', '', $full_width), $columns);

  $output = '';

  if ($show_title == '1') {
    $output .= '<div class="container">';
    $output .= '<div class="row">';

    $output .= '<div class="col-md-6">';
    $output .= '<div class="title m-0 txt-xs-center txt-sm-center">';
    $output .= '<h2 class="upper">'.esc_attr($title).'<span class="red-dot"></span></h2>';
    $output .= '<hr>';
    $output .= '</div>';
    $output .= '</div>';


    if ($filters == '1') {
      $output .= '<div class="col-md-6">';
      $output .= str_replace('<ul id="filters">', '<ul id="filters" class="no-fix mt-25">', $filters_out);
      $output .= '</div>';
    }

    $output .= '</div>';
    $output .= '</div>';
  } elseif($filters == '1'){
    if ($animate_filters) {
      $output .= $filters_out;
    } else{
      $output .= str_replace('<ul id="filters">', '<ul id="filters" class="no-fix">', $filters_out);
    }
  }

  $output .= '<div id="works-grid" class="'.implode(' ', $portfolio_classes).'">';

  if ($items == 'latest') {
    $args = array('post_type' => 'portfolio', 'orderby'=> 'date', 'posts_per_page' => $items_to_show, 'post_status' => 'publish');
    $mainquery = new WP_query($args);

    if($mainquery->have_posts()) {

      while ($mainquery->have_posts()) : $mainquery->the_post();

        $project_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'comet_medium');      
        $project_category  = '';
        $project_category_slug  = '';
        $cats = get_the_terms(get_the_id(), 'portfolio_category');
        if($cats){
          foreach($cats as $cat) {
            $project_category  .= $cat->name . ', ';
            $project_category_slug  .= (preg_match('/[^\x{0030}-\x{007f}]/u', $cat->slug)) ? 'c-'.md5($cat->slug). ', ' : $cat->slug . ', ';
          }
          $project_category = rtrim($project_category, ', ');
          $project_category_slug = rtrim($project_category_slug, ', ');
        }

        $output .= '<div class="work-item '.strtolower(str_replace(',', '', $project_category_slug)).'">';
        $output .= '<div class="work-detail">';
        $output .= '<a href="'.esc_url(get_the_permalink()).'">';
        if ($project_thumb) {
          $output .= '<img src="'.esc_attr($project_thumb[0]).'" alt="'.get_the_title().'">';
        }
        $output .= '<div class="work-info">';
        $output .= '<div class="centrize">';
        $output .= '<div class="v-center">';
        $output .= '<h3>'.esc_attr(get_the_title()).'</h3>';
        $output .= '<p>'.esc_attr($project_category).'</p>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</a>';
        $output .= '</div>';
        $output .= '</div>';

      endwhile;

    }
  } elseif ($items == 'manual') {
    $postIDs = explode(',', str_replace(' ', '', $items_ids));

    foreach ($postIDs as $postID) {

      if ('publish' == get_post_status($postID)) {
        $post = get_post($postID);
        
        $project_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'comet_medium');      
        $project_category  = '';
        $project_category_slug  = '';
        $cats = get_the_terms($post->ID, 'portfolio_category');
        if($cats){
          foreach($cats as $cat) {
            $project_category  .= $cat->name . ', ';
            $project_category_slug  .= (preg_match('/[^\x{0030}-\x{007f}]/u', $cat->slug)) ? 'c-'.md5($cat->slug). ', ' : $cat->slug . ', ';
          }
          $project_category = rtrim($project_category, ', ');
          $project_category_slug = rtrim($project_category_slug, ', ');
        }

        $output .= '<div class="work-item '.strtolower(str_replace(',', '', $project_category_slug)).'">';
        $output .= '<div class="work-detail">';
        $output .= '<a href="'.esc_url(get_the_permalink($post->ID)).'">';
        if ($project_thumb) {
          $output .= '<img src="'.esc_attr($project_thumb[0]).'" alt="'.get_the_title().'">';
        }
        $output .= '<div class="work-info">';
        $output .= '<div class="centrize">';
        $output .= '<div class="v-center">';
        $output .= '<h3>'.esc_attr(get_the_title($post->ID)).'</h3>';
        $output .= '<p>'.esc_attr($project_category).'</p>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</a>';
        $output .= '</div>';
        $output .= '</div>';
      }

    }
  }
  
  $output .= '</div>';

  return $output;
}
