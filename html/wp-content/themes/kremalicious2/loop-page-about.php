
<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>

<article <?php post_class() ?> id="aboutPage">
	
	<header class="row featureTitle">
		<div class="col6">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-kremalicious-g-profile.png" alt="logo-kremalicious-g-profile" width="940" height="180" />
		</div>
	</header>
	
	<section class="row" id="hello">
		<div class="col2">
	
			<p>This blog is where I post random stuff mostly about design, front-end development, photography.</p>
			
			<p>You can subscribe by clicking one of these buttons:</p>
			
			<?php krlc2_subscribe_buttons(); ?>
		</div>
		<div class="col4 entry-content">
			<?php the_content(); ?>
		</div>
		
	</section>

<?php endwhile; /* End loop */ ?>

	<section id="work">
	
		<!--<div class="row">
			<div class="col2">
				<h3>Latest Code</h3>
				<p><a href="https://github.com/kremalicious" title="GitHub Profile" class="btn btn-tag icon-github-alt">View all GitHub repos</a></p>
			</div>
			<div class="col4">
				
			</div>
		</div>-->
		<div class="row">
			<div class="col2">
				<h3>Latest Work</h3>
				<p><a href="http://matthiaskretschmann.com" class="btn btn-tag icon-star">View Portfolio</a></p>
			</div>
			<div class="col4">
				<a href="http://matthiaskretschmann.com/" class="col3">
					<img src="http://matthiaskretschmann.com/folio/Portfolio-Mr-Reader-Theme-1.png" width="400" height="300" />
				</a>
				<a href="http://matthiaskretschmann.com/" class="col3">
					<img src="http://matthiaskretschmann.com/folio/Portfolio-IPP-Halle-1.png" width="400" height="300" />
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col2">
				<h3>Latest Dribbble</h3>
				<p><a href="http://dribbble.com/kremalicious" class="btn btn-tag">View all Dribbble shots</a></p>
			</div>
			<div class="col4">
				<?php krlc2_show_dribbble_shots(); ?>
			</div>
		</div>
	</div>

</article>