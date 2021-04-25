<?php
global $wp_query;

$post_id = comet_blog_page_id();

if (is_home() || is_archive() || is_category()) {
  $the_query = $wp_query;
} else{
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array('post_type' => 'post', 'posts_per_page' => $wp_query->max_num_pages, 'paged' => $paged);
  $the_query = new WP_Query($args);
}

if (get_query_var('s')) {
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $the_query = new WP_Query(array(
    's' => esc_attr(get_query_var('s')),
    'paged' => $paged,            
    'post_type' => array('post', 'product', 'portfolio')
  ));
}

?>
<section class="p-0 b-0">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 col-sm-4 img-side img-left">
        <div class="img-holder blog-fixed-image">
          <img src="<?php echo esc_url(comet_meta($post_id, 'blog_fixed_bg')); ?>" alt="" class="bg-img">
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-5 col-md-offset-7 col-sm-8 col-sm-offset-4">
        <?php if ($the_query->have_posts()): ?>
          <div class="articles-list">
            <?php while($the_query->have_posts()): $the_query->the_post(); ?>
              <div id="<?php echo esc_attr(get_the_id()); ?>" <?php post_class('post-listing'); ?>>
                <span class="upper">
                  <a class="black-text" href="<?php esc_url(the_permalink()); ?>"><span class="post-date"><?php the_time('M d, Y'); ?></span></a>
                  <?php if (has_category()): ?>
                    <span class="dot"></span>
                    <span class="post-catetory"><?php the_category(', '); ?></span>
                  <?php endif ?>
                </span>
                <h2 class="serif">
                  <a href="<?php echo esc_url(get_the_permalink()); ?>">
                    <?php echo esc_attr(get_the_title()); ?>
                  </a>
                </h2>
                <p class="serif"><?php echo esc_attr(comet_excerpt(25)); ?></p>
                <p><a href="<?php echo esc_url(get_the_permalink()); ?>" class="small-link upper"><?php esc_html_e('Read More', 'comet-wp'); ?></a></p>
              </div>
            <?php endwhile ?>
          </div> 
          <?php comet_pagination($the_query); ?>
          <?php wp_reset_postdata(); ?>      
        <?php else: ?>
          <div class="no-posts full">
            <p class="lead-text black-text"><?php esc_html_e('No results have been found.', 'comet-wp'); ?></p>
            <p class="mt-15 mb-25"><?php esc_html_e('Want to try another search?', 'comet-wp'); ?></p>
            <?php get_search_form(); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
