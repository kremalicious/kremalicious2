<?php

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

require_once locate_template('/inc/krlc2-cleanup.php');     // cleanup
require_once locate_template('/inc/krlc2-scripts.php');     // modified scripts output
require_once locate_template('/inc/krlc2-admin.php');     	// admin stuff

function kremalicious2_setup() {

  // tell the TinyMCE editor to use editor-style.css
  // if you have issues with getting the editor to show your changes then
  // use this instead: add_editor_style('editor-style.css?' . time());
  add_editor_style('assets/css/editor.css');

  // http://codex.wordpress.org/Post_Thumbnails
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);

  // http://codex.wordpress.org/Post_Formats
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'roots')
  ));
}

add_action('after_setup_theme', 'kremalicious2_setup');
