<?php get_sidebar(); ?>

<section role="main" class="col4">
	
	<?php 
	
	/* ===================================================== */
	/* The Dev Warning */
	/* ===================================================== */
	
	if ( is_front_page() && !is_paged() ) { ?>
		
		<div id="devWarning" class="alert alert-block">
			<p>
				<i class="icon-warning-sign icon-large"></i>This site is currently undergoing heavy restructuring &amp; maintenance. Please excuse if some parts of it behave somehow funky for you. Oh, and welcome to <a href="/welcome-to-kremalicious2">the new site</a>!
			</p>
		</div>
		
	<?php } ?>
	
	<?php if ( is_category('photos') ) { ?>
	<div class="masonryWrap clearfix">
	<?php } ?>
	
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

			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix divider-bottom'); ?>>
				
				<?php 
				
				/* ===================================================== */
				/* Post Format - Link */
				/* ===================================================== */
				
				if (has_post_format( 'link' )) { 
					
					$linkURL 	= get_post_meta($post->ID, '_format_link_url', true); ?>
					
					<div class="col1 posttype">
						<a class="icon-bookmark" rel="tooltip" href="/links" title="Show all posts in 'links'"></a>
					</div>
					<div class="col5">
						<header>
							<h2><a href="<?php echo $linkURL ?>"><?php the_title(); ?> <i class="icon-external-link"></i></a></h2>
						</header>
						<?php if (!is_search()) { ?>
							<?php the_content('Continue reading <i class="icon-chevron-right"></i>'); ?>
							<p>
								<a class="more-link" href="<?php echo $linkURL ?>">Go to Article <i class="icon-external-link"></i></a>
								<a class="permalink-link" href="<?php the_permalink(); ?>" rel="tooltip" title="Permalink">&#8734;</a>
							</p>
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
							<a class="icon-picture" rel="tooltip" href="/photos" title="Show all posts in 'photos'"></a>
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
				/* Goodies Archive */
				/* ===================================================== */
				
				elseif (in_category('goodies') && is_category('goodies')) { ?>

					<div class="col6">
						<header>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</header>
						<?php if ( has_post_thumbnail() ) { ?>
							<p><a href="<?php the_permalink(); ?>" class="goodieImage">
								<?php the_post_thumbnail( 'goodieImage' ); ?>
							</a></p>
						<?php } else { ?>
							<?php the_content('Continue reading <i class="icon-chevron-right"></i>'); ?>
						<?php } ?>
						
						<footer id="goodiesDownload" class="clearfix">
							
							<?php 
								$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'order' => 'ASC', 'orderby' => 'menu_order ID', 'post_mime_type' => 'application/zip' ) );
								
								if ($attachments) {
									$attachment = array_shift($attachments); ?>
									<p><a class="btn icon-download-alt" href="<?php echo wp_get_attachment_url($attachment->ID); ?>">Download <span>zip</span></a></p>
							<?php } ?>
							<p><a class="btn icon-info-sign" href="<?php the_permalink(); ?>">Release Post</a></p>
						</footer>
					</div>
					
				<?php } 
				
				
				/* ===================================================== */
				/* Goodies Post Only */
				/* ===================================================== */
				
				elseif ( in_category('goodies') ) { ?>
					
					<div class="col1 posttype">
						<a class="icon-gift" rel="tooltip" href="/goodies" title="Show all Goodies"></a>
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
							
							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'featureImageStream' ); ?>
								</a>
							<?php } ?>
							
							<?php the_content('Continue reading <i class="icon-chevron-right"></i>'); ?>
							
						<?php } ?>
					</div>

				<?php } ?>
				
		    	
			</article>

	<?php endwhile; /* End loop */ ?>
	
	<?php if ( is_category('photos') ) { ?>
	</div> <!--END #masonryWrap-->
	<?php } ?>

</section>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ($wp_query->max_num_pages > 1) { ?>
	<nav id="post-nav" class="pager divider-top">
		<p class="previous alignleft"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></p>
		<p class="next alignright"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></p>
	</nav>
<?php } ?>
