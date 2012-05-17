<?php

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

require_once locate_template('/inc/krlc2-cleanup.php');
require_once locate_template('/inc/krlc2-scripts.php');
require_once locate_template('/inc/krlc2-admin.php');
require_once locate_template('/inc/krlc2-content.php');
require_once locate_template('/inc/krlc2-htaccess.php');

function kremalicious2_setup() {

  // http://codex.wordpress.org/Post_Thumbnails
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
  add_image_size( 'featureImageBig', 960, 300, true );
  add_image_size( 'featureImageStream', 540, 9999, true );
  add_image_size( 'goodieImage', 650, 9999, true );
  add_image_size( 'photoStream', 520, 9999 );
  add_image_size( 'photoArchive', 300, 9999 );
  add_image_size( 'photoBig', 960, 960 );

  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', array('link', 'image'));

}
add_action('after_setup_theme', 'kremalicious2_setup');


// add to virtual robots.txt
function krlc2_robots() {
	echo "Disallow: /wp-content/\n";
	echo "Disallow: /author/\n";
	echo "Disallow: /tag/\n";
	echo "Disallow: /type/\n";
	echo "Disallow: /links/\n";
	echo "Disallow: /search/\n";
	echo "Disallow: /page/\n";
	echo "Disallow: /*/page/\n";
	echo "Disallow: /20*/\n";
	echo "Disallow: /comments\n";
	echo "Disallow: */comments\n";
	echo "Disallow: */comment-page-*\n";
	echo "Disallow: /trackback\n";
	echo "Disallow: */trackback\n";
	echo "Disallow: /*?*\n";
	echo "Disallow: /*?\n";
}
add_action('do_robots', 'krlc2_robots');

