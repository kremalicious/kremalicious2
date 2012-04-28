<?php

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

// add arrow to link posts in feed
function krlc2_feed_title_arrow($title) {
	
	global $post;
	
	if ( has_post_format( 'link', $post->ID ) ) {
		$title = $title.' &#187;';
	} else {
		$title = $title;
	}

    return $title;
}
add_filter('the_title_rss', 'krlc2_feed_title_arrow');

// show post thumbnails in feeds
// modified from http://digwp.com/2010/06/show-post-thumbnails-in-feeds/
function krlc2_feed_content( $content ) {

    global $post;
    $postTitle 		= $post->post_title;
    $postLink 		= get_permalink($post->ID);
    $featuredImage 	= get_the_post_thumbnail( $post->ID, 'featureImageStream', array('class' => 'center') );
    $photoImage		= get_the_post_thumbnail( $post->ID, 'photoStream', array('class' => 'center') );
    $linkURL 		= get_post_meta($post->ID, '_format_link_url', true);
    
    $linkPostStuff = '<p>
    					<a class="more-link" href="'.$linkURL.'">Go to Article &#187;</a> <br />
    					<a href="'. $postLink .'" title="Permalink for this post">&#8734;</a>
    				  </p>';
    				  
    $shareStuff = '<br /><hr /><p id="share">
    				<a class="btn socialite twitter" href="https://twitter.com/intent/tweet?source=kremalicious&text='.urlencode($postTitle) .'&url='. urlencode($postLink) .'&via=kremalicious" data-via="kremalicious"><i class="icon-twitter-sign"></i> Tweet</a>. And you should follow me on Twitter <a href="https://twitter.com/kremalicious">here</a>.
    			   </p>';
    
    if ( has_post_thumbnail($post->ID) && !has_post_format( 'image', $post->ID ) ) {
    	$content = '<div>' . $featuredImage . '</div>' . $content . $shareStuff;
    } elseif ( has_post_thumbnail($post->ID) && has_post_format( 'image', $post->ID ) ) {
    	$content = '<div>' . $photoImage . '</div>' . $content . $shareStuff;    
    } elseif ( has_post_format( 'link' ) ) {
    	$content = $content . $linkPostStuff . $shareStuff;
    } else {
        $content = $content . $shareStuff;
    }
    return $content;
}
add_filter( 'the_content_feed', 'krlc2_feed_content' );


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


// Redirect all feeds to Feedburner
// taken from FeedBurner FeedSmith plugin http://support.google.com/feedburner/bin/answer.py?hl=en&answer=78483
function krlc2_feed_redirect() {
	global $wp, $feed;
	if ( is_feed() && $feed != 'comments-rss2' && !is_single() && $wp->query_vars['category_name'] == '') {
		if (function_exists('status_header')) status_header( 302 );
		header("Location:http://feeds.feedburner.com/kremalicious");
		header("HTTP/1.1 302 Temporary Redirect");
		exit();
	} elseif (is_feed() && ($feed == 'comments-rss2') ) {
		if (function_exists('status_header')) status_header( 302 );
		header("Location:http://feeds.feedburner.com/kremalicious_comments");
		header("HTTP/1.1 302 Temporary Redirect");
		exit();
	}
}

function krlc2_check_url() {
	switch (basename($_SERVER['PHP_SELF'])) {
		case 'wp-rss.php':
		case 'wp-rss2.php':
		case 'wp-atom.php':
		case 'wp-rdf.php':
			if (function_exists('status_header')) status_header( 302 );
			header("Location:http://feeds.feedburner.com/kremalicious");
			header("HTTP/1.1 302 Temporary Redirect");
			exit();
			break;
		case 'wp-commentsrss2.php':
			if (function_exists('status_header')) status_header( 302 );
			header("Location:http://feeds.feedburner.com/kremalicious_comments");
			header("HTTP/1.1 302 Temporary Redirect");
			exit();
			break;
	}
}

if (!preg_match("/feedburner|feedvalidator/i", $_SERVER['HTTP_USER_AGENT'])) {
	add_action('template_redirect', 'krlc2_feed_redirect');
	add_action('init','krlc2_check_url');
}


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


// Goodies Download Button Shortcode
function krlc2_goodie_download_shortcode( $atts, $content = null ) {
 	
 	extract( shortcode_atts( array(
      'version' => ''
    ), $atts ) );
  	
  	if ($version) { 
  		$packageVersion = 'v'.$version.' | '; 
  	} else {
  		$packageVersion = '';
  	}
  	
 	$attachments = get_children( array('post_parent' => get_the_ID(), 'post_status' => 'inherit', 'post_type' => 'attachment', 'order' => 'ASC', 'orderby' => 'menu_order ID', 'post_mime_type' => 'application/zip' ) );
 	
 	if ($attachments) {
 		$attachment = array_shift($attachments);
 		
 		$attachment = '<p>
 						 <a class="btn btn-block icon-download-alt" href="'.wp_get_attachment_url($attachment->ID) .'">Download <span>'.$packageVersion.' zip</span></a>
 					   </p>';
 
		return $attachment;
	}
 
}
add_shortcode('download_button', 'krlc2_goodie_download_shortcode');


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