<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

add_action( 'woocommerce_shop_loop_item_thumb_open', 'woocommerce_template_loop_product_thumb', 10 );
add_action( 'woocommerce_shop_loop_item_thumb_close', 'woocommerce_template_loop_product_thumb_close', 5 );

add_action( 'woocommerce_shop_loop_item_thumb_cart', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

if ( ! function_exists( 'woocommerce_template_loop_product_thumb' ) ) {
  function woocommerce_template_loop_product_thumb() {
    $output = '<div class="product-thumb">';
    $output .= '<a href="' . get_the_permalink() . '">';
    if (has_post_thumbnail(get_the_id() )) {
      $output .= woocommerce_get_product_thumbnail('shop_single');
    } elseif ( wc_placeholder_img_src() ) {
      $output .= wc_placeholder_img( 'shop_single' );
    }
    $output .= '</a>';
    $output .= '<div class="product-overlay">';

    echo $output;
  }
}

if ( ! function_exists( 'woocommerce_template_loop_product_thumb_close' ) ) {
  function woocommerce_template_loop_product_thumb_close() {
    $output = '</div>';
    $output .= '</div>';

    echo $output;
  }
}


if (  ! function_exists( 'woocommerce_template_loop_product_title' ) ) {

  function woocommerce_template_loop_product_title() {
    global $product;

    $output = '<div class="product-info">';
    $output .= '<h4 class="upper">';
    $output .= '<a href="' . get_the_permalink() . '">';
    $output .= get_the_title();
    $output .= '</a>';
    $output .= '</h4>';
    if ( $price_html = $product->get_price_html() ){
      $output .= '<span>'.$price_html.'</span>';
    }
    $output .= '</div>';

    echo $output;
  }
}
