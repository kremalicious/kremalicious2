<?php
    $goodies_id = get_cat_ID( 'goodies' );
    $goodies_link = get_category_link( $goodies_id );
	
    $photos_id = get_cat_ID( 'photos' );
    $photos_link = get_category_link( $photos_id );
	
    $personal_id = get_cat_ID( 'personal' );
    $personal_link = get_category_link( $personal_id );
	
    $design_id = get_cat_ID( 'design' );
    $design_link = get_category_link( $design_id );
	
    $photography_id = get_cat_ID( 'photography' );
    $photography_link = get_category_link( $photography_id );
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) { ?>
	<div class="alert alert-block fade in">
		<a class="close" data-dismiss="alert">&times;</a>
		<p><?php _e('Sorry, no results were found.', 'roots'); ?></p>
	</div>
  <?php get_search_form(); ?>
<?php } ?>
	
<?php if ( is_search() ) { ?>
	<header>
		<h1>
			<?php if ( is_paged() ) { ?>
				<a rel="tooltip" title="Back to home" href="/">/</a> 
				<a rel="tooltip" title="Back to first page" href="../../">Search Results for <ins><?php echo get_search_query(); ?></ins> /</a> 
				<?php global $page, $paged; echo sprintf( __( ' Page %s', 'twentyeleven' ), max( $paged, $page )); ?>
			<?php } else { ?>
				<a rel="tooltip" title="Back To Home" href="/">/</a> Search Results for <ins><?php echo get_search_query(); ?></ins>
			<?php } ?>
		</h1>
	</header>
<?php } ?>

<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php 
		
		/* ===================================================== */
		/* Post Format - Link */
		/* ===================================================== */
		
		if (has_post_format( 'link' )) { 
			
			$linkURL 	= get_post_meta($post->ID, 'format_link_url', true); 
			$leTopic 	= get_the_category(); ?>
			
			<header>
				<a class="icon-<?php echo $leTopic[0]->slug; ?> posttype" rel="tooltip" title="Show all posts in '<?php echo $leTopic[0]->cat_name; ?>'" href="<?php echo get_category_link($leTopic[0]->term_id); ?>"></a>
				<h2 class="entry-title"><a href="<?php echo $linkURL ?>"><?php the_title(); ?> <i class="icon-external-link"></i></a></h2>
			</header>
			<?php if (!is_search()) { ?>
			<section class="entry-content">
				<?php the_content('Continue reading <i class="icon-arrow-right"></i>'); ?>
				<p>
					<a class="more-link" href="<?php echo $linkURL ?>">Go to source <i class="icon-forward"></i></a>
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
						<?php krlc2_the_post_thumbnail('photoArchive'); ?>
						<figcaption><?php the_title(); ?></figcaption>
					</figure>
				</a>
			
		<?php 
			// Stream layout
			} else { ?>
				<a class="icon-pictures posttype" rel="tooltip" href="<?php echo esc_url( $photos_link ); ?>" title="Show all photo posts"></a>
				<a class="photoPost" href="<?php the_permalink(); ?>">
					<figure>
            			<?php krlc2_the_post_thumbnail('photoStream'); ?>
						<figcaption><?php the_title(); ?></figcaption>
                        <?php krlc2_post_thumbnail_exif_data(); ?>
					</figure>
				</a>
			
		<?php } 
		
		}
		
		
		/* ===================================================== */
		/* Goodies Archive */
		/* ===================================================== */
		
		elseif (in_category('goodies') && is_category('goodies')) { ?>

			<header>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<?php if ( has_post_thumbnail() ) { ?>
				<p><a href="<?php the_permalink(); ?>" class="goodieImage">
					<?php the_post_thumbnail( 'featureImage' ); ?>
				</a></p>
			<?php } else { ?>
				<?php the_content('Continue reading <i class="icon-arrow-right"></i>'); ?>
			<?php } ?>
			
			<footer id="goodiesDownload" class="clearfix">
				
				<?php 
					$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'order' => 'ASC', 'orderby' => 'menu_order ID', 'post_mime_type' => 'application/zip' ) );
					
					if ($attachments) {
						$attachment = array_shift($attachments); ?>
						<p><a class="btn icon-arrow-down" href="<?php echo wp_get_attachment_url($attachment->ID); ?>">Download <span>zip</span></a></p>
				<?php } ?>
				<p><a class="btn icon-info" href="<?php the_permalink(); ?>">Release Post</a></p>
			</footer>
			
		<?php } 
		
		/* ===================================================== */
		/* All the rest */
		/* ===================================================== */
		
		else { ?>
			
			<header>
				<?php if ( in_category('design') ) { ?>
					<a class="icon-leaf posttype" rel="tooltip" href="<?php echo esc_url( $design_link ); ?>" title="Show all posts in 'design'"></a>
				<?php } elseif ( in_category('goodies') ) { ?>
					<a class="icon-heart posttype" rel="tooltip" href="<?php echo esc_url( $goodies_link ); ?>" title="Show all goodies"></a>
				<?php } elseif ( in_category('personal') ) { ?>
					<a class="icon-user posttype" rel="tooltip" href="<?php echo esc_url( $personal_link ); ?>" title="Show all posts in 'personal'"></a>
				<?php } elseif ( in_category('photography') ) { ?>
					<a class="icon-camera posttype" rel="tooltip" href="<?php echo esc_url( $photography_link ); ?>" title="Show all posts in 'photography'"></a>
				<?php } else { ?>
					<a class="icon-asterisk posttype" rel="tooltip" href="<?php the_permalink(); ?>" title="Show all posts in"></a>
				<?php } ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<?php if ( !is_search() ) { ?>
				<section class="entry-content">
					<?php if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'featureImage' ); ?>
						</a>
					<?php } ?>
					
					<?php the_content('Continue reading <i class="icon-arrow-right"></i>'); ?>
				</section>
			<?php } ?>

		<?php } ?>
		
    	
	</article>

<?php endwhile; /* End loop */ ?>