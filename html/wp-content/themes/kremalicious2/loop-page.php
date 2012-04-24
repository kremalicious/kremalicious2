<?php if ( is_404() ) { ?>

	<h1>It's a 404</h1>

	<div class="alert alert-block fade in">
		<a class="close" data-dismiss="alert">&times;</a>
		<p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
	</div>
	
	<p>You might want to search for what you're looking for:</p>
	
	<?php get_search_form(); ?>

	<p>Or please try the following:</p>
	
	<ul>
		<li><?php _e('Check your spelling', 'roots'); ?></li>
		<li><?php printf(__('Return to the <a href="%s">home page</a>', 'roots'), home_url()); ?></li>
		<li><?php _e('Click the <a href="javascript:history.back()">Back</a> button', 'roots'); ?></li>
	</ul>
	
<?php } else { ?>

	<?php /* Start loop */ ?>
	<?php while (have_posts()) : the_post(); ?>
		
			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
				
				<header class="col2">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
				<div class="col4">
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<footer>
						<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
					</footer>
				</div>
					
			</article>
	      
	<?php endwhile; /* End loop */ ?>

<?php } ?>