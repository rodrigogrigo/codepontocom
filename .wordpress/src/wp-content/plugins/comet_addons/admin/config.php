<?php

  /* Redux Framework Config */

  if ( ! class_exists( 'comet_settings_Redux_Framework_config' ) ) {

    class comet_settings_Redux_Framework_config {

      public $args = array();
      public $sections = array();
      public $theme;
      public $ReduxFramework;

      public function __construct() {

        if ( ! class_exists( 'ReduxFramework' ) ) {
          return;
        }

        // This is needed. Bah WordPress bugs.  ;)
        if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
          $this->initSettings();
        } else {
          add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
        }

      }

      public function initSettings() {

        // Just for demo purposes. Not needed per say.
        $this->theme = wp_get_theme();

        // Set the default arguments
        $this->setArguments();        

        // Create the sections and fields
        $this->setSections();

        if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
          return;
        }

        // If Redux is running as a plugin, this will remove the demo notice and links
        //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

        // Function to test the compiler hook and demo CSS output.
        // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
        //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

        // Change the arguments after they've been declared, but before the panel is created
        //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

        // Change the default value of a field after it's been set, but before it's been useds
        //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

        // Dynamically add a section. Can be also used to modify sections/fields
        //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

        $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
      }

      /**
       * This is a test function that will let you see when the compiler hook occurs.
       * It only runs if a field    set with compiler=>true is changed.
       * */
      function compiler_action( $options, $css, $changed_values ) {
        echo '<h1>The compiler hook has run!</h1>';
        echo "<pre>";
          print_r( $changed_values ); // Values that have changed since the last save
          echo "</pre>";
          //print_r($options); //Option values
          //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

          /*
        // Demo of how to use the dynamic CSS and write your own static CSS file
        $filename = dirname(__FILE__) . '/style' . '.css';
        global $wp_filesystem;
        if( empty( $wp_filesystem ) ) {
          require_once( ABSPATH .'/wp-admin/includes/file.php' );
        WP_Filesystem();
        }

        if( $wp_filesystem ) {
          $wp_filesystem->put_contents(
              $filename,
              $css,
              FS_CHMOD_FILE // predefined mode settings for WP files
          );
        }
       */
      }

      /**
       * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
       * Simply include this function in the child themes functions.php file.
       * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
       * so you must use get_template_directory_uri() if you want to use any of the built in icons
       * */
      function dynamic_section( $sections ) {
          //$sections = array();
        $sections[] = array(
          'title'  => __( 'Section via hook', 'comet_addons' ),
          'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'comet_addons' ),
          'icon'   => 'el-icon-paper-clip',
              // Leave this as a blank section, no options just some intro text set above.
          'fields' => array()
          );

        return $sections;
      }

      /**
       * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
       * */
      function change_arguments( $args ) {
          //$args['dev_mode'] = true;

        return $args;
      }

      /**
       * Filter hook for filtering the default value of any given field. Very useful in development mode.
       * */
      function change_defaults( $defaults ) {
        $defaults['str_replace'] = 'Testing filter hook!';

        return $defaults;
      }

      // Remove the demo link and the notice of integrated demo from the redux-framework plugin
      function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
          remove_filter( 'plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2 );
          // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
          remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
      }

      public function setSections() {
        include_once 'sections.php';
      }

      public function setHelpTabs() {

        // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
        $this->args['help_tabs'][] = array(
          'id'      => 'redux-help-tab-1',
          'title'   => __( 'Theme Information 1', 'comet_addons' ),
          'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'comet_addons' )
        );

        $this->args['help_tabs'][] = array(
          'id'      => 'redux-help-tab-2',
          'title'   => __( 'Theme Information 2', 'comet_addons' ),
          'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'comet_addons' )
        );

        // Set the help sidebar
        $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'comet_addons' );
      }

      /**
       * All the possible arguments for Redux.
       * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
       * */

      public function setArguments() {

        $theme = wp_get_theme(); // For use with some settings. Not necessary.

        $this->args = array(
          'opt_name'             => 'comet_options',
          'display_name'         => $theme->get( 'Name' ),
          'display_version'      => $theme->get( 'Version' ),
          'menu_type'            => 'menu',
          'allow_sub_menu'       => false,
          'menu_title'           => __( 'Comet Options', 'comet_addons' ),
          'page_title'           => __( 'Comet Options', 'comet_addons' ),
          'google_api_key'       => '',
          'google_update_weekly' => false,
          'async_typography'     => true,
          'admin_bar'            => true,
          'admin_bar_icon'       => 'dashicons-admin-generic',
          'admin_bar_priority'   => 50,
          'global_variable'      => '',
          'dev_mode'             => false,
          'update_notice'        => false,
          'customizer'           => true,
          'page_priority'        => null,
          'page_parent'          => 'themes.php',
          'page_permissions'     => 'manage_options',
          'menu_icon'            => '',
          'last_tab'             => '',
          'page_icon'            => 'icon-themes',
          'page_slug'            => 'comet_options',
          'save_defaults'        => true,
          'default_show'         => false,
          'default_mark'         => '',
          'show_import_export'   => false,
          'transient_time'       => 60 * MINUTE_IN_SECONDS,
          'output'               => true,
          'output_tag'           => true,
          'database'             => '',
          'page_position'        => 63.33,
          'system_info'          => false,
          'hints'                => array(
            'icon'          => 'icon-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
              'color'   => 'light',
              'shadow'  => true,
              'rounded' => false,
              'style'   => '',
            ),
            'tip_position'  => array(
              'my' => 'top left',
              'at' => 'bottom right',
            ),
            'tip_effect'    => array(
              'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
                ),
              'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
                ),
            ),
          )
        );
      }

      public function validate_callback_function( $field, $value, $existing_value ) {
        $error = true;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;

          }
       */

        $return['value'] = $value;
        $field['msg']    = 'your custom error message';
        if ( $error == true ) {
          $return['error'] = $field;
        }

        return $return;
      }

      public function class_field_callback( $field, $value ) {
        print_r( $field );
        echo '<br/>CLASS CALLBACK';
        print_r( $value );
      }
    }

    global $reduxConfig;
    $reduxConfig = new comet_settings_Redux_Framework_config();
  }

  /**
   * Custom function for the callback referenced above
   */
  if ( ! function_exists( 'redux_my_custom_field' ) ):
    function redux_my_custom_field( $field, $value ) {
      print_r( $field );
      echo '<br/>';
      print_r( $value );
    }
  endif;

  /**
   * Custom function for the callback validation referenced above
   * */
  if ( ! function_exists( 'redux_validate_callback_function' ) ):
    function redux_validate_callback_function( $field, $value, $existing_value ) {
      $error = true;
      $value = 'just testing';

          /*
        do your validation

        if(something) {
          $value = $value;
        } elseif(something else) {
          $error = true;
          $value = $existing_value;

        }
       */

      $return['value'] = $value;
      $field['msg']    = 'your custom error message';
      if ( $error == true ) {
        $return['error'] = $field;
      }

      return $return;
    }
  endif;

?>
