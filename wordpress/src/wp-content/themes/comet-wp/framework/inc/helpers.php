<?php

/* Function to get theme options */
if ( ! function_exists('comet_options') ) {
  function comet_options($value){
    global $comet_options;
    if (isset($comet_options[$value])) {
      return $comet_options[$value];
    } else{
      return false;
    }
  }
}

/* Access post meta easily */
if ( ! function_exists('comet_meta') ) {
  function comet_meta($id, $key){
    if (get_post_meta( $id, 'comet_'.$key, true)) {
      return get_post_meta( $id, 'comet_'.$key, true);
    } else{
      return false;
    }
  }
}

/* Multiple excerpt lenghts */
if ( ! function_exists('comet_excerpt')) {
  function comet_excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
      array_pop($excerpt);
      $excerpt = implode(" ",$excerpt).' ... ';
    } else {
      $excerpt = implode(" ",$excerpt);
    } 
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
  }
}

// Enable font size & font family selects in the editor
add_filter( 'mce_buttons_2', 'comet_wpex_mce_buttons' );
if ( ! function_exists( 'comet_wpex_mce_buttons' ) ) {
  function comet_wpex_mce_buttons( $buttons ) {
    array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
    return $buttons;
  }
}

// Customize mce editor font sizes
add_filter( 'tiny_mce_before_init', 'comet_wpex_mce_text_sizes' );
if ( ! function_exists( 'comet_wpex_mce_text_sizes' ) ) {
  function comet_wpex_mce_text_sizes( $initArray ){
    $initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 15px 16px 18px 20px 21px 24px 28px 32px 36px";
    return $initArray;
  }
}

// Posts Pagination
if ( ! function_exists('comet_pagination') ) {
  function comet_pagination($qry) {
    $big = 999999999;
    $pages = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $qry->max_num_pages,
            'prev_next' => false,
            'type'  => 'array',
            'prev_next'   => TRUE,
            'prev_text'    => '<i class="ti-arrow-left"></i>',
            'next_text'    => '<i class="ti-arrow-right"></i>',
        ) );
    if( is_array( $pages ) ) {
      $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
      echo '<ul class="pagination">';

      foreach ( $pages as $page ) {
        echo "<li>$page</li>";
      }

      echo '</ul>';
    }
  }
}

// Search Filter
add_filter('pre_get_posts','comet_search_filter');
if ( ! function_exists('comet_search_filter') ) {
  function comet_search_filter($query) {
    if (!is_admin() && !is_post_type_archive('product')) {
      if ($query->is_search) {
        $query->set('post_type', array('post', 'product', 'portfolio'));
      }
      return $query;
    }
  }
}


/* WooCommerce Ajax Cart */
add_filter( 'woocommerce_add_to_cart_fragments', 'comet_header_add_to_cart_fragment' );
if ( ! function_exists('comet_header_add_to_cart_fragment') ) {
  function comet_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    ?>
    <div class="cart">
      <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
        <i class="ti-bag"></i><span class="cart-number"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
      </a>
      <div class="shopping-cart">
        
        <div class="shopping-cart-info">
          <div class="row">
            <div class="col-xs-6">
              <h6 class="upper"><?php esc_html_e('Your Cart', 'comet-wp'); ?></h6>
            </div>
            <div class="col-xs-6 text-right">
              <h6 class="upper"><span class="mini-cart-total"><?php echo WC()->cart->get_cart_total(); ?></span></h6>
            </div>
          </div>
        </div>

        <?php woocommerce_mini_cart(); ?>

      </div>
    </div>
    
    <?php
    
    $fragments['#topnav .cart'] = ob_get_clean();
    
    return $fragments;
  }
}

// Comments template
if ( ! function_exists('comet_comments') ) {
  function comet_comments( $comment, $args, $depth ) {
      $GLOBALS['comment'] = $comment; ?>
      <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
      <div class="comment">

        <div class="comment-pic">
          <?php echo get_avatar( $comment, 80 ); ?>          
        </div>
        <div class="comment-text">
          <h5 class="upper"><?php echo get_comment_author_link(); ?></h5>
          <span class="comment-date"><?php esc_html_e('Posted on', 'comet-wp'); ?> <?php echo get_comment_date(); ?> <?php esc_html_e('at', 'comet-wp'); ?> <?php echo get_comment_time(); ?></span>
          <?php if ($comment->comment_approved == '0') : ?>
            <em><?php esc_html_e('Your comment is awaiting moderation.', 'comet-wp') ?></em>
          <?php endif; ?>
          <p><?php comment_text(); ?></p>
          <?php 
          comment_reply_link( array_merge( $args, array( 
            'reply_text' =>  esc_html__('Reply', 'comet-wp'),
            'depth' => $depth,
            'max_depth' => $args['max_depth'] 
          ) ) ); ?>
        </div>
      </div>
      <?php    
  }
}

// Get Blog Page ID
if ( ! function_exists('comet_blog_page_id') ) {
  function comet_blog_page_id(){
    $home_id = get_option('page_for_posts');
    if (is_home() && $home_id || is_search() && $home_id || is_archive() && $home_id || is_category() && $home_id) {
      $id = $home_id;
    } elseif ( get_post_type(get_the_id()) == 'page' ) {
      $id = get_the_id();
    } else{
      $id = 0;
    }
    return $id;
  }
}

// Get Blog Page Options
if ( ! function_exists('comet_blog_page_opts') ) {
  function comet_blog_page_opts($id){
    $opts = array(
      'show_title' => (comet_meta($id, 'show_page_title') != '') ? comet_meta($id, 'show_page_title') : 'yes',
      'style' => (comet_meta($id, 'page_title_style') != '') ? comet_meta($id, 'page_title_style') : 'grey',
      'text_align' => (comet_meta($id, 'title_text_align') != '') ? comet_meta($id, 'title_text_align') : 'center',
      'text_transform' => (comet_meta($id, 'title_text_transform') != '') ? comet_meta($id, 'title_text_transform') : '',
      'page_title' => (comet_meta($id, 'page_title') != '') ? comet_meta($id, 'page_title') : get_the_title($id),
      'page_subtitle' => (comet_meta($id, 'page_subtitle') != '') ? comet_meta($id, 'page_subtitle') : '',
      'blog_layout' => (comet_meta($id, 'blog_layout') != '') ? comet_meta($id, 'blog_layout') : 'default',
      'blog_sidebar' => (comet_meta($id, 'blog_sidebar') != '') ? comet_meta($id, 'blog_sidebar') : 'right',
      'masonry_columns' => (comet_meta($id, 'masonry_columns') != '') ? comet_meta($id, 'masonry_columns') : 'two-col',
    );

    return $opts;
  }
}

// Replaces the excerpt "more" text by a link
add_filter('excerpt_more', 'comet_excerpt_more');
if ( ! function_exists('comet_excerpt_more') ) {
  function comet_excerpt_more($more) {
    global $post;
    return '[...] <p class="mt-15"><a class="btn btn-color btn-sm" href="'.esc_url(get_the_permalink()).'">'. esc_html__('Read More', 'comet-wp').'</a>';
  }
}

add_filter( 'the_content_more_link', 'comet_read_more_link' );
if ( ! function_exists('comet_read_more_link') ) {
  function comet_read_more_link() {
    return '<p class="mt-15"><a class="btn btn-color btn-sm" href="'.esc_url(get_the_permalink()).'">'. esc_html__('Read More', 'comet-wp').'</a>';
  }
}

// Social Links
if ( ! function_exists('comet_social_footer')) {
  function comet_social_footer(){
    
    $socials = array(
      array('name' => 'facebook', 'icon' => 'ti-facebook'),
      array('name' => 'twitter', 'icon' => 'ti-twitter-alt'),
      array('name' => 'google_plus', 'icon' => 'ti-google'),
      array('name' => 'linkedin', 'icon' => 'ti-linkedin'),
      array('name' => 'instagram', 'icon' => 'ti-instagram'),
      array('name' => 'dribbble', 'icon' => 'ti-dribbble'),
      array('name' => 'github', 'icon' => 'ti-github'),
      array('name' => 'flickr', 'icon' => 'ti-flickr'),
      array('name' => 'pinterest', 'icon' => 'ti-pinterest'),
      array('name' => 'youtube', 'icon' => 'ti-youtube'),
      array('name' => 'tumblr', 'icon' => 'ti-tumblr-alt'),
      array('name' => 'email', 'icon' => 'ti-email'),
    );

    $output = '<ul>';
    foreach ($socials as $social) {
      if ( $social['name'] == 'email' && comet_options($social['name']) != '') {
        $output .= '<li><a target="_blank" href="mailto:'.comet_options($social['name']).'"><i class="'.$social['icon'].'"></i></a></li>';
      } elseif (comet_options($social['name']) != '') {
        $output .= '<li><a target="_blank" href="'.esc_url(comet_options($social['name'])).'"><i class="'.$social['icon'].'"></i></a></li>';
      }
    }
    $output .= '</ul>';

    echo $output;

  }
}

// Custom CSS
if ( ! function_exists('comet_custom_css') ) {
  function comet_custom_css(){
    if (comet_options('custom_css') != '') {
      $custom_css = comet_options('custom_css');
      echo '<style type="text/css">'.$custom_css."</style>\r\n";
    }
  }
}
add_action('wp_head', 'comet_custom_css');


// Title Tag
function comet_title_tag(){
  if ( ! function_exists( '_wp_render_title_tag' ) ): ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
  <?php endif;
}

add_action('wp_head', 'comet_title_tag');

// Site Icon
function comet_site_icon(){
  if ( ! function_exists( 'wp_site_icon' ) ){
    echo '<link rel="shortcut icon" href="'.COMET_THEME_URI . '/assets/images/favicon.png' .'">';
  }
}
add_action('wp_head', 'comet_site_icon');
