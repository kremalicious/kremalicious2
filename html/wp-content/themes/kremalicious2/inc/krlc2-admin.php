<?php

// http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
function roots_remove_dashboard_widgets() {
  //remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'normal');
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}

add_action('admin_init', 'roots_remove_dashboard_widgets');


//Custom Login Screen CSS
function krlc2_login_style() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri() . '/assets/css/login.css" />';
}
add_action('login_head', 'krlc2_login_style');


//Custom Admin Area CSS
function krlc2_admin_style() {
   echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/assets/css/admin.css" />';
}
add_action('admin_head', 'krlc2_admin_style');


// allow more tags in TinyMCE including <iframe> and <script>
function roots_change_mce_options($options) {
  $ext = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src],script[charset|defer|language|src|type]';
  if (isset($initArray['extended_valid_elements'])) {
    $options['extended_valid_elements'] .= ',' . $ext;
  } else {
    $options['extended_valid_elements'] = $ext;
  }
  return $options;
}
add_filter('tiny_mce_before_init', 'roots_change_mce_options');


// set the post revisions to 3
if (!defined('WP_POST_REVISIONS')) { define('WP_POST_REVISIONS', 3); }