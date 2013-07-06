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
		
		<?php 
		
		/* ===================================================== */
		/* Post Format - Link */
		/* ===================================================== */
		
		if (has_post_format( 'link' )) { 
			
			$linkURL 	= get_post_meta($post->ID, '_format_link_url', true); 
			$leTopic 	= get_the_category(); ?>
			
			<header>
				<a class="icon- cat-<?php echo $leTopic[0]->slug; ?> posttype" rel="tooltip" title="Show all posts in '<?php echo $leTopic[0]->cat_name; ?>'" href="<?php echo get_category_link($leTopic[0]->term_id); ?>"></a>
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
		
		<?php } 
		
		/* ===================================================== */
		/* Post Format - Image */
		/* ===================================================== */
		
		elseif ( has_post_format( 'image' ) ) { 
			
			// Photos section layout
			if ( is_category('photos') ) { ?>
				
				<a class="photoPost" href="<?php the_permalink(); ?>">
					<figure>
						<?php the_post_thumbnail('photoArchive'); ?>
						<figcaption><?php the_title(); ?></figcaption>
					</figure>
				</a>
			
			
		<?php 
			// Stream layout
			} else { ?>
			
				<a class="icon-picture posttype" rel="tooltip" href="/photos" title="Show all photo posts"></a>
				<a class="photoPost" href="<?php the_permalink(); ?>">
					<figure>
						<?php the_post_thumbnail('photoStream'); ?>
						<figcaption><?php the_title(); ?></figcaption>
					</figure>
				</a>
			
		<?php } 
		
		}
		
		
		/* ===================================================== */
		/* Goodies Archive */
		/* ===================================================== */
		
		elseif (in_category('goodies') && is_category('goodies')) { ?>

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
			
		<?php } 
		
		
		/* ===================================================== */
		/* Goodies Post Only */
		/* ===================================================== */
		
		elseif ( in_category('goodies') ) { ?>
			
			<header>
				<a class="icon-gift posttype" rel="tooltip" href="/goodies" title="Show all goodies"></a>
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
		
		<?php }
		
		/* ===================================================== */
		/* All the rest */
		/* ===================================================== */
		
		else { ?>
			
			<header>
				<?php if ( in_category('design') ) { ?>
					<a class="icon-leaf posttype" rel="tooltip" href="/design" title="Show all posts in 'design'"></a>
				<?php } elseif ( in_category('personal') ) { ?>
					<a class="icon-user posttype" rel="tooltip" href="/personal" title="Show all posts in 'personal'"></a>
				<?php } elseif ( in_category('photography') ) { ?>
					<a class="icon-camera-retro posttype" rel="tooltip" href="/photography" title="Show all posts in 'photography'"></a>
				<?php } else { ?>
					<a class="icon-asterisk posttype" rel="tooltip" href="<?php the_permalink(); ?>" title="Show all posts in"></a>
				<?php } ?>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<?php if ( !is_search() ) { ?>
				<section class="row entry-content">
					<?php if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'featureImageStream' ); ?>
						</a>
					<?php } ?>
					
					<?php the_content('Continue reading <i class="icon-chevron-right"></i>'); ?>
				</section>
			<?php } ?>

		<?php } ?>
		
    	
	</article>

<?php endwhile; /* End loop */ ?>