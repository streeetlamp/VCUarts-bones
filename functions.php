<?php
/*
Author: VCUarts
URL: http://arts.vcu.edu
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// Google Analytics
require_once( 'library/inc/google-analytics.php' );

// Disables trackbacks/pingbacks
require_once( 'library/inc/disable-trackbacks.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );


/*********************
LAUNCH BONES
*********************/

function bones_ahoy() {

  //Allow editor style.
  // add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );


  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
// add_image_size( 'bones-thumb-600', 600, 150, true );
// add_image_size( 'bones-thumb-300', 300, 100, true );


// add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

// function bones_custom_image_sizes( $sizes ) {
//     return array_merge( $sizes, array(
//         'bones-thumb-600' => __('600px by 150px'),
//         'bones-thumb-300' => __('300px by 100px'),
//     ) );
// }


/************* THEME CUSTOMIZE *********************/
function bones_theme_customizer($wp_customize) {
  $wp_customize->remove_section('colors');
  $wp_customize->remove_section('background_image');
}

add_action( 'customize_register', 'bones_theme_customizer' );


/************* EXTERNAL FONTS *********************/
function bones_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}

add_action('wp_enqueue_scripts', 'bones_fonts');


/*
we_are_live() is a function for testing our environment. 
@returns true if on production server false if not
*/

function we_are_live(){
  $current_server = $_SERVER['HTTP_HOST']; 

  if ( $current_server == 'arts.vcu.edu' ){
    return true;
  }
  return false;
}

/*
get_development_scripts() tests our environment with we_are_live()
@returns the appropriate scripts if local via wp_footer filter 
*/
function get_development_scripts() {

  // abort if live
  if ( we_are_live() ) {
    return;
  }

  $dev_script = "<script src='//localhost:35729/livereload.js'></script>";
  echo $dev_script;
}

add_filter('wp_footer', 'get_development_scripts', 20);


// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
    'caption',
    'search-form'
	) );


  /*
  * ACF options page
  */
  if( function_exists('acf_add_options_page') ) {
    
  acf_add_options_page(array(
    'page_title'  => 'Site Options',
    'menu_title'  => 'Site Options',
    'menu_slug'   => 'options',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));

}

/* DON'T DELETE THIS CLOSING TAG */ ?>
