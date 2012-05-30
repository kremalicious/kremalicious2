<?php

$remainingOffset	= get_option('posts_per_page'); // get the offset from admin settings
$remainingPosts 	= new WP_Query(array( 'posts_per_page' => 200, 'offset' => $remainingOffset )); //posts_per_page hack, so offset works

// start the loop for all remaining posts
while ($remainingPosts->have_posts()) : $remainingPosts->the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('remainingPost'); ?>>
		<header>
			<?php 
		
			/* ===================================================== */
			/* Post Format - Link */
			/* ===================================================== */
			
			if (has_post_format( 'link' )) { 
			
			$linkURL 	= get_post_meta($post->ID, '_format_link_url', true); 
			$leTopic 	= get_the_category(); ?>
			
			<div class="posttype">
				<a class="icon- cat-<?php echo $leTopic[0]->slug; ?>" rel="tooltip" title="Show all posts in '<?php echo $leTopic[0]->cat_name; ?>'" href="<?php echo get_category_link($leTopic[0]->term_id); ?>"></a>
			</div>
			<h2 class="entry-title"><a href="<?php echo $linkURL ?>"><?php the_title(); ?> <i class="icon-external-link"></i></a></h2>
			
			<?php } 
		
			/* ===================================================== */
			/* Post Format - Image */
			/* ===================================================== */
			
			elseif ( has_post_format( 'image' ) ) { ?>
			
			<div class="posttype">
				<a class="icon-picture" rel="tooltip" href="/photos" title="Show all photo posts"></a>
			</div>
			<a href="<?php the_permalink(); ?>" class="entry-content">
				<figure>
					<?php the_post_thumbnail('photoStreamTinySlot'); ?>
				</figure>
			</a>
			
			<?php }	
			
			/* ===================================================== */
			/* Goodies Post */
			/* ===================================================== */
			
			elseif ( in_category('goodies') ) { ?>
			
			<div class="posttype">
				<a class="icon-gift" rel="tooltip" href="/goodies" title="Show all goodies"></a>
			</div>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			
			<?php }
	
			/* ===================================================== */
			/* All the rest */
			/* ===================================================== */
			
			else { ?>
			
			<div class="posttype">
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
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			
			<?php } ?>
			
		</header>
	</article>
	
<?php endwhile; ?>

<?php wp_reset_postdata(); ?>