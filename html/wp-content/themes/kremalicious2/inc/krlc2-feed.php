<?php
    
//
// Add stuff to the RSS Feed items like post thumbnails, custom fields etc.
//

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
    $featuredImage 	= get_the_post_thumbnail( $post->ID, 'featureImage', array('class' => 'center') );
    $photoImage		= get_the_post_thumbnail( $post->ID, 'photoStream', array('class' => 'center') );
    $linkURL 		= get_post_meta($post->ID, 'format_link_url', true);
    
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
    	$content = '<div><a href="'.$postLink.'">' . $photoImage . '</a></div>' . $content . $shareStuff;    
    } elseif ( has_post_format( 'link' ) ) {
    	$content = $content . $linkPostStuff . $shareStuff;
    } else {
        $content = $content . $shareStuff;
    }
    return $content;
}
add_filter( 'the_content_feed', 'krlc2_feed_content' );
    
?>