
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
		
		<?php dynamic_sidebar('about-stuff'); ?>
		
		<div class="row">
			<div class="col2">
				<h3>Latest Client Work</h3>
				<p><a href="http://matthiaskretschmann.com" class="btn btn-tag icon-star">Portfolio</a></p>
			</div>
			<a href="http://matthiaskretschmann.com/" class="col2">
				<img src="http://matthiaskretschmann.com/folio/Portfolio-Mr-Reader-Theme-1.png" width="400" height="300" />
			</a>
			<a href="http://matthiaskretschmann.com/" class="col2">
				<img src="http://matthiaskretschmann.com/folio/Portfolio-IPP-Halle-1.png" width="400" height="300" />
			</a>
		</div>
		<div class="row">
			<div class="col2">
				<h3>Latest Dribbble</h3>
				<p><a href="#" class="btn btn-tag">Dribbble</a></p>
			</div>
			<a href="http://dribbble.com/shots/540014-kremalicious2" class="col2">
				<img src="http://dribbble.com/system/assets/2525/73955/screenshots/540014/dribbble-kremalicious2.png" width="400" height="300" />
			</a>
			<a href="http://dribbble.com/shots/497613-GlassFruit-Growl-Style" class="col2">
				<img src="http://dribbble.com/system/assets/2525/73955/screenshots/497613/dribbble_glassfruit.png" width="400" height="300" />
			</a>
		</div>
	</div>

</article>