<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  
  <?php if (comet_options('hide_preloader')): ?>    
  <!-- Preloader-->
  <div id="loader">
    <div class="centrize">
      <div class="v-center">
        <div id="mask">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
  </div>
  <!-- End Preloader-->
  <?php endif ?>
  <?php $menu_color = (isset($post->ID) && comet_meta($post->ID, 'menu_color') != '') ? comet_meta($post->ID, 'menu_color') : comet_options('menu_color') ; ?>

  <header id="topnav" class="<?php echo str_replace('light', '', esc_attr($menu_color)); ?>">
    <div class="container">
      <!-- Logo container-->
      <div class="logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <?php if (class_exists('comet_settings_Redux_Framework_config')): ?>
            <?php if (comet_options('logo_light')): ?>
              <?php $logo_light = comet_options('logo_light'); ?>
              <img src="<?php echo esc_url($logo_light['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="logo-light">
            <?php endif ?>
            <?php if (comet_options('logo_dark')): ?>
              <?php $logo_dark = comet_options('logo_dark'); ?>
              <img src="<?php echo esc_url($logo_dark['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="logo-dark">
          <?php endif ?>
            <?php else: ?>
            <span class="comet-site-name"><?php echo esc_attr(get_bloginfo('name')); ?></span>
          <?php endif ?>
        </a>
      </div>
      <!-- End Logo container-->
      
      <div class="menu-extras">
        <?php if (class_exists( 'WooCommerce' )): ?>

          <?php if (comet_options('hide_cart') && (isset($post->ID) && comet_meta($post->ID, 'show_cart') != 'no') || !isset($post->ID) && comet_options('hide_cart')): ?>
            <!-- Shopping Cart -->
            <div class="menu-item">
              <div class="cart">
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                  <i class="ti-bag"></i><span class="cart-number"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </a>
                <div class="shopping-cart">
                  
                  <div class="shopping-cart-info">
                    <div class="row">
                      <div class="col-xs-6">
                        <h6 class="upper"><?php esc_html_e('Your Cart', 'comet-wp'); ?></h6>
                      </div>
                      <div class="col-xs-6 text-right">
                        <h6 class="upper"><span class="mini-cart-total"><?php echo WC()->cart->get_cart_total(); ?></span></h6>
                      </div>
                    </div>
                  </div>

                  <?php woocommerce_mini_cart(); ?>

                </div>
              </div>
            </div>
          <?php endif ?>
        <?php endif ?>

        <?php if (comet_options('hide_search_form') && (isset($post->ID) && comet_meta($post->ID, 'show_search') != 'no') || !isset($post->ID) && comet_options('hide_search_form')): ?>
        <!-- Search Form -->
        <div class="menu-item">
          <div class="search">
            <a href="#">
              <i class="ti-search"></i>
            </a>
            <div class="search-form">
              <?php get_search_form(); ?>
            </div>
          </div>
        </div>
        <?php endif ?>

        <div class="menu-item">
          <!-- Mobile menu toggle-->
          <a class="navbar-toggle">
            <div class="lines">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </a>
          <!-- End mobile menu toggle-->
        </div>
      </div>

      <div id="navigation">
        <?php if (has_nav_menu('primary')){
            $args = array(              
              'container' => false,
              'menu_id' => 'main-menu',
              'menu_class' => 'navigation-menu nav',
              'walker'    => new Comet_Walker_Nav_Menu()
            );

            if (isset($post->ID) && comet_meta($post->ID, 'menu_id')) {
              $args['menu'] = comet_meta($post->ID, 'menu_id');
            } else{
              $args['theme_location'] = 'primary';
            }

            wp_nav_menu($args); 

          } elseif(current_user_can('manage_options')){ ?>
            <a class="no-menu" href="<?php echo esc_url(home_url('/wp-admin/nav-menus.php')) ?>"><?php esc_html_e('Click here to add your menu', 'comet-wp'); ?></a>
          <?php } ?>
      </div>
    </div>
  </header>
