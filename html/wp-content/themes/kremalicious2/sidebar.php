
<?php if ( is_archive() ) { ?>
	
	<aside role="complementary" class="col2">
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
					single_cat_title();
				}
			?>
		</h1>
	</aside>
	
<?php } elseif ( is_search() ) { ?>
	
	<header class="col2">
	    <h1><?php _e('Search Results for', 'roots'); ?> <?php echo get_search_query(); ?></h1>
	</header>

<?php } else { ?>

	<aside role="complementary" class="col2">
		<p>Blog of web &amp; ui designer/developer hybrid Matthias Kretschmann, who massages pixels all day.</p>
		<p><a class="btn" href="#"> RSS</a> <a class="btn" href="#"><i class="icon-twitter-sign"></i> Twitter</a></p>
		<p><a class="btn" href="#">Google+</a> <a class="btn" href="#"><i class="icon-facebook-sign"></i> Facebook</a></p>
		
		<footer id="topics">
			<?php wp_list_categories('orderby=slug&style=none&depth=1&title_li='); ?>
		</footer>
	</aside>
	
	
	
<?php } ?>