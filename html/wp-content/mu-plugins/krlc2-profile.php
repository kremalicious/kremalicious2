<?php
/*
Plugin Name: kremalicious2 User Profile
Plugin URI: http://kremalicious.com
Description: User Profile Stuff for kremalicious.com
Version: 0.0.2
Author: Matthias Kretschmann
Author URI: http://mkretschmann.com
*/

/**
 * Copyright (c) 2012 Matthias Kretschmann. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * **********************************************************************
 */
 
class krlc2_userprofile {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	function __construct() {
		add_filter('user_contactmethods', array( $this, 'krlc2_userprofile_remove_contact_methods' ), 10, 1);
	    add_filter('user_contactmethods', array( $this, 'krlc2_userprofile_add_contact_methods' ), 10, 1 );
		add_shortcode('kremalicious_contact', array( $this, 'krlc2_contact_methods') );
	    // Remove Color styles from profile page
		remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');
	}
	
	/*--------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/
	
	/*
     * Remove Contact Methods
    */
    function krlc2_userprofile_remove_contact_methods($userprofile) {
	    unset($userprofile['aim']);
		unset($userprofile['yim']);
    }
    
	/*
     * Add more Contact Methods
     */
	function krlc2_userprofile_add_contact_methods($userprofile) {		
		$userprofile['blog'] 		= 'Blog<br /><small style="color:#666666;font-style:italic">full URL including http://</small>';
		$userprofile['twitter'] 	= 'Twitter<br /><small style="color:#666666;font-style:italic">only the username</small>';
		$userprofile['googleplus'] 	= 'Googe+<br /><small style="color:#666666;font-style:italic">full URL including http://</small>';
		$userprofile['dribbble'] 	= 'Dribbble<br /><small style="color:#666666;font-style:italic">only the username</small>';
		$userprofile['github'] 		= 'Github<br /><small style="color:#666666;font-style:italic">only the username</small>';
		$userprofile['zerply'] 		= 'Zerply<br /><small style="color:#666666;font-style:italic">only the username</small>';
		$userprofile['500px'] 		= '500px<br /><small style="color:#666666;font-style:italic">only the username</small>';
		$userprofile['flickr'] 		= 'Flickr<br /><small style="color:#666666;font-style:italic">only the username</small>';
		
		return $userprofile;
	}
	
	/*
     * Create a Shortcode [kremalicious_contact]
     * 
     * output as tag buttons
     */
	function krlc2_contact_methods() {
	
		// Get the one
		$users = get_users('include=1');
					
		ob_start();
		// loop through results although we just have one
		foreach ($users as $user) {
			
			// Get me
	        $kremalicious = $user->ID;
	        
	        // Email
	        echo '<a class="btn btn-tag icon-envelope-alt" href="mailto:' . antispambot(get_the_author_meta('user_email', $kremalicious)) . '">Email</a>';
	        // Portfolio site
	        if ( get_the_author_meta( 'user_url', $kremalicious) ) {		
	        	echo '<a class="btn btn-tag icon-star" rel="me" href="'. get_the_author_meta('user_url', $kremalicious) .'">Portfolio</a> ';
	        }
	        // Twitter
	        if ( get_the_author_meta( 'twitter', $kremalicious) ) {		
	        	echo '<a class="btn btn-tag icon-twitter" rel="me" href="https://twitter.com/'. get_the_author_meta('twitter', $kremalicious) .'">Twitter</a> ';
	        }
	        // Google+
	        if ( get_the_author_meta( 'googleplus', $kremalicious) ) {		
	        	echo '<a class="btn btn-tag icon-google-plus" rel="me" href="'. get_the_author_meta('googleplus', $kremalicious) .'">Google+</a> ';
	        }
	        // Github
	        if ( get_the_author_meta( 'github', $kremalicious) ) {		
	        	echo '<a class="btn btn-tag icon-github-alt" href="https://github.com/'. get_the_author_meta('github', $kremalicious) .'">GitHub</a> ';
	        }
	        // Dribbble
	        if ( get_the_author_meta( 'dribbble', $kremalicious) ) {		
	        	echo '<a class="btn btn-tag" href="http://dribbble.com/'. get_the_author_meta('dribbble', $kremalicious) .'">Dribbble</a> ';
	        }
	        // Zerply
	        if ( get_the_author_meta( 'zerply', $kremalicious) ) {		
	        	echo '<a class="btn btn-tag" href="http://zerply.com/'. get_the_author_meta('zerply', $kremalicious) .'">Zerply</a> ';
	        }
	        // 500px
	        if ( get_the_author_meta( '500px', $kremalicious) ) {		
	        	echo '<a class="btn btn-tag" href="http://500px.com/'. get_the_author_meta('500px', $kremalicious) .'">500px</a> ';
	        }
	        // Flickr
	        if ( get_the_author_meta( 'flickr', $kremalicious) ) {		
	        	echo '<a class="btn btn-tag icon-flickr-alt" href="http://www.flickr.com/photos/'. get_the_author_meta('flickr', $kremalicious) .'">Flickr</a> ';
	        }
        }
	    $list = ob_get_clean();
	    return $list;

	} // END krlc2_contact_methods();
  
}
new krlc2_userprofile();