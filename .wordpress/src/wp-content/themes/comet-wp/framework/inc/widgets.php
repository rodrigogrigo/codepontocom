<?php
function comet_sidebars(){

  register_sidebar(array(
    'name'          =>  esc_html__( 'Blog Sidebar', 'comet-wp' ),
    'id'            => 'blog_sidebar',
    'before_widget' => '<div class="widget %2 clearfix">',
    'after_widget'  => '</div>',
    'before_title'  => '<h6 class="upper">',
    'after_title'   => '</h6>'
  ));

  register_sidebar(array(
    'name'          =>  esc_html__( 'Shop Sidebar', 'comet-wp' ),
    'id'            => 'shop_sidebar',
    'before_widget' => '<div class="widget %2 clearfix">',
    'after_widget'  => '</div>',
    'before_title'  => '<h6 class="upper">',
    'after_title'   => '</h6>'
  ));

  register_sidebar(array(
    'name'          =>  esc_html__( 'First Footer Column', 'comet-wp' ),
    'id'            => 'footer_widget_1',
    'before_widget' => '<div class="widget %2 clearfix">',
    'after_widget'  => '</div>',
    'before_title'  => '<h6 class="upper">',
    'after_title'   => '</h6>'
  ));

  register_sidebar(array(
    'name'          =>  esc_html__( 'Second Footer Column', 'comet-wp' ),
    'id'            => 'footer_widget_2',
    'before_widget' => '<div class="widget %2 clearfix">',
    'after_widget'  => '</div>',
    'before_title'  => '<h6 class="upper">',
    'after_title'   => '</h6>'
  ));

  register_sidebar(array(
    'name'          =>  esc_html__( 'Third Footer Column', 'comet-wp' ),
    'id'            => 'footer_widget_3',
    'before_widget' => '<div class="widget %2 clearfix">',
    'after_widget'  => '</div>',
    'before_title'  => '<h6 class="upper">',
    'after_title'   => '</h6>'
  ));

  register_sidebar(array(
    'name'          =>  esc_html__( 'Fourth Footer Column', 'comet-wp' ),
    'id'            => 'footer_widget_4',
    'before_widget' => '<div class="widget %2 clearfix">',
    'after_widget'  => '</div>',
    'before_title'  => '<h6 class="upper">',
    'after_title'   => '</h6>'
  ));

  register_sidebar(array(
    'name'          =>  esc_html__( 'Footer Bottom', 'comet-wp' ),
    'id'            => 'footer_widget_5',
    'before_widget' => '<div class="inline-menu %2 clearfix">',
    'after_widget'  => '</div>',
    'before_title'  => '',
    'after_title'   => ''
  ));

}

add_action('widgets_init', 'comet_sidebars');

class CometNewsletterForm extends WP_Widget {

  function __construct() {
    parent::__construct( false, 'Comet - Newsletter Form' );
  }

  function widget( $args, $instance ) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    }
    if ( ! empty( $instance['text'] ) ) {
      echo '<p>'.esc_attr($instance['text']).'</p>';
    }
    if ( ! empty( $instance['url'] ) ) {
      echo do_shortcode('[cm_newsletter_form url="'.esc_url($instance['url']).'"]' );
    }
    echo $args['after_widget'];
  }

  function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
    $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';

    return $instance;
  }

  function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
    $url = ! empty( $instance['url'] ) ? $instance['url'] : '';
    $text = ! empty( $instance['text'] ) ? $instance['text'] : '';
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'comet-wp' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <p>
    <label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php esc_html_e( 'Mailchimp URL:', 'comet-wp' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
    </p>
    <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php esc_html_e( 'Text:', 'comet-wp' ); ?></label> 
    <textarea class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_attr( $text ); ?></textarea>
    </p>
    <?php
  }
}

function comet_register_widgets() {
  register_widget( 'CometNewsletterForm' );
}

add_action( 'widgets_init', 'comet_register_widgets' );
