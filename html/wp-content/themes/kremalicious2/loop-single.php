<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" class="hentry">
			
			<header class="col2">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<div class="col4">
				<section class="entry-content">
					<?php the_content(); ?>
				</section>
				<footer>
					<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
					<?php $tags = get_the_tags(); if ($tags) { ?><p><?php the_tags(); ?></p><?php } ?>
				</footer>
			
				<aside>
					<?php comments_template(); ?>
				</aside>
			</div>
			
	</article>
    
<?php endwhile; /* End loop */ ?>