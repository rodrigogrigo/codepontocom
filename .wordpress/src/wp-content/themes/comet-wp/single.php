<?php

get_header();

if(have_posts()): the_post();

$sidebar = (comet_meta($post->ID, 'post_sidebar') != '') ? comet_meta($post->ID, 'post_sidebar') : 'right';
$blog_col_class = 'col-md-8';

if ($sidebar == 'off') {
  $blog_col_class = 'col-md-8 col-md-offset-2';
} if ($sidebar == 'left') {
  $blog_col_class = 'col-md-8 col-md-offset-1';
}

?>

<article class="page-single">

  <section class="page-title grey">
    <div class="centrize">
      <div class="v-center">
        <div class="container">
          <div class="title center">
            <h1 class="serif"><?php esc_attr(the_title()); ?></h1>
            <h5 class="serif mt-25 upper">
              <?php if (get_post_format() != ''): ?>
                <span class="post-format format-<?php echo get_post_format(); ?>">
                  <a class="entry-format" href="<?php echo esc_url( get_post_format_link(get_post_format()) ); ?>"><?php echo get_post_format_string(get_post_format()); ?></a>
                </span>
                <span class="dot"></span>      
              <?php endif ?>
              <span><?php esc_html_e('By', 'comet-wp'); ?> <?php the_author_link(' - '); ?></span>
              <span class="dot"></span>
              <?php if (has_category()): ?>
                <span class="post-catetory"><?php the_category(', '); ?></span>
                <span class="dot"></span>
              <?php endif ?>
              <span class="post-date"><?php the_time('M d, Y'); ?></span>
              <span class="dot"></span>
              <span class="post-comments"><?php comments_popup_link(); ?></span>
            </h5>  
            <hr>          
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">

      <?php if ($sidebar == 'left'): ?>
        <div class="col-md-3 hidden-sm hidden-xs">
          <div id="sidebar">
            <?php dynamic_sidebar('blog_sidebar'); ?>
          </div>
        </div>
      <?php endif ?>

      <div class="<?php echo esc_attr($blog_col_class); ?>">
        <article <?php post_class('post-single'); ?>>
          
          <?php if (has_post_thumbnail() && get_post_format() != 'video' && get_post_format() != 'audio'): ?>
          <div class="post-media">
            <?php the_post_thumbnail('blog_image'); ?>
          </div>
          <?php endif ?>

          <div class="post-body b-0">
            <?php the_content(); ?>
            <?php wp_link_pages(array('before' => '<div class="post-pages">' .  esc_html__('Pages:','comet-wp'), 'after' => '</div>')); ?>
          </div>

          <div class="post-tags">
            <?php the_tags('','',''); ?>
          </div>

        </article>
        <div class="post-share">
          <ul class="list-inline">
            <li>
              <?php esc_html_e('Share:', 'comet-wp'); ?>
            </li>
            <li>
              <a class="share-btn facebook" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(esc_url(get_permalink())) ?>"><i class="ti-facebook"></i></a>
            </li>
            <li>
              <a class="share-btn twitter" href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post->post_title); ?>&url=<?php echo urlencode(esc_url(get_permalink())); ?>"><i class="ti-twitter"></i></a>
            </li>
            <li>
              <a class="share-btn google" href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink());?>"><i class="ti-google"></i></a>
            </li>
          </ul>
        </div>
        <?php comments_template(); ?>
      </div>

      <?php if ($sidebar == 'right'): ?>
        <div class="col-md-3 col-md-offset-1 hidden-sm hidden-xs">
          <div id="sidebar">
              <?php dynamic_sidebar('blog_sidebar'); ?>
            </div>
        </div>
      <?php endif ?>

    </div>
  </section>

</article>



<?php

endif;
wp_reset_postdata();
get_footer();
