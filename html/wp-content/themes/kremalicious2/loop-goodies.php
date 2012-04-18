
<?php /* Start loop */ ?>

<?php while (have_posts()) : the_post(); ?>
	
	<article class="hentry col2" id="post-<?php the_ID(); ?>">
		
		<header>
			<h1><?php the_title(); ?></h1>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
			
	</article>
      
<?php endwhile; /* End loop */ ?>

<div class="col4">

	<?php 
	
	$goodiesQuery = new WP_Query( 'category_name=goodies&posts_per_page=-1' ); 
	
	while ( $goodiesQuery->have_posts() ) : $goodiesQuery->the_post(); 
		
		$categories = get_the_category();
	?>
	
		<article <?php post_class('goodieEntry'); ?> id="post-<?php the_ID(); ?>">
			<header>
				<h2><?php the_title(); ?></h2>
			</header>
			<?php if ( has_post_thumbnail() ) { ?>
				<?php the_post_thumbnail( 'goodieImage' ); ?>
			<?php } ?>
			<footer>
				<p class="col3"><a class="btn download" href="#">Download</a></p>
				<p class="col3"><a href="<?php the_permalink(); ?>">Release Post</a></p>
			</footer>
		</article>
		
	<?php endwhile; ?>
	
	<?php wp_reset_postdata(); ?>

</div>