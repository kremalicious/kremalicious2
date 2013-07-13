<?php

//
// Goodies Download Button Shortcode
//
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


//
// Relative Time
// props: http://terriswallow.com/weblog/2008/relative-dates-in-wordpress-templates/
//
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


//
// Get the Attachment ID from an Image URL
// thanks to 
// http://philipnewcomer.net/2012/11/get-the-attachment-id-from-an-image-url-in-wordpress/
//
function pn_get_attachment_id_from_url( $attachment_url = '' ) {
	global $wpdb;
	$attachment_id = false;

	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
	return $attachment_id;
}

//
// http://digwp.com/2010/02/custom-css-per-post/
//
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