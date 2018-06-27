<?php
/**
 * Author: Cody Whitby
 * URL: https://github.com/streeetlamp/bare-wp
 *
 * @package Bare_WP_Theme
 */

/**
 * Disables pingbacks
 */
function bare_filter_xmlrpc_method( $methods ) {
  unset( $methods['pingback.ping'] );
  return $methods;
}
add_filter( 'xmlrpc_methods', 'bare_filter_xmlrpc_method', 10, 1 );


/**
 * Remove pingback header
 */
function bare_filter_headers( $headers ) {
  if ( isset( $headers['X-Pingback'] ) ) {
    unset( $headers['X-Pingback'] );
  }
  return $headers;
}
add_filter( 'wp_headers', 'bare_filter_headers', 10, 1 );


/**
 * Kill trackback rewrite rule
 */
function bare_filter_rewrites( $rules ) {
  foreach ( $rules as $rule => $rewrite ) {
    if ( preg_match( '/trackback\/\?\$$/i', $rule ) ) {
      unset( $rules[ $rule ] );
    }
  }
  return $rules;
}
add_filter( 'rewrite_rules_array', 'bare_filter_rewrites' );


/**
 * Kill bloginfo('pingback_url')
 */
function bare_kill_pingback_url( $output, $show ) {
  if ( 'pingback_url' === $show ) {
    $output = '';
  }
  return $output;
}
add_filter( 'bloginfo_url', 'bare_kill_pingback_url', 10, 2 );


/**
 * Disable XMLRPC call
 */
function bare_kill_xmlrpc( $action ) {
  if ( 'pingback.ping' === $action ) {
    wp_die( 'Pingbacks are not supported', 'Not Allowed!' );
  }
}
add_action( 'xmlrpc_call', 'bare_kill_xmlrpc' );
