<?php

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
                    $photoShutterSpeed = "1/" . number_format((1 / $photoMeta['image_meta']['shutter_speed']), 1, '.', '') . " second";
                } else {
                    $photoShutterSpeed = "1/" . number_format((1 / $photoMeta['image_meta']['shutter_speed']), 0, '.', '') . " second";
                }
            } else {
                $photoShutterSpeed = $photoMeta['image_meta']['shutter_speed'] . " seconds";
            }
            // print our definition list
        ?>
        	<h2>Image Metadata</h2>
            <dl id="exif">
            	<?php if ( $photoMeta['image_meta']['title'] ) { ?>
            		<dt>Title</dt>
            		<dd><?php echo $photoMeta['image_meta']['title']; ?></dd>
            	<?php } ?>
            	
            	<?php if ( $photoMeta['image_meta']['caption'] ) { ?>
            		<dt>Caption</dt>
            		<dd><?php echo $photoMeta['image_meta']['caption']; ?></dd>
            	<?php } ?>
            	
            	<?php if ( $photoMeta['image_meta']['copyright'] ) { ?>
            		<dt>Copyright</dt>
            		<dd><?php echo $photoMeta['image_meta']['copyright']; ?></dd>
            	<?php } ?>
            	
                <dt>Date Taken</dt>
                <dd><?php echo date("d M Y, H:i:s", $photoMeta['image_meta']['created_timestamp']); ?></dd>
                <dt>Camera</dt>
                <dd><?php echo $photoMeta['image_meta']['camera']; ?></dd>
                <dt>Focal Length</dt>
                <dd><?php echo $photoMeta['image_meta']['focal_length']; ?>mm</dd>
                <dt>Aperture</dt>
                <dd>f/<?php echo $photoMeta['image_meta']['aperture']; ?></dd>
                <dt>ISO</dt>
                <dd><?php echo $photoMeta['image_meta']['iso']; ?></dd>
                <dt>Shutter Speed</dt>
                <dd><?php echo $photoShutterSpeed; ?></dd>
            </dl>
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
    	$content = '<div>' . get_the_post_thumbnail( $post->ID, 'featureImageBig', array('class' => 'center') ) . '</div>' . $content;
    } elseif ( has_post_thumbnail($post->ID) && has_post_format( 'image', $post->ID ) ) {
    	$content = '<div>' . get_the_post_thumbnail( $post->ID, 'photoBig', array('class' => 'center') ) . '</div>' . $content;    
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