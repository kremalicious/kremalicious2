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
	
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta http-equiv="cleartype" content="on">
	
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/libs/modernizr-2.5.3.min.js"></script>
	
	<?php wp_head(); ?>
	
	<script>
		TypekitConfig = {
			kitId: 'msu4qap',
			scriptTimeout: 3000
		};
		(function() {
			var h = document.getElementsByTagName('html')[0];
			h.className += ' wf-loading';
			var t = setTimeout(function() {
			  h.className = h.className.replace(/(\s|^)wf-loading(\s|$)/g, '');
			  h.className += ' wf-inactive';
			}, TypekitConfig.scriptTimeout);
			var tk = document.createElement('script');
			tk.src = '//use.typekit.com/' + TypekitConfig.kitId + '.js';
			tk.type = 'text/javascript';
			tk.async = 'true';
			tk.onload = tk.onreadystatechange = function() {
			  var rs = this.readyState;
			  if (rs && rs != 'complete' && rs != 'loaded') return;
			  clearTimeout(t);
			  try { Typekit.load(TypekitConfig); } catch (e) {}
			};
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(tk, s);
		})();
	</script>
  	
  	<link rel="alternate"  href="http://kremalicious.com/feed/" type="application/rss+xml" title="Posts Feed"/>
  	<link rel="alternate"  href="http://kremalicious.com/comments/feed/" type="application/rss+xml" title="Comments Feed"/>
  	
  	<!-- Explicit touch icon declarations, otherwise won't work on Android -->
  	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-144x144-precomposed.png">
  	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-114x114-precomposed.png">
  	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/apple-touch-icon-72x72-precomposed.png">
  	<link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-precomposed.png">
  	<link rel="shortcut icon" href="/favicon.ico">
  	
  	<link rel="image_src" href="/kremalicious512.png" />

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
								<li <?php if ( is_category('links') ) echo 'class="current_page_item"';  ?>><a href="/links"> <i class="icon-bookmark"></i> links</a></li>
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
		