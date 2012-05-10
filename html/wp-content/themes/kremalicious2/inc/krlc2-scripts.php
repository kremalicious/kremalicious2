<?php

function krlc2_scripts() {
	
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
	wp_register_script('krlc2_scripts', get_template_directory_uri() . '/assets/js/kremalicious2.min.js', false, null, true);
	wp_enqueue_script('krlc2_scripts','','','', true);
	
}
add_action('wp_enqueue_scripts', 'krlc2_scripts', 100);


function krlc2_admin_scripts_styles() {
	wp_enqueue_style('krlc2_admin_style', get_template_directory_uri() . '/assets/css/admin.min.css', false, null);
	?>
	<script src="//use.typekit.com/msu4qap.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<?php 
}
add_action('admin_enqueue_scripts', 'krlc2_admin_scripts_styles', 100);

function krlc2_login_scripts_styles() {
	wp_enqueue_style('krlc2_login_style', get_template_directory_uri() . '/assets/css/login.min.css', false, null);
}
add_action('login_enqueue_scripts', 'krlc2_login_scripts_styles', 100);