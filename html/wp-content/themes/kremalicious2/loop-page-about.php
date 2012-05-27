
<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>

<article <?php post_class() ?> id="aboutPage">
	
	<section class="row">
		<div class="col6">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-kremalicious-g-profile.png" alt="logo-kremalicious-g-profile" width="940" height="180" />
		</div>
	</section>
	
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
	
		<!--
<div class="row">
			<div class="col2">
				<h3>Latest Code</h3>
				<p><a href="https://github.com/kremalicious" title="Github Profile" class="btn btn-tag icon-github-alt">Github</a></p>
			</div>
			<div class="col4">
				<?php krlc2_show_github_repos(); ?>
			</div>
		</div>
-->
		<div class="row">
			<div class="col2">
				<h3>Latest Client Work</h3>
				<p><a href="http://matthiaskretschmann.com" class="btn btn-tag icon-star">Portfolio</a></p>
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
				<h3>Latest Dribbbles</h3>
				<p><a href="#" class="btn btn-tag">Dribbble</a></p>
			</div>
			<div class="col4">
				<?php krlc2_show_dribbble_shots(); ?>
			</div>
		</div>
	</div>

</article>