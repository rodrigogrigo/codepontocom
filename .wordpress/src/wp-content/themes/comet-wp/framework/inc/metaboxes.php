<?php

class CometMetaboxes{
  
  function __construct()
  {
    $this->comet_metaboxes();
  }

  function comet_metaboxes(){
    add_action('add_meta_boxes', array($this, 'comet_add_meta_boxes'));
    add_action('save_post', array($this, 'save_meta_boxes'));
  }

  public function comet_add_meta_boxes(){
    $this->comet_add_meta_box('blog_options', 'Blog Options', array('page'));
    $this->comet_add_meta_box('page_options', 'Page Options', array('page'));
    $this->comet_add_meta_box('post_options', 'Post Options', array('post'));
    $this->comet_add_meta_box('portfolio_options', 'Portfolio Options', array('portfolio'));
  }

  public function comet_add_meta_box($id, $label, $post_type){
    add_meta_box('comet_' . $id, $label, array(&$this, $id), $post_type);
  }  

  public function save_meta_boxes($post_id){
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    foreach($_POST as $key => $value) {
      if(strstr($key, 'comet_')) {
        update_post_meta($post_id, $key, $value);
      }
    }
  }

  public function blog_options(){
    $output = '<div id="comet_metabox" style="display: block;">';
    
    $output .= $this->select(
      'blog_layout',
       esc_html__('Blog Layout', 'comet-wp'),
      array(
        'default'  => 'Default',
        'masonry'  => 'Masonry',
        'fixed' => 'Fixed Image'
      )
    );

    $output .= $this->select(
      'blog_sidebar',
       esc_html__('Sidebar Position', 'comet-wp'),
      array(
        'right'  => 'Right',
        'left'  => 'Left',
        'off'  => 'Off',
      )
    );

    $output .= $this->select(
      'masonry_columns',
       esc_html__('Masonry Columns', 'comet-wp'),
      array(
        'two-col'  => '2',
        'three-col'  => '3',
      )
    );

    $output .= $this->upload(
      'blog_fixed_bg',
       esc_html__('Background Image', 'comet-wp')      
    );

    $output .= '</div>';

    echo $output;
  }

  public function page_options(){
    
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
    $menus_array = array('' => 'Default');
    foreach ($menus as $menu) {
      $menus_array[$menu->term_id] = $menu->name;
    }

    $output = '<div id="comet_metabox">';

    $output .= '<div id="comet_metabox_tabs">';
    $output .= '<ul class="nav nav-pills nav-stacked nav-tabs" role="tablist">';
    $output .= '<li class="active"><a data-toggle="tab" href="#comet-options-title"><i class="ti-announcement"></i>'. esc_html__('Title', 'comet-wp').'</a></li>';
    $output .= '<li><a data-toggle="tab" href="#comet-options-header"><i class="ti-layout"></i>'. esc_html__('Header', 'comet-wp').'</a></li>';
    $output .= '<li><a data-toggle="tab" href="#comet-options-menu"><i class="ti-menu"></i>'. esc_html__('Menu', 'comet-wp').'</a></li>';
    $output .= '<li><a data-toggle="tab" href="#comet-options-footer"><i class="ti-layout"></i>'. esc_html__('Footer', 'comet-wp').'</a></li>';
    $output .= '</ul>';
    $output .= '</div>';

    $output .= '<div id="comet_metabox_content" class="tab-content">';

    /* Title */
    $output .= '<div role="tabpanel" class="tab-pane active" id="comet-options-title">';    
    $output .= $this->select(
      'show_page_title',
       esc_html__('Show Page Title?', 'comet-wp'),
      array(
        'yes'  => 'Yes',
        'no'  => 'No',
      )
    );

    $output .= $this->select(
      'page_title_style',
       esc_html__('Title Area Style', 'comet-wp'),
      array(
        ''  => 'Simple',
        'dark' => 'Simple (Dark)',
        'parallax'  => 'Parallax'
      )
    );

    $output .= $this->upload(
      'title_bg',
       esc_html__('Background Image', 'comet-wp')      
    );

    $output .= $this->text(
      'page_title',
       esc_html__('Page Title', 'comet-wp'),
       esc_html__('If empty default page title will be used.', 'comet-wp')
    );

    $output .= $this->text(
      'page_subtitle',
       esc_html__('Page Subtitle', 'comet-wp')      
    );

    $output .= $this->select(
      'title_text_align',
       esc_html__('Text Align', 'comet-wp'),
      array(
        'center' => 'Center',
        'left'  => 'Left',
        'right'  => 'Right'
      )
    );

    $output .= $this->select(
      'title_text_transform',
       esc_html__('Text Transform', 'comet-wp'),
      array(
        ''  => 'None',
        'upper' => 'Uppercase',
      )
    );

    $output .= $this->select(
      'title_text_color',
       esc_html__('Text Color', 'comet-wp'),
      array(
        ''  => 'Light',
        'light' => 'Dark',
      )
    );
    $output .= '</div>';

    /* Header */
    $output .= '<div role="tabpanel" class="tab-pane" id="comet-options-header">';
    $output .= $this->select(
      'show_cart',
       esc_html__('Show Shopping Cart?', 'comet-wp'),
      array(
        'yes'  => 'Yes',
        'no'  => 'No',
      )
    );
    
    $output .= $this->select(
      'show_search',
       esc_html__('Show Search Form?', 'comet-wp'),
      array(
        'yes'  => 'Yes',
        'no'  => 'No',
      )
    );
    $output .= '</div>';

    /* Menu */
    $output .= '<div role="tabpanel" class="tab-pane" id="comet-options-menu">';
    $output .= $this->select(
      'menu_id',
       esc_html__('Menu', 'comet-wp'),
      $menus_array
    );
    
    $output .= $this->select(
      'menu_color',
       esc_html__('Menu Color', 'comet-wp'),
      array(
        '' => 'Default',
        'light' => 'Light',
        'dark' => 'Dark'
      )
    );
    $output .= '</div>';

    /* Footer */
    $output .= '<div role="tabpanel" class="tab-pane" id="comet-options-footer">';
    $output .= $this->select(
      'show_footer',
       esc_html__('Show Default Footer With Widgets?', 'comet-wp'),
      array(
        'yes'  => 'Yes',
        'no'  => 'No',
      )
    ); 
    $output .= '</div>';
    
    $output .= '</div>';
    $output .= '</div>';

    echo $output;
  }

  public function post_options(){
    $output = '<div id="comet_metabox" style="display: block;">';

    $output .= $this->select(
      'post_sidebar',
       esc_html__('Sidebar Position', 'comet-wp'),
      array(
        'right'  => 'Right',
        'left'  => 'Left',
        'off'  => 'Off',
      )
    );

    $output .= '</div>';

    echo $output;
  }

  public function portfolio_options(){

    $output = '<div id="comet_metabox">';

    $output .= '<div id="comet_metabox_tabs">';
    $output .= '<ul class="nav nav-pills nav-stacked nav-tabs" role="tablist">';
    $output .= '<li class="active"><a data-toggle="tab" href="#comet-options-general"><i class="ti-layout-grid-2"></i>'. esc_html__('General', 'comet-wp').'</a></li>';
    $output .= '</ul>';
    $output .= '</div>';

    $output .= '<div id="comet_metabox_content" class="tab-content">';

    /* General */
    $output .= '<div role="tabpanel" class="tab-pane active" id="comet-options-general">';
    $output .= $this->select(
      'show_portfolio_title',
       esc_html__('Show Page Title?', 'comet-wp'),
      array(
        'yes'  => 'Yes',
        'no'  => 'No',
      )
    );
    $output .= $this->upload(
      'portfolio_title_bg',
       esc_html__('Header Background Image', 'comet-wp')      
    );
    $output .= '</div>';
    
    $output .= '</div>';
    $output .= '</div>';

    echo $output;
  }

  public function text($id, $label, $help = ''){
    global $post;

    return '<div class="comet_field" id="comet_'.$id.'_field">
      <label for="comet_'.$id.'">'. $label.'</label>
      <div class="field">
        <input type="text" id="comet_'. $id .'" name="comet_'. $id .'" value="'. esc_attr(get_post_meta($post->ID, 'comet_' . $id, true)).'">
          <span class="help-line">'. $help.'</span>
      </div>
    </div>';
  }

  public function textarea($id, $label){
    global $post;
    return '<div class="comet_field" id="comet_'. $id.'_field">
        <label for="comet_'. $id.'">'. $label .'</label>
        <div class="field">
          <textarea id="comet_'. $id.'" name="comet_'. $id.'">'. esc_attr(get_post_meta($post->ID, 'comet_' . $id, true)).'</textarea>
        </div>
      </div>';
  }

  public function select($id, $label, $options){
    global $post;
    $output = '<div class="comet_field" id="comet_'. $id .'_field">';
    $output .= '<label for="comet_'. $id .'">'. $label .'</label>';
    $output .= '<div class="field">';
    $output .= '<select id="comet_'. $id.'" name="comet_'. $id.'">';
    foreach ($options as $key => $option) {
      if(get_post_meta($post->ID, 'comet_' . $id, true) == $key) {
        $selected = 'selected="selected"';
      } else {
        $selected = '';
      }
      $output .= '<option '.$selected.' value="'. $key.'">'. $option .'</option>';
    }
    $output .= '</select>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
  }

  public function radio($id, $label, $options){
    global $post;
    $output = '<div class="comet_field" id="comet_<?php echo $id; ?>_field">';
    $output .= '<div class="field">';
    foreach ($options as $key => $option) {
      if(get_post_meta($post->ID, 'comet_' . $id, true) == $key) {
        $selected = 'checked="checked"';
      } else {
        $selected = '';
      }
      $output .= '<label for="comet_'. $id .'_'. $key .'">';
      $output .= '<input type="radio" id="comet_'.$id .'_'. $key.'" name="comet_'. $id .'" '.$selected.' value="'.$key.'">';
      $output .= $option . '</label>';
    }
    $output .= '</div>';
    $output .= '</div>';
    return $output;
  }

  public function checkbox($id, $label, $options){
    global $post;
    $output = '<div class="comet_field" id="comet_'. $id.'_field">';
    $output .= '<div class="field">';
    foreach ($options as $key => $option) {
      if(get_post_meta($post->ID, 'comet_' . $id, true) == $key) {
        $selected = 'checked="checked"';
      } else {
        $selected = '';
      }
      $output .= '<label for="comet_'. $id .'_'. $key.'">';
      $output .= '<input type="checkbox" id="comet_'.$id .'_'. $key.'" name="comet_'. $id .'" '.$selected.' value="'.$key.'">';
      $output .= $option . '</label>';
    }
    $output .= '</div>';
    $output .= '</div>';
    return $output;
  }

  public function upload($id, $label){
    global $post;
    return '<div class="comet_field" id="comet_'. $id .'_field">
      <label for="comet_'. $id.'">'. $label .'</label>
      <div class="field upload_field">
        <input type="text" id="comet_'. $id.'" name="comet_'. $id.'" value="'. esc_attr(get_post_meta($post->ID, 'comet_' . $id, true)).'">
        <button class="button upload_button" type="button">'. esc_html__('Browse', 'comet-wp') .'</button>
      </div>
    </div>';
  }

}

$metaboxes = new CometMetaboxes;

?>
