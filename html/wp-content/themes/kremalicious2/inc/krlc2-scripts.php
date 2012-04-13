<?php

function roots_scripts() {
  wp_enqueue_style('krlc2_h5bp', get_template_directory_uri() . '/assets/css/h5bp.css', false, null);
  wp_enqueue_style('krlc2_grid', get_template_directory_uri() . '/assets/css/grid.css', false, null);
  wp_enqueue_style('krlc2_fontawesome', get_template_directory_uri() . '/assets/fonts/fontawesome/css/font-awesome.css', false, null);
  wp_enqueue_style('krlc2_app', get_template_directory_uri() . '/assets/css/app.css', false, null);

  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '', '', '', false);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_register_script('roots_plugins', get_template_directory_uri() . '/assets/js/plugins.js', false, null, false);
  wp_register_script('roots_script', get_template_directory_uri() . '/assets/js/script.js', false, null, false);
  wp_enqueue_script('roots_plugins');
  wp_enqueue_script('roots_script');
}

add_action('wp_enqueue_scripts', 'roots_scripts', 100);
