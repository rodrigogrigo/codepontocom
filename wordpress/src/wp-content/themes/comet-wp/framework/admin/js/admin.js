jQuery(document).ready(function($) {

  $('#comet-import-btn').on('click', function() {

    var importConfirm = confirm('Have you installed all required plugins? Before installing demo data be sure to do a full backup incase anything goes wrong with the import. Proceed if you have done this.');

    if (importConfirm) {

      $('#info-info_import').slideDown(400);

      $.post(
        ajaxurl, 
        {
          'action': 'comet_import_data',
          'data':   ''
        }, 
        function(data){        
          $.post(
            ajaxurl, 
            {
              'action': 'comet_import_attachments',
              'data':   ''
            }, 
            function(data){
              //       
            }
          );
        }
      );

      var updateText = true;
      
      var checkImport = setInterval(function () {
        $.post(ajaxurl, {action: 'comet_check_import'}, function(data, textStatus, xhr) {        
          var res = JSON.parse(data);
          if (res.posts == 1) {
            if (updateText) {
              $('#info-info_import p span').text("Demo Content imported. Now importing images... Don't close the page!");
            }
            updateText = false;
          }
          if (res.images == 1) {
            clearInterval(checkImport);
            $('#info-info_import').removeClass('redux-warning').addClass('redux-success');
            $('#info-info_import p').text('Import completed. Have fun!'); 
          }
        });
      }, 1500)

    }

   });

  $('#comet_title_bg_field, #comet_blog_options, #comet_masonry_columns_field, #comet_blog_fixed_bg_field').hide();

  if (!$('#page_template').length) {
    $('#comet_blog_options').show();
  }

  $('#page_template').on('change', function(event) {
    var selected = $('#page_template option:selected').val();

    if (selected == 'template-blog.php') {
      $('#comet_blog_options').fadeIn(200);
    } else{
      $('#comet_blog_options').hide();
    }
  }).trigger('change');

  $('#comet_blog_layout').on('change', function(event) {
    var selected = $('#comet_blog_layout option:selected').val();

    if (selected == 'masonry') {
      $('#comet_masonry_columns_field').fadeIn(200);
    } else{
      $('#comet_masonry_columns_field').hide();
    }

    if (selected == 'masonry' || selected == 'default') {
      $('#comet_blog_sidebar_field').fadeIn(200);
    } else{
      $('#comet_blog_sidebar_field').hide();
    }

    if (selected == 'fixed'){
      $('#comet_blog_fixed_bg_field').fadeIn(200);
    } else{
      $('#comet_blog_fixed_bg_field').hide();
    }

  }).trigger('change');

  $('#comet_show_page_title').on('change', function(event) {
    var selected = $('#comet_show_page_title option:selected').val();

    if (selected !== 'yes') {
      $('#comet_page_title_style_field, #comet_page_title_field, #comet_page_subtitle_field, #comet_title_text_align_field, #comet_title_text_transform_field, #comet_title_text_color_field').hide();      
    } else{
      $('#comet_page_title_style_field, #comet_page_title_field, #comet_page_subtitle_field, #comet_title_text_align_field, #comet_title_text_transform_field, #comet_title_text_color_field').fadeIn(200);
    }

    $('#comet_page_title_style').trigger('change');
    
  }).trigger('change');

  $('#comet_page_title_style').on('change', function(event) {
    var selected = $('#comet_page_title_style option:selected').val();

    if (selected == 'parallax' && $(this).is(':visible')) {
      $('#comet_title_bg_field').fadeIn(200);
    } else{
      $('#comet_title_bg_field').hide();
    }
    
  }).trigger('change');

  $('#comet_sidebar').on('change', function(event) {
    var selected = $('#comet_sidebar option:selected').val();

    if (selected != '') {
      $('#comet_sidebar_position_field').fadeIn(200);
    } else{
      $('#comet_sidebar_position_field').hide();
    }
    
  }).trigger('change');

  var custom_uploader;

  $('body').on('click', '.upload_button', function(e) {
    e.preventDefault();
    var this_btn = $(this);

    custom_uploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
          text: 'Choose Image'
      },
      multiple: false
    });

    custom_uploader.on('select', function() {
      attachment = custom_uploader.state().get('selection').first().toJSON();
      this_btn.prev().val(attachment.url).trigger('change');
    });

    custom_uploader.open();
  });

  $('body').on('click', '.upload_video_button', function(e) {
    e.preventDefault();
    var this_btn = $(this);

    custom_uploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Video',
      button: {
        text: 'Choose Video'
      },
      multiple: false,
      library: {
        type: 'video'
      }
    });

    custom_uploader.on('select', function() {
      attachment = custom_uploader.state().get('selection').first().toJSON();
      this_btn.prev().val(attachment.url).trigger('change');
    });

    custom_uploader.open();
  });

  function renderMenuIcons(itemId) {

    var wrapper = $('.menu-icon-container[data-menu-item-id='+itemId+']');

    var themifyIcons = [
      {
        'class':'ti-wand',
        'name': 'wand'
      },
      {
        'class':'ti-volume',
        'name': 'volume'
      },
      {
        'class':'ti-user',
        'name': 'user'
      },
      {
        'class':'ti-unlock',
        'name': 'unlock'
      },
      {
        'class':'ti-unlink',
        'name': 'unlink'
      },
      {
        'class':'ti-trash',
        'name': 'trash'
      },
      {
        'class':'ti-thought',
        'name': 'thought'
      },
      {
        'class':'ti-target',
        'name': 'target'
      },
      {
        'class':'ti-tag',
        'name': 'tag'
      },
      {
        'class':'ti-tablet',
        'name': 'tablet'
      },
      {
        'class':'ti-star',
        'name': 'star'
      },
      {
        'class':'ti-spray',
        'name': 'spray'
      },
      {
        'class':'ti-signal',
        'name': 'signal'
      },
      {
        'class':'ti-shopping-cart',
        'name': 'shopping-cart'
      },
      {
        'class':'ti-shopping-cart-full',
        'name': 'shopping-cart-full'
      },
      {
        'class':'ti-settings',
        'name': 'settings'
      },
      {
        'class':'ti-search',
        'name': 'search'
      },
      {
        'class':'ti-zoom-in',
        'name': 'zoom-in'
      },
      {
        'class':'ti-zoom-out',
        'name': 'zoom-out'
      },
      {
        'class':'ti-cut',
        'name': 'cut'
      },
      {
        'class':'ti-ruler',
        'name': 'ruler'
      },
      {
        'class':'ti-ruler-pencil',
        'name': 'ruler-pencil'
      },
      {
        'class':'ti-ruler-alt',
        'name': 'ruler-alt'
      },
      {
        'class':'ti-bookmark',
        'name': 'bookmark'
      },
      {
        'class':'ti-bookmark-alt',
        'name': 'bookmark-alt'
      },
      {
        'class':'ti-reload',
        'name': 'reload'
      },
      {
        'class':'ti-plus',
        'name': 'plus'
      },
      {
        'class':'ti-pin',
        'name': 'pin'
      },
      {
        'class':'ti-pencil',
        'name': 'pencil'
      },
      {
        'class':'ti-pencil-alt',
        'name': 'pencil-alt'
      },
      {
        'class':'ti-paint-roller',
        'name': 'paint-roller'
      },
      {
        'class':'ti-paint-bucket',
        'name': 'paint-bucket'
      },
      {
        'class':'ti-na',
        'name': 'na'
      },
      {
        'class':'ti-mobile',
        'name': 'mobile'
      },
      {
        'class':'ti-minus',
        'name': 'minus'
      },
      {
        'class':'ti-medall',
        'name': 'medall'
      },
      {
        'class':'ti-medall-alt',
        'name': 'medall-alt'
      },
      {
        'class':'ti-marker',
        'name': 'marker'
      },
      {
        'class':'ti-marker-alt',
        'name': 'marker-alt'
      },
      {
        'class':'ti-arrow-up',
        'name': 'arrow-up'
      },
      {
        'class':'ti-arrow-right',
        'name': 'arrow-right'
      },
      {
        'class':'ti-arrow-left',
        'name': 'arrow-left'
      },
      {
        'class':'ti-arrow-down',
        'name': 'arrow-down'
      },
      {
        'class':'ti-lock',
        'name': 'lock'
      },
      {
        'class':'ti-location-arrow',
        'name': 'location-arrow'
      },
      {
        'class':'ti-link',
        'name': 'link'
      },
      {
        'class':'ti-layout',
        'name': 'layout'
      },
      {
        'class':'ti-layers',
        'name': 'layers'
      },
      {
        'class':'ti-layers-alt',
        'name': 'layers-alt'
      },
      {
        'class':'ti-key',
        'name': 'key'
      },
      {
        'class':'ti-import',
        'name': 'import'
      },
      {
        'class':'ti-image',
        'name': 'image'
      },
      {
        'class':'ti-heart',
        'name': 'heart'
      },
      {
        'class':'ti-heart-broken',
        'name': 'heart-broken'
      },
      {
        'class':'ti-hand-stop',
        'name': 'hand-stop'
      },
      {
        'class':'ti-hand-open',
        'name': 'hand-open'
      },
      {
        'class':'ti-hand-drag',
        'name': 'hand-drag'
      },
      {
        'class':'ti-folder',
        'name': 'folder'
      },
      {
        'class':'ti-flag',
        'name': 'flag'
      },
      {
        'class':'ti-flag-alt',
        'name': 'flag-alt'
      },
      {
        'class':'ti-flag-alt-2',
        'name': 'flag-alt-2'
      },
      {
        'class':'ti-eye',
        'name': 'eye'
      },
      {
        'class':'ti-export',
        'name': 'export'
      },
      {
        'class':'ti-exchange-vertical',
        'name': 'exchange-vertical'
      },
      {
        'class':'ti-desktop',
        'name': 'desktop'
      },
      {
        'class':'ti-cup',
        'name': 'cup'
      },
      {
        'class':'ti-crown',
        'name': 'crown'
      },
      {
        'class':'ti-comments',
        'name': 'comments'
      },
      {
        'class':'ti-comment',
        'name': 'comment'
      },
      {
        'class':'ti-comment-alt',
        'name': 'comment-alt'
      },
      {
        'class':'ti-close',
        'name': 'close'
      },
      {
        'class':'ti-clip',
        'name': 'clip'
      },
      {
        'class':'ti-angle-up',
        'name': 'angle-up'
      },
      {
        'class':'ti-angle-right',
        'name': 'angle-right'
      },
      {
        'class':'ti-angle-left',
        'name': 'angle-left'
      },
      {
        'class':'ti-angle-down',
        'name': 'angle-down'
      },
      {
        'class':'ti-check',
        'name': 'check'
      },
      {
        'class':'ti-check-box',
        'name': 'check-box'
      },
      {
        'class':'ti-camera',
        'name': 'camera'
      },
      {
        'class':'ti-announcement',
        'name': 'announcement'
      },
      {
        'class':'ti-brush',
        'name': 'brush'
      },
      {
        'class':'ti-briefcase',
        'name': 'briefcase'
      },
      {
        'class':'ti-bolt',
        'name': 'bolt'
      },
      {
        'class':'ti-bolt-alt',
        'name': 'bolt-alt'
      },
      {
        'class':'ti-blackboard',
        'name': 'blackboard'
      },
      {
        'class':'ti-bag',
        'name': 'bag'
      },
      {
        'class':'ti-move',
        'name': 'move'
      },
      {
        'class':'ti-arrows-vertical',
        'name': 'arrows-vertical'
      },
      {
        'class':'ti-arrows-horizontal',
        'name': 'arrows-horizontal'
      },
      {
        'class':'ti-fullscreen',
        'name': 'fullscreen'
      },
      {
        'class':'ti-arrow-top-right',
        'name': 'arrow-top-right'
      },
      {
        'class':'ti-arrow-top-left',
        'name': 'arrow-top-left'
      },
      {
        'class':'ti-arrow-circle-up',
        'name': 'arrow-circle-up'
      },
      {
        'class':'ti-arrow-circle-right',
        'name': 'arrow-circle-right'
      },
      {
        'class':'ti-arrow-circle-left',
        'name': 'arrow-circle-left'
      },
      {
        'class':'ti-arrow-circle-down',
        'name': 'arrow-circle-down'
      },
      {
        'class':'ti-angle-double-up',
        'name': 'angle-double-up'
      },
      {
        'class':'ti-angle-double-right',
        'name': 'angle-double-right'
      },
      {
        'class':'ti-angle-double-left',
        'name': 'angle-double-left'
      },
      {
        'class':'ti-angle-double-down',
        'name': 'angle-double-down'
      },
      {
        'class':'ti-zip',
        'name': 'zip'
      },
      {
        'class':'ti-world',
        'name': 'world'
      },
      {
        'class':'ti-wheelchair',
        'name': 'wheelchair'
      },
      {
        'class':'ti-view-list',
        'name': 'view-list'
      },
      {
        'class':'ti-view-list-alt',
        'name': 'view-list-alt'
      },
      {
        'class':'ti-view-grid',
        'name': 'view-grid'
      },
      {
        'class':'ti-uppercase',
        'name': 'uppercase'
      },
      {
        'class':'ti-upload',
        'name': 'upload'
      },
      {
        'class':'ti-underline',
        'name': 'underline'
      },
      {
        'class':'ti-truck',
        'name': 'truck'
      },
      {
        'class':'ti-timer',
        'name': 'timer'
      },
      {
        'class':'ti-ticket',
        'name': 'ticket'
      },
      {
        'class':'ti-thumb-up',
        'name': 'thumb-up'
      },
      {
        'class':'ti-thumb-down',
        'name': 'thumb-down'
      },
      {
        'class':'ti-text',
        'name': 'text'
      },
      {
        'class':'ti-stats-up',
        'name': 'stats-up'
      },
      {
        'class':'ti-stats-down',
        'name': 'stats-down'
      },
      {
        'class':'ti-split-v',
        'name': 'split-v'
      },
      {
        'class':'ti-split-h',
        'name': 'split-h'
      },
      {
        'class':'ti-smallcap',
        'name': 'smallcap'
      },
      {
        'class':'ti-shine',
        'name': 'shine'
      },
      {
        'class':'ti-shift-right',
        'name': 'shift-right'
      },
      {
        'class':'ti-shift-left',
        'name': 'shift-left'
      },
      {
        'class':'ti-shield',
        'name': 'shield'
      },
      {
        'class':'ti-notepad',
        'name': 'notepad'
      },
      {
        'class':'ti-server',
        'name': 'server'
      },
      {
        'class':'ti-quote-right',
        'name': 'quote-right'
      },
      {
        'class':'ti-quote-left',
        'name': 'quote-left'
      },
      {
        'class':'ti-pulse',
        'name': 'pulse'
      },
      {
        'class':'ti-printer',
        'name': 'printer'
      },
      {
        'class':'ti-power-off',
        'name': 'power-off'
      },
      {
        'class':'ti-plug',
        'name': 'plug'
      },
      {
        'class':'ti-pie-chart',
        'name': 'pie-chart'
      },
      {
        'class':'ti-paragraph',
        'name': 'paragraph'
      },
      {
        'class':'ti-panel',
        'name': 'panel'
      },
      {
        'class':'ti-package',
        'name': 'package'
      },
      {
        'class':'ti-music',
        'name': 'music'
      },
      {
        'class':'ti-music-alt',
        'name': 'music-alt'
      },
      {
        'class':'ti-mouse',
        'name': 'mouse'
      },
      {
        'class':'ti-mouse-alt',
        'name': 'mouse-alt'
      },
      {
        'class':'ti-money',
        'name': 'money'
      },
      {
        'class':'ti-microphone',
        'name': 'microphone'
      },
      {
        'class':'ti-menu',
        'name': 'menu'
      },
      {
        'class':'ti-menu-alt',
        'name': 'menu-alt'
      },
      {
        'class':'ti-map',
        'name': 'map'
      },
      {
        'class':'ti-map-alt',
        'name': 'map-alt'
      },
      {
        'class':'ti-loop',
        'name': 'loop'
      },
      {
        'class':'ti-location-pin',
        'name': 'location-pin'
      },
      {
        'class':'ti-list',
        'name': 'list'
      },
      {
        'class':'ti-light-bulb',
        'name': 'light-bulb'
      },
      {
        'class':'ti-Italic',
        'name': 'Italic'
      },
      {
        'class':'ti-info',
        'name': 'info'
      },
      {
        'class':'ti-infinite',
        'name': 'infinite'
      },
      {
        'class':'ti-id-badge',
        'name': 'id-badge'
      },
      {
        'class':'ti-hummer',
        'name': 'hummer'
      },
      {
        'class':'ti-home',
        'name': 'home'
      },
      {
        'class':'ti-help',
        'name': 'help'
      },
      {
        'class':'ti-headphone',
        'name': 'headphone'
      },
      {
        'class':'ti-harddrives',
        'name': 'harddrives'
      },
      {
        'class':'ti-harddrive',
        'name': 'harddrive'
      },
      {
        'class':'ti-gift',
        'name': 'gift'
      },
      {
        'class':'ti-game',
        'name': 'game'
      },
      {
        'class':'ti-filter',
        'name': 'filter'
      },
      {
        'class':'ti-files',
        'name': 'files'
      },
      {
        'class':'ti-file',
        'name': 'file'
      },
      {
        'class':'ti-eraser',
        'name': 'eraser'
      },
      {
        'class':'ti-envelope',
        'name': 'envelope'
      },
      {
        'class':'ti-download',
        'name': 'download'
      },
      {
        'class':'ti-direction',
        'name': 'direction'
      },
      {
        'class':'ti-direction-alt',
        'name': 'direction-alt'
      },
      {
        'class':'ti-dashboard',
        'name': 'dashboard'
      },
      {
        'class':'ti-control-stop',
        'name': 'control-stop'
      },
      {
        'class':'ti-control-shuffle',
        'name': 'control-shuffle'
      },
      {
        'class':'ti-control-play',
        'name': 'control-play'
      },
      {
        'class':'ti-control-pause',
        'name': 'control-pause'
      },
      {
        'class':'ti-control-forward',
        'name': 'control-forward'
      },
      {
        'class':'ti-control-backward',
        'name': 'control-backward'
      },
      {
        'class':'ti-cloud',
        'name': 'cloud'
      },
      {
        'class':'ti-cloud-up',
        'name': 'cloud-up'
      },
      {
        'class':'ti-cloud-down',
        'name': 'cloud-down'
      },
      {
        'class':'ti-clipboard',
        'name': 'clipboard'
      },
      {
        'class':'ti-car',
        'name': 'car'
      },
      {
        'class':'ti-calendar',
        'name': 'calendar'
      },
      {
        'class':'ti-book',
        'name': 'book'
      },
      {
        'class':'ti-bell',
        'name': 'bell'
      },
      {
        'class':'ti-basketball',
        'name': 'basketball'
      },
      {
        'class':'ti-bar-chart',
        'name': 'bar-chart'
      },
      {
        'class':'ti-bar-chart-alt',
        'name': 'bar-chart-alt'
      },
      {
        'class':'ti-back-right',
        'name': 'back-right'
      },
      {
        'class':'ti-back-left',
        'name': 'back-left'
      },
      {
        'class':'ti-arrows-corner',
        'name': 'arrows-corner'
      },
      {
        'class':'ti-archive',
        'name': 'archive'
      },
      {
        'class':'ti-anchor',
        'name': 'anchor'
      },
      {
        'class':'ti-align-right',
        'name': 'align-right'
      },
      {
        'class':'ti-align-left',
        'name': 'align-left'
      },
      {
        'class':'ti-align-justify',
        'name': 'align-justify'
      },
      {
        'class':'ti-align-center',
        'name': 'align-center'
      },
      {
        'class':'ti-alert',
        'name': 'alert'
      },
      {
        'class':'ti-alarm-clock',
        'name': 'alarm-clock'
      },
      {
        'class':'ti-agenda',
        'name': 'agenda'
      },
      {
        'class':'ti-write',
        'name': 'write'
      },
      {
        'class':'ti-window',
        'name': 'window'
      },
      {
        'class':'ti-widgetized',
        'name': 'widgetized'
      },
      {
        'class':'ti-widget',
        'name': 'widget'
      },
      {
        'class':'ti-widget-alt',
        'name': 'widget-alt'
      },
      {
        'class':'ti-wallet',
        'name': 'wallet'
      },
      {
        'class':'ti-video-clapper',
        'name': 'video-clapper'
      },
      {
        'class':'ti-video-camera',
        'name': 'video-camera'
      },
      {
        'class':'ti-vector',
        'name': 'vector'
      },
      {
        'class':'ti-themify-logo',
        'name': 'themify-logo'
      },
      {
        'class':'ti-themify-favicon',
        'name': 'themify-favicon'
      },
      {
        'class':'ti-themify-favicon-alt',
        'name': 'themify-favicon-alt'
      },
      {
        'class':'ti-support',
        'name': 'support'
      },
      {
        'class':'ti-stamp',
        'name': 'stamp'
      },
      {
        'class':'ti-split-v-alt',
        'name': 'split-v-alt'
      },
      {
        'class':'ti-slice',
        'name': 'slice'
      },
      {
        'class':'ti-shortcode',
        'name': 'shortcode'
      },
      {
        'class':'ti-shift-right-alt',
        'name': 'shift-right-alt'
      },
      {
        'class':'ti-shift-left-alt',
        'name': 'shift-left-alt'
      },
      {
        'class':'ti-ruler-alt-2',
        'name': 'ruler-alt-2'
      },
      {
        'class':'ti-receipt',
        'name': 'receipt'
      },
      {
        'class':'ti-pin2',
        'name': 'pin2'
      },
      {
        'class':'ti-pin-alt',
        'name': 'pin-alt'
      },
      {
        'class':'ti-pencil-alt2',
        'name': 'pencil-alt2'
      },
      {
        'class':'ti-palette',
        'name': 'palette'
      },
      {
        'class':'ti-more',
        'name': 'more'
      },
      {
        'class':'ti-more-alt',
        'name': 'more-alt'
      },
      {
        'class':'ti-microphone-alt',
        'name': 'microphone-alt'
      },
      {
        'class':'ti-magnet',
        'name': 'magnet'
      },
      {
        'class':'ti-line-double',
        'name': 'line-double'
      },
      {
        'class':'ti-line-dotted',
        'name': 'line-dotted'
      },
      {
        'class':'ti-line-dashed',
        'name': 'line-dashed'
      },
      {
        'class':'ti-layout-width-full',
        'name': 'layout-width-full'
      },
      {
        'class':'ti-layout-width-default',
        'name': 'layout-width-default'
      },
      {
        'class':'ti-layout-width-default-alt',
        'name': 'layout-width-default-alt'
      },
      {
        'class':'ti-layout-tab',
        'name': 'layout-tab'
      },
      {
        'class':'ti-layout-tab-window',
        'name': 'layout-tab-window'
      },
      {
        'class':'ti-layout-tab-v',
        'name': 'layout-tab-v'
      },
      {
        'class':'ti-layout-tab-min',
        'name': 'layout-tab-min'
      },
      {
        'class':'ti-layout-slider',
        'name': 'layout-slider'
      },
      {
        'class':'ti-layout-slider-alt',
        'name': 'layout-slider-alt'
      },
      {
        'class':'ti-layout-sidebar-right',
        'name': 'layout-sidebar-right'
      },
      {
        'class':'ti-layout-sidebar-none',
        'name': 'layout-sidebar-none'
      },
      {
        'class':'ti-layout-sidebar-left',
        'name': 'layout-sidebar-left'
      },
      {
        'class':'ti-layout-placeholder',
        'name': 'layout-placeholder'
      },
      {
        'class':'ti-layout-menu',
        'name': 'layout-menu'
      },
      {
        'class':'ti-layout-menu-v',
        'name': 'layout-menu-v'
      },
      {
        'class':'ti-layout-menu-separated',
        'name': 'layout-menu-separated'
      },
      {
        'class':'ti-layout-menu-full',
        'name': 'layout-menu-full'
      },
      {
        'class':'ti-layout-media-right-alt',
        'name': 'layout-media-right-alt'
      },
      {
        'class':'ti-layout-media-right',
        'name': 'layout-media-right'
      },
      {
        'class':'ti-layout-media-overlay',
        'name': 'layout-media-overlay'
      },
      {
        'class':'ti-layout-media-overlay-alt',
        'name': 'layout-media-overlay-alt'
      },
      {
        'class':'ti-layout-media-overlay-alt-2',
        'name': 'layout-media-overlay-alt-2'
      },
      {
        'class':'ti-layout-media-left-alt',
        'name': 'layout-media-left-alt'
      },
      {
        'class':'ti-layout-media-left',
        'name': 'layout-media-left'
      },
      {
        'class':'ti-layout-media-center-alt',
        'name': 'layout-media-center-alt'
      },
      {
        'class':'ti-layout-media-center',
        'name': 'layout-media-center'
      },
      {
        'class':'ti-layout-list-thumb',
        'name': 'layout-list-thumb'
      },
      {
        'class':'ti-layout-list-thumb-alt',
        'name': 'layout-list-thumb-alt'
      },
      {
        'class':'ti-layout-list-post',
        'name': 'layout-list-post'
      },
      {
        'class':'ti-layout-list-large-image',
        'name': 'layout-list-large-image'
      },
      {
        'class':'ti-layout-line-solid',
        'name': 'layout-line-solid'
      },
      {
        'class':'ti-layout-grid4',
        'name': 'layout-grid4'
      },
      {
        'class':'ti-layout-grid3',
        'name': 'layout-grid3'
      },
      {
        'class':'ti-layout-grid2',
        'name': 'layout-grid2'
      },
      {
        'class':'ti-layout-grid2-thumb',
        'name': 'layout-grid2-thumb'
      },
      {
        'class':'ti-layout-cta-right',
        'name': 'layout-cta-right'
      },
      {
        'class':'ti-layout-cta-left',
        'name': 'layout-cta-left'
      },
      {
        'class':'ti-layout-cta-center',
        'name': 'layout-cta-center'
      },
      {
        'class':'ti-layout-cta-btn-right',
        'name': 'layout-cta-btn-right'
      },
      {
        'class':'ti-layout-cta-btn-left',
        'name': 'layout-cta-btn-left'
      },
      {
        'class':'ti-layout-column4',
        'name': 'layout-column4'
      },
      {
        'class':'ti-layout-column3',
        'name': 'layout-column3'
      },
      {
        'class':'ti-layout-column2',
        'name': 'layout-column2'
      },
      {
        'class':'ti-layout-accordion-separated',
        'name': 'layout-accordion-separated'
      },
      {
        'class':'ti-layout-accordion-merged',
        'name': 'layout-accordion-merged'
      },
      {
        'class':'ti-layout-accordion-list',
        'name': 'layout-accordion-list'
      },
      {
        'class':'ti-ink-pen',
        'name': 'ink-pen'
      },
      {
        'class':'ti-info-alt',
        'name': 'info-alt'
      },
      {
        'class':'ti-help-alt',
        'name': 'help-alt'
      },
      {
        'class':'ti-headphone-alt',
        'name': 'headphone-alt'
      },
      {
        'class':'ti-hand-point-up',
        'name': 'hand-point-up'
      },
      {
        'class':'ti-hand-point-right',
        'name': 'hand-point-right'
      },
      {
        'class':'ti-hand-point-left',
        'name': 'hand-point-left'
      },
      {
        'class':'ti-hand-point-down',
        'name': 'hand-point-down'
      },
      {
        'class':'ti-gallery',
        'name': 'gallery'
      },
      {
        'class':'ti-face-smile',
        'name': 'face-smile'
      },
      {
        'class':'ti-face-sad',
        'name': 'face-sad'
      },
      {
        'class':'ti-credit-card',
        'name': 'credit-card'
      },
      {
        'class':'ti-control-skip-forward',
        'name': 'control-skip-forward'
      },
      {
        'class':'ti-control-skip-backward',
        'name': 'control-skip-backward'
      },
      {
        'class':'ti-control-record',
        'name': 'control-record'
      },
      {
        'class':'ti-control-eject',
        'name': 'control-eject'
      },
      {
        'class':'ti-comments-smiley',
        'name': 'comments-smiley'
      },
      {
        'class':'ti-brush-alt',
        'name': 'brush-alt'
      },
      {
        'class':'ti-youtube',
        'name': 'youtube'
      },
      {
        'class':'ti-vimeo',
        'name': 'vimeo'
      },
      {
        'class':'ti-twitter',
        'name': 'twitter'
      },
      {
        'class':'ti-time',
        'name': 'time'
      },
      {
        'class':'ti-tumblr',
        'name': 'tumblr'
      },
      {
        'class':'ti-skype',
        'name': 'skype'
      },
      {
        'class':'ti-share',
        'name': 'share'
      },
      {
        'class':'ti-share-alt',
        'name': 'share-alt'
      },
      {
        'class':'ti-rocket',
        'name': 'rocket'
      },
      {
        'class':'ti-pinterest',
        'name': 'pinterest'
      },
      {
        'class':'ti-new-window',
        'name': 'new-window'
      },
      {
        'class':'ti-microsoft',
        'name': 'microsoft'
      },
      {
        'class':'ti-list-ol',
        'name': 'list-ol'
      },
      {
        'class':'ti-linkedin',
        'name': 'linkedin'
      },
      {
        'class':'ti-layout-sidebar-2',
        'name': 'layout-sidebar-2'
      },
      {
        'class':'ti-layout-grid4-alt',
        'name': 'layout-grid4-alt'
      },
      {
        'class':'ti-layout-grid3-alt',
        'name': 'layout-grid3-alt'
      },
      {
        'class':'ti-layout-grid2-alt',
        'name': 'layout-grid2-alt'
      },
      {
        'class':'ti-layout-column4-alt',
        'name': 'layout-column4-alt'
      },
      {
        'class':'ti-layout-column3-alt',
        'name': 'layout-column3-alt'
      },
      {
        'class':'ti-layout-column2-alt',
        'name': 'layout-column2-alt'
      },
      {
        'class':'ti-instagram',
        'name': 'instagram'
      },
      {
        'class':'ti-google',
        'name': 'google'
      },
      {
        'class':'ti-github',
        'name': 'github'
      },
      {
        'class':'ti-flickr',
        'name': 'flickr'
      },
      {
        'class':'ti-facebook',
        'name': 'facebook'
      },
      {
        'class':'ti-dropbox',
        'name': 'dropbox'
      },
      {
        'class':'ti-dribbble',
        'name': 'dribbble'
      },
      {
        'class':'ti-apple',
        'name': 'apple'
      },
      {
        'class':'ti-android',
        'name': 'android'
      },
      {
        'class':'ti-save',
        'name': 'save'
      },
      {
        'class':'ti-save-alt',
        'name': 'save-alt'
      },
      {
        'class':'ti-yahoo',
        'name': 'yahoo'
      },
      {
        'class':'ti-wordpress',
        'name': 'wordpress'
      },
      {
        'class':'ti-vimeo-alt',
        'name': 'vimeo-alt'
      },
      {
        'class':'ti-twitter-alt',
        'name': 'twitter-alt'
      },
      {
        'class':'ti-tumblr-alt',
        'name': 'tumblr-alt'
      },
      {
        'class':'ti-trello',
        'name': 'trello'
      },
      {
        'class':'ti-stack-overflow',
        'name': 'stack-overflow'
      },
      {
        'class':'ti-soundcloud',
        'name': 'soundcloud'
      },
      {
        'class':'ti-sharethis',
        'name': 'sharethis'
      },
      {
        'class':'ti-sharethis-alt',
        'name': 'sharethis-alt'
      },
      {
        'class':'ti-reddit',
        'name': 'reddit'
      },
      {
        'class':'ti-pinterest-alt',
        'name': 'pinterest-alt'
      },
      {
        'class':'ti-microsoft-alt',
        'name': 'microsoft-alt'
      },
      {
        'class':'ti-linux',
        'name': 'linux'
      },
      {
        'class':'ti-jsfiddle',
        'name': 'jsfiddle'
      },
      {
        'class':'ti-joomla',
        'name': 'joomla'
      },
      {
        'class':'ti-html5',
        'name': 'html5'
      },
      {
        'class':'ti-flickr-alt',
        'name': 'flickr-alt'
      },
      {
        'class':'ti-email',
        'name': 'email'
      },
      {
        'class':'ti-drupal',
        'name': 'drupal'
      },
      {
        'class':'ti-dropbox-alt',
        'name': 'dropbox-alt'
      },
      {
        'class':'ti-css3',
        'name': 'css3'
      },
      {
        'class':'ti-rss',
        'name': 'rss'
      },
      {
        'class':'ti-rss-alt',
        'name': 'rss-alt'
      },
    ];

    var iconsContainer = '';
    var cssClass = '';
    var selectedIcon = $(wrapper).find('.icon-value').val();

    if (selectedIcon) {
      iconsContainer += '<div class="icon-field active"><i class="'+$(wrapper).find('.icon-value').val()+'"></i></div>';  
    }


    for (var i = 0; i < themifyIcons.length; i++) {
      if (themifyIcons[i].class == $(wrapper).find('.icon-value').val()) {
        cssClass = 'hidden';
      }
      iconsContainer += '<div class="icon-field '+cssClass+'" data-filter="'+themifyIcons[i].name.replace(/-/g, ' ')+'"><i class="'+themifyIcons[i].class+'"></i></div>';
      cssClass = '';
    }

    var output = '<div class="icons-wrapper" data-menu="menu-item-icon['+itemId+']">'+iconsContainer+'</div>';

    if ( ! $(wrapper).find('.icons-wrapper').length ) {
      $(wrapper).append(output);
    }
  }


  $(document).on('change', '.menu-icon-toggle', function() {
    menuId = $(this).data('item-id');
    
    if ( $(this).is(':checked') ) {
      $('.menu-icon-container[data-menu-item-id='+menuId+']').fadeIn();
      renderMenuIcons(menuId);
    } else{
      $('.menu-icon-container[data-menu-item-id='+menuId+']').hide();
    }

  });

  $('.menu-icon-toggle').trigger('change');

  $('body').on('click', '.icon-field i', function(event) {
    $(this).parents('.icons-wrapper').find('.icon-field').removeClass('active');
    $(this).parent('.icon-field').addClass('active');

    var iconClass = $(this).attr('class');

    var iconInput = $(this).parents('.icons-wrapper').data('menu');
    
    $(this).closest('.menu-icon-container').find('.icon-value').val(iconClass);

  });

  function filterIcons() {
    var icons = $(this).closest('.menu-icon-container').find('.icons-wrapper .icon-field');
    var vl = $(this).val();
    
    $(icons).filter(function(index) {
      return $(this).data('filter').indexOf(vl) != -1;
    }).show();

    $(icons).filter(function(index) {
      return $(this).data('filter').indexOf(vl) == -1;
    }).hide();

  }

  $(document).on('input', '.filter-icons', filterIcons);
  $('.filter-icons').on('input', filterIcons);

});
