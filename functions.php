<?php
/**
 * Theme functions.
 */
namespace DustPressStarter;
require_once "vendor/autoload.php";

// Enable DustPress.
if ( function_exists( 'dustpress' ) ) {
  \DustPress();
}
else {
  wp_die('DustPress must be installed when using the DustPress Starter Theme!');
}

// Define some constants.
if ( ! defined( 'ASSETS_DIR' ) ) {
  define( 'ASSETS_DIR', get_template_directory_uri() . '/assets' );
}

/**
 * Theme setup
 */
function setup() {
  // Make theme available for translation
  \load_theme_textdomain( 'dustpress-demo', get_template_directory() . '/lang' );
  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  \add_theme_support( 'title-tag' );
  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  \register_nav_menus( [
    'primary_navigation' => __( 'Primary navigation', 'dustpress-demo' ),
  ] );
  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  \add_theme_support( 'post-thumbnails' );
  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  \add_theme_support(
    'html5',
    [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ]
  );
}

\add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );

/**
 * Add theme scripts and styles.
 */
function scripts_and_styles() {
  $theme      = \wp_get_theme();
  $version    = $theme->get( 'Version' );

  \wp_enqueue_script( 'theme-js', ASSETS_DIR . '/scripts/theme.js', [ 'jquery' ], $version, true );
  \wp_enqueue_style( 'normalize', ASSETS_DIR . '/stylesheets/normalize.css', [], '5.0.0', 'all' );
  \wp_enqueue_style( 'theme-css', ASSETS_DIR . '/stylesheets/theme.css', [], $version, 'all' );
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\scripts_and_styles' );



add_action( 'init', function () {

  // You'll want to replace the values below with your own.
  register_post_type( 'events', // change the name
    array(
      'labels' => array(
        'name' => __( 'Events' ), // change the name
        'singular_name' => __( 'event' ), // change the name
      ),
      'public' => true,
      'supports' => array ( 'title', 'editor', 'custom-fields', 'page-attributes', 'thumbnail' ), // do you need all of these options?
      // 'taxonomies' => array( 'category', 'post_tag' ), // do you need categories and tags?
      // 'hierarchical' => true,
      // 'menu_icon' => get_bloginfo( 'template_directory' ) . "/images/icon.png",
      'rewrite' => array ( 'slug' => __( 'events' ) ) // change the name
    )
  );

});

