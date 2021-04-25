<?php 

$post_embeds = get_media_embedded_in_content(apply_filters( 'the_content', get_the_content() ));
$can_show_thumb = has_post_thumbnail() && !is_search() && !in_array(get_post_format(), array('audio', 'video', 'quote'));
$media_format = (get_post_format() == 'audio') ? 'audio': 'video';


?>
<article id="post-<?php echo esc_attr(get_the_id()); ?>" <?php post_class('post-single'); ?>>
  
  <?php get_template_part('partials/blog/post-info'); ?>  
  
  <?php if (!empty($post_embeds) || $can_show_thumb): ?>
    <div class="post-media">
      
      <?php if ($can_show_thumb): ?>

      <a href="<?php echo esc_url(get_the_permalink()); ?>">
        <?php the_post_thumbnail('comet_medium'); ?>
      </a>

      <?php elseif(get_post_format() == 'audio' || get_post_format() == 'video' && !is_search()): ?>   
        <div class="media-<?php echo esc_attr($media_format); ?>">
        <?php 
          if (!empty($post_embeds)) {
            echo $post_embeds[0];
          }
        ?>
        </div>

      <?php endif ?>

    </div> 
  <?php endif ?>                                    

  <div class="post-body">
    <?php if (get_post_format() == 'quote'): ?>
      <a href="<?php echo esc_url(get_the_permalink()); ?>">
        <blockquote>
          <?php the_excerpt(); ?>
        </blockquote>
      </a>
    <?php else: ?>
      <?php the_excerpt(); ?>
    <?php endif ?>
  </div>

</article>
