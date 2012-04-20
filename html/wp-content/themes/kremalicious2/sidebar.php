
<?php if ( is_archive() ) { ?>
	
	<aside role="complementary" id="archiveSidebar" class="col2">
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
				} else {
					single_cat_title('<a rel="tooltip" title="Back To Home" href="/">/</a>');
				}
			?>
		</h1>
		<p><?php echo category_description(); ?></p>
		<footer id="topics" class="hoverbuttons divider-top divider-bottom">
			<?php wp_list_categories('orderby=slug&style=none&depth=1&title_li='); ?>
		</footer>
	</aside>
	
<?php } elseif ( is_search() ) { ?>
	
	<header class="col2">
	    <h1><?php _e('Search Results for', 'roots'); ?> <?php echo get_search_query(); ?></h1>
	</header>

<?php } else { ?>

	<aside role="complementary" class="col2">
		<p>Blog of web &amp; ui designer/developer hybrid Matthias Kretschmann, masseur of fine pixels.</p>
		<p class="hoverbuttons divider-top divider-bottom">
			<a class="btn btn-tag" href="#"> RSS</a> <a class="btn btn-tag" href="#"><i class="icon-twitter-sign"></i> Twitter</a> <a class="btn btn-tag" href="#">Google+</a> <a class="btn btn-tag" href="#"><i class="icon-facebook-sign"></i> Facebook</a>
		</p>
	</aside>
	
	
	
<?php } ?>