<?php

function krlc2_scripts_styles() {
	
	// Styles
	wp_enqueue_style('krlc2_h5bp', get_template_directory_uri() . '/assets/css/h5bp.css', false, null);
	wp_enqueue_style('krlc2_grid', get_template_directory_uri() . '/assets/css/grid.css', false, null);
	wp_enqueue_style('krlc2_app', get_template_directory_uri() . '/assets/css/app.css', false, null);
	
	// Deregister default jquery, manual call in footer.php
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', '', '', '', true);
	}
	
	// comment reply script
	if (is_single() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	
	// Scripts, print in wp_footer
	wp_register_script('krlc2_scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', false, null, true);
	wp_enqueue_script('krlc2_scripts','','','', true);
	
}
add_action('wp_enqueue_scripts', 'krlc2_scripts_styles', 100);


function krlc2_admin_scripts_styles() {
	wp_enqueue_style('krlc2_admin_style', get_template_directory_uri() . '/assets/css/admin.css', false, null);
}
add_action('admin_enqueue_scripts', 'krlc2_admin_scripts_styles', 100);

function krlc2_login_scripts_styles() {
	wp_enqueue_style('krlc2_login_style', get_template_directory_uri() . '/assets/css/login.css', false, null);
}
add_action('login_enqueue_scripts', 'krlc2_login_scripts_styles', 100);