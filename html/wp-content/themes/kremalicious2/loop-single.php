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
			<aside class="entry-meta">
				<p class="byline author vcard source-org">by <a class="fn" rel="author" href="/about/"><?php the_author(); ?></a></p>
				<p class="time"><?php echo krlc2_post_date(); ?></p>
			</aside>
		<?php } 
		
		/* ===================================================== */
		/* Post Format - Image */
		/* ===================================================== */
		
		elseif ( has_post_format( 'image' ) ) { ?>
			
			<div class="photoPost">
				<figure class="hmedia">
                    
        			<?php krlc2_the_post_thumbnail('photoBig'); ?>                    
					<figcaption class="entry-title fn"><?php the_title(); ?></figcaption>
					<?php krlc2_post_thumbnail_exif_data(); ?>
				</figure>
			</div>
            <aside class="entry-meta">
				<p class="byline author vcard source-org">by <a class="fn" rel="author" href="/about/"><?php the_author(); ?></a></p>
				<p class="time"><?php echo krlc2_post_date(); ?></p>
			</aside>
		<?php } 
		
		/* ===================================================== */
		/* Everything else */
		/* ===================================================== */
		
		else { ?>
			
			<?php if ( has_post_thumbnail() ) { ?>
				<header>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php the_post_thumbnail( 'featureImage', array('class' => 'photo') ); ?>
				</header>
			<?php } else { ?>
				<header>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
			<?php } ?>
			
			<aside class="entry-meta">
				<p class="byline author vcard source-org">by <a class="fn" rel="author" href="/about/"><?php the_author(); ?></a></p>
				<p class="time"><?php echo krlc2_post_date(); ?></p>
			</aside>
						
		<?php } ?>
		
			<section class="entry-content">
				<?php if (has_post_format( 'link' )) {
						the_content(); ?>
						<p>
							<a class="more-link" href="<?php echo $linkURL ?>">Go to source <i class="icon-forward"></i></a>
						</p>
					<?php } else {
						the_content();
					} ?>
				
				<footer class="entry-meta">
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
			</section>

	</article>
    
<?php endwhile; /* End loop */ ?>