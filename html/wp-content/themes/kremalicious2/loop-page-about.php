
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

</article>