<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php 
		
		/* ===================================================== */
		/* Post Format - Link */
		/* ===================================================== */
		
		if (has_post_format( 'link' )) { 
			
			$linkURL 	= get_post_meta($post->ID, '_format_link_url', true); ?>
			
			<header>
				<h1 class="entry-title"><a href="<?php echo $linkURL ?>"><?php the_title(); ?> <i class="icon-external-link"></i></a></h1>
			</header>
			<div class="entry-meta">
				<p class="byline author vcard source-org">by <a class="fn" rel="author" href="/about/"><?php the_author(); ?></a></p>
				<p class="time"><?php echo krlc2_post_date(); ?></p>
			</div>
		<?php } 
		
		/* ===================================================== */
		/* Post Format - Image */
		/* ===================================================== */
		
		elseif ( has_post_format( 'image' ) ) { ?>
			
			<div class="photoPostWrap">
				<div class="photoPost">
					<figure class="hmedia">
						<?php the_post_thumbnail('photoBig', array('class' => 'photo')); ?>
						<figcaption class="entry-title fn"><?php the_title(); ?></figcaption>
						<?php krlc2_post_thumbnail_exif_data(); ?>
					</figure>
				</div>
			</div>
			<div class="entry-meta">
				<p class="byline author vcard source-org">by <a class="fn" rel="author" href="/about/"><?php the_author(); ?></a></p>
				<p class="time"><?php echo krlc2_post_date(); ?></p>
			</div>
		<?php } else { ?>
			
			<?php if ( has_post_thumbnail() ) { ?>
				<header class="featureTitle">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php the_post_thumbnail( 'featureImageBig', array('class' => 'photo') ); ?>
				</header>
			<?php } else { ?>
				<header>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
			<?php } ?>
			
			<div class="entry-meta">
				<p class="byline author vcard source-org">by <a class="fn" rel="author" href="/about/"><?php the_author(); ?></a></p>
				<p class="time"><?php echo krlc2_post_date(); ?></p>
			</div>
						
		<?php } ?>
		
			<div class="entry-content">
				<?php if (has_post_format( 'link' )) {
						the_content(); ?>
						<p>
							<a class="more-link" href="<?php echo $linkURL ?>">Go to source <i class="icon-external-link"></i></a>
						</p>
					<?php } else {
						the_content();
					} ?>
				
				<footer>
					<p><?php 
						$parentscategory ="";
						foreach((get_the_category()) as $category) {
							if ($category->category_parent == 0) {
								$parentscategory .= ' <a class="icon- cat-'.$category->slug.'" rel="category tag" href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
							}
						}
						echo substr($parentscategory,0,-2);
					?>
					</p>
				</footer>
			</div>

			<?php comments_template(); ?>
			
		<nav id="post-nav-single" class="pager">
			<p class="previous alignleft"><?php previous_post_link('<i class="icon-chevron-left"></i> %link'); ?> </p>
			<p class="next alignright"><?php next_post_link('%link <i class="icon-chevron-right"></i>'); ?> </p>
		</nav>	
				
	</article>
    
<?php endwhile; /* End loop */ ?>