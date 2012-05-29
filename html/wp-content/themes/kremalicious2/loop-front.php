<div class="row">

<?php get_sidebar(); ?>

<section role="main" class="col4">
	
	<?php 
	
	/* ===================================================== */
	/* Attention Please! Dashboard Widget Output */
	/* ===================================================== */
	
	$widget_options = krlc2_attention_widget_Options();
	
	if ( $widget_options['attentionMessageShown'] == 1 ) { ?>
			
		<div id="devWarning" class="alert alert-block rememberClose fade in">
			<a class="close" data-dismiss="alert" href="#">&times;</a>
			<p>
				<i class="icon-warning-sign icon-large"></i>
				<?php echo wp_kses_data( $widget_options["attentionMesssage"] ); ?>
			</p>
			<a class="rememberCloseButton" data-dismiss="alert" href="#">Hide this.</a>
		</div>
				
	<?php } ?>

	<?php /* Start main loop */ ?>
	
	<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix divider-bottom'); ?>>
			
			<?php 
			
			/* ===================================================== */
			/* Post Format - Link */
			/* ===================================================== */
			
			if (has_post_format( 'link' )) { 
				
				$linkURL 	= get_post_meta($post->ID, '_format_link_url', true); 
				$leTopic 	= get_the_category(); ?>
				
				<div class="col1 posttype">
					<a class="icon- cat-<?php echo $leTopic[0]->slug; ?>" rel="tooltip" title="Show all posts in '<?php echo $leTopic[0]->cat_name; ?>'" href="<?php echo get_category_link($leTopic[0]->term_id); ?>"></a>
				</div>
				<div class="col5">
					<header>
						<h2><a href="<?php echo $linkURL ?>"><?php the_title(); ?> <i class="icon-external-link"></i></a></h2>
					</header>
					<?php if (!is_search()) { ?>
					<section class="entry-content">
						<?php the_content('Continue reading <i class="icon-chevron-right"></i>'); ?>
						<p>
							<a class="more-link" href="<?php echo $linkURL ?>">Go to source <i class="icon-external-link"></i></a>
							<a class="permalink-link" href="<?php the_permalink(); ?>" rel="tooltip" title="Permalink">&#8734;</a>
						</p>
					<?php } else { ?>
						<p>
							<a class="permalink-link" href="<?php the_permalink(); ?>" rel="tooltip" title="Permalink">&#8734;</a>
						</p>
					</section>
					<?php } ?>
				</div>
			
			<?php } 
			
			/* ===================================================== */
			/* Post Format - Image */
			/* ===================================================== */
			
			elseif ( has_post_format( 'image' ) ) { 
				
				if ( is_category('photos') ) { ?>
				
					<div class="col6">
						<a class="photoPost" href="<?php the_permalink(); ?>">
							<figure>
								<?php the_post_thumbnail('photoArchive'); ?>
								<figcaption><?php the_title(); ?></figcaption>
							</figure>
						</a>
					</div>
					
				<?php } else { ?>
				
					<div class="col1 posttype">
						<a class="icon-picture" rel="tooltip" href="/photos" title="Show all photo posts"></a>
					</div>
					<div class="col5">
						<a class="photoPost" href="<?php the_permalink(); ?>">
							<figure>
								<?php the_post_thumbnail('photoStream'); ?>
								<figcaption><?php the_title(); ?></figcaption>
							</figure>
						</a>
					</div>
				
			<?php } 
			
			}	
			
			/* ===================================================== */
			/* Goodies Post Only */
			/* ===================================================== */
			
			elseif ( in_category('goodies') ) { ?>
				
				<div class="col1 posttype">
					<a class="icon-gift" rel="tooltip" href="/goodies" title="Show all goodies"></a>
				</div>
				<div class="col5">
					<header>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</header>
					<?php if ( !is_search() ) { ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<p><a href="<?php the_permalink(); ?>" class="goodieImage">
								<?php the_post_thumbnail( 'goodieImage' ); ?>
							</a></p>
						<?php } ?>
						
						<?php the_content('Continue reading <i class="icon-chevron-right"></i>'); ?>
					<?php } ?>
				</div>
			
			<?php }
			
			/* ===================================================== */
			/* All the rest */
			/* ===================================================== */
			
			else { ?>
				
				<div class="col1 posttype">
					<?php if ( in_category('design') ) { ?>
						<a class="icon-leaf" rel="tooltip" href="/design" title="Show all posts in 'design'"></a>
					<?php } elseif ( in_category('personal') ) { ?>
						<a class="icon-user" rel="tooltip" href="/personal" title="Show all posts in 'personal'"></a>
					<?php } elseif ( in_category('photography') ) { ?>
						<a class="icon-camera-retro" rel="tooltip" href="/photography" title="Show all posts in 'photography'"></a>
					<?php } else { ?>
						<a class="icon-asterisk" rel="tooltip" href="<?php the_permalink(); ?>" title="Show all posts in"></a>
					<?php } ?>
				</div>
				
				<div class="col5">
					<header>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</header>
					<?php if ( !is_search() ) { ?>
						<section class="entry-content">
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'featureImageStream' ); ?>
							</a>
						<?php } ?>
						
						<?php the_content('Continue reading <i class="icon-chevron-right"></i>'); ?>
						</section>
					<?php } ?>
				</div>

			<?php } ?>

		</article>

	<?php endwhile; endif; /* End loop */ ?>
	
	<?php /* Check for paged, so no extensive offset parameter hacking is required */ ?>
	
	<?php if ($wp_query->max_num_pages > 1) { ?>
		
		
	<?php
		$remainingOffset	= get_option('posts_per_page'); // get the offset from admin settings
		$remainingPosts 	= new WP_Query(array( 'posts_per_page' => 200, 'offset' => $remainingOffset )); //posts_per_page hack, so offset works
		
		// start the loop for all remaining posts
		while ($remainingPosts->have_posts()) : $remainingPosts->the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix divider-bottom remainingPost'); ?>>
				<?php the_title(); ?>
			</article>
			
		<?php endwhile; ?>
		
		<?php wp_reset_postdata(); ?>
				
	<?php } ?>

</section>

</div>