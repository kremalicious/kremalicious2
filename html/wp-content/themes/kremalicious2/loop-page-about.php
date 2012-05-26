
<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>

<article <?php post_class() ?> id="aboutPage">

	<section class="row" id="hello">
		<div class="col2">
			<h2>What’s this</h2>
	
			<p>This blog is where I post random stuff mostly about design, front-end development, photography.</p>
			
			<p>You can subscribe by clicking one of these buttons:</p>
			
			<?php krlc2_subscribe_buttons(); ?>
		</div>
		<div class="col4">
			<?php the_content(); ?>
		</div>
		
	</section>

<?php endwhile; /* End loop */ ?>
	
	<section class="row" id="contact">
		<div class="col2">
			<h2>Contact</h2>
	
			Twitter
			Email desk@kremalicious.com
		</div>
		<div class="col4">
			<h2>Where to find me</h2>
	
			* Portfolio
			* Twitter
			* Google+
			* Dribbble
			* Zerply
			* 500px
			* Flickr
			* Github
		</div>
	</section>
	
	<section id="work">
		<div class="row">
			<div class="col2">
				<h3>Latest Code</h3>
				<p><a href="#" class="btn btn-tag icon-github-alt">Github</a></p>
			</div>
			<p class="col1"><a href="">kremalicious2</a> <small class="dimmed">WordPress theme &amp; site files powering kremalicious.com</small></p>
			<p class="col1"><a href="">wp-icons-template</a> <small class="dimmed">Admin icons template &amp; functions for WordPress</small></p>
			<p class="col1"><a href="">csspaperstack</a> <small class="dimmed">Pure CSS3 based solution for creating the illusion of stacked papers</small></p>
			<p class="col1"><a href="">glassfruit</a> <small class="dimmed">Growl notification style inspired by displays of a particular fruit company</small></p>
		</div>
		<div class="row">
			<div class="col2">
				<h3>Latest Client Work</h3>
				<p><a href="http://matthiaskretschmann.com" class="btn btn-tag">Portfolio</a></p>
			</div>
			<div class="col2">
				<img src="http://matthiaskretschmann.com/folio/Portfolio-Mr-Reader-1.jpg" width="400" height="300" />
			</div>
			<div class="col2">
				<img src="http://matthiaskretschmann.com/folio/Portfolio-IPP-Halle-1.png" width="400" height="300" />
			</div>
		</div>
		<div class="row">
			<div class="col2">
				<h3>Latest Dribbble</h3>
				<p><a href="#" class="btn btn-tag">Dribbble</a></p>
			</div>
			<div class="col2">
				<img src="http://placekitten.com/315/200" width="315" height="200" />
			</div>
			<div class="col2">
				<img src="http://placekitten.com/315/200" width="315" height="200" />
			</div>
		</div>
	</div>

	Credits/Colophon

</article>