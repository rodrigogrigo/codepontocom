<?php

class Comet_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {

  public $current_menu;
  public $locations = array();

  public function __construct(){
    $this->locations = array_flip( (array) get_nav_menu_locations());
  }

  public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

    if (!$this->current_menu) {
      $menu = wp_get_post_terms($item->ID, 'nav_menu');

      if (!empty($menu[0])) {
        $this->current_menu = $menu[0]->term_id;
      }

      if (!$this->current_menu && $_REQUEST['menu']) {
        $this->current_menu = $_REQUEST['menu'];
      }
    }

    $item_output = '';

    parent::start_el($item_output, $item, $depth, $args, $id);

    // add new fields
    $new_fields = $this->get_new_fields($item, $depth);

    ob_start();
    do_action('wp_nav_menu_item_custom_fields', $item->ID, $item, $depth, $args);
    $new_fields .= ob_get_clean();

    if ($new_fields) {
      $item_output = preg_replace('/(?=<div[^>]+class="[^"]*submitbox)/', $new_fields, $item_output);
    }

    $output .= $item_output;
  }

  public function get_new_fields($item, $depth = 0){

    $custom_fields = '';

    $custom_fields .=
    '<p class="field-custom description description-wide mega-menu-field">
      <label for="edit-mega-menu-item-'.$item->db_id.'">
        <input id="edit-mega-menu-item-'.$item->db_id.'" name="menu-item-mega-menu['.$item->db_id.']" type="checkbox" value="1" '.checked( $item->mega_menu, '1', false).' >
        '. esc_html__( 'Enable Mega Menu', 'comet-wp' ).'
      </label>
    </p>';

    $custom_fields .=
    '<p class="field-custom description description-wide mega-menu-label-field">
      <label for="edit-menu-label-item-'.$item->db_id.'">
        <input id="edit-menu-label-item-'.$item->db_id.'" name="menu-item-menu-label['.$item->db_id.']" type="checkbox" value="1" '.checked( $item->is_label, '1', false).' >
        '. esc_html__( 'Use as Mega Menu Label', 'comet-wp' ).'
      </label>
    </p>';

    $custom_fields .=
    '<p class="field-custom description description-wide menu-icon-field">
      <label for="edit-show-menu-icon-'.$item->db_id.'">
        <input class="menu-icon-toggle" id="edit-show-menu-icon-'.$item->db_id.'" name="show-menu-icon['.$item->db_id.']" type="checkbox" value="1" '.checked( $item->show_icon, '1', false).' data-item-id="'.$item->db_id.'">
        '. esc_html__( 'Add Icon?', 'comet-wp' ).'
      </label>
    </p>';

    $custom_fields .=
    '<p class="field-custom description description-wide menu-icon-container" data-menu-item-id="'.$item->db_id.'">
      <label>
        '. esc_html__( 'Select an Icon', 'comet-wp' ).'
        <input type="text" class="filter-icons" placeholder="Search Icon">
      </label>
      <input id="menu-icon-['.$item->db_id.']" type="hidden" value="'.$item->icon.'" class="icon-value" name="menu-item-icon['.$item->db_id.']">
    </p>';

    return $custom_fields;
  }
}
