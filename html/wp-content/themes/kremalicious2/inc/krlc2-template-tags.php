<?php

// Subscribe Buttons
function krlc2_subscribe_buttons() {
	echo '<p id="subscribe" class="hoverbuttons">
			  <a class="btn btn-tag rss" href="http://kremalicious.com/feed"><i class="icon-rss-sign"></i> RSS</a> <a class="btn btn-tag twitter" href="https://twitter.com/kremaliciouscom"><i class="icon-twitter-sign"></i> Twitter</a> <a class="btn btn-tag google" href="https://plus.google.com/100015950464424503954"><i class="icon-google-plus-sign"></i> Google+</a> <a class="btn btn-tag facebook" href="https://www.facebook.com/pages/kremalicious/154539134564052"><i class="icon-facebook-sign"></i> Facebook</a>
		  </p>';
}

// Github Repos
/*
function krlc2_show_github_repos() {
	require_once locate_template('/inc/lib/Github/Autoloader.php');
	Github_Autoloader::register();
	$github = new Github_Client();
	$myRepos = $github->getRepoApi()->getUserRepos('kremalicious');
	
	// Sort all results by pushed date, descending
	usort($myRepos, function($b,$a) {
		return strcmp($a['pushed_at'], $b['pushed_at']);
	});
	
	// limit the array to only 3
	$myRepos = array_slice($myRepos, 0, 3);
	
	// iterate over each remaining repo and output data
    foreach ($myRepos as $myRepo) {
        echo '<p class="col2"><a href="'.$myRepo['url'].'">'.$myRepo['name'].'</a> <small class="dimmed">'.$myRepo['description'].'</small></p>';
    }
}
*/

// Dribbble Shots
function krlc2_show_dribbble_shots() {
	require_once locate_template('/inc/lib/dribbble.php');
	$dribbble = new Dribbble();
	
	try {
	    $my_shots = $dribbble->get_player_shots('kremalicious','1' , '4');
	    foreach ($my_shots->shots as $shot) {
	        echo '<a class="col3" href="' . $shot->url . '"><img src="' . $shot->image_url . '" alt="' . $shot->title . '" /></a>';
	    }
	}
	catch (DribbbleException $e) {
	    echo 'Error: ' . $e->getMessage();
	}
}