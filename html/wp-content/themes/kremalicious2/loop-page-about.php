
<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>

<article id="aboutPage" <?php post_class() ?>>
	
	<header class="featureTitle">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-kremalicious-g-profile.png" alt="logo-kremalicious-g-profile" width="940" height="180" />
	</header>
	
	<section id="hello">
		
		<div id="hello-blog">
			<p>This blog is where I post random stuff mostly about design, front-end development, photography.</p>
			
			<?php krlc2_subscribe_buttons(); ?>
		</div>
		
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</section>

<?php endwhile; /* End loop */ ?>

	<section id="work">
	
		<!--
		<h3>Latest Code</h3>
		<p><a href="https://github.com/kremalicious" title="GitHub Profile" class="btn btn-tag icon-github-alt">View all GitHub repos</a></p>
		-->
		<header>
			<h3>Latest Work</h3>
			<p><a href="http://matthiaskretschmann.com" class="btn btn-tag icon-star">View Portfolio</a></p>
		</header>
		
		<div class="work-content">
			<a href="http://matthiaskretschmann.com/">
				<img src="http://matthiaskretschmann.com/folio/Portfolio-Mr-Reader-Theme-1.png" width="400" height="300" />
			</a>
			<a href="http://matthiaskretschmann.com/">
				<img src="http://matthiaskretschmann.com/folio/Portfolio-IPP-Halle-1.png" width="400" height="300" />
			</a>
		</div>
		
		<header>
			<h3>Latest Dribbble</h3>
			<p><a href="http://dribbble.com/kremalicious" class="btn btn-tag">View all Dribbble shots</a></p>
		</header>
		
		<div class="work-content">
			<?php krlc2_show_dribbble_shots(); ?>
		</div>
		
	</section>

</article>