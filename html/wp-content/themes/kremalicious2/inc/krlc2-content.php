<?php


// Add stuff to the RSS Feed items like post thumbnails, custom fields etc.

// Construct the title for link posts
function krlc2_feed_linked_title($permalink) {
	global $wp_query;
	if ( $url = get_post_meta($wp_query->post->ID, '_format_link_url', true) ) {
		return $url;
	}
	return $permalink;
}
add_filter('the_permalink_rss', 'krlc2_feed_linked_title');

// show post thumbnails in feeds
// modified from http://digwp.com/2010/06/show-post-thumbnails-in-feeds/
function krlc2_feed_post_thumb( $content ) {

    global $post;
     
    if (has_post_thumbnail($post->ID)) {
    	$content = '<div>' . get_the_post_thumbnail( $post->ID, 'featureImageBig', array('class' => 'center') ) . '</div>' . $content;
    } else {
        $content = $content;
    }
    return $content;
}
add_filter( 'the_content_feed', 'krlc2_feed_post_thumb' );


// http://www.wprecipes.com/how-to-get-the-first-image-from-the-post-and-display-it
//function catch_that_image() {
//	global $post, $posts;
//	$first_img = '';
//	ob_start();
//	ob_end_clean();
//	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
//	$first_img = $matches [1] [0];
//	
//	return $first_img;
//}

?>