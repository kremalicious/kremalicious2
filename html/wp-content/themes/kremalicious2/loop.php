<?php get_sidebar(); ?>

<section role="main" class="col4">
	
	<?php /* If there are no posts to display, such as an empty archive page */ ?>
	<?php if (!have_posts()) { ?>
	  <div class="alert alert-block fade in">
	    <a class="close" data-dismiss="alert">&times;</a>
	    <p><?php _e('Sorry, no results were found.', 'roots'); ?></p>
	  </div>
	  <?php get_search_form(); ?>
	<?php } ?>

	<?php /* Start loop */ ?>
	<?php 
		$first = true;
		while (have_posts()) : the_post(); ?>
		
		<?php if ( $first && is_front_page() && !is_paged() ) { ?>
		
			<article id="post-<?php the_ID(); ?>" class="hentry hero">
				<header>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</header>
		    	<div class="entry-content">
		    		<?php the_content(); ?>
		    	</div>
		    	<?php $first = false; ?>
			</article>
		
		<?php } else { ?>
		
			<article id="post-<?php the_ID(); ?>" class="hentry">
		    	<header class="clearfix">
		    		<div class="col1">
		    			<i class="icon-flag"></i>
		    		</div>
		    		<div class="col5">
		    			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		    		</div>
		    	</header>
			</article>
			
		<?php } ?>
			
		
	    
	<?php endwhile; /* End loop */ ?>
	
	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php if ($wp_query->max_num_pages > 1) { ?>
		<nav id="post-nav" class="pager">
			<p class="previous alignleft"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></p>
			<p class="next alignright"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></p>
		</nav>
	<?php } ?>

</section>