<?php if ((isset($post->ID) && comet_meta($post->ID, 'show_footer') != 'no') || !isset($post->ID)): ?>
  <footer id="footer-widgets">
    <div class="container">
      
      <div class="go-top">
        <a href="#top">
          <i class="ti-arrow-up"></i>
        </a>
      </div>

      <div class="row">
        <div class="col-md-6 ov-h">
          <div class="row">
            <?php if (is_active_sidebar('footer_widget_1')): ?>
              <div class="col-sm-4">
                <?php dynamic_sidebar('footer_widget_1'); ?>
              </div>
            <?php endif ?>
            <?php if (is_active_sidebar('footer_widget_2')): ?>
              <div class="col-sm-4">
                <?php dynamic_sidebar('footer_widget_2'); ?>
              </div>
            <?php endif ?>
            <?php if (is_active_sidebar('footer_widget_3')): ?>
              <div class="col-sm-4">
                <?php dynamic_sidebar('footer_widget_3'); ?>
              </div>
            <?php endif ?>
          </div>
        </div>
        <div class="col-md-4 col-md-offset-2">
          <div class="row">
            <?php if (is_active_sidebar('footer_widget_4')): ?>
              <div class="col-md-12">
                <?php dynamic_sidebar('footer_widget_4'); ?>
              </div>
            <?php endif ?>
          </div>
        </div>
      </div>

    </div>
  </footer>
  <footer id="footer">
    <div class="container">
      <div class="footer-wrap">
        <div class="row">
          <div class="col-md-4">
            <div class="copy-text">
              <p><?php echo esc_attr(comet_options('footer_text')); ?></p>
            </div>
          </div>
          <div class="col-md-4">
            <?php if (is_active_sidebar('footer_widget_5')): ?>
              <?php dynamic_sidebar('footer_widget_5'); ?>
            <?php endif ?>
          </div>
          <div class="col-md-4">
            <div class="footer-social">
              <?php comet_social_footer(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
<?php endif ?>
<?php wp_footer(); ?>
</body>
</html>
