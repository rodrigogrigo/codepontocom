<?php

get_header();

if (have_posts()) : the_post();

$style = (comet_meta($post->ID, 'page_title_style') != '') ? comet_meta($post->ID, 'page_title_style') : 'grey' ;
$text_align = (comet_meta($post->ID, 'title_text_align') != '') ? comet_meta($post->ID, 'title_text_align') : 'center';
$text_transform = (comet_meta($post->ID, 'title_text_transform') != '') ? comet_meta($post->ID, 'title_text_transform') : '';
$text_color = (comet_meta($post->ID, 'title_text_color') != '') ? comet_meta($post->ID, 'title_text_color') : '';
$page_title = (comet_meta($post->ID, 'page_title') != '') ? comet_meta($post->ID, 'page_title') : get_the_title($post->ID);
$page_subtitle = (comet_meta($post->ID, 'page_subtitle') != '') ? comet_meta($post->ID, 'page_subtitle') : '';

?>

<article id="<?php echo esc_html($post->post_name); ?>-<?php echo esc_attr($post->ID); ?>" class="page-single">
  <?php if (comet_meta($post->ID, 'show_page_title') != 'no'): ?>
  <section class="page-title <?php echo esc_attr($style); ?>">
    
    <?php if (comet_meta($post->ID, 'page_title_style') != '' && comet_meta($post->ID, 'page_title_style') == 'parallax'): ?>
      <div class="row-parallax-bg">
        <div class="parallax-wrapper">
          <div class="parallax-bg-element" style="background-image: url(<?php echo esc_url(comet_meta($post->ID, 'title_bg')); ?>);"></div>
        </div>
      </div>
    <div class="parallax-overlay <?php echo esc_attr($text_color); ?>">
    <?php endif ?>

      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title <?php echo esc_attr($text_align); ?>">
              <h1 class="<?php echo esc_attr($text_transform); ?>"><?php echo esc_attr($page_title); ?><span class="red-dot"></span></h1>
              <h4><?php echo esc_attr($page_subtitle); ?></h4>
              <hr>
            </div>
          </div>
        </div>
      </div>

    <?php if (comet_meta($post->ID, 'page_title_style') && comet_meta($post->ID, 'page_title_style') == 'parallax'): ?>
    </div>
    <?php endif ?>

  </section>  
  <?php endif ?>

  <?php
    
    $the_content = get_the_content();
    
    if ( defined( 'WPB_VC_VERSION' ) ) {
      if(!strpos($the_content,'vc_row')){
        $the_content = '[vc_row][vc_column width="1/1"]'.$the_content.'[/vc_column][/vc_row]';
      }
    } else{
      $the_content = '<section><div class="container">'.$the_content.'</div></section>';
    }
    
    $the_content = apply_filters("the_content",$the_content);
    
    echo $the_content;

  ?>

  <?php if (comments_open() || get_comments_number()): ?>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <?php comments_template(); ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif ?>
  
</article>

<?php

endif;

get_footer();
