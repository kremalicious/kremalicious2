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
			<?php comments_template(); ?>
		</div>
			
	</article>
      
<?php endwhile; /* End loop */ ?>