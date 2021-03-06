<?php

function krlc2_scripts() {

	// Deregister default jquery
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', get_template_directory_uri() . '/assets/js/libs/jquery.min.js', '', null, true);
		wp_enqueue_script( 'jquery','','','', true );
	}

	// Scripts, print in wp_footer
	wp_register_script('krlc2_scripts', get_template_directory_uri().auto_version('/assets/js/kremalicious2.min.js'), array('jquery'), null, true);
	wp_enqueue_script('krlc2_scripts','', array('jquery'),'', true);

	// prevent syntaxhighlighting core css from loading
	wp_deregister_style('syntaxhighlighter-core');
	// register our own theme
	// http://www.viper007bond.com/wordpress-plugins/syntaxhighlighter/adding-a-new-theme/
	wp_register_style('syntaxhighlighter-theme-kremalicious2', get_template_directory_uri().auto_version('/assets/css/syntaxhighlighting.min.css'), false, null);

}
add_action('wp_enqueue_scripts', 'krlc2_scripts', 100);


function krlc2_admin_scripts_styles() {
	wp_enqueue_style('krlc2_admin_style', get_template_directory_uri().auto_version('/assets/css/wp-admin.min.css'), false, null);
}
add_action('admin_enqueue_scripts', 'krlc2_admin_scripts_styles', 100);


function krlc2_login_scripts_styles() {
	wp_enqueue_style('krlc2_login_style', get_template_directory_uri().auto_version('/assets/css/wp-login.min.css'), false, null);
}
add_action('login_enqueue_scripts', 'krlc2_login_scripts_styles', 100);

// add syntax highlighting theme to plugin
// http://www.viper007bond.com/wordpress-plugins/syntaxhighlighter/adding-a-new-theme/
function krlc2_syntax_theme( $themes ) {
    $themes['kremalicious2'] = 'kremalicious2';

    return $themes;
}
add_filter( 'syntaxhighlighter_themes', 'krlc2_syntax_theme' );

// load syntaxhighlighting css in admin area for preview, but only on plugin option page
function krlc2_syntax_theme_admin() {
	$screen = get_current_screen();
	if (is_object($screen) && $screen->id == 'settings_page_syntaxhighlighter') {
		wp_deregister_style('syntaxhighlighter-core');
		wp_register_style('syntaxhighlighter-theme-kremalicious2', get_template_directory_uri().auto_version('/assets/css/syntaxhighlighting.min.css'), false, null);
	}
}
add_action('admin_enqueue_scripts', 'krlc2_syntax_theme_admin', 100);