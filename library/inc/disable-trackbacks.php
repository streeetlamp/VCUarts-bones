<?php
/**
 * Author: VCUarts
 * URL: http://arts.vcu.edu
 *
 * @package VCUarts_Bones_WP
 */

/**
 * Disables pingbacks
 */
function bones_filter_xmlrpc_method( $methods ) {
  unset( $methods['pingback.ping'] );
  return $methods;
}
add_filter( 'xmlrpc_methods', 'bones_filter_xmlrpc_method', 10, 1 );


/**
 * Remove pingback header
 */
function bones_filter_headers( $headers ) {
  if ( isset( $headers['X-Pingback'] ) ) {
    unset( $headers['X-Pingback'] );
  }
  return $headers;
}
add_filter( 'wp_headers', 'bones_filter_headers', 10, 1 );


/**
 * Kill trackback rewrite rule
 */
function bones_filter_rewrites( $rules ) {
  foreach ( $rules as $rule => $rewrite ) {
    if ( preg_match( '/trackback\/\?\$$/i', $rule ) ) {
      unset( $rules[ $rule ] );
    }
  }
  return $rules;
}
add_filter( 'rewrite_rules_array', 'bones_filter_rewrites' );


/**
 * Kill bloginfo('pingback_url')
 */
function bones_kill_pingback_url( $output, $show ) {
  if ( 'pingback_url' === $show ) {
    $output = '';
  }
  return $output;
}
add_filter( 'bloginfo_url', 'bones_kill_pingback_url', 10, 2 );


/**
 * Disable XMLRPC call
 */
function bones_kill_xmlrpc( $action ) {
  if ( 'pingback.ping' === $action ) {
    wp_die( 'Pingbacks are not supported', 'Not Allowed!' );
  }
}
add_action( 'xmlrpc_call', 'bones_kill_xmlrpc' );
