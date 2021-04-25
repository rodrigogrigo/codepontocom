<?php

class Comet_Walker_Nav_Menu extends Walker_Nav_Menu {
  public $is_mega_menu = false;
  public $current_item;

  public $last_lvl;

  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

    if ($item->is_label) {
      $item->classes[] = 'menu-label';
    }

    parent::start_el($item_output, $item, $depth, $args, $id);

    if ($depth == 0) {
      $this->is_mega_menu = false;
      $this->current_item = null;
    }

    if ($item->mega_menu) {
      $this->is_mega_menu = true;
      $this->current_item = $item;
    }

    if ($this->is_mega_menu && $depth > 0) {
      $this->last_lvl .= $item_output;
      return;
    }

    $output .= $item_output;
  }

  function end_el(&$output, $item, $depth = 0, $args = array()){
    $item_output = '';
    $template = '';

    if ($this->is_mega_menu) {
      if ($depth == 0) {
        $sub_menu = $this->last_lvl;
        if ($item->mega_menu == '1' && $sub_menu) {
          $output .= '<ul class="submenu megamenu">'.preg_replace('/has-submenu/', '//', $sub_menu).'</ul>';
        }

        $this->last_lvl = '';
        return;
      }

      $this->last_lvl .= $item_output;
      return;
    }

    $output .= $item_output;
  }

  public function start_lvl(&$output, $depth = 0, $args = array()){
    $item_output = '';

    if ($this->is_mega_menu) {
      parent::start_lvl($item_output, $depth, $args);
      if ($depth >= 1) {
        $this->last_lvl .= $item_output;
      }
      return;
    } else{
      $indent = str_repeat("\t", $depth);
      $item_output .= "\n$indent<ul class=\"submenu\">\n";
    }

    $output .= $item_output;
  }

  public function end_lvl(&$output, $depth = 0, $args = array()){
    $item_output = '';
    parent::end_lvl($item_output, $depth, $args);

    if ($this->is_mega_menu){
      if ($depth >= 1) {
        $this->last_lvl .= $item_output;
      }
      return;
    }

    $output .= $item_output;
  }
}

/* Add mega menu option */
add_filter('wp_edit_nav_menu_walker', 'comet_edit_menu_walker', 10, 2);

function comet_edit_menu_walker( $walker, $menu_id ) {
  include COMET_FW_DIR . '/inc/menu-walker-edit.php';
  return 'Comet_Walker_Nav_Menu_Edit';
}

/* Add menu custom fields */
add_filter('wp_setup_nav_menu_item', 'comet_add_custom_nav_fields');

function comet_add_custom_nav_fields( $menu_item ) {
  if (get_post_meta($menu_item->ID, '_menu_item_menu_item_parent', true ) == 0) {
    $menu_item->mega_menu = get_post_meta( $menu_item->ID, '_comet_mega_menu', true ) ? get_post_meta( $menu_item->ID, '_comet_mega_menu', true ) : '';
    $menu_item->is_label = '';
  } else{
    $menu_item->mega_menu = '';
    $menu_item->is_label = get_post_meta( $menu_item->ID, '_comet_menu_label', true ) ? get_post_meta( $menu_item->ID, '_comet_menu_label', true ) : '';
  }

  $menu_item->show_icon = get_post_meta( $menu_item->ID, '_comet_menu_show_icon', true ) ? get_post_meta( $menu_item->ID, '_comet_menu_show_icon', true ) : '';
  $menu_item->icon = get_post_meta( $menu_item->ID, '_comet_menu_icon', true ) ? get_post_meta( $menu_item->ID, '_comet_menu_icon', true ) : '';

  return $menu_item;
}

/* Update menu custom fields */
add_action('wp_update_nav_menu_item', 'comet_update_nav_menu_fields', 10, 3 );

function comet_update_nav_menu_fields( $menu_id, $menu_item_db_id, $args ) {
  $value = isset( $_REQUEST['menu-item-mega-menu'][$menu_item_db_id] ) ? $_REQUEST['menu-item-mega-menu'][$menu_item_db_id] : '';
  $is_label = isset( $_REQUEST['menu-item-menu-label'][$menu_item_db_id] ) ? $_REQUEST['menu-item-menu-label'][$menu_item_db_id] : '';
  $show_icon = isset( $_REQUEST['show-menu-icon'][$menu_item_db_id] ) ? $_REQUEST['show-menu-icon'][$menu_item_db_id] : '';
  $menu_icon = isset( $_REQUEST['menu-item-icon'][$menu_item_db_id] ) ? $_REQUEST['menu-item-icon'][$menu_item_db_id] : '';
  
  update_post_meta( $menu_item_db_id, '_comet_mega_menu', $value );
  update_post_meta( $menu_item_db_id, '_comet_menu_label', $is_label );
  update_post_meta( $menu_item_db_id, '_comet_menu_show_icon', $show_icon );
  update_post_meta( $menu_item_db_id, '_comet_menu_icon', $menu_icon );
}

function comet_add_menu_atts( $atts, $item, $args ) {
  
  if ($item->show_icon && $item->icon != '') {
    $atts['data-cm-icon'] = $item->icon;
  }

  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'comet_add_menu_atts', 10, 3 );
