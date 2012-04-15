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
		while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" class="hentry clearfix">
				
				<?php if (has_post_format( 'link' )) { ?>
					
					<div class="col1 posttype">
						<i class="icon-bookmark"></i>
					</div>
					<div class="col5">
						<header>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <i class="icon-external-link"></i></a></h2>
						</header>
						<?php the_content(); ?>
					</div>
					
				<?php } else { ?>
					
					<div class="col1 posttype">
						<i class="icon-asterisk"></i>
					</div>
					<div class="col5">
						<header>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</header>
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>">
								<img class="featureImage" src="http://placekitten.com/450/140" />
							</a>
						<?php } ?>
						<?php the_excerpt(); ?>
					</div>
					
				<?php } ?>
				
		    	
			</article>

	<?php endwhile; /* End loop */ ?>
	
	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php if ($wp_query->max_num_pages > 1) { ?>
		<nav id="post-nav" class="pager">
			<p class="previous alignleft"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></p>
			<p class="next alignright"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></p>
		</nav>
	<?php } ?>

</section>