<?php

/*
Template Name: Blog Page
*/

get_header();

global $wp_query;
$post_id = comet_blog_page_id();
$options = comet_blog_page_opts($post_id);

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

if (get_query_var('s') || is_search()) {
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $searchquery = new WP_Query(array(
    's' => esc_attr(get_query_var('s')),
    'paged' => $paged,            
    'post_type' => array('post', 'product', 'portfolio')
  ));
}

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
                 <?php if (is_search()): ?>
                   <h1 class="upper">
                     "<?php echo esc_attr(get_query_var('s')); ?>"
                   </h1>
                   <h4>
                     <?php esc_html_e('Found', 'comet-wp'); ?>
                     <?php echo $searchquery->found_posts ?>
                     <?php if ($searchquery->found_posts == 1): ?>
                       <?php esc_html_e('Item', 'comet-wp'); ?>.
                     <?php else: ?>
                       <?php esc_html_e('Items', 'comet-wp'); ?>.
                     <?php endif ?>
                   </h4>
                 <?php elseif (is_category()): ?>
                   <h4><?php esc_html_e('Browsing category', 'comet-wp'); ?>:</h4>
                   <h1 class="upper"><?php echo esc_attr(single_cat_title()); ?></h1>
                 <?php elseif ( is_tag() ): ?>
                   <h4><?php esc_html_e('Browsing tag', 'comet-wp'); ?>:</h4>
                   <h1 class="upper"><?php echo esc_attr(single_tag_title()); ?></h1>
                 <?php elseif ( is_author() ): ?>
                   <h4><?php esc_html_e('Posts by', 'comet-wp'); ?>:</h4>
                   <h1 class="upper"><?php echo esc_attr(get_the_author()); ?></h1>
                 <?php elseif (is_archive()): ?>
                   <?php if (is_month()): ?>
                     <h1 class="upper"><?php echo esc_attr(single_month_title(' ')); ?></h1>
                   <?php else: ?>
                      <h1 class="upper"><?php echo esc_attr(single_term_title()); ?></h1>
                   <?php endif ?>
                 <?php else: ?>
                   <h1 class="<?php echo esc_attr($options['text_transform']); ?>">
                     <?php echo esc_attr($page_title); ?><span class="red-dot"></span>
                   </h1>
                   <h4><?php echo esc_attr($options['page_subtitle']); ?></h4>
                 <?php endif ?>
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
          
          <?php if (have_posts()): ?>
            <div class="<?php echo esc_attr($blog_posts_class); ?>">
              <?php

              while(have_posts()): the_post();
                if ($options['blog_layout'] == 'masonry') {
                  get_template_part('partials/blog/loop-single', 'masonry' );
                } else {
                  get_template_part('partials/blog/loop-single');
                }
                
              endwhile

              ?>
            </div>
            <?php comet_pagination($wp_query); ?>
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
