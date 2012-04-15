<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" class="hentry">
			
			<?php if ( has_post_thumbnail() ) { ?>
			
				<header class="row featureTitle">
					<div class="col6">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<img class="featureImage" src="http://placekitten.com/960/300" />
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
				<div class="col4">
					<section class="entry-content">
						<?php the_content(); ?>
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