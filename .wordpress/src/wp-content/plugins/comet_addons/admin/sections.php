<?php

$theme_uri = get_template_directory_uri();

/* General */
$this->sections[] = array(
  'icon'      => 'ti-settings',
  'title'     => __( 'General', 'comet_addons' ),
  'fields'    => array(
    array(
      'id'  => 'logo_light',
      'title' => __( 'Light Logo', 'comet_addons' ),
      'subtitle'  => __( 'Upload your .png or .jpg logo', 'comet_addons' ),
      'type'  => 'media',
      'default' => array(
        'url' => $theme_uri . '/assets/images/logo_light.png'
      )
    ),
    array(
      'id'  => 'logo_dark',
      'title' => __( 'Logo', 'comet_addons' ),
      'subtitle'  => __( 'Upload your .png or .jpg logo', 'comet_addons' ),
      'type'  => 'media',
      'default' => array(
        'url' => $theme_uri . '/assets/images/logo_dark.png'
      )
    ),
    array(
      'id'       => 'smooth_scroll',
      'type'     => 'switch',
      'title'    => __('Smooth Scroll', 'comet_addons'),
      'subtitle' => __('Enable Smooth Scrolling, it\'s on!', 'comet_addons'),
      'default'  => true,
    ),
    array(
      'id'       => 'hide_preloader',
      'type'     => 'switch',
      'title'    => __('Preloader', 'comet_addons'),
      'subtitle' => __('Look, it\'s on!', 'comet_addons'),
      'default'  => true,
    ),
    array(
      'id'       => 'hide_search_form',
      'type'     => 'switch',
      'title'    => __('Header Search Form', 'comet_addons'),
      'subtitle' => __('Warning: if set to off, individual page settings will be overridden.', 'comet_addons'),
      'default'  => true,
    ),
    array(
      'id'       => 'hide_cart',
      'type'     => 'switch',
      'title'    => __('Header Shopping Cart', 'comet_addons'),
      'subtitle' => __('Warning: if set to off, individual page settings will be overridden.', 'comet_addons'),
      'default'  => true,
    ),
    array(
      'id'      =>'google_maps_api_key',
      'type'    => 'text',
      'title'   => __('Google Maps Api Key', 'comet_addons'),
      'default' => '',
    ),
  )
);

/* Styling */
$this->sections[] = array(
  'icon'      => 'ti-pencil',
  'title'     => __( 'Styling', 'comet_addons' ),
  'fields'    => array(
    array(
      'id'    => 'primary_color',
      'type'  => 'color',
      'title' => __('Primary Color', 'comet_addons'),
      'subtitle'  => __('Pick the primary color for the theme', 'comet_addons'),
      'transparent' => false,
      'default' => '#EF2D56'
    ),
    array(
      'id'    => 'dark_color',
      'type'  => 'color',
      'title' => __('Dark Color', 'comet_addons'),
      'subtitle'  => __('Pick the dark color for the theme', 'comet_addons'),
      'description' => __("It's used for dark sections, buttons, and navbars.", 'comet_addons'),
      'transparent' => false,
      'default' => '#191b1d'
    ),
    array(
      'id'    => 'text_color',
      'type'  => 'color',
      'title' => __('Text Color', 'comet_addons'),
      'subtitle'  => __('Pick the text color for the theme', 'comet_addons'),
      'transparent' => false,
      'default' => '#191b1d'
    ),
    array(
      'id' => 'menu_color',
      'title' => __('Navbar Color', 'comet_addons'),
      'type' => 'select',
      'options' => array(
        'light' => 'Light',
        'dark'  => 'Dark',
      ),
      'default' => 'light'
    ),
    array(
      'id'          => 'primary_font',
      'type'        => 'typography',
      'title'       => __('Primary Font', 'comet_addons'),
      'subtitle'    => __('Select the primary font for the theme', 'comet_addons'),
      'description' => __('Leave blank to use default theme fonts.', 'comet_addons'),
      'google'      => true,
      'fonts'       => array('Helvetica' => 'Helvetica Neue, Helvetica'),
      'font-backup' => false,
      'color'       => false,
      'text-align'  => false,
      'subsets'     => false,
      'line-height' => false,
      'font-size'   => false,
      'output'      => '',
      'units'       =>'px',
    ),
    array(
      'id'          => 'heading_font',
      'type'        => 'typography',
      'title'       => __('Heading Font', 'comet_addons'),
      'subtitle'    => __('Select the font for the heading tags (H1, H2, H1, H4, H5, H6)', 'comet_addons'),
      'description' => __('Leave blank to use default theme fonts.', 'comet_addons'),
      'google'      => true,
      'fonts'       => array('Helvetica' => 'Helvetica Neue, Helvetica'),
      'font-backup' => false,
      'color'       => false,
      'text-align'  => false,
      'subsets'     => false,
      'font-weight' => false,
      'line-height' => false,
      'font-size'   => false,
      'output'      => '',
      'units'       =>'px',
    ),
    array(
      'id'          => 'serif_font',
      'type'        => 'typography',
      'title'       => __('Serif Font', 'comet_addons'),
      'subtitle'    => __('Select the serif font family.', 'comet_addons'),
      'description' => __('Leave blank to use default theme fonts.', 'comet_addons'),
      'google'      => true,
      'fonts'       => array('Helvetica' => 'Helvetica Neue, Helvetica'),
      'font-backup' => false,
      'color'       => false,
      'text-align'  => false,
      'subsets'     => false,
      'line-height' => false,
      'font-size'   => false,
      'output'      => '',
      'units'       =>'px',
    ),
    array(
      'id'          => 'cursive_font',
      'type'        => 'typography',
      'title'       => __('Cursive Font', 'comet_addons'),
      'subtitle'    => __('Select the cursive font family.', 'comet_addons'),
      'description' => __('Leave blank to use default theme fonts.', 'comet_addons'),
      'google'      => true,
      'fonts'       => array('Helvetica' => 'Helvetica Neue, Helvetica'),
      'font-backup' => false,
      'color'       => false,
      'text-align'  => false,
      'subsets'     => false,
      'line-height' => false,
      'font-size'   => false,
      'output'      => '',
      'units'       =>'px',
    ),
    array(
      'id'       => 'custom_css',
      'type'     => 'ace_editor',
      'title'    => __('Custom CSS', 'comet_addons'),
      'subtitle' => __('Paste your CSS code here.', 'comet_addons'),
      'mode'     => 'css',
      'theme'    => 'monokai',
      'default'  => "/* Your code here */ "
    ),
  )
);


/* Social Networks */
$this->sections[] = array(
  'icon'      => 'ti-twitter',
  'title'     => __( 'Social Links', 'comet_addons' ),
  'desc'      => '',
  'fields'    => array(
    array(
      'id'      =>'facebook',
      'type'    => 'text',
      'title'   => __('Facebook', 'comet_addons'),
      'default' => '',
    ),
    array(
      'id'      =>'twitter',
      'type'    => 'text',
      'title'   => __('Twitter', 'comet_addons'),
      'default' => '',
    ),
    array(
      'id'      =>'google_plus',
      'type'    => 'text',
      'title'   => __('Google Plus', 'comet_addons'),
      'default' => '',
    ),
    array(
      'id'      =>'instagram',
      'type'    => 'text',
      'title'   => __('Instagram', 'comet_addons'),
      'default' => '',
    ),
    array(
      'id'      =>'linkedin',
      'type'    => 'text',
      'title'   => __('Linkedin', 'comet_addons'),
      'default' => '',
    ),
    array(
      'id'      =>'youtube',
      'type'    => 'text',
      'title'   => __('Youtube', 'comet_addons'),
      'default' => '',
    ),
    array(
      'id'      =>'pinterest',
      'type'    => 'text',
      'title'   => __('Pinterest', 'comet_addons'),
      'default' => '',
    ),
    array(
      'id'      =>'dribbble',
      'type'    => 'text',
      'title'   => __('Dribbble', 'comet_addons'),
      'default' => '',
    ),
    array(
      'id'      =>'tumblr',
      'type'    => 'text',
      'title'   => __('Tumblr', 'comet_addons'),
      'default' => '',
    ),
    array(
      'id'      =>'flickr',
      'type'    => 'text',
      'title'   => __('Flickr', 'comet_addons'),
      'default' => '',
    ),
    array(
      'id'      =>'github',
      'type'    => 'text',
      'title'   => __('Github', 'comet_addons'),
      'default' => '',
    ),
    array(
      'id'      =>'email',
      'type'    => 'text',
      'title'   => __('Email Address', 'comet_addons'),
      'default' => '',
    ),
  )
);

/* Shop */
$this->sections[] = array(
  'icon'      => 'ti-shopping-cart',
  'title'     => __( 'Shop', 'comet_addons' ),
  'fields'    => array(
    array(
      'id'    => 'shop_sidebar',
      'title' => __('Show Sidebar on Shop Page', 'comet_addons'),
      'type'  => 'switch',
      'default' => true,
    ),
    array(
      'id' => 'shop_columns',
      'title' => __('Number of Columns', 'comet_addons'),
      'type' => 'select',
      'options' => array(
        '2' => '2',
        '3' => '3',
        '4' => '4',
      ),
      'default' => '3'
    )
  )
);

/* 404 */
$this->sections[] = array(
  'icon'      => 'ti-alert',
  'title'     => __( '404 Page', 'comet_addons' ),
  'fields'    => array(
    array(
      'id'  => 'error_bg_image',
      'title' => __( 'Background Image', 'comet_addons' ),
      'type'  => 'media'
    ),
    array(
      'id'    => 'error_title',
      'title' => __('Error Page Title', 'comet_addons'),
      'type'  => 'text',
      'default' => __('Error 404', 'comet_addons')
    ),
    array(
      'id'    => 'error_text',
      'title' => __('Error Page Text', 'comet_addons'),
      'type'  => 'textarea',
      'default' => __('The requested page was not found on this server. That’s all we know.', 'comet_addons')
    ),
  )
);

/* Footer */
$this->sections[] = array(
  'icon'      => 'ti-layout-media-overlay-alt',
  'title'     => __( 'Footer', 'comet_addons' ),
  'fields'    => array(
    array(
      'id'  => 'footer_text',
      'title' => __( 'Copyright Text', 'comet_addons' ),
      'type'  => 'text',
      'default' => '&copy; 2015 '. get_bloginfo('name').'. All rights reserved.'
    )
  )
);

$alert = array(
  'id'    => 'info_import_again',
  'type'  => 'line',
  'style' => '',
  'desc'  => ''
);

if (get_option('comet_demo_data_imported')) {
  $alert = array(
    'id'    => 'info_import_again',
    'type'  => 'info',
    'style' => 'critical',
    'desc'  => __("<b>Warning</b>: You have already imported the demo content. Import another one will create duplicate content. If you want to reimport demo content, delete existing content before proceed.", 'comet_addons')
  );
}

/* Importer */
$this->sections[] = array(
  'icon'      => 'ti-settings',
  'title'     => __( 'Import Demo Data', 'comet_addons' ),
  'desc'      => '',
  'fields'    => array(
    $alert,
    array(
      'id'    => 'info_import',
      'type'  => 'info',
      'style' => 'warning',
      'desc'  => __("<img style='height: 18px; margin-bottom: -5px; margin-right: 5px;' src='".get_template_directory_uri() . '/assets/images/loading.gif'."'> <span>Importing demo content... It may take a few minutes. Don't close the page!</span>", 'comet_addons')
    ),
    array( 
      'id'       => 'comet_import',
      'type'     => 'raw',
      'title'    => __('Import Demo', 'comet_addons'),
      'desc'     => __('Click the button to make your website look exactly like the demo..', 'comet_addons'),
      'content'  => '<button type="button" id="comet-import-btn" class="button button-primary">Import</button>'
    ),
  )
);

/* Theme Support */
$this->sections[] = array(
  'icon'      => 'ti-support',
  'title'     => __( 'Theme Support', 'comet_addons' ),
  'desc'      => '',
  'fields'    => array(
    array( 
      'id'       => 'comet_support',
      'type'     => 'raw',
      'desc'     => __('Here you can read the theme documentation and watch video tutorials. If you do not find an answer to your problem, submit a ticket.', 'comet_addons'),
      'content'  => '<a target="_blank" href="http://bit.ly/CometDocumentation" class="button button-primary">Get Theme Support</a>',
      'full_width' => true
    ),
  )
);

?>
