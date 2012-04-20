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
				
				<?php if (has_post_format( 'link' )) { 
					
					$linkURL 	= get_post_meta($post->ID, '_format_link_url', true); ?>
					
					<div class="col1 posttype">
						<a class="icon-bookmark" href="/links" title="Show all posts in 'links'"></a>
					</div>
					<div class="col5">
						<header>
							<h2><a href="<?php echo $linkURL ?>"><?php the_title(); ?> <i class="icon-external-link"></i></a></h2>
						</header>
						<?php if (!is_search()) { ?>
							<?php the_content('Read On'); ?>
						<?php } ?>
					</div>
				
				<?php } elseif ( has_post_format( 'image' ) ) { ?>
					
					<div class="col1 posttype">
						<a class="icon-camera-retro" href="/photos" title="Show all posts in 'photos'"></a>
					</div>
					<div class="col5">
						<a class="photoPost" href="<?php the_permalink(); ?>">
							<figure>
								<?php the_post_thumbnail('photoStream'); ?>
								<figcaption><?php the_title(); ?></figcaption>
							</figure>
							<?php the_content(); ?>
						</a>
					</div>
				
				<?php } elseif (in_category('goodies') && is_category('goodies')) { ?>
					
					<div class="col1 posttype">
						<a class="icon-gift" href="/goodies" title="Show all Goodies"></a>
					</div>
					<div class="col5">
						<header>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</header>
					</div>
					<div class="col6">
						
						<?php if ( has_post_thumbnail() ) { ?>
							<p><a href="<?php the_permalink(); ?>" class="goodieImage">
								<?php the_post_thumbnail( 'goodieImage' ); ?>
							</a></p>
						<?php } else { ?>
							<?php the_content('Read On'); ?>
						<?php } ?>
						<footer>
							<p class="col3"><a class="btn download" href="#">Download</a></p>
							<p class="col3"><a href="<?php the_permalink(); ?>">Release Post</a></p>
						</footer>
					</div>
					
				<?php } elseif ( in_category('goodies') ) { ?>
					
					<div class="col1 posttype">
						<a class="icon-gift" href="/goodies" title="Show all Goodies"></a>
					</div>
					<div class="col5">
						<header>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</header>
						<?php if ( has_post_thumbnail() ) { ?>
							<p><a href="<?php the_permalink(); ?>" class="goodieImage">
								<?php the_post_thumbnail( 'goodieImage' ); ?>
							</a></p>
							<?php echo krlc2_excerpt_more(); ?>
						<?php } else { ?>
							<?php the_content('Read On'); ?>
						<?php } ?>
					</div>
				
				<?php } else { ?>
					
					<div class="col1 posttype">
						<?php if ( in_category('design') ) { ?>
							<a class="icon-leaf" href="/design" title="Show all posts in 'design'"></a>
						<?php } elseif ( in_category('personal') ) { ?>
							<a class="icon-user" href="<?php the_permalink(); ?>" title="Show all posts in 'personal'"></a>
						<?php } elseif ( in_category('photography') ) { ?>
							<a class="icon-camera" href="/photography" title="Show all posts in 'photography'"></a>
						<?php } else { ?>
							<a class="icon-asterisk" href="<?php the_permalink(); ?>" title="Show all posts in"></a>
						<?php } ?>
					</div>
					
					<div class="col5">
						<header>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</header>
						<?php if (!is_search()) { ?>
							
							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'featureImageStream' ); ?>
								</a>
							<?php } ?>
							<?php the_content('Read On'); ?>
							
						<?php } ?>
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