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
    					<a class="more-link" href="'.$linkURL.'">Go to source &#187;</a> <br />
    					<a href="'. $postLink .'" title="Permalink for this post">&#8734;</a>
    				  </p>';
    				  
    $shareStuff = '<br />
    			   <hr />
    			   <div>
    			     <a href="https://twitter.com/intent/tweet?source=kremalicious&text='.urlencode($postLink) .'&url='. urlencode($postLink) .'&via=kremalicious" data-via="kremalicious">Tweet this</a>, or follow me on Twitter <a href="https://twitter.com/kremalicious">here</a>.
    			   </div>';
    
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


// Relative Time
// props: http://terriswallow.com/weblog/2008/relative-dates-in-wordpress-templates/
function krlc2_how_long_ago($timestamp){
	$difference = time() - $timestamp;
	
	if($difference >= 60*60*24*365){        // if more than a year ago
	    $int = intval($difference / (60*60*24*365));
	    $s = ($int > 1) ? 's' : '';
	    $r = $int . ' year' . $s . ' ago';
	} elseif($difference >= 60*60*24*7*5){  // if more than five weeks ago
	    $int = intval($difference / (60*60*24*30));
	    $s = ($int > 1) ? 's' : '';
	    $r = $int . ' month' . $s . ' ago';
	} elseif($difference >= 60*60*24*7){        // if more than a week ago
	    $int = intval($difference / (60*60*24*7));
	    $s = ($int > 1) ? 's' : '';
	    $r = $int . ' week' . $s . ' ago';
	} elseif($difference >= 60*60*24){      // if more than a day ago
	    $int = intval($difference / (60*60*24));
	    $s = ($int > 1) ? 's' : '';
	    $r = $int . ' day' . $s . ' ago';
	} elseif($difference >= 60*60){         // if more than an hour ago
	    $int = intval($difference / (60*60));
	    $s = ($int > 1) ? 's' : '';
	    $r = $int . ' hour' . $s . ' ago';
	} elseif($difference >= 60){            // if more than a minute ago
	    $int = intval($difference / (60));
	    $s = ($int > 1) ? 's' : '';
	    $r = $int . ' minute' . $s . ' ago';
	} else {                                // if less than a minute ago
	    $r = 'moments ago';
	}	
	return $r;
}

// http://digwp.com/2010/02/custom-css-per-post/
function artStyle() {
    global $post;
    if (is_single()) {
        $currentID = $post->ID;
        $serverfilepath = TEMPLATEPATH.'/assets/css/poststyle-'.$currentID.'.css';
        $publicfilepath = get_bloginfo('template_url');
        $publicfilepath .= '/assets/css/poststyle-'.$currentID.'.css';
        if (file_exists($serverfilepath)) {
            echo "<link rel='stylesheet' type='text/css' href='$publicfilepath' media='screen' />"."\n";
        }
    }
}
add_action('wp_head', 'artStyle');

?>