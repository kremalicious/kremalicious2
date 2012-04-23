
<aside role="complementary" class="col2">

	<?php if ( is_archive() ) { ?>
		
		<h1>
			<?php
				$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
				
				if ($term) {
					echo $term->name;
				} elseif (is_day()) {
					printf(__('Daily Archives: %s', 'roots'), get_the_date());
				} elseif (is_month()) {
					printf(__('Monthly Archives: %s', 'roots'), get_the_date('F Y'));
				} elseif (is_year()) {
					printf(__('Yearly Archives: %s', 'roots'), get_the_date('Y'));
				} elseif (is_author()) {
					global $post;
					$author_id = $post->post_author;
					printf(__('Author Archives: %s', 'roots'), get_the_author_meta('user_nicename', $author_id));
				} elseif ( is_paged() ) {
					global $page, $paged;
					echo '<a rel="tooltip" title="Back To Home" href="/">/</a> <a href="../../">'.single_cat_title('', false).' /</a>'. sprintf( __( ' Page %s', 'twentyeleven' ), max( $paged, $page ) );
					
				} else {
					single_cat_title('<a rel="tooltip" title="Back To Home" href="/">/</a>');
					
				}
			?>
		</h1>
		<p><?php echo category_description(); ?></p>
		<footer id="topics" class="hoverbuttons divider-top divider-bottom">
		
			<?php 
			
				$cats 		= get_categories('orderby=slug&style=none&depth=1&title_li=');
				
                foreach ($cats as $cat) {
                	if ( !$cat->category_parent > 0 ) {
                		echo '<a class="icon- cat-'.$cat->slug.'" rel="category tag" href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a>';
                	}
                }
			
			?>
		</footer>
		
	<?php } elseif ( is_search() ) { ?>
		<header>
			<h1>
				<a rel="tooltip" title="Back To Home" href="/">/</a> Search Results for <?php echo get_search_query(); ?>
			</h1>
		</header>
	<?php } else { ?>
		
		<?php 
		global $page, $paged;
		if ( $paged >= 2 || $page >= 2 )
			echo '<h1><a rel="tooltip" title="Back To Home" href="/">/</a>' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) ) .'</h1>'; ?>
		
		<p><strong>Blog of designer, developer, consultant Matthias Kretschmann.</strong></p>
		<p class="hoverbuttons divider-top divider-bottom">
			<a class="btn btn-tag rss" href="http://feeds.feedburner.com/kremalicious"> RSS</a> <a class="btn btn-tag twitter" href="https://twitter.com/kremalicious"><i class="icon-twitter-sign"></i> Twitter</a> <a class="btn btn-tag google" href="https://plus.google.com/u/0/b/100015950464424503954/100015950464424503954/posts">Google+</a> <a class="btn btn-tag facebook" href="#"><i class="icon-facebook-sign"></i> Facebook</a>
		</p>

	<?php } ?>
</aside>