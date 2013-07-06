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
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri().auto_version('/assets/css/kremalicious2.min.css'); ?>">
	
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
  	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo home_url('/apple-touch-icon-144x144-precomposed.png'); ?>">
  	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo home_url('/apple-touch-icon-114x114-precomposed.png'); ?>">
  	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo home_url('/apple-touch-icon-72x72-precomposed.png'); ?>">
  	<link rel="apple-touch-icon-precomposed" href="<?php echo home_url('/apple-touch-icon-precomposed.png'); ?>">
  	<link rel="shortcut icon" href="<?php echo home_url('/favicon.ico'); ?>">
  	
  	<!-- Windows 8 Metro Tile Image -->
  	<meta name="msapplication-TileImage" content="<?php echo home_url('/metro-tile.png'); ?>"/>
  	<meta name="msapplication-TileColor" content="#015565"/>

</head>

<body <?php body_class(); ?>>
    
    <header role="banner" class="banner container">
    	<h1 class="banner-title row">
    	    <a class="banner-logo" class="hide-text" href="<?php echo home_url(); ?>">kremalicious</a>
    	</h1>
		<p class="banner-description">Blog of designer &amp; developer <a href="http://matthiaskretschmann.com">Matthias Kretschmann</a></p>
    </header>
    
	<section role="document" class="container">
		