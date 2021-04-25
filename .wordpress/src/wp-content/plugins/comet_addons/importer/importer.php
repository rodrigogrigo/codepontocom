<?php   

add_action('wp_ajax_comet_import_data', 'comet_import_data');

if (!function_exists('comet_import_data')) {

  @ini_set('max_execution_time', 600);
  
  function comet_import_data($file){

    update_option('comet_demo_data_imported', '');
    
    if ( ! class_exists('WP_Import') ) {
      require_once('wordpress-importer/wordpress-importer.php');
    }

    // Import Content
    $comet_import = new WP_Import();
    $demo_file = get_template_directory() . '/framework/admin/demo-data.xml';

    if (file_exists($demo_file)) {
      $comet_import->fetch_attachments = false; ob_start();
      $comet_import->import($demo_file); ob_end_clean();    
    }

    // Update Reading Settings
    $onepage  = get_page_by_title('Classic');
    $blogpage = get_page_by_title('Blog');
    if( isset($onepage->ID) && isset($blogpage->ID) ) {
      update_option('show_on_front', 'page');
      update_option('page_on_front',  $onepage->ID); 
      update_option('page_for_posts', $blogpage->ID); 
    }

    // Update Postmeta
    global $wpdb;
    $from_url = 'http://themes.hody.co/comet';
    $to_url = home_url();
    $wpdb->query($wpdb->prepare("UPDATE {$wpdb->postmeta} SET meta_value = REPLACE(meta_value, %s, %s)", $from_url, $to_url));
    $wpdb->query($wpdb->prepare("UPDATE {$wpdb->posts} SET post_content = REPLACE(post_content, %s, %s)", 'http%3A%2F%2Fthemes.hody.co%2Fcomet%2Fblog%2F', '%23'));

    $menus = wp_get_nav_menu_items('Primary Nav');
    if (is_array($menus)) {
      foreach ($menus as $menu_item) {
        if ($menu_item->url == '#' && in_array($menu_item->post_name, array('home', 'pages', 'elements'))) {
          update_post_meta( $menu_item->ID, '_comet_mega_menu', 1 );
          $mens[] = $menu_item->ID;
        } elseif ($menu_item->url == '#' && in_array($menu_item->post_name, array('multi-page', 'one-page', 'home-layouts', 'pages-2', 'other-pages', 'elements-2', 'elements-3'))) {
          update_post_meta( $menu_item->ID, '_comet_menu_label', 1 );
          $mens[] = $menu_item->ID;
        }
      }
    }


    // Update navigation menus
    $default_menu = get_term_by('name', 'Primary Nav', 'nav_menu');
    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary'] = $default_menu->term_id;
    set_theme_mod('nav_menu_locations', $locations);

    $onepage_menus = array('One Page', 'Restaurant', 'Architecture', 'Landing', 'Resume', 'Models', 'Resume');

    foreach ($onepage_menus as $pag) {
      $page_name = get_page_by_title($pag);
      $menu_id = get_term_by('name', $pag, 'nav_menu');
      update_post_meta($page_name->ID, 'comet_menu_id', $menu_id->term_id);
    }

    update_option('comet_demo_data_imported', '1');
    die();
    
  }
}

add_action('wp_ajax_comet_import_attachments', 'comet_import_attachments');

if (!function_exists('comet_import_attachments')) {
  
  function comet_import_attachments($file){

    update_option('comet_demo_attachments_imported', '');

    if ( ! class_exists('WP_Import') ) {
      require_once('wordpress-importer/wordpress-importer.php');
    }

    // Import Content
    $comet_import_attachments = new WP_Import();
    $demo_attachments = get_template_directory() . '/framework/admin/demo-attachments.xml';

    if (file_exists($demo_attachments)) {
      $comet_import_attachments->fetch_attachments = true; ob_start();
      $comet_import_attachments->import($demo_attachments); ob_end_clean();    
    }

    update_option('comet_demo_attachments_imported', '1');
    die();

  }
}

add_action('wp_ajax_comet_check_import', 'comet_check_import');

if (!function_exists('comet_check_import')) {

  function comet_check_import(){
    $imported_posts = (get_option('comet_demo_data_imported') == '1') ? 1 : 0;
    $imported_images = (get_option('comet_demo_attachments_imported') == '1') ? 1 : 0;

    $arr = array(
      'posts' => $imported_posts,
      'images' => $imported_images
    );

    echo json_encode($arr, JSON_PRETTY_PRINT);
    die();
  }

}

?>
