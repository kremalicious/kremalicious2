<?php

// http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
function roots_remove_dashboard_widgets() {
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'normal');
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}
add_action('admin_init', 'roots_remove_dashboard_widgets');

/**
 * ATTENTION PLEASE DASHBOARD WIDGET
 * ===========================================
 * adapted from 
 * http://rick.jinlabs.com/2009/02/01/how-add-options-to-your-wordpress-27-dashboard-widgets/
 */
 
/**
 *** Content of Dashboard-Widget
 */
function krlc2_attention_widget() {
    $widget_options = krlc2_attention_widget_Options();
    
    echo '<p>The following message is currently ';
    if ($widget_options['attentionMessageShown'] == 1) {
    	echo '<a href="/wp-admin/index.php?edit=krlc2_attention_widget"><strong class="attentionMessageStatus active">Active</strong></a>';
    } else {
    	echo '<a href="/wp-admin/index.php?edit=krlc2_attention_widget"><strong class="attentionMessageStatus inactive">Inactive</strong></a>';
    }
    echo '</p>';
	echo '<p class="alert alert-block">'. wp_kses_data( $widget_options["attentionMesssage"] ) .'</p>';
}
 
/**
 *** add Dashboard Widget via function wp_add_dashboard_widget()
 */
function krlc2_attention_widget_Init() {
	wp_add_dashboard_widget( 'krlc2_attention_widget', __( 'Attention Please!' ), 'krlc2_attention_widget', 'krlc2_attention_widget_Setup' );
}
 
function krlc2_attention_widget_Options() {
	$defaults = array( 'attentionMesssage' => 0, 'attentionMessageShown' => 0);
	if ( ( !$options = get_option( 'krlc2_attention_widget' ) ) || !is_array($options) )
		$options = array();
	return array_merge( $defaults, $options );
}
 
function krlc2_attention_widget_Setup() {
 
	$options = krlc2_attention_widget_Options();
 
	if ( 'post' == strtolower($_SERVER['REQUEST_METHOD']) && isset( $_POST['widget_id'] ) && 'krlc2_attention_widget' == $_POST['widget_id'] ) {
		foreach ( array( 'attentionMessageShown', 'attentionMesssage' ) as $key )
				$options[$key] = $_POST[$key];
		update_option( 'krlc2_attention_widget', $options );
	}
 	
 	echo '<p><label for="attentionMessageShown">';
 	echo '  <input id="attentionMessageShown" name="attentionMessageShown" type="checkbox" value="1" ';
 	if ( 1 == $options['attentionMessageShown'] ) {
 		echo ' checked="checked"';
 	}
 	echo '/> Activate Message?';
	echo '</label></p>';
	 	
 	echo '<p>
 	 		<label for="attentionMesssage">Le Message</label><br />
 		    <textarea id="attentionMesssage" name="attentionMesssage" class="regular-text" rows="4" >'. wp_kses_data( $options['attentionMesssage'] ) .'</textarea><p>';

}
add_action('wp_dashboard_setup', 'krlc2_attention_widget_Init');


/** 
 * STYLES DROPDOWN FOR EDITOR
 * ===========================================
 * adapted from 
 * http://theme.it/an-alternative-to-the-shortcode-madness-part-1/
 *
 * Filter TinyMCE Buttons
 */
function krlc2_mce_buttons_1( $buttons ) {
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
add_filter( 'mce_buttons_1', 'krlc2_mce_buttons_1' );

/**
 * Add Style Options
 * {@link http://tinymce.moxiecode.com/examples/example_24.php }
 */
function krlc2_tiny_mce_before_init( $settings ) {
  $settings['theme_advanced_buttons1'] = 'formatselect,|,bold,italic,|,bullist,numlist,|,blockquote,|,link,unlink,|,styleselect,|,undo,redo,|,spellchecker,wp_fullscreen';
  $settings['theme_advanced_buttons2'] = '';
  $settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4,code,pre,';

  $style_formats = array(
      array( 'title' => 'Button Link',         	'selector' => 'a',  'classes' => 'btn', 'remove' => 'empty' ),
      array( 'title' => 'Primary Button Link',	'selector' => 'a',  'classes' => 'btn btn-primary', 'remove' => 'empty' ),
      //array( 'title' => 'Download Button', 	'inline' => 'a',  'classes' => 'btn btn-primary' ),
  );

  $settings['style_formats'] = json_encode( $style_formats );
  
  $ext = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src],script[charset|defer|language|src|type]';
  if (isset($settings['extended_valid_elements'])) {
    $settings['extended_valid_elements'] .= ',' . $ext;
  } else {
    $settings['extended_valid_elements'] = $ext;
  }
  return $settings;
}
add_filter( 'tiny_mce_before_init', 'krlc2_tiny_mce_before_init' );


/**
 * Simplify options for `page` and `post` screens
 * ===========================================
 */
function krlc2_post_type_support() {
	// for posts
	remove_post_type_support( 'post', 'author' );
	remove_post_type_support( 'post', 'custom-fields' );
	remove_post_type_support( 'post', 'excerpt' );
	remove_post_type_support( 'post', 'trackbacks');
	
	// for pages
	remove_post_type_support( 'page', 'author' );
	remove_post_type_support( 'page', 'comments' );
	remove_post_type_support( 'page', 'custom-fields' );
	remove_post_type_support( 'page', 'discussion' );
	remove_post_type_support( 'page', 'excerpt' );
	remove_post_type_support( 'page', 'trackbacks');
}
add_action('admin_init', 'krlc2_post_type_support');

/**
 * set the post revisions to 3
 * ===========================================
 */
if (!defined('WP_POST_REVISIONS')) { define('WP_POST_REVISIONS', 3); }