<!-- Search Form -->
<form class="inline-form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
  <div class="input-group">
    <input type="text" name="s" placeholder="<?php esc_html_e('Search', 'comet-wp'); ?>" class="form-control" value="<?php echo get_search_query(); ?>">
    <span class="input-group-btn">
      <button type="submit" class="btn btn-color">
        <span><i class="ti-search"></i></span>
      </button>
    </span>
  </div>
</form>
<!-- End Search Form -->
