<!doctype html>
<!--
		      ___           ___     
		     /__/\         /__/|    
		    |  |::\       |  |:|    
		    |  |:|:\      |  |:|    
		  __|__|:|\:\   __|  |:|    
		 /__/::::| \:\ /__/\_|:|____
		 \  \:\~~\__\/ \  \:\/:::::/
		  \  \:\        \  \::/~~~~ 
		   \  \:\        \  \:\     
		    \  \:\        \  \:\    
		     \__\/         \__\/ 
-->

<!--[if IE 8]>    		<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if IEMobile 7 ]> 	<html class="no-js iem7" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> 	<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	
	<title><?php wp_title('&brvbar;', true, 'right'); bloginfo('name'); ?></title>
	
	<?php 
	if (  (is_home()) || (is_front_page())  ) { ?>
		<meta name="description" content="<?php bloginfo('description'); ?>">
	<?php } 
	elseif ( is_singular() ) { 
		while( have_posts() ): the_post(); ?>
		<meta name="description" content="<?php echo strip_tags(get_the_excerpt()); ?>">
		<?php endwhile; ?>
	<?php } elseif (is_archive()) { ?>
		<meta name="description" content="<?php echo strip_tags(category_description()); ?>">
	<?php } ?>
	
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta http-equiv="cleartype" content="on">
	
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/libs/modernizr-2.5.3.min.js"></script>
	<script src="//use.typekit.com/msu4qap.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/kremalicious2.min.css">
	
	<?php wp_head(); ?>
  	
  	<link rel="alternate"  href="http://kremalicious.com/feed/" type="application/rss+xml" title="Posts Feed"/>
  	<link rel="alternate"  href="http://kremalicious.com/comments/feed/" type="application/rss+xml" title="Comments Feed"/>
  	
  	<!-- Explicit touch icon declarations, otherwise won't work on Android -->
  	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-144x144-precomposed.png">
  	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-114x114-precomposed.png">
  	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/apple-touch-icon-72x72-precomposed.png">
  	<link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-precomposed.png">
  	<link rel="shortcut icon" href="/favicon.ico">
  	
  	<?php if ( !is_singular() ) {  ?>
  	<link rel="image_src" href="/kremalicious512.png" />
  	<?php } ?>

</head>

<body <?php body_class(); ?>>

	<div class="container" id="menubar-wrap">
		<div class="row" id="menubar">
			
			<header role="banner">
				<h1><a id="logo" class="ir" href="/">kremalicious</a></h1>
			</header>
			<div class="col6">
				<nav role="navigation" class="clearfix alignleft">
					<ul>
						<li id="home"><a href="/"><i class="icon-home"></i> Home<span></span></a></li>
						<li class="dropdown" id="topicmenu">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#topicmenu">
								<i class="icon-align-justify"></i><b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li <?php if ( is_category('goodies') ) echo 'class="current_page_item"';  ?>><a href="/goodies"><i class="icon-gift"></i> goodies</a></li>
								<li <?php if ( is_category('photos') ) echo 'class="current_page_item"';  ?>><a href="/photos"><i class="icon-picture"></i> photos</a></li>
								<li <?php if ( is_category('personal') ) echo 'class="current_page_item"';  ?>><a href="/personal"><i class="icon-user"></i> personal</a></li>
								<li <?php if ( is_category('design') ) echo 'class="current_page_item"';  ?>><a href="/design"><i class="icon-leaf"></i> design</a></li>
								<li <?php if ( is_category('photography') ) echo 'class="current_page_item"';  ?>><a href="/photography"><i class="icon-camera-retro"></i> photography</a></li>
							</ul>
						</li>						
						<!--<li><a href="/about"> <i class="icon-user"></i> About</a></li>-->
					</ul>
				</nav>
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
	
	<div class="container" id="content" role="document">
		