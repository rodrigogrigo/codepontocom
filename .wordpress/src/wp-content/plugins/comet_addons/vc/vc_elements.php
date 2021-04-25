<?php

$portfolio_array = array();
$portfolio_posts = get_posts(array('posts_per_page' => '-1', 'post_type' => 'portfolio'));
foreach ($portfolio_posts as $post) {
  $portfolio_array[$post->post_title] = $post->ID;
}

/* Home Slider */
vc_map(
  array(
    'name' => __('Home Slider', 'comet'),
    'base' => 'cm_home_slider',
    'icon' => 'ti-layout-slider',
    'description' => __('Slideshow with images and texts.', 'comet'),
    'category' => __('Content', 'comet'),
    'as_parent' => array('only' => 'cm_home_slide'),
    'content_element' => true,
    'is_container' => true,
    'params' => array(
      array(
        'type' => 'dropdown',
        'heading' => __('Animated Slider', 'comet'),
        'param_name' => 'animated',
        'value' => array(
          'No' => '',
          'Yes' => 'kenburn'
        ),
        'std' => ''
      )
    ),
    'js_view' => 'VcColumnView'
  )
);

/* Single Home Slider */
vc_map(
  array(
    'name' => __('Single Slide', 'comet'),
    'base' => 'cm_home_slide',
    'icon' => 'ti-image',
    'description' => __('Slide with images and text.', 'comet'),
    'content_element' => true,
    'as_child' => array('only' => 'cm_home_slider'),
    'params' => array(
      array(
        'type' => 'attach_image',
        'value' => '',
        'heading' => __('Image', 'comet'),
        'param_name' => 'image'
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Headline', 'comet'),
        'param_name' => 'headline',
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Subtitle', 'comet'),
        'param_name' => 'subtitle',
      ),
      array(
        'type' => 'param_group',
        'value' => '',
        'param_name' => 'buttons',
        'heading' => __('Buttons', 'comet'),
        'params' => array(
          array(
            'type' => 'vc_link',
            'value' => '',
            'heading' => __('Button Link', 'comet'),
            'param_name' => 'link',
          ),
          array(
            'type' => 'dropdown',
            'heading' => __('Button Color', 'comet'),
            'param_name' => 'color',
            'value' => array(
              'Colored' => 'color',
              'Colored (borders only)' => 'color-out',
              'Dark' => 'dark',
              'Dark (borders only)' => 'dark-out',
              'Light' => 'light',
              'Light (borders only)' => 'light-out',
            )
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'shape',
            'heading' => __('Border Shape', 'comet'),
            'value' => array(
              'Square'  => '',
              'Rounded' => 'btn-round',
              'Round' => 'btn-scroll'
            ),
            'std' => ''
          ),
          array(
            'type' => 'dropdown',
            'value' => array(
              'No' => '',
              'Yes'     => 'yes',
            ),
            'heading' => __('Add Icon?', 'comet'),
            'param_name' => 'show_icon',
            'std' => '',
            'group' => __('Style', 'comet')
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Icon library', 'comet' ),
            'value' => array(
              __( 'ET Line Icons', 'comet' ) => 'etline',
              __( 'Themify', 'comet' ) => 'themify'
            ),
            'param_name' => 'icon_type',
            'description' => __( 'Select icon library.', 'comet' ),
            'dependency' => array(
              'element' => 'show_icon',
              'value' => 'yes'
            ),
            'group' => __('Style', 'comet')
          ),
          array(
            'type' => 'iconpicker',
            'heading' => __('Icon', 'comet'),
            'param_name' => 'icon_etline',
            'settings' => array(
              'type' => 'etline',
              'emptyIcon' => false,
              'iconsPerPage' => 100
            ),
            'dependency' => array(
              'element' => 'icon_type',
              'value' => 'etline'
            ),
            'group' => __('Style', 'comet')
          ),
          array(
            'type' => 'iconpicker',
            'heading' => __('Icon', 'comet'),
            'param_name' => 'icon_themify',
            'settings' => array(
              'type' => 'themify',
              'emptyIcon' => false,
              'iconsPerPage' => 100
            ),
            'dependency' => array(
              'element' => 'icon_type',
              'value' => 'themify'
            ),
            'group' => __('Style', 'comet')
          ),
        ),
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Left'    => 'left',
          'Center'  => 'center',
          'Right'   => 'right'
        ),
        'heading' => __('Text Align', 'comet'),
        'param_name' => 'text_align',
        'std' => 'center',
        'group' => __('Font Style', 'comet')
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Small'   => 'small',
          'Medium'  => 'medium',
          'Big'     => 'big'
        ),
        'std' => 'medium',
        'heading' => __('Font Size', 'comet'),
        'param_name' => 'font_size',
        'group' => __('Font Style', 'comet')
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Default'   => 'default',
          'Cursive'  => 'cursive',
        ),
        'std' => 'default',
        'heading' => __('Font Style', 'comet'),
        'param_name' => 'font_style',
        'description' => __('Note: cursive text applies only to subtitle.', 'comet'),
        'group' => __('Font Style', 'comet')
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'None' => '',
          'Uppercase'   => 'upper',
        ),
        'heading' => __('Text Transform', 'comet'),
        'param_name' => 'text_transform',
        'group' => __('Font Style', 'comet'),
        'std' => ''
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Top'    => 'top',
          'Bottom'  => 'bottom',
        ),
        'heading' => __('Subtitle Position', 'comet'),
        'param_name' => 'subtitle_position',
        'std' => 'bottom'
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Yes' => '1',
          'No'  => '0'
        ),
        'heading' => __('Add styled dot at the end?', 'comet'),
        'param_name' => 'headline_dot',
      ),
    )
  )
);

/* Text Rotator */
vc_map(
  array(
    'name' => __('Text Rotator'),
    'base' => 'cm_text_rotator',
    'description' => __('Simple text rotator.', 'comet'),
    'icon' => 'ti-layout-media-center',
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'dropdown',
        'value' => array(
          'None' => '',
          'Uppercase'   => 'upper',
        ),
        'heading' => __('Text Transform', 'comet'),
        'param_name' => 'text_transform',
        'std' => ''
      ),
      array(
        'type' => 'param_group',
        'value' => '',
        'param_name' => 'headings',
        'heading' => __('Headings', 'comet'),
        'params' => array(
          array(
            'type' => 'textfield',
            'value' => '',
            'heading' => __('Heading', 'comet'),
            'param_name' => 'heading',
          )
        )
      )
    )
  )
);

/* Page Title */
vc_map(
  array(
    'name' => __('Page Title'),
    'base' => 'cm_page_title',
    'icon' => 'ti-uppercase',
    'description' => __('Styled heading.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Title', 'comet'),
        'param_name' => 'title',
        'admin_label' => true
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Subtitle', 'comet'),
        'param_name' => 'subtitle',
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'H1'    => 'h1',
          'H2'    => 'h2',
          'H3'    => 'h3',
          'H4'    => 'h4',
          'H5'    => 'h5',
          'H6'    => 'h6',
        ),
        'heading' => __('Title Tag', 'comet'),
        'param_name' => 'tag',
        'std' => 'h2'
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'No' => '',
          'Yes'     => 'yes',
        ),
        'heading' => __('Add Icon?', 'comet'),
        'param_name' => 'show_icon',
        'std' => '',
        'group' => __('Style', 'comet')
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Icon library', 'comet' ),
        'value' => array(
          __( 'ET Line Icons', 'comet' ) => 'etline',
          __( 'Themify', 'comet' ) => 'themify'
        ),
        'param_name' => 'icon_type',
        'description' => __( 'Select icon library.', 'comet' ),
        'dependency' => array(
          'element' => 'show_icon',
          'value' => 'yes'
        ),
        'group' => __('Style', 'comet')
      ),
      array(
        'type' => 'iconpicker',
        'heading' => __('Icon', 'comet'),
        'param_name' => 'icon_etline',
        'settings' => array(
          'type' => 'etline',
          'emptyIcon' => false,
          'iconsPerPage' => 100
        ),
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'etline'
        ),
        'group' => __('Style', 'comet')
      ),
      array(
        'type' => 'iconpicker',
        'heading' => __('Icon', 'comet'),
        'param_name' => 'icon_themify',
        'settings' => array(
          'type' => 'themify',
          'emptyIcon' => false,
          'iconsPerPage' => 100
        ),
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'themify'
        ),
        'group' => __('Style', 'comet')
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Default'    => '',
          'Serif'  => 'serif',
          'Cursive'   => 'cursive'
        ),
        'heading' => __('Title Font Style', 'comet'),
        'param_name' => 'title_style',
        'std' => '',
        'group' => __('Style', 'comet'),
        'edit_field_class' => 'vc_col-xs-6 m-15',
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Default'    => '',
          'Serif'  => 'serif',
          'Cursive'   => 'cursive'
        ),
        'heading' => __('Subtitle Font Style', 'comet'),
        'param_name' => 'subtitle_style',
        'std' => '',
        'group' => __('Style', 'comet'),
        'edit_field_class' => 'vc_col-xs-6 m-15',
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Left'    => 'left',
          'Center'  => 'center',
          'Right'   => 'right'
        ),
        'heading' => __('Text Align', 'comet'),
        'param_name' => 'text_align',
        'std' => 'center',
        'edit_field_class' => 'vc_col-xs-4 m-15',
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          '' => '',
          'Left'    => 'left',
          'Center'  => 'center',
          'Right'   => 'right'
        ),
        'heading' => __('Text Align (Tablet)', 'comet'),
        'param_name' => 'text_align_sm',
        'std' => '',
        'edit_field_class' => 'vc_col-xs-4 m-15',
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          '' => '',
          'Left'    => 'left',
          'Center'  => 'center',
          'Right'   => 'right'
        ),
        'heading' => __('Text Align (Smartphone)', 'comet'),
        'param_name' => 'text_align_xs',
        'std' => '',
        'edit_field_class' => 'vc_col-xs-4 m-15',
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Yes' => '1',
          'No'  => '0'
        ),
        'heading' => __('Show Horizontal Rule?', 'comet'),
        'param_name' => 'horizontal_rule',
        'group' => __('Style', 'comet'),
        'edit_field_class' => 'vc_col-xs-6 m-15',
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Default' => '',
          'Black'  => 'black'
        ),
        'heading' => __('Horizontal Rule Color', 'comet'),
        'param_name' => 'hr_color',
        'dependency' => array(
          'element' => 'horizontal_rule',
          'value' => '1'
        ),
        'group' => __('Style', 'comet'),
        'edit_field_class' => 'vc_col-xs-6 m-15',
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'None' => '',
          'Uppercase'   => 'upper',
        ),
        'heading' => __('Text Transform', 'comet'),
        'param_name' => 'text_transform',
        'std' => '',
        'group' => __('Style', 'comet')
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Yes' => '1',
          'No'  => '0'
        ),
        'heading' => __('Add styled dot at the end?', 'comet'),
        'param_name' => 'title_dot',
        'group' => __('Style', 'comet')
      ),
    )
  )
);

/* Buttons */
vc_map(
  array(
    'name' => __('Button', 'comet'),
    'base' => 'cm_button',
    'icon' => 'ti-control-play',
    'description' => __('Button element.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'textfield',
        'param_name' => 'text',
        'heading' => __('Text', 'comet'),
        'value' => ''
      ),
      array(
        'type' => 'vc_link',
        'param_name' => 'link',
        'heading' => __('URL (Link)', 'comet'),
        'value' => ''
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'style',
        'heading' => __('Style', 'comet'),
        'value' => array(
          'Colored' => 'color',
          'Colored (borders only)' => 'color-out',
          'Dark' => 'dark',
          'Dark (borders only)' => 'dark-out',
          'Light' => 'light',
          'Light (borders only)' => 'light-out',
        ),
        'std' => 'color'
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'alignment',
        'heading' => __('Alignment', 'comet'),
        'value' => array(
          'Inline'  => 'inline-btn-container',
          'Center'  => 'text-center',
          'Left'    => 'text-left',
          'Right'   => 'text-right'
        ),
        'std' => 'inline-btn-container'
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'shape',
        'heading' => __('Shape', 'comet'),
        'value' => array(
          'Square'  => '',
          'Rounded' => 'btn-round'
        ),
        'std' => ''
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'size',
        'heading' => __('Size', 'comet'),
        'value' => array(
          'Small'  => 'btn-sm',
          'Normal' => 'normal',
          'Big' => 'btn-lg'
        ),
        'std' => 'normal'
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'No' => '',
          'Yes'     => 'yes',
        ),
        'heading' => __('Add Icon?', 'comet'),
        'param_name' => 'show_icon',
        'std' => '',
        'group' => __('Style', 'comet')
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Icon library', 'comet' ),
        'value' => array(
          __( 'ET Line Icons', 'comet' ) => 'etline',
          __( 'Themify', 'comet' ) => 'themify'
        ),
        'param_name' => 'icon_type',
        'description' => __( 'Select icon library.', 'comet' ),
        'dependency' => array(
          'element' => 'show_icon',
          'value' => 'yes'
        ),
        'group' => __('Style', 'comet')
      ),
      array(
        'type' => 'iconpicker',
        'heading' => __('Icon', 'comet'),
        'param_name' => 'icon_etline',
        'settings' => array(
          'type' => 'etline',
          'emptyIcon' => false,
          'iconsPerPage' => 100
        ),
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'etline'
        ),
        'group' => __('Style', 'comet')
      ),
      array(
        'type' => 'iconpicker',
        'heading' => __('Icon', 'comet'),
        'param_name' => 'icon_themify',
        'settings' => array(
          'type' => 'themify',
          'emptyIcon' => false,
          'iconsPerPage' => 100
        ),
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'themify'
        ),
        'group' => __('Style', 'comet')
      ),
    )
  )
);

/* Services */
vc_map(
  array(
    'name' => __('Services Box', 'comet'),
    'base' => 'cm_services',
    'icon' => 'ti-layout-grid2',
    'description' => __('Services container', 'comet'),
    'category' => __('Content', 'comet'),
    'as_parent' => array('only' => 'cm_single_service'),
    'content_element' => true,
    'is_container' => true,
    'show_settings_on_create' => false,
    'js_view' => 'VcColumnView'
  )
);

/* Single Service */
vc_map(
  array(
    'name' => __('Service', 'comet'),
    'base' => 'cm_single_service',
    'icon' => 'ti-layout-media-overlay-alt-2',
    'content_element' => true,
    'as_child' => array('only' => 'cm_services'),
    'params' => array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Icon library', 'comet' ),
        'value' => array(
          __( 'ET Line Icons', 'comet' ) => 'etline',
          __( 'Themify', 'comet' ) => 'themify'
        ),
        'param_name' => 'icon_type',
        'description' => __( 'Select icon library.', 'comet' ),
      ),
      array(
        'type' => 'iconpicker',
        'heading' => __('Icon', 'comet'),
        'param_name' => 'icon_etline',
        'settings' => array(
          'type' => 'etline',
          'emptyIcon' => false,
          'iconsPerPage' => 100
        ),
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'etline'
        )
      ),
      array(
        'type' => 'iconpicker',
        'heading' => __('Icon', 'comet'),
        'param_name' => 'icon_themify',
        'settings' => array(
          'type' => 'themify',
          'emptyIcon' => false,
          'iconsPerPage' => 100
        ),
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'themify'
        )
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Title', 'comet'),
        'admin_label' => true,
        'param_name' => 'title',
      ),
      array(
        'type' => 'textarea',
        'value' => '',
        'heading' => __('Text', 'comet'),
        'param_name' => 'text',
      ),
      array(
        'type' => 'checkbox',
        'heading' => __('Borders', 'comet'),
        'param_name' => 'borders',
        'group' => __('Design Options', 'comet'),
        'value' => array(
          'Top' => 'border-top',
          'Right' => 'border-right',
          'Bottom' => 'border-bottom',
          'Left' => 'border-left',
        )
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'No' => '',
          'Yes'     => 'yes',
        ),
        'heading' => __('Add Link?', 'comet'),
        'param_name' => 'add_link',
        'std' => '',
      ),
      array(
        'type' => 'vc_link',
        'value' => '',
        'heading' => __('Link', 'comet'),
        'param_name' => 'link',
        'dependency' => array(
          'element' => 'add_link',
          'value' => array('yes'),
        ),
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Column Width', 'comet' ),
        'param_name' => 'column_width',
        'group' => __( 'Design Options', 'comet' ),
        'value' => array(
          '1 column - 1/12' => 'vc_col-md-1',
          '2 columns - 1/6' => 'vc_col-md-2',
          '3 columns - 1/4' => 'vc_col-md-3',
          '4 columns - 1/3' => 'vc_col-md-4',
          '5 columns - 5/12' => 'vc_col-md-5',
          '6 columns - 1/2' => 'vc_col-md-6',
          '7 columns - 7/12' => 'vc_col-md-7',
          '8 columns - 2/3' => 'vc_col-md-8',
          '9 columns - 3/4' => 'vc_col-md-9',
          '10 columns - 5/6' => 'vc_col-md-10',
          '11 columns - 11/12' => 'vc_col-md-11',
          '12 columns - 1/1' => 'vc_col-md-12',
        ),
        'std' => 'vc_col-md-6'
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Column Width (Tablet)', 'comet' ),
        'param_name' => 'column_width_sm',
        'group' => __( 'Design Options', 'comet' ),
        'value' => array(
          '1 column - 1/12' => 'vc_col-sm-1',
          '2 columns - 1/6' => 'vc_col-sm-2',
          '3 columns - 1/4' => 'vc_col-sm-3',
          '4 columns - 1/3' => 'vc_col-sm-4',
          '5 columns - 5/12' => 'vc_col-sm-5',
          '6 columns - 1/2' => 'vc_col-sm-6',
          '7 columns - 7/12' => 'vc_col-sm-7',
          '8 columns - 2/3' => 'vc_col-sm-8',
          '9 columns - 3/4' => 'vc_col-sm-9',
          '10 columns - 5/6' => 'vc_col-sm-10',
          '11 columns - 11/12' => 'vc_col-sm-11',
          '12 columns - 1/1' => 'vc_col-sm-12',
        ),
        'std' => 'vc_col-sm-6'
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Column Width (Smartphone)', 'comet' ),
        'param_name' => 'column_width_xs',
        'group' => __( 'Design Options', 'comet' ),
        'value' => array(
          '1 column - 1/12' => 'vc_col-xs-1',
          '2 columns - 1/6' => 'vc_col-xs-2',
          '3 columns - 1/4' => 'vc_col-xs-3',
          '4 columns - 1/3' => 'vc_col-xs-4',
          '5 columns - 5/12' => 'vc_col-xs-5',
          '6 columns - 1/2' => 'vc_col-xs-6',
          '7 columns - 7/12' => 'vc_col-xs-7',
          '8 columns - 2/3' => 'vc_col-xs-8',
          '9 columns - 3/4' => 'vc_col-xs-9',
          '10 columns - 5/6' => 'vc_col-xs-10',
          '11 columns - 11/12' => 'vc_col-xs-11',
          '12 columns - 1/1' => 'vc_col-xs-12',
        ),
        'std' => 'vc_col-xs-12'
      ),
    )
  )
);

/* Icon Boxes */
vc_map(
  array(
    'name' => __('Icon Box', 'comet'),
    'base' => 'cm_icon_box',
    'category' => __('Content', 'comet'),
    'icon' => 'ti-star',
    'description' => __('Styled icon with text.', 'comet'),
    'params' => array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Style', 'comet' ),
        'value' => array(
          'Small' => 'small',
          'Circular' => 'circular',
          'Simple' => 'simple',
          'Basic' => 'basic',
          'Text Box' => 'text_box',
          'Number Box' => 'number_box'
        ),
        'admin_label' => true,
        'param_name' => 'box_style',
        'description' => __( 'Select icon library.', 'comet' ),
      ),
      array(
        'type' => 'textfield',
        'value' => 'Item no.',
        'heading' => __('Top Text', 'comet'),
        'param_name' => 'top_text',
        'dependency' => array(
          'element' => 'box_style',
          'value' => array('number_box')
        )
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Number', 'comet'),
        'param_name' => 'number',
        'dependency' => array(
          'element' => 'box_style',
          'value' => array('number_box')
        )
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Title', 'comet'),
        'param_name' => 'title',
      ),
      array(
        'type' => 'textarea',
        'value' => '',
        'heading' => __('Text', 'comet'),
        'param_name' => 'text',
        'dependency' => array(
          'element' => 'box_style',
          'value' => array('small', 'circular', 'basic', 'text_box', 'number_box')
        )
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Icon library', 'comet' ),
        'value' => array(
          __( 'ET Line Icons', 'comet' ) => 'etline',
          __( 'Themify', 'comet' ) => 'themify'
        ),
        'param_name' => 'icon_type',
        'description' => __( 'Select icon library.', 'comet' ),
        'dependency' => array(
          'element' => 'box_style',
          'value' => array('small', 'circular', 'simple', 'basic')
        )
      ),
      array(
        'type' => 'iconpicker',
        'heading' => __('Icon', 'comet'),
        'param_name' => 'icon_etline',
        'settings' => array(
          'type' => 'etline',
          'emptyIcon' => false,
          'iconsPerPage' => 100
        ),
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'etline',
        )
      ),
      array(
        'type' => 'iconpicker',
        'heading' => __('Icon', 'comet'),
        'param_name' => 'icon_themify',
        'settings' => array(
          'type' => 'themify',
          'emptyIcon' => false,
          'iconsPerPage' => 100
        ),
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'themify',
        )
      ),
      array(
        'type' => 'colorpicker',
        'heading' => __( 'Icon Color', 'comet' ),
        'value' => '',
        'param_name' => 'icon_color',
        'dependency' => array(
          'element' => 'box_style',
          'value' => array('small', 'circular', 'simple', 'basic')
        )
      ),
      array(
        'type' => 'checkbox',
        'param_name' => 'small_style',
        'heading' => __( 'Style', 'comet' ),
        'value' => array(
          'Boxed' => 'boxed',
          'Outlined' => 'outlined'
        ),
        'dependency' => array(
          'element' => 'box_style',
          'value' => array('small'),
        )
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'back_icon',
        'heading' => __( 'Enable Icon Shadow?', 'comet' ),
        'value' => array(
          'Yes' => 'yes',
          'No' => ''
        ),
        'dependency' => array(
          'element' => 'box_style',
          'value' => array('small'),
        )
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'icon_border',
        'heading' => __( 'Add Border to Icon?', 'comet' ),
        'value' => array(
          'No' => '',
          'Yes' => 'yes',
        ),
        'dependency' => array(
          'element' => 'box_style',
          'value' => array('small'),
        )
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'horizontal_rule',
        'heading' => __( 'Show Horizontal Rule?', 'comet' ),
        'value' => array(
          'Yes' => 'yes',
          'No' => ''
        ),
        'dependency' => array(
          'element' => 'box_style',
          'value' => array('small'),
        )
      ),
    )
  )
);

/* Clients */
vc_map(
  array(
    'name' => __('Clients', 'comet'),
    'base' => 'cm_clients',
    'icon' => 'ti-id-badge',
    'description' => __('Clients logos.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'dropdown',
        'param_name' => 'column_width',
        'heading' => __('Columns Width', 'comet'),
        'value' => array(
          '3 Column Desktop / 6 Columns Smartphone' => 'col-sm-3 col-xs-6',
          '4 Column Desktop / 6 Columns Smartphone' => 'col-sm-4 col-xs-6',
          '6 Columns' => 'col-xs-6',
        ),
        'std' => 'col-sm-4 col-xs-6'
      ),
      array(
        'type' => 'param_group',
        'value' => '',
        'param_name' => 'images',
        'heading' => __('Clients', 'comet'),
        'params' => array(
          array(
            'type' => 'attach_image',
            'value' => '',
            'heading' => __('Client Logo', 'comet'),
            'param_name' => 'image',
          ),
          array(
            'type' => 'checkbox',
            'heading' => __('Borders', 'comet'),
            'param_name' => 'borders',
            'value' => array(
              'Top' => 'border-top',
              'Right' => 'border-right',
              'Bottom' => 'border-bottom',
              'Left' => 'border-left',
            )
          ),
        )
      )
    )
  )
);

/* Testimonials */
vc_map(
  array(
    'name' => __('Testimonials', 'comet'),
    'base' => 'cm_testimonials',
    'icon' => 'ti-book',
    'description' => __('Testimonials slider.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'param_group',
        'value' => '',
        'param_name' => 'clients',
        'heading' => __('Testimonials', 'comet'),
        'params' => array(
          array(
            'type' => 'textfield',
            'value' => '',
            'heading' => __('Client name', 'comet'),
            'param_name' => 'client_name',
          ),
          array(
            'type' => 'textarea',
            'value' => '',
            'heading' => __('Comment', 'comet'),
            'param_name' => 'client_comment',
          ),
        )
      )
    )
  )
);

/* Blog Summary */
vc_map(
  array(
    'name' => __('Blog Summary', 'comet'),
    'base' => 'cm_blog_summary',
    'icon' => 'ti-notepad',
    'category' => __('Content', 'comet'),
    'description' => __('A section with your latest posts.', 'comet'),
    'params' => array(
      array(
        'type' => 'textfield',
        'param_name' => 'posts_to_show',
        'heading' => __('Number of posts to show', 'comet'),
        'value' => '4'
      )
    )
  )
);

/* Portfolio Section */
vc_map(
  array(
    'name' => __('Portfolio Section', 'comet'),
    'base' => 'cm_portfolio',
    'icon' => 'ti-briefcase',
    'category' => __('Content', 'comet'),
    'description' => __('A section with your portfolio items.', 'comet'),
    'params' => array(
      array(
        'type' => 'dropdown',
        'param_name' => 'items',
        'heading' => __('Items to show', 'comet'),
        'value' => array(
          'Latest' => 'latest',
          'Select Manually' => 'manual'
        ),
      ),
      array(
        'type' => 'textfield',
        'param_name' => 'items_to_show',
        'heading' => __('Number of items to show', 'comet'),
        'value' => '8',
        'dependency' => array(
          'element' => 'items',
          'value' => 'latest'
        )
      ),
      array(
        'type' => 'dropdown_multi',
        'param_name' => 'items_ids',
        'heading' => __('Select Items', 'comet'),
        'description' => __('Ctrl+click or Cmd+click to select multiple items.', 'comet'),
        'value' => $portfolio_array,
        'dependency' => array(
          'element' => 'items',
          'value' => 'manual'
        )
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'columns',
        'heading' => __('How many columns?', 'comet'),
        'value' => array(
          'Two' => 'two-col',
          'Three' => 'three-col',
          'Four' => 'four-col',
        ),
        'std' => 'two-col'
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'show_title',
        'heading' => __('Show title?', 'comet'),
        'value' => array(
          'Yes' => '1',
          'No'  => '0'
        ),
        'std' => '0'
      ),
      array(
        'type' => 'textfield',
        'param_name' => 'title',
        'heading' => __('Section title', 'comet'),
        'value' => '',
        'dependency' => array(
          'element' => 'show_title',
          'value' => '1'
        )
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'full_width',
        'heading' => __('Full Width?', 'comet'),
        'value' => array(
          'Yes' => 'wide',
          'No'  => 'no'
        ),
        'std' => 'wide'
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'filters',
        'heading' => __('Show filters?', 'comet'),
        'value' => array(
          'Yes' => '1',
          'No'  => '0'
        ),
        'std' => '1'
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'animate_filters',
        'heading' => __('Animate filters to be always visible?', 'comet'),
        'value' => array(
          'Yes' => '1',
          'No'  => '0'
        ),
        'dependency' => array(
          'element' => 'show_title',
          'value' => '0'
        ),
        'std' => '0'
      )
    )
  )
);

/* Tabs */
vc_map(
  array(
    'name' => __( 'Tabs', 'comet' ),
    'base' => 'cm_tabs',
    'icon' => 'ti-layout-tab',
    'is_container' => true,
    'as_parent' => array(
      'only' => 'cm_single_tab',
    ),
    'description' => __('Tabbed contents.', 'comet'),
    'category' => __('Content', 'comet'),
    'description' => __( 'Tabbed content', 'comet' ),
    'params' => array(
      array(
        'type' => 'dropdown',
        'param_name' => 'style',
        'value' => array(
          __( 'Boxed', 'comet' ) => '',
          __( 'Minimal', 'comet' ) => 'outline',
        ),
        'heading' => __( 'Style', 'comet' ),
        'description' => __( 'Select tabs display style.', 'comet' ),
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'alignment',
        'value' => array(
          __( 'Left', 'comet' ) => 'left',
          __( 'Center', 'comet' ) => 'center',
          __( 'Right', 'comet' ) => 'right',
        ),
        'heading' => __( 'Alignment', 'comet' ),
        'description' => __( 'Select tabs section title alignment.', 'comet' ),
      ),
    ),
    'default_content' => '',
    'js_view' => 'VcColumnView'
  )
);

vc_map(
  array(
    'name' => __( 'Tab', 'comet' ),
    'base' => 'cm_single_tab',
    'allowed_container_element' => 'vc_row',
    'icon' => 'ti-layout-media-overlay',
    'is_container' => true,
    'as_child' => array(
      'only' => 'cm_tabs',
    ),
    'description' => __('Single tab container.', 'comet'),
    'category' => __( 'Content', 'comet' ),
    'params' => array(
      array(
        'type' => 'textfield',
        'param_name' => 'title',
        'heading' => __( 'Title', 'comet' ),
        'admin_label' => true,
        'description' => __( 'Enter tab title.', 'comet' ),
      ),
      array(
        'type' => 'checkbox',
        'param_name' => 'active',
        'heading' => __( 'Active?', 'comet' ),
        'value' => array(
          'Yes' => 'true'
        )
      ),
      array(
        'type' => 'el_id',
        'param_name' => 'tab_id',
        'settings' => array(
          'auto_generate' => true,
        ),
        'heading' => __( 'Section ID', 'comet' ),
        'description' => __( 'Enter Tab ID (Note: make sure it is unique and valid according to <a href="https://www.w3.org/TR/2011/WD-html5-20110525/elements.html#the-id-attribute" target="_blank">w3c specification</a>).', 'comet' ),
      ),
    ),
    'js_view' => 'VcColumnView'
  )
);

/* Accordion */
vc_map(
  array(
    'name' => __('Simple Accordion', 'comet'),
    'base' => 'cm_accordion',
    'icon' => 'ti-layout-accordion-merged',
    'description' => __('Collapsible text panels.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'dropdown',
        'heading' => __('Behavior', 'comet'),
        'param_name' => 'behavior',
        'value' => array(
          'Open One at Time' => '',
          'Multiple Open' => 'multiple'
        ),
        'std' => '',
      ),
      array(
        'type' => 'param_group',
        'param_name' => 'items',
        'heading' => __('Items', 'comet'),
        'params' => array(
          array(
            'type' => 'textfield',
            'param_name' => 'title',
            'heading' => __('Title', 'comet'),
            'value' => ''
          ),
          array(
            'type' => 'textarea',
            'param_name' => 'text',
            'heading' => __('Text', 'comet'),
            'value' => ''
          ),
        )
      ),
    )
  )
);

/* Progress Bars */
vc_map(
  array(
    'name' => __( 'Progress Bars', 'comet' ),
    'base' => 'cm_progress_bars',
    'icon' => 'ti-align-left',
    'description' => __('Animated Progress Bars.', 'comet'),
    'category' => __( 'Content', 'comet' ),
    'params' => array(
      array(
        'type' => 'dropdown',
        'param_name' => 'color',
        'heading' => __('Progress Bars Color', 'comet'),
        'value' => array(
          'Dark' => '',
          'Colored' => 'colored'
        )
      ),
      array(
        'type' => 'param_group',
        'value' => '',
        'param_name' => 'progress_bars',
        'heading' => __('Progress Bars', 'comet'),
        'params' => array(
          array(
            'type' => 'textfield',
            'value' => '',
            'heading' => __('Name', 'comet'),
            'param_name' => 'name',
          ),
          array(
            'type' => 'textfield',
            'value' => '',
            'heading' => __('Percentage', 'comet'),
            'param_name' => 'percentage',
          )
        )
      )
    )
  )
);

/* Team Member */
vc_map(
  array(
    'name' => __( 'Team Member', 'comet' ),
    'base' => 'cm_team_member',
    'icon' => 'ti-user',
    'description' => __('Add a team member.', 'comet'),
    'category' => __( 'Content', 'comet' ),
    'params' => array(
      array(
        'type' => 'attach_image',
        'value' => '',
        'heading' => __('Image', 'comet'),
        'param_name' => 'image',
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Name', 'comet'),
        'param_name' => 'name',
        'admin_label' => true
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Role', 'comet'),
        'param_name' => 'role',
      ),
      array(
        'type' => 'textarea',
        'value' => '',
        'heading' => __('Description', 'comet'),
        'param_name' => 'description',
      ),
      array(
        'type' => 'param_group',
        'heading' => __('Social Links', 'comet'),
        'param_name' => 'socials',
        'params' => array(
          array(
            'type' => 'dropdown',
            'heading' => __('Social', 'comet'),
            'param_name' => 'social',
            'admin_label' => true,
            'value' => array(
              '' => '',
              'Facebook' => 'facebook',
              'Twitter' => 'twitter',
              'Linkedin' => 'linkedin',
              'Instagram' => 'instagram',
              'Dribbble' => 'dribbble',
              'Github' => 'github',
              'Flickr' => 'flickr',
              'Pinterest' => 'pinterest',
              'YouTube' => 'youtube',
              'Tumblr' => 'tumblr'
            )
          ),
          array(
            'type' => 'textfield',
            'value' => '',
            'heading' => __('URL', 'comet'),
            'param_name' => 'url',
          ),
        )
      )
    )
  )
);

/* Carousel */
vc_map(
  array(
    'name' => __('Carousel', 'comet'),
    'base' => 'cm_carousel',
    'icon' => 'ti-layout-slider-alt',
    'description' => __('Animated carousel.', 'comet'),
    'category' => __( 'Content', 'comet' ),
    'is_container' => true,
    'params' => array(
      array(
        'type' => 'textfield',
        'value' => '4',
        'heading' => __('Items', 'comet'),
        'description' => __('Set the maximum amount of items displayed at a time.', 'comet'),
        'param_name' => 'items',
      ),
      array(
        'type' => 'textfield',
        'value' => '10',
        'heading' => __('Margin', 'comet'),
        'description' => __('Set the margin between items.', 'comet'),
        'param_name' => 'margin',
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Loop', 'comet'),
        'param_name' => 'loop',
        'value' => array(
          'On' => '1',
          'Off'  => '',
        )
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Autoplay', 'comet'),
        'param_name' => 'autoplay',
        'value' => array(
          'On' => '1',
          'Off'  => '',
        )
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Controls', 'comet'),
        'param_name' => 'controls',
        'value' => array(
          'Off'  => '',
          'On' => '1',
        ),
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Items (medium devices)', 'comet'),
        'description' => __('Set the maximum amount of items displayed at a time on medium devices.', 'comet'),
        'param_name' => 'md_items',
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Items (small devices)', 'comet'),
        'description' => __('Set the maximum amount of items displayed at a time on small devices.', 'comet'),
        'param_name' => 'sm_items',
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Items (extra small devices)', 'comet'),
        'description' => __('Set the maximum amount of items displayed at a time on extra small devices.', 'comet'),
        'param_name' => 'xs_items',
      ),
      array(
        'type' => 'css_editor',
        'heading' => __( 'CSS box', 'js_composer' ),
        'param_name' => 'css',
        'group' => __( 'Design Options', 'js_composer' ),
      ),
    ),
    'js_view' => 'VcColumnView'
  )
);

/* Pricing Tables */
vc_map(
  array(
    'name' => __('Pricing Table', 'comet'),
    'base' => 'cm_pricing_table',
    'icon' => 'ti-money',
    'description' => __('Pricing Table.', 'comet'),
    'category' => __( 'Content', 'comet' ),
    'params' => array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Icon library', 'comet' ),
        'value' => array(
          __( 'ET Line Icons', 'comet' ) => 'etline',
          __( 'Themify', 'comet' ) => 'themify'
        ),
        'param_name' => 'icon_type',
        'description' => __( 'Select icon library.', 'comet' ),
      ),
      array(
        'type' => 'iconpicker',
        'heading' => __('Icon', 'comet'),
        'param_name' => 'icon_etline',
        'settings' => array(
          'type' => 'etline',
          'emptyIcon' => false,
          'iconsPerPage' => 100
        ),
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'etline'
        )
      ),
      array(
        'type' => 'iconpicker',
        'heading' => __('Icon', 'comet'),
        'param_name' => 'icon_themify',
        'settings' => array(
          'type' => 'themify',
          'emptyIcon' => false,
          'iconsPerPage' => 100
        ),
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'themify'
        )
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Title', 'comet'),
        'param_name' => 'title',
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Price', 'comet'),
        'param_name' => 'price',
      ),
      array(
        'type' => 'textfield',
        'value' => '$',
        'heading' => __('Currency', 'comet'),
        'param_name' => 'currency',
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Interval', 'comet'),
        'param_name' => 'interval',
        'value' => array(
          'No Interval' => '',
          'Month' => 'm',
          'Year' => 'y'
        ),
        'std' => 'm'
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Style', 'comet'),
        'param_name' => 'style',
        'value' => array(
          'Default' => '',
          'Hightlight' => 'featured'
        ),
        'std' => ''
      ),
      array(
        'type' => 'param_group',
        'heading' => __('Features', 'comet'),
        'param_name' => 'features',
        'params' => array(
          array(
            'type' => 'textfield',
            'heading' => __('Text', 'comet'),
            'param_name' => 'text',
            'value' => ''
          )
        )
      ),
      array(
        'type' => 'vc_link',
        'value' => '',
        'heading' => __('Button', 'comet'),
        'param_name' => 'button',
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Button Color', 'comet'),
        'param_name' => 'button_color',
        'value' => array(
          'Colored' => 'color',
          'Colored (borders only)' => 'color-out',
          'Dark' => 'dark',
          'Dark (borders only)' => 'dark-out',
          'Light' => 'light',
          'Light (borders only)' => 'light-out',
        )
      ),
    )
  )
);

/* Photo Gallery */
vc_map(
  array(
    'name' => __('Photo Gallery', 'comet'),
    'base' => 'cm_photo_gallery',
    'icon' => 'ti-gallery',
    'description' => __('Modal photo gallery.', 'comet'),
    'category' => __( 'Content', 'comet' ),
    'params' => array(
      array(
        'type' => 'param_group',
        'param_name' => 'photos',
        'heading' => __('Photos', 'comet'),
        'value' => '',
        'params' => array(
          array(
            'type' => 'attach_image',
            'param_name' => 'pic',
            'heading' => __('Select Image', 'comet'),
            'value' => ''
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'size',
            'heading' => __('Image Size', 'comet'),
            'value' => array(
              'Default' => '',
              'Half Width' => 'half'
            )
          ),
          array(
            'type' => 'textfield',
            'heading' => __('Caption', 'comet'),
            'param_name' => 'caption',
            'value' => ''
          )
        )
      )
    )
  )
);

/* Restaurant Menu */
vc_map(
  array(
    'name' => __('Restaurant Menu', 'comet'),
    'base' => 'cm_restaurant_menu',
    'icon' => 'ti-menu',
    'description' => __('Menu for restaurants.', 'comet'),
    'category' => __( 'Content', 'comet' ),
    'params' => array(
      array(
        'type' => 'param_group',
        'heading' => __('Menu Items', 'comet'),
        'param_name' => 'menu_items',
        'params' => array(
          array(
            'type' => 'textfield',
            'param_name' => 'title',
            'value' => '',
            'admin_label' => true,
            'heading' => __('Title', 'comet'),
          ),
          array(
            'type' => 'textarea',
            'param_name' => 'text',
            'value' => '',
            'heading' => __('Text', 'comet'),
          ),
          array(
            'type' => 'attach_image',
            'param_name' => 'image',
            'value' => '',
            'heading' => __('Image', 'comet'),
          ),
          array(
            'type' => 'dropdown',
            'param_name' => 'image_position',
            'heading' => __('Image Position', 'comet'),
            'value' => array(
              'Left' => '',
              'Right' => 'image-right',
            ),
          ),
          array(
            'type' => 'textfield',
            'param_name' => 'infoline',
            'value' => '',
            'heading' => __('Infoline', 'comet'),
            'description' => __('I.E: From $7.99', 'comet')
          )
        )
      )
    )
  )
);

/* Counter */
vc_map(
  array(
    'name' => __('Counter', 'comet'),
    'base' => 'cm_counter',
    'icon' => 'ti-signal',
    'description' => __('Animated Counter.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Number', 'comet'),
        'param_name' => 'number'
      ),
      array(
        'type' => 'textfield',
        'value' => '',
        'heading' => __('Text', 'comet'),
        'param_name' => 'text'
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Icon library', 'comet' ),
        'value' => array(
          __( 'ET Line Icons', 'comet' ) => 'etline',
          __( 'Themify', 'comet' ) => 'themify'
        ),
        'param_name' => 'icon_type',
        'description' => __( 'Select icon library.', 'comet' ),
      ),
      array(
        'type' => 'iconpicker',
        'heading' => __('Icon', 'comet'),
        'param_name' => 'icon_etline',
        'settings' => array(
          'type' => 'etline',
          'emptyIcon' => false,
          'iconsPerPage' => 100
        ),
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'etline'
        )
      ),
      array(
        'type' => 'iconpicker',
        'heading' => __('Icon', 'comet'),
        'param_name' => 'icon_themify',
        'settings' => array(
          'type' => 'themify',
          'emptyIcon' => false,
          'iconsPerPage' => 100
        ),
        'dependency' => array(
          'element' => 'icon_type',
          'value' => 'themify'
        )
      ),
      array(
        'type' => 'dropdown',
        'heading' => __('Icon Position', 'comet'),
        'param_name' => 'icon_position',
        'value' => array(
          'Left' => '',
          'Top' => 'block'
        ),
        'std' => '',
        'group' => __('Style', 'comet')
      ),
      array(
        'type' => 'dropdown',
        'value' => array(
          'Default'    => '',
          'Serif'  => 'serif',
          'Cursive'   => 'cursive'
        ),
        'heading' => __('Font Style', 'comet'),
        'param_name' => 'font_style',
        'std' => '',
        'group' => __('Style', 'comet')
      ),
    )
  )
);

/* Social Icons */
vc_map(
  array(
    'name' => __('Social Icons', 'comet'),
    'base' => 'cm_social_icons',
    'icon' => 'ti-facebook',
    'description' => __('Social media icons.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'dropdown',
        'heading' => __('Style', 'comet'),
        'param_name' => 'style',
        'value' => array(
          'Default' => '',
          'Minimal' => 'style-2'
        ),
        'std' => '',
      ),
      array(
        'type' => 'param_group',
        'heading' => __('Social Links', 'comet'),
        'param_name' => 'socials',
        'params' => array(
          array(
            'type' => 'dropdown',
            'heading' => __('Social', 'comet'),
            'param_name' => 'social',
            'admin_label' => true,
            'value' => array(
              '' => '',
              'Facebook' => 'facebook',
              'Twitter' => 'twitter',
              'Linkedin' => 'linkedin',
              'Instagram' => 'instagram',
              'Dribbble' => 'dribbble',
              'Github' => 'github',
              'Flickr' => 'flickr',
              'Pinterest' => 'pinterest',
              'YouTube' => 'youtube',
              'Tumblr' => 'tumblr'
            )
          ),
          array(
            'type' => 'textfield',
            'value' => '',
            'heading' => __('URL', 'comet'),
            'param_name' => 'url',
          ),
        )
      )
    )
  )
);

/* Timeline */
vc_map(
  array(
    'name' => __('Timeline', 'comet'),
    'base' => 'cm_timeline',
    'icon' => 'ti-layout-list-thumb-alt',
    'description' => __('Timeline with your resume details.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'param_group',
        'param_name' => 'items',
        'heading' => __('Items', 'comet'),
        'params' => array(
          array(
            'type' => 'textfield',
            'param_name' => 'title',
            'heading' => __('Title', 'comet'),
            'value' => ''
          ),
          array(
            'type' => 'textarea',
            'param_name' => 'text',
            'heading' => __('Text', 'comet'),
            'value' => ''
          ),
          array(
            'type' => 'textfield',
            'param_name' => 'place',
            'heading' => __('Job Place/University', 'comet'),
            'value' => ''
          ),
          array(
            'type' => 'textfield',
            'param_name' => 'date',
            'heading' => __('Date', 'comet'),
            'description' => __('I.E: February 2010 - April 2012', 'comet'),
            'value' => ''
          )
        )
      )
    )
  )
);

/* Map */
vc_map(
  array(
    'name' => __('Google Maps', 'comet'),
    'base' => 'cm_map',
    'icon' => 'ti-location-pin',
    'description' => __('Map block.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'textfield',
        'value' => '40.773328',
        'heading' => __('Map Latitude', 'comet'),
        'param_name' => 'lat',
        "group" => __( "Comet Options", 'comet' ),
        'description' => __('Find your Latitude and Longitude <a target="blank" href="http://www.latlong.net/">here</a>', 'comet'),
      ),
      array(
        'type' => 'textfield',
        'value' => '-73.960088',
        'heading' => __('Map Longitude', 'comet'),
        'param_name' => 'lng',
        "group" => __( "Comet Options", 'comet' ),
        'description' => __('Find your Latitude and Longitude <a target="blank" href="http://www.latlong.net/">here</a>', 'comet'),
      ),
    )
  )
);

/* Job Offer */
vc_map(
  array(
    'name' => __('Job Offer', 'comet'),
    'base' => 'cm_job_offer',
    'icon' => 'ti-announcement',
    'description' => __('Simple job offer.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'textfield',
        'param_name' => 'title',
        'heading' => __('Job Title', 'comet'),
        'value' => ''
      ),
      array(
        'type' => 'textfield',
        'param_name' => 'category',
        'heading' => __('Category', 'comet'),
        'value' => ''
      ),
      array(
        'type' => 'textfield',
        'param_name' => 'location',
        'heading' => __('Location', 'comet'),
        'value' => ''
      ),
      array(
        'type' => 'textarea',
        'param_name' => 'text',
        'heading' => __('Description', 'comet'),
        'value' => ''
      ),
      array(
        'type' => 'vc_link',
        'param_name' => 'link',
        'heading' => __('Link', 'comet'),
        'value' => ''
      ),
    )
  )
);

/* Countdown */
vc_map(
  array(
    'name' => __('Countdown', 'comet'),
    'base' => 'cm_countdown',
    'icon' => 'ti-timer',
    'description' => __('Animated countdown.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'dropdown',
        'heading' => __('Alignment', 'comet'),
        'param_name' => 'alignment',
        'value' => array(
          'Left' => '',
          'Center' => 'text-center'
        ),
        'std' => '',
      ),
      array(
        'type' => 'datepicker',
        'param_name' => 'date',
        'heading' => __('Date', 'comet'),
        'value' => ''
      ),
    )
  )
);

/* Newsletter form */
vc_map(
  array(
    'name' => __('Newsletter Form', 'comet'),
    'base' => 'cm_newsletter_form',
    'icon' => 'ti-email',
    'description' => __('Mailchimp newsletter form.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'textfield',
        'param_name' => 'url',
        'heading' => __('URL', 'comet'),
        'value' => '',
        'description' => __('Add your Mailchimp URL. It should look like this: <b>http://hody.us12.list-manage.com/subscribe/post?u=d9d989sc1b2ba80926372a9fb&id=c789sg65b0</b>', 'comet')
      ),
    )
  )
);

/* Alerts */
vc_map(
  array(
    'name' => __('Alert', 'comet'),
    'base' => 'cm_alert',
    'icon' => 'ti-info-alt',
    'description' => __('Notification element.', 'comet'),
    'category' => __('Content', 'comet'),
    'params' => array(
      array(
        'type' => 'dropdown',
        'param_name' => 'color',
        'heading' => __('Color', 'comet'),
        'value' => array(
          'Green' => 'alert-success',
          'Blue' => 'alert-info',
          'Yellow' => 'alert-warning',
          'Red' => 'alert-danger',
        )
      ),
      array(
        'type' => 'dropdown',
        'param_name' => 'style',
        'heading' => __('Style', 'comet'),
        'value' => array(
          'Outlined' => 'alert-outline',
          'Colored' => 'alert-colored',
        )
      ),
      array(
        'type' => 'textarea',
        'param_name' => 'text',
        'heading' => __('Text', 'comet'),
        'value' => ''
      ),
    )
  )
);

if (class_exists('WPBakeryShortCodesContainer')) {
  class WPBakeryShortCode_CM_Services extends WPBakeryShortCodesContainer {}
  class WPBakeryShortCode_CM_Single_Service extends WPBakeryShortCode {}
  class WPBakeryShortCode_CM_Home_Slider extends WPBakeryShortCodesContainer {}
  class WPBakeryShortCode_CM_Tabs extends WPBakeryShortCodesContainer {}
  class WPBakeryShortCode_CM_Single_Tab extends WPBakeryShortCodesContainer {}
  class WPBakeryShortCode_CM_Carousel extends WPBakeryShortCodesContainer {}
}

if (class_exists('WPBakeryShortCode')) {
  class WPBakeryShortCode_CM_Home_Slide extends WPBakeryShortCode {}
}
