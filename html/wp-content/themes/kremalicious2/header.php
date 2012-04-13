<!doctype html>
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

  <meta name="viewport" content="width=device-width">

  <script src="<?php echo get_template_directory_uri(); ?>/assets/js/libs/modernizr-2.5.3.min.js"></script>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/assets/js/libs/jquery-1.7.2.min.js"><\/script>')</script>

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<div class="container" id="menubar-wrap">
		<div class="row" id="menubar">
			<header role="banner" class="col2">
				<h1>kremalicious</h1>
			</header>
			<nav role="navigation" class="col4">
				<ul>
					<li><a href="/">Home</a></li>
					<li><a href="#">Goodies</a></li>
					<li><a href="#">About</a></li>
				</ul>
			</nav>
		<!--	<form method="get" id="searchform" class="col1">
				<label for="s" class="assistive-text">Search</label>
				<input type="text" class="field" name="s" id="s" placeholder="Search">
				<input type="submit" class="submit" name="submit" id="searchsubmit" value="Search">
			</form>-->
		</div>
	</div>
	
	<div class="container" role="document">
		