<?php
/*
* Google Analytics snippet
*/

function bones_ga_snippet($gaID = null) {

  $gaID = get_field('ga_code', 'options') ? get_field('ga_code', 'options') : null;
  if (!$gaID || !we_are_live() || is_user_logged_in()) { return; }

  $analytics_code = "
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', '".$gaID."', 'auto');
    ga('send', 'pageview');

  </script>
  ";

  echo $analytics_code;
}

add_filter('wp_head', 'bones_ga_snippet', 20);
?>
