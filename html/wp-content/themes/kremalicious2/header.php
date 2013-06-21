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
	     
	 YOU EARNED THE GEEK ACHIEVEMENT 
	 FOR LOOKING AT MY SOURCE
	 
	 But because of all the minimizing and caching 
	 going on you better check out the code on 
	 github
	 _____________________________________________
	 
	 https://github.com/kremalicious/kremalicious2
	 
	 _____________________________________________
-->

<!--[if IE 9]>			<html class="no-js lt-ie10" lang="en" <?php krlc2_socialgraph_doctype(); ?>> <![endif]-->
<!--[if gt IE 9]><!-->	<html class="no-js" lang="en" <?php krlc2_socialgraph_doctype(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	
	<title>
		<?php 
			if (is_front_page()) {
				bloginfo('name'); echo ' &brvbar; '; bloginfo('description');
			} else {
				wp_title('&brvbar;', true, 'right'); bloginfo('name');
			} 
		?>
	</title>
	
	<?php 
	if (  (is_home()) || (is_front_page())  ) { ?>
		<meta name="description" content="<?php bloginfo('description'); ?>">
	<?php } 
	elseif ( is_singular() ) { 
		while( have_posts() ): the_post(); ?>
		<meta name="description" content="<?php echo strip_tags(get_the_excerpt()); ?>">
		<?php endwhile; ?>
	<?php } elseif (is_category()) { ?>
		<meta name="description" content="<?php echo strip_tags(category_description()); ?>">
	<?php } ?>
	
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta http-equiv="cleartype" content="on">
	
	<link rel="stylesheet" href="<?php echo site_url(auto_version('/wp-content/themes/kremalicious2/assets/css/kremalicious2.min.css')); ?>">
	
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/libs/modernizr-2.6.1.min.js"></script>
	<script src="//use.typekit.com/msu4qap.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	
	<script>
		var total = <?php echo $wp_query->max_num_pages; ?>;
	</script>
	
	<?php wp_head(); ?>
  	
  	<link rel="alternate"  href="http://kremalicious.com/feed/" type="application/rss+xml" title="Posts Feed"/>
  	<link rel="alternate"  href="http://kremalicious.com/comments/feed/" type="application/rss+xml" title="Comments Feed"/>
  	
  	<!-- Explicit touch icon declarations, otherwise won't work on Android -->
  	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo site_url('/apple-touch-icon-144x144-precomposed.png'); ?>">
  	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo site_url('/apple-touch-icon-114x114-precomposed.png'); ?>">
  	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo site_url('/apple-touch-icon-72x72-precomposed.png'); ?>">
  	<link rel="apple-touch-icon-precomposed" href="<?php echo site_url('/apple-touch-icon-precomposed.png'); ?>">
  	<link rel="shortcut icon" href="<?php echo site_url('/favicon.ico'); ?>">
  	
  	<!-- Windows 8 Metro Tile Image -->
  	<meta name="msapplication-TileImage" content="<?php echo site_url('/metro-tile.png'); ?>"/>
  	<meta name="msapplication-TileColor" content="#015565"/>

</head>

<body <?php body_class(); ?>>

	<section id="menubar-wrap" class="container">
		<div id="menubar" class="row">
			<header role="banner" class="banner">
				<h1 class="banner-title"><a id="logo" class="hide-text" href="/">kremalicious</a></h1>
			</header>
			<nav role="navigation" class="fade in">
				<ul>
					<li id="home"><a href="/"><i class="icon-home"></i> Home<span></span></a></li>
					<li class="dropdown" id="topicmenu">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#topicmenu">
							<i class="icon-reorder"></i><b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li <?php if ( is_category('goodies') ) echo 'class="current_page_item"';  ?>><a href="/goodies"><i class="icon-gift"></i> goodies</a></li>
							<li <?php if ( is_category('photos') ) echo 'class="current_page_item"';  ?>><a href="/photos"><i class="icon-picture"></i> photos</a></li>
							<li <?php if ( is_category('personal') ) echo 'class="current_page_item"';  ?>><a href="/personal"><i class="icon-user"></i> personal</a></li>
							<li <?php if ( is_category('design') ) echo 'class="current_page_item"';  ?>><a href="/design"><i class="icon-leaf"></i> design</a></li>
							<li <?php if ( is_category('photography') ) echo 'class="current_page_item"';  ?>><a href="/photography"><i class="icon-camera-retro"></i> photography</a></li>
						</ul>
					</li>						
				</ul>
			</nav>
			<div id="searchWrap">
				<?php get_search_form(); ?>
			</div>
		</div>
	</section>
	
	<section role="document" class="container">
		