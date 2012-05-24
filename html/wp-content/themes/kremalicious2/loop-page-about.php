
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

	<section class="row" id="work">
		<div class="col2">
			<h2><i class="icon-github-alt"></i>Code</h2>
			<img src="http://placekitten.com/315/200" width="315" height="200" />
		</div>
		<div class="col2">
			<h2>Client Work</h2>
			<img src="http://placekitten.com/315/200" width="315" height="200" />
		</div>
		<div class="col2">
			<h2>Dribbble</h2>
			<img src="http://placekitten.com/315/200" width="315" height="200" />
		</div>
	</div>
	
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

	Credits/Colophon

</article>