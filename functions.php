<?php
/**
 * Author: VCUarts
 * URL: http://arts.vcu.edu
 *
 * @package VCUarts_Bones_WP
 */

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// Google Analytics
require_once( 'library/inc/google-analytics.php' );

// Disables trackbacks/pingbacks
require_once( 'library/inc/disable-trackbacks.php' );

// Minimal Branding Bar Styles
define( 'VCUARTS_BAR_MIN_STYLES', true );


/**
 * LAUNCH BONES
 */
function bones_ahoy() {

  /** Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' ); */

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

/** Thumbnail sizes
// add_image_size( 'bones-thumb-600', 600, 150, true );
// add_image_size( 'bones-thumb-300', 300, 100, true );

// add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

// function bones_custom_image_sizes( $sizes ) {
//     return array_merge( $sizes, array(
//         'bones-thumb-600' => __('600px by 150px'),
//         'bones-thumb-300' => __('300px by 100px'),
//     ) );
// }
 */


/**
 * THEME CUSTOMIZE
 */
function bones_theme_customizer( $wp_customize ) {
  $wp_customize->remove_section( 'colors' );
  $wp_customize->remove_section( 'background_image' );
}

add_action( 'customize_register', 'bones_theme_customizer' );


/**
 * EXTERNAL FONTS
 */
function bones_fonts() {
  wp_enqueue_style( 'googleFonts', 'https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic' );
}

add_action( 'wp_enqueue_scripts', 'bones_fonts' );


/**
 * Testing our environment.
 *
 * @returns true if on production server false if not
 */
function we_are_live() {
  $host = home_url();

  if ( preg_match( '/\.dev/', $host ) ) {
    return false;
  }
  return true;
}


// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
    'caption',
    'search-form',
	) );


  if ( ! function_exists( 'the_field' ) ) {
    add_action( 'admin_notices', 'bones_acf_notice' );
  }

  function bones_acf_notice() {
    ?>
    <div class="update-nag notice" style="display:block; margin:20px 0;">
      <h3><?php echo( 'Install Advanced Custom Fields Pro please or nothing will work probably!' ); ?></h3>
    </div>
    <?php
  }

  /*
  * ACF options page
  */
  if ( function_exists( 'acf_add_options_page' ) ) {

  acf_add_options_page(array(
    'page_title'  => 'Site Options',
    'menu_title'  => 'Site Options',
    'menu_slug'   => 'options',
    'capability'  => 'edit_posts',
    'redirect'    => false,
  ));

}
