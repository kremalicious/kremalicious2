<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
		<?php 
		
		/* ===================================================== */
		/* Post Format - Link */
		/* ===================================================== */
		
		if (has_post_format( 'link' )) { 
			
			$linkURL 	= get_post_meta($post->ID, '_format_link_url', true); ?>
			
			<div class="row">
				<header class="col2">
					<h1 class="entry-title"><a href="<?php echo $linkURL ?>"><?php the_title(); ?> <i class="icon-external-link"></i></a></h1>
					<p class="byline author vcard dimmed">by <a class="fn" rel="author" href=""><?php the_author() ?></a></p>
				</header>
		
		<?php } 
		
		/* ===================================================== */
		/* Post Format - Image */
		/* ===================================================== */
		
		elseif ( has_post_format( 'image' ) ) { ?>
			
			<div class="row">
				<div class="col6">
					<div class="photoPost">
						<figure>
							<?php the_post_thumbnail('photoBig'); ?>
							<figcaption><?php the_title(); ?></figcaption>
							<?php krlc2_post_thumbnail_exif_data(); ?>
						</figure>
					</div>
				</div>
			</div>
			<div class="row" id="photoPostContent">
				<p class="byline author vcard dimmed">by <a class="fn" rel="author" href=""><?php the_author() ?></a></p>
			
		<?php } else { ?>
			
			<?php if ( has_post_thumbnail() ) { ?>
			
				<header class="row featureTitle">
					<div class="col6">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php the_post_thumbnail( 'featureImageBig' ); ?>
					</div>
				</header>
				<div class="row">
					<p class="byline author vcard dimmed col2">by <a class="fn" rel="author" href=""><?php the_author() ?></a></p>
					
			<?php } else { ?>
			
				<div class="row">
					<header class="col2">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<p class="byline author vcard dimmed">by <a class="fn" rel="author" href=""><?php the_author() ?></a></p>
					</header>
					
			<?php } ?>
			
		<?php } ?>
		
				<div class="col4">
					<section class="entry-content">
						<?php the_content();  ?>
					</section>
					
					<footer id="meta" class="hoverbuttons divider-bottom divider-top">
						<div class="clearfix">
							<p id="share">
								<a class="btn socialite twitter" href="https://twitter.com/intent/tweet?source=kremalicious&text=<?php the_title(); ?>&url=<?php the_permalink(); ?>&via=kremalicious" data-via="kremalicious"><i class="icon-twitter-sign"></i> Tweet</a>
							</p>
							<p id="pubdate" class="dimmed">
								<time class="updated" datetime="<?php echo get_the_time('c') ?>" pubdate><?php the_date(); ?></time>
							</p>
							<p id="topic">
								<?php 
									$parentscategory ="";
									foreach((get_the_category()) as $category) {
										if ($category->category_parent == 0) {
											$parentscategory .= ' <a class="icon- cat-'.$category->slug.'" rel="category tag" href="' . get_category_link($category->cat_ID) . '" title="' . $category->name . '">' . $category->name . '</a>, ';
										}
									}
									echo substr($parentscategory,0,-2);
								?>
							</p>
						</div>
					</footer>
					
					<aside>
						<nav id="post-nav-single" class="clearfix">
							<p class="previous alignleft"><?php previous_post_link('<i class="icon-chevron-left"></i> %link'); ?> </p>
							<p class="next alignright"><?php next_post_link('%link <i class="icon-chevron-right"></i>'); ?> </p>
						</nav>
					</aside>
					
					<?php comments_template(); ?>
				</div>
			</div>
			
	</article>
    
<?php endwhile; /* End loop */ ?>