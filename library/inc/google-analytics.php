<?php
/**
 * Author: VCUarts
 * URL: http://arts.vcu.edu
 *
 * @package VCUarts_Bones_WP
 */

/**
 * Create and return the GA snippet if
 * an ID is set
 */
function bones_ga_snippet( $ga_id = null ) {

  $ga_id = get_field( 'ga_code', 'options' ) ? get_field( 'ga_code', 'options' ) : null;
  if ( ! $ga_id || ! we_are_live() || is_user_logged_in() ) { return; }

  echo "
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', '" . esc_html( $ga_id ) . "', 'auto');
    ga('send', 'pageview');

  </script>
  ";
}

add_filter( 'wp_head', 'bones_ga_snippet', 20 );
