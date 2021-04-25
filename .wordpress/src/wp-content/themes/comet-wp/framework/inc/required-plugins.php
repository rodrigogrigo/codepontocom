<?php

/**
* Include the TGM_Plugin_Activation class.
*/

require_once COMET_FW_DIR . '/lib/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'comet_register_required_plugins');

function comet_register_required_plugins() {
  $plugins = array(
    array(
      'name'               => 'Comet Addons',
      'slug'               => 'comet_addons',
      'source'             => 'https://dl.dropbox.com/s/mjupwo3oroekhg6/comet_addons.zip',
      'required'           => true,
      'version'            => '1.1.5',
      'force_deactivation' => true,
      'external_url'       => 'https://dl.dropbox.com/s/mjupwo3oroekhg6/comet_addons.zip',
    ),
    array(
      'name'               => 'WPBakery Page Builder',
      'slug'               => 'js_composer',
      'source'             => 'https://dl.dropbox.com/s/t5w0egsw5pofkc2/js_composer.zip',
      'required'           => true,
      'version'            => '5.7',
      'external_url'       => 'https://dl.dropbox.com/s/t5w0egsw5pofkc2/js_composer.zip',
    ),
    array(
      'name'      => 'WooCommerce',
      'slug'      => 'woocommerce',
      'required'  => false
    ),
    array(
      'name'      => 'Contact Form 7',
      'slug'      => 'contact-form-7',
      'required'  => false
    )
  );

  $config = array(
    'default_path' => '',
    'menu'         => 'tgmpa-install-plugins',
    'has_notices'  => true,
    'dismissable'  => true,
    'dismiss_msg'  => '',
    'is_automatic' => false,
    'message'      => '',
  );

  tgmpa( $plugins, $config );

}

?>
