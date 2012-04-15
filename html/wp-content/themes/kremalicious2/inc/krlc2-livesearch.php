<?php

function krlc2_autocomplete_init() {
	//wp_register_style('krlc2-jquery-ui','http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
	wp_register_script( 'krlc2_livesearch', get_template_directory_uri() . '/inc/js/krlc2search.js', array('jquery','jquery-ui-autocomplete'),null,true);
	wp_localize_script( 'krlc2_livesearch', 'krlc2LiveSearch', array('url' => admin_url( 'admin-ajax.php' )));	

	// Function to fire whenever search form is displayed
	add_action( 'wp_enqueue_scripts', 'krlc2_autocomplete_search_form' );

	// Functions to deal with the AJAX request - one for logged in users, the other for non-logged in users.
	add_action( 'wp_ajax_krlc2_autocompletesearch', 'krlc2_autocomplete_suggestions' );
	add_action( 'wp_ajax_nopriv_krlc2_autocompletesearch', 'krlc2_autocomplete_suggestions' );
}
add_action( 'init', 'krlc2_autocomplete_init' );

function krlc2_autocomplete_search_form(){
	wp_enqueue_script( 'krlc2_livesearch' );
	//wp_enqueue_style( 'krlc2-jquery-ui' );
}

function krlc2_autocomplete_suggestions(){
	// Query for suggestions
	$posts = get_posts( array(
		's' =>$_REQUEST['term'],
	) );

	// Initialise suggestions array
	$suggestions=array();

	global $post;
	foreach ($posts as $post): setup_postdata($post);
		// Initialise suggestion array
		$suggestion = array();
		$suggestion['label'] = esc_html($post->post_title);
		$suggestion['link'] = get_permalink();

		// Add suggestion to suggestions array
		$suggestions[]= $suggestion;
	endforeach;

	// JSON encode and echo
	$response = $_GET["callback"] . "(" . json_encode($suggestions) . ")";
	echo $response;

	// Don't forget to exit!
	exit;
}
