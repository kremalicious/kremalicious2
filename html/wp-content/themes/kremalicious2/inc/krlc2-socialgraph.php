<?php
// 
// OpenGraph
// http://ogp.me/
// #
// Facebook OpenGraph
// https://developers.facebook.com/docs/opengraph/
// #
// Twitter Cards
// https://dev.twitter.com/docs/cards
// 

// html doctype, just make it a template tag
function krlc2_socialgraph_doctype() {
	echo 'xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"';
}

// Find the best image to use
// adapted from http://yoast.com/facebook-open-graph-protocol/
function krlc2_get_socialgraph_image($postID = NULL) {
	
	// if $postID not specified, then get global post and assign ID
	if (!$postID) {
	    global $post, $posts;
	    $postID 	 = $post->ID;
	    $postContent = $post->post_content;
	}
	
	// photo post
	if ( has_post_format( 'image', $postID ) ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'photoBig', '' );
		$socialgraphimage	= $src[0];
	} 
	// post with post thumbnail but no photo post
	elseif (!has_post_format( 'image', $postID ) && has_post_thumbnail($postID)) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'featureImage', '' );
		$socialgraphimage	= $src[0];
	} 
	// all other posts
	else {
		// find the first image in post content
		//global $post, $posts;
		$socialgraphimage = '';
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',
		$postContent, $matches);
		$socialgraphimage = $matches [1] [0];
	}
	// default fallback image
	if ( empty($socialgraphimage) OR !is_singular() ) {
		$socialgraphimage = "/kremalicious512.png";
	}
	return $socialgraphimage;
}

// The head output
function krlc2_socialgraph_head_tags($postID = NULL) {
	
    // if $postID not specified, then get global post and assign ID
    if (!$postID) {
        global $post;
        $postID = $post->ID;
    }
    
    // Conditionally define the values
    if ( is_home()) { 
    	$ogTitle		= get_bloginfo('name');
    	$ogDescription 	= get_bloginfo('description');
    	$ogURL			= get_bloginfo('wpurl');
    } elseif (is_category()) { 
    	$category 		= get_the_category(); 
    	$ogTitle		= $category[0]->cat_name;
    	$ogDescription	= strip_tags(category_description($category[0]->cat_ID));
    	$ogURL			= get_category_link($category[0]->cat_ID);
    } else { 
    	$ogTitle		= get_the_title($postID);
    	$ogDescription	= strip_tags(get_the_excerpt());
    	$ogURL			= get_permalink($postID);
    }
    if (is_single() || is_page()) { 
    	$ogType		= 'article';
    } else { 
    	$ogType		= 'website';
    }
	
	// Output meta tags
	if ( has_post_format( 'image', $postID ) && !is_category() ) { ?>
		<meta name="twitter:card" value="photo">
	<?php } else { ?>
		<meta name="twitter:card" value="summary">
	<?php } ?>
	<meta name="twitter:site" value="@kremaliciouscom">
	<meta name="twitter:creator" value="@kremalicious">
	
	<meta property="og:title" content="<?php echo $ogTitle ?>" />
	<meta property="og:description" content="<?php echo $ogDescription ?>"/>
	<meta property="og:url" content="<?php echo $ogURL ?>"/>
	<meta property="og:image" content="<?php echo krlc2_get_socialgraph_image(); ?>"/>
	<meta property="og:type" content="<?php echo $ogType ?>"/>
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
	<meta property="fb:page_id" content="154539134564052" />

<?php }
// add it to the head
add_action( 'wp_head', 'krlc2_socialgraph_head_tags', 5 );