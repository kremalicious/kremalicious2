<!doctype html>
<!--[if IE 7]>    		<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    		<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if IEMobile 7 ]> 	<html class="no-js iem7" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> 	<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	
	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
	
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta http-equiv="cleartype" content="on">
	
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/libs/modernizr-2.5.3.min.js"></script>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/assets/js/libs/jquery-1.7.2.min.js"><\/script>')</script>
	
	<link href='http://fonts.googleapis.com/css?family=PT+Serif:400,700italic,700,400italic' rel='stylesheet' type='text/css'>
	<link rel="alternate"  href="http://feeds.feedburner.com/kremalicious" type="application/rss+xml" title="RSS Feed"/>
	
  	<?php wp_head(); ?>

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
						<li><a href="/about"> <i class="icon-user"></i> About</a></li>
					</ul>
				</nav>
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
	
	<div class="container" id="content" role="document">
		