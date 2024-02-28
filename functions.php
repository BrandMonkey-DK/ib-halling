<?php
//////////////////////////////////////////////////////////// PARENT THEME SETUP ////////////////////////////////////////////////////////////

// ---------------------------------------- THEME SETUP ----------------------------------------
function bm_theme_setup()
{
  // Register Menu 
  register_nav_menu('primary', __('Primary Menu', 'brandmonkey'));
  register_nav_menu('footer', __('Footer Menu', 'brandmonkey'));

  // Add Post Thumbnails Support
  add_theme_support('post-thumbnails');

  // Add HTML5 Theme Support
  add_theme_support('html5', array('search-form'));

  // Add Theme Logo Support
  add_theme_support('custom-logo', array(
    'height'      => 45,
    'width'       => 230,
    'flex-height' => true,
    'flex-width'  => true,
  ));

  // Image Sizes
  add_image_size('large-image-square', 800, 800, true);
  add_image_size('medium-image-square', 600, 600, true);
  add_image_size('small-image-square', 300, 300, true);
  add_image_size('large-icon-square', 150, 150, true);
  add_image_size('small-icon-square', 50, 50, true);
  add_image_size('acf-e-field-image-selector', 65, 65, true);
}
add_action('after_setup_theme', 'bm_theme_setup', 10);

// ---------------------------------------- ADMIN MENU SETUP ----------------------------------------
// Remove Unused Menu Items in admin
function bm_remove_admin_menus()
{
  // remove_menu_page('index.php');                  //Dashboard
  // remove_menu_page('edit.php');                   //Posts
  // remove_menu_page('upload.php');                 //Media
  // remove_menu_page('edit.php?post_type=page');    //Pages
  // remove_menu_page('edit-comments.php');          //Comments
  // remove_menu_page('themes.php');                 //Appearance
  // remove_menu_page('plugins.php');                //Plugins
  // remove_menu_page('users.php');                  //Users
  // remove_menu_page('tools.php');                  //Tools
  // remove_menu_page('options-general.php');        //Settings
}
add_action('admin_menu', 'bm_remove_admin_menus');

// ---------------------------------------- ADMIN FOOTER ----------------------------------------
function bm_footer_admin()
{
  echo 'Theme designed and developed by <a href="http://brandmonkey.dk" target="_blank">BrandMonkey ApS</a>';
}
add_filter('admin_footer_text', 'bm_footer_admin');

// ---------------------------------------- IMAGE P TAG UNWRAPPER ---------------------------------------- 
// Stop images getting wrapped up in p tags, when they get dumped out with the_content() for easier theme styling
function bm_remove_img_p_tags($content)
{
  return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'bm_remove_img_p_tags');

// ---------------------------------------- WYSIWYG EDITOR FORMATS ----------------------------------------
// Change default block formats in admin wysiwyg editor
function bm_custom_editor_formats($init)
{
  $init['block_formats'] = "Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5;";
  return $init;
}
add_filter('tiny_mce_before_init', 'bm_custom_editor_formats');

// ---------------------------------------- WYSIWYG EDITOR FONT COLORS ----------------------------------------
// Change default font colors in admin wysiwyg editor
function bm_custom_editor_font_colors($init)
{
  $custom_colours = '
  "000000", "Black",
  "222222", "Dark gray",
  "FFFFFF", "White",
  "F6F6F6", "Lightgrey",
  "FF0000", "Red",
  "00FF00", "Green",
  "0000FF", "Blue",
  ';
  $init['textcolor_map'] = '[' . $custom_colours . ']';
  $init['textcolor_rows'] = 2;
  return $init;
}
add_filter('tiny_mce_before_init', 'bm_custom_editor_font_colors');

// ---------------------------------------- WYSIWYG EDITOR CUSTOM FONT COLORS ----------------------------------------
// Remove option for custom font colors in admin wysiwyg editor
function remove_custom_colors_tiny_mce($plugins)
{
  foreach ($plugins as $key => $plugin_name) {
    if ('colorpicker' === $plugin_name) {
      unset($plugins[$key]);
      return $plugins;
    }
  }
  return $plugins;
}
add_filter('tiny_mce_plugins', 'remove_custom_colors_tiny_mce');

// ---------------------------------------- SITE META TITLE ----------------------------------------
// If yoast plugin is NOT installed and active
if (!bm_is_plugin_active('wordpress-seo/wp-seo.php')) {
  // Set site meta title
  function bm_wp_title($title, $sep)
  {
    global $paged, $page;
    if (is_feed()) {
      return $title;
    }
    $title .= get_bloginfo('name');
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
      $title = "$title $sep $site_description";
    }
    if ($paged >= 2 || $page >= 2) {
      $title = "$title $sep " . sprintf(__('Page %s', 'brandmonkey'), max($paged, $page));
    }
    return $title;
  }
  add_filter('wp_title', 'bm_wp_title', 10, 2);
}

// ---------------------------------------- YOAST METABOX ---------------------------------------- 
// If yoast plugin is installed and active
if (bm_is_plugin_active('wordpress-seo/wp-seo.php')) {
  // Move Yoast metabox to bottom in admin
  function bm_move_yoast_to_bottom()
  {
    return 'low';
  }
  add_filter('wpseo_metabox_prio', 'bm_move_yoast_to_bottom');
}



//////////////////////////////////////////////////////////// CUSTOM POST TYPE ////////////////////////////////////////////////////////////

// Register custom post types
function bm_register_custom_post_types()
{
  // register_post_type(
  //   'custom-post-type',
  //   array(
  //     'labels' => array(
  //       'name'                => __('Custom post type'),
  //       'singular_name'       => __('Custom post type'),
  //       'add_new'             => __('Add post'),
  //       'add_new_item'        => __('Add post')
  //     ),
  //     'label'                 => __('Custom post type'),
  //     'description'           => __('Custom post type description'),
  //     'supports'              => array('title', 'thumbnail', 'excerpt'),
  //     'rewrite'               => array('slug' => 'new_custom_post_type'),
  //     'menu_icon'             => 'dashicons-editor-table',
  //     'public'                => true,
  //     'publicly_queryable'    => true,  // Default is value of 'public'
  //     // 'has_archive'           => true,
  //     // 'show_ui'               => true,  // Default is value of 'public'
  //     // 'show_in_nav_menus'     => true,  // Default is value of 'public'
  //     // 'exclude_from_search'   => false, // Default is the opposite value of 'public'
  //     // 'menu_position'         => 5,
  //   )
  // );
}
add_action('init', 'bm_register_custom_post_types', 0);



//////////////////////////////////////////////////////////// ADVANCED CUSTOM FIELDS SETUP ////////////////////////////////////////////////////////////
// If Advanced Custom Fields plugin is installed and active
if (bm_is_plugin_active('advanced-custom-fields-pro/acf.php')) {

  // ---------------------------------------- ADD THEME ADMIN MENU PAGES ---------------------------------------- 
  // Add Theme Settings Page
  acf_add_options_page(array(
    'page_title'      => 'Theme settings',
    'menu_title'      => 'Theme settings',
    'menu_slug'       => 'theme-settings',
  ));

  // Add Theme Settings Sub Page
  acf_add_options_sub_page(array(
    'page_title'      => 'General',
    'menu_title'      => 'General',
    'parent_slug'     => 'theme-settings',
    'updated_message' => __("The content has been saved", 'acf'),
    'update_button'   => __('Update', 'acf'),
  ));

  // Add Theme Settings Sub Page
  acf_add_options_sub_page(array(
    'page_title'      => 'Footer',
    'menu_title'      => 'Footer',
    'parent_slug'     => 'theme-settings',
    'updated_message' => __("The content has been saved", 'acf'),
    'update_button'   => __('Update', 'acf'),
  ));

  // ---------------------------------------- GET BLOCKS ---------------------------------------- 
  function get_blocks($type = "content")
  {
    if (have_posts()) : while (have_posts()) : the_post();
        if (have_rows($type)) :
          while (have_rows($type)) : the_row();
            get_template_part('template-parts/blocks/block', get_row_layout());
          endwhile;
        endif;
      endwhile;
    endif;
  }

  // ---------------------------------------- GET SECTIONS CALLBACK ---------------------------------------- 
  function bm_get_sections_callback($block)
  {
    $slug = str_replace('acf/', '', $block['name']);
    if (file_exists(get_theme_file_path("/template-parts/sections/{$slug}.php"))) {
      include(get_theme_file_path("/template-parts/sections/{$slug}.php"));
    }
  }

  // ---------------------------------------- CUSTOM ACF BLOCKS ---------------------------------------- 
  function bm_acf_init()
  {
    // Register Blocks
    if (function_exists('acf_register_block')) {
      acf_register_block(array(
        'name' => 'header',
        'title' => __('Header'),
        'description' => __('Header displayed at the top of each page.'),
        'render_callback'  => 'bm_get_sections_callback',
        'category' => 'formatting',
        'supports' => array('mode' => false, 'align' => false),
        'icon' => 'format-image',
        'mode' => 'edit',
        'keywords' => array('header', 'content'),
      ));

      acf_register_block(array(
        'name' => 'section',
        'title' => __('Sektion'),
        'description' => __('Content section that can contain different blocks'),
        'render_callback' => 'bm_get_sections_callback',
        'category' => 'common',
        'supports' => array('mode' => false, 'align' => false),
        'icon' => 'align-center',
        'mode' => 'edit',
        'keywords' => array('indhold', 'sektion', 'content')
      ));

      acf_register_block(array(
        'name' => 'example-section',
        'title' => __('Example Section'),
        'description' => __('Example section'),
        'render_callback' => 'bm_get_sections_callback',
        'category' => 'common',
        'supports' => array('mode' => false, 'align' => false),
        'icon' => 'align-center',
        'mode' => 'edit',
        'keywords' => array('example')
      ));
    }
  }
  add_action('acf/init', 'bm_acf_init');

  // ---------------------------------------- WORDPRESS GUTENBERG BLOCKS ---------------------------------------- 
  // Disable Default Gutenberg Blocks and allow only custom ACF blocks
  function bm_allowed_block_types($block_editor_context, $editor_context)
  {
    if (!empty($editor_context->post)) {
      return array(
        'acf/header',
        'acf/section',
        'acf/example-section',
      );
    }
    return $block_editor_context;
  }
  add_filter('allowed_block_types_all', 'bm_allowed_block_types', 10, 2);
}



//////////////////////////////////////////////////////////// SCRIPTS & STYLESHEETS ////////////////////////////////////////////////////////////

// ---------------------------------------- JQUERY ---------------------------------------- 
// Remove jQuery Script
function remove_core_jquery_version()
{
  wp_deregister_script('jquery');
}
add_action('wp_enqueue_scripts', 'remove_core_jquery_version');

// Add jQuery Script
function replace_core_jquery_version()
{
  wp_register_script('jquery', "https://code.jquery.com/jquery-3.6.0.min.js", array(), null, true);
}
add_action('wp_footer', 'replace_core_jquery_version');


// ---------------------------------------- SCRIPTS ---------------------------------------- 
function bm_enqueue_scripts()
{
  // wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js', array('jquery'), '3.9.1', true);
  wp_enqueue_script('bootstrap_js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array(), '5.1.3', true);
  bm_enqueue_asset('js', 'script', '/assets/js/script.min.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'bm_enqueue_scripts');

// ---------------------------------------- STYLESHEETS ---------------------------------------- 
function bm_enqueue_stylesheets()
{
  wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', array(), false, 'all');
  bm_enqueue_asset('css', 'style', '/assets/css/style.min.css', array('bootstrap'));
}
add_action('wp_enqueue_scripts', 'bm_enqueue_stylesheets');

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function bm_enqueue_custom_admin_style() {
  wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/assets/css/admin.css', false, '1.0.0' );
  wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'bm_enqueue_custom_admin_style' );



//////////////////////////////////////////////////////////// GENERAL FUNCTIONS ////////////////////////////////////////////////////////////

// ---------------------------------------- CHECK IF PLUGINS IS ACTIVE ---------------------------------------- 
function bm_is_plugin_active($plugin)
{
  $network_active = false;
  if (is_multisite()) {
    $plugins = get_site_option('active_sitewide_plugins');
    if (isset($plugins[$plugin])) {
      $network_active = true;
    }
  }
  return in_array($plugin, get_option('active_plugins')) || $network_active;
}

// ---------------------------------------- ENQUEUE ASSET WITH VERSION NUMBER ---------------------------------------- 
// Adds version number to asset if file is changed
function bm_enqueue_asset($type = '', $name = '', $path = '', $deps = array())
{
  $file_path = get_theme_file_path($path);
  $path = get_template_directory_uri() . $path;
  if ($type === "css") {
    wp_enqueue_style($name, $path, $deps, filemtime($file_path), 'all');
  } elseif ($type === "js") {
    wp_enqueue_script($name, $path, $deps, filemtime($file_path), true);
  }
}



//////////////////////////////////////////////////////////// THEME FUNCTIONS ////////////////////////////////////////////////////////////

// ...
// ...
// ...
