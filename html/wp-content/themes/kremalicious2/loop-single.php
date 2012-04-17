<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" class="hentry">
		
		<?php if (has_post_format( 'link' )) { 
			
			$linkURL 	= get_post_meta($post->ID, '_format_link_url', true); ?>
			
			<div class="row">
				<header class="col2">
					<h1 class="entry-title"><a href="<?php echo $linkURL ?>"><?php the_title(); ?> <i class="icon-external-link"></i></a></h1>
					<p id="byline" class="dimmed">by <span class="author"><?php the_author() ?></span></p>
				</header>
		
		<?php } elseif ( has_post_format( 'image' ) ) { ?>
			
			<div class="row">
				<div class="col6 photoPost">
					<figure>
						<?php the_post_thumbnail('photoBig'); ?>
						<figcaption><?php the_title(); ?></figcaption>
					</figure>
				</div>
			</div>
			<div class="row">
				<p id="byline" class="col2 dimmed">by <span class="author"><?php the_author() ?></span></p>
			
		<?php } else { ?>
			
			<?php if ( has_post_thumbnail() ) { ?>
			
				<header class="row featureTitle">
					<div class="col6">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php the_post_thumbnail( 'featureImageBig' ); ?>
					</div>
				</header>
				<div class="row">
					<p id="byline" class="col2 dimmed">by <span class="author"><?php the_author() ?></span></p>
					
			<?php } else { ?>
			
				<div class="row">
					<header class="col2">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<p id="byline" class="dimmed">by <span class="author"><?php the_author() ?></span></p>
					</header>
					
			<?php } ?>
			
		<?php } ?>
		
				<div class="col4">
					<section class="entry-content">
						<?php 
							the_content(); 
							
							if ( has_post_format( 'image' ) ) { 
								krlc2_post_thumbnail_exif_data(); 
							}
						?>
					</section>
					
					<?php 
					$tags = get_the_tags(); 
					if ($tags) { ?>
						<footer>
							<p id="tags"><i class="icon-tags"></i><?php the_tags('', ' ', ''); ?></p>
						</footer>
					<?php } ?>
					
					<aside>
						<?php comments_template(); ?>
					</aside>
				</div>
			</div>
			
	</article>
    
<?php endwhile; /* End loop */ ?>