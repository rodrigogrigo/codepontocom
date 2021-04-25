<div class="post-info">
  <h2><a href="<?php esc_url(the_permalink()); ?>"><?php echo esc_attr( get_the_title() ); ?></a></h2>
  <h6 class="upper">
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
    <a class="black-text" href="<?php esc_url(the_permalink()); ?>"><span class="post-date"><?php the_time('M d, Y'); ?></span></a>
  </h6>
</div>
