<?php get_sidebar(); ?>

<section role="main" class="col4 grid2-col1">
	
	<?php /* If there are no posts to display, such as an empty archive page */ ?>
	<?php if (!have_posts()) { ?>
	  <div class="alert alert-block fade in">
	    <a class="close" data-dismiss="alert">&times;</a>
	    <p><?php _e('Sorry, no results were found.', 'roots'); ?></p>
	  </div>
	  <?php get_search_form(); ?>
	<?php } ?>

	<?php /* Start loop */ ?>
	<?php while (have_posts()) : the_post(); ?>
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<header>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</header>
			
		</article>
	    
	<?php endwhile; /* End loop */ ?>
	
	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php if ($wp_query->max_num_pages > 1) { ?>
	  <nav id="post-nav" class="pager">
	    <div class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></div>
	    <div class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></div>
	  </nav>
	<?php } ?>

</section>