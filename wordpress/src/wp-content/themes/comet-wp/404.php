<?php
get_header();
$bg_image = comet_options('error_bg_image');
$section_class = (isset($bg_image['url']) && $bg_image['url'] != '') ? 'parallax' : '';

?>

  <section id="error-404" class="<?php echo esc_attr($section_class); ?>">
    <?php if (isset($bg_image['url']) && $bg_image['url'] != ''): ?>    
    <div class="row-parallax-bg">
      <div class="parallax-wrapper">
        <div class="parallax-bg-element" style="background-image: url(<?php echo esc_url($bg_image['url']); ?>);"></div>
      </div>
    </div>
    <div class="parallax-overlay">
    <?php endif ?>
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="error-page">
              <i class="icon-sad"></i>
              <div class="title">
                <h2 class="mb-25 upper"><?php echo esc_attr(comet_options('error_title')); ?><span class="red-dot"></span></h2>
                <h4 class="upper"><?php echo esc_attr(comet_options('error_text')); ?></h4>
              </div>
              <div class="inline-form center mb-50">
                <?php get_search_form(); ?>
              </div>
              <a class="btn btn-color" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back to the home', 'comet-wp'); ?></a>
            </div>
          </div>
        </div>
      </div>
    <?php if (isset($bg_image['url']) && $bg_image['url'] != ''): ?>
    </div>    
    <?php endif; ?>
  </section>
<?php get_footer(); ?>
