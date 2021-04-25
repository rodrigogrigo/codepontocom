<?php

/*
Template Name: Blog Page
*/

get_header();

global $wp_query;
$post_id = comet_blog_page_id();
$options = comet_blog_page_opts($post_id);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array('post_type' => 'post', 'posts_per_page' => $wp_query->max_num_pages, 'paged' => $paged);
$the_query = new WP_Query($args);


$can_show_title = !empty($post_id) && $options['show_title'] == 'yes' || is_search() || is_archive();
$blog_col_class = 'col-md-8';

if ($options['blog_layout'] && $options['masonry_columns'] == 'three-col' && $options['blog_sidebar'] == 'off') {
  $blog_col_class = 'row';
} elseif ($options['blog_sidebar'] == 'off') {
  $blog_col_class = 'col-md-8 col-md-offset-2';
} if ($options['blog_sidebar'] == 'left') {
  $blog_col_class = 'col-md-8 col-md-offset-1';
}

$blog_posts_class = ($options['blog_layout'] == 'masonry') ? 'blog-masonry '. $options['masonry_columns'] : 'blog-posts';

$page_title = (is_search()) ? get_query_var('s') : $options['page_title'];

?>
<article class="page-single">
  <?php if ($options['blog_layout'] == 'fixed'): ?>
    <?php get_template_part('partials/blog/fixed-image'); ?>
  <?php else: ?>
    <?php if ($can_show_title): ?>
      <section class="page-title <?php echo esc_attr($options['style']); ?>">
       
       <?php if ($options['style'] == 'parallax'): ?>
        <div class="row-parallax-bg">
        <div class="parallax-wrapper">
          <div class="parallax-bg-element" style="background-image: url(<?php echo esc_url(comet_meta($post_id, 'title_bg')); ?>);"></div>
        </div>
      </div>
       <div class="parallax-overlay">
       <?php endif ?>

         <div class="centrize">
           <div class="v-center">
             <div class="container">
               <div class="title <?php echo esc_attr($options['text_align']); ?>">
                 <h1 class="<?php echo esc_attr($options['text_transform']); ?>">
                   <?php echo esc_attr($page_title); ?><span class="red-dot"></span>
                 </h1>
                 <h4><?php echo esc_attr($options['page_subtitle']); ?></h4>
                 <hr>
               </div>
             </div>
           </div>
         </div>

       <?php if ($options['style'] == 'parallax'): ?>
       </div>
       <?php endif ?>

      </section>
    <?php endif ?>

    <section>
      <div class="container">
        
        <?php if ($options['blog_sidebar'] == 'left'): ?>
          <div class="col-md-3 hidden-sm hidden-xs">
            <div id="sidebar">
              <?php dynamic_sidebar('blog_sidebar'); ?>
            </div>
          </div>
        <?php endif ?>

        <div class="<?php echo esc_attr($blog_col_class); ?>">
          
          <?php if ($the_query->have_posts()): ?>
            <div class="<?php echo esc_attr($blog_posts_class); ?>">
              <?php

              while($the_query->have_posts()): $the_query->the_post();
                if ($options['blog_layout'] == 'masonry') {
                  get_template_part('partials/blog/loop-single', 'masonry' );
                } else {
                  get_template_part('partials/blog/loop-single');
                }
                
              endwhile

              ?>
            </div>
            <?php comet_pagination($the_query); ?>
            <?php wp_reset_postdata(); ?>              
          <?php else: ?>
            <div class="no-posts">
              <p class="lead-text black-text"><?php esc_html_e('No results have been found.', 'comet-wp'); ?></p>
              <p class="mt-15 mb-25"><?php esc_html_e('Want to try another search?', 'comet-wp'); ?></p>
              <?php get_search_form(); ?>
            </div>
          <?php endif; ?>
        </div>
        
        <?php if ($options['blog_sidebar'] == 'right'): ?>
          <div class="col-md-3 col-md-offset-1 hidden-sm hidden-xs">
            <div id="sidebar">
              <?php dynamic_sidebar('blog_sidebar'); ?>
            </div>
          </div>
        <?php endif ?>

      </div>
    </section>
  <?php endif ?>
</article>

<?php get_footer(); ?>
