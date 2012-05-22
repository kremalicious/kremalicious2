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
	
	// Default Settings
	////////////////////////////////////////
	
	// Reading
	update_option('posts_per_page', 15);
	update_option('posts_per_rss', 100);
	
	// Media
	update_option('medium_size_w', 540);
	update_option('medium_size_h', 540);
	update_option('large_size_w', 960);
	update_option('large_size_h', 960);
	update_option('upload_path', 'media');
	update_option('uploads_use_yearmonth_folders', 0);
	
	// Discussion
	update_option('default_ping_status', 'closed');
	update_option('default_pingback_flag', 1);
	update_option('thread_comments', 1);
	update_option('thread_comments_depth', 2);
	
	// Permalinks
	update_option('permalink_structure', '/%postname%/');
	update_option('category_base', 'topics');

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
	echo "Disallow: /comments\n";
	echo "Disallow: */comments\n";
	echo "Disallow: */comment-page-*\n";
	echo "Disallow: /trackback\n";
	echo "Disallow: */trackback\n";
	echo "Disallow: /*?*\n";
	echo "Disallow: /*?\n";
}
add_action('do_robots', 'krlc2_robots');

