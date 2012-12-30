<?php

// Subscribe Buttons
function krlc2_subscribe_buttons() {
	echo '<div id="subscribe">
			<p>
			  <a class="btn rss" href="http://kremalicious.com/feed"><i class="icon-rss"></i> <span>RSS</span></a> <a class="btn twitter" href="https://twitter.com/kremaliciouscom"><i class="icon-twitter"></i> <span>Twitter</span></a> <a class="btn google" href="https://plus.google.com/100015950464424503954" rel="publisher"><i class="icon-google-plus"></i> <span>Google+</span></a> <a class="btn facebook" href="https://www.facebook.com/pages/kremalicious/154539134564052"><i class="icon-facebook"></i> <span>Facebook</span></a>
			</p>
		  </div>';
}

// Post date under single view
function krlc2_post_date() {
	$time = '<time rel="tooltip" title="'. get_the_date() .'" datetime="'. get_the_time('c') .'" pubdate>' . krlc2_how_long_ago(get_the_time('U')) .'</time>';
	return $time;
}

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

// Github Repos
//function krlc2_show_github_repos() {
//	require_once locate_template('/inc/lib/Github/Autoloader.php');
//	Github_Autoloader::register();
//	$github = new Github_Client();
//	$myRepos = $github->getRepoApi()->getUserRepos('kremalicious');
//	
	// Sort all results by pushed date, descending
//	usort($myRepos, function($b,$a) {
//		return strcmp($a['pushed_at'], $b['pushed_at']);
//	});
//	
	// limit the array to only 3
//	$myRepos = array_slice($myRepos, 0, 3);
//	
	// iterate over each remaining repo and output data
//    foreach ($myRepos as $myRepo) {
//    	if ( $myRepo['fork'] == true ) {
//	    	echo '<p class="col2 fork">';
//    	} else {
//	    	echo '<p class="col2">';
//    	}
//        echo '<a href="'.$myRepo['url'].'">'.$myRepo['name'].'</a> <small class="dimmed">'.$myRepo['description'].'</small></p>';
//    }
//}

// Dribbble Shots
function krlc2_show_dribbble_shots() {
	require_once locate_template('/inc/lib/dribbble.php');
	$dribbble = new Dribbble();
	
	try {
	    $my_shots = $dribbble->get_player_shots('kremalicious','1' , '4');
	    foreach ($my_shots->shots as $shot) {
	        echo '<a href="' . $shot->url . '"><img src="' . $shot->image_url . '" alt="' . $shot->title . '" /></a>';
	    }
	}
	catch (DribbbleException $e) {
	    echo 'Error: ' . $e->getMessage();
	}
}