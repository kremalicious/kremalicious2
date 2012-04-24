<?php

// add custom post content
function krlc2_add_post_content($content) {
	
	global $post;
	$post_title = $post->post_title;
	$post_link = get_permalink($post->ID);
		
	if( is_feed() ) {
		$content .= '<p id="share">
						<a class="btn socialite twitter" href="https://twitter.com/intent/tweet?source=kremalicious&text='.urlencode($post_title) .'&url='. urlencode($post_link) .'&via=kremalicious" data-via="kremalicious"><i class="icon-twitter-sign"></i> Tweet</a>
					</p>';
	}
	return $content;
}
add_filter('the_content', 'krlc2_add_post_content');


// Add stuff to the RSS Feed items like post thumbnails, custom fields etc.

// Construct the source linked title for link posts
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
     
    if ( has_post_thumbnail($post->ID) && !has_post_format( 'image', $post->ID ) ) {
    	$content = '<div>' . get_the_post_thumbnail( $post->ID, 'featureImageStream', array('class' => 'center') ) . '</div>' . $content;
    } elseif ( has_post_thumbnail($post->ID) && has_post_format( 'image', $post->ID ) ) {
    	$content = '<div>' . get_the_post_thumbnail( $post->ID, 'photoStream', array('class' => 'center') ) . '</div>' . $content;    
    } else {
        $content = $content;
    }
    return $content;
}
add_filter( 'the_content_feed', 'krlc2_feed_post_thumb' );


// delay feed update
// thanks http://digwp.com/2010/04/wordpress-custom-functions-php-template-part-2/
function publish_later_on_feed($where) {
	global $wpdb;

	if (is_feed()) {
		// timestamp in WP-format
		$now = gmdate('Y-m-d H:i:s');

		// value for wait; + device
		$wait = '5'; // integer

		// http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_timestampdiff
		$device = 'MINUTE'; // MINUTE, HOUR, DAY, WEEK, MONTH, YEAR

		// add SQL-sytax to default $where
		$where .= " AND TIMESTAMPDIFF($device, $wpdb->posts.post_date_gmt, '$now') > $wait ";
	}
	return $where;
}
add_filter('posts_where', 'publish_later_on_feed');


// escape html entities in comments
// thanks http://digwp.com/2010/04/wordpress-custom-functions-php-template-part-2/
function encode_html_code_in_comment($source) {
	$encoded = preg_replace_callback('/<code>(.*?)<\/code>/ims',
	create_function('$matches', '$matches[1] = preg_replace(array("/^[\r|\n]+/i", "/[\r|\n]+$/i"), "", $matches[1]); 
	return "<pre><code>" . htmlentities($matches[1]) . "</"."code></pre>";'), $source);
	if ($encoded)
		return $encoded;
	else
		return $source;
}
add_filter('pre_comment_content', 'encode_html_code_in_comment');


// Grab EXIF Metadata from featured image
function krlc2_post_thumbnail_exif_data($postID = NULL) {
    // if $postID not specified, then get global post and assign ID
    if (!$postID) {
        global $post;
        $postID = $post->ID;
    }
    if (has_post_thumbnail($postID)) {
        // get the meta data from the featured image
        $postThumbnailID = get_post_thumbnail_id( $postID );
        $photoMeta = wp_get_attachment_metadata( $postThumbnailID );
        // if the shutter speed is not equal to 0
        if ($photoMeta['image_meta']['shutter_speed'] != 0) {
            // Convert the shutter speed to a fraction
            if ((1 / $photoMeta['image_meta']['shutter_speed']) > 1) {
                if ((number_format((1 / $photoMeta['image_meta']['shutter_speed']), 1)) == 1.3
                or number_format((1 / $photoMeta['image_meta']['shutter_speed']), 1) == 1.5
                or number_format((1 / $photoMeta['image_meta']['shutter_speed']), 1) == 1.6
                or number_format((1 / $photoMeta['image_meta']['shutter_speed']), 1) == 2.5) {
                    $photoShutterSpeed = "1/" . number_format((1 / $photoMeta['image_meta']['shutter_speed']), 1, '.', '') . "s";
                } else {
                    $photoShutterSpeed = "1/" . number_format((1 / $photoMeta['image_meta']['shutter_speed']), 0, '.', '') . "s";
                }
            } else {
                $photoShutterSpeed = $photoMeta['image_meta']['shutter_speed'] . " seconds";
            }
            // print our definition list
        ?>
        	
        <p id="exif"><span>ISO<?php echo $photoMeta['image_meta']['iso']; ?></span>  <span><?php echo $photoMeta['image_meta']['focal_length']; ?>mm</span>  <span>&fnof;/<?php echo $photoMeta['image_meta']['aperture']; ?></span>  <span><?php echo $photoShutterSpeed; ?></span></p>
        	
        <?php
        // if shutter speed exif is 0 then echo error message
        } else {
            echo '';
        }
    // if no featured image, echo error message
    } else {
        echo '<p>Featured image not found</p>';
    }
}

?>