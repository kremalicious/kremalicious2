
<aside role="complementary" class="row">

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
					echo '<a rel="tooltip" title="Back to home" href="/">/</a> <a rel="tooltip" title="Back to first page" href="../../">'.single_cat_title('', false).' /</a>'. sprintf( __( ' Page %s', 'twentyeleven' ), max( $paged, $page ) );
					
				} else {
					single_cat_title('<a rel="tooltip" title="Back To Home" href="/">/</a>');
					
				}
			?>
		</h1>
		
	<?php } elseif ( is_search() ) { ?>
		<header>
			<h1>
				<?php if ( is_paged() ) { ?>
					<a rel="tooltip" title="Back to home" href="/">/</a> 
					<a rel="tooltip" title="Back to first page" href="../../">Search Results for <ins><?php echo get_search_query(); ?></ins> /</a> 
					<?php global $page, $paged; echo sprintf( __( ' Page %s', 'twentyeleven' ), max( $paged, $page )); ?>
				<?php } else { ?>
					<a rel="tooltip" title="Back To Home" href="/">/</a> Search Results for <ins><?php echo get_search_query(); ?></ins>
				<?php } ?>
			</h1>
		</header>
	<?php } else { ?>
		
		<?php 
		global $page, $paged;
		if ( $paged >= 2 || $page >= 2 )
			echo '<h1><a rel="tooltip" title="Back To Home" href="/">/</a>' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) ) .'</h1>'; ?>
		
		<section id="siteMeta">
			<p id="description" class="dimmed">Blog of designer &amp; developer <a href="http://matthiaskretschmann.com">Matthias Kretschmann</a></p>
			
			<?php krlc2_subscribe_buttons(); ?>
			
			<div id="tweetsWrap">
				<div id="tweets" class="dimmed">
				    <a class="twitter-timeline" href="https://twitter.com/kremalicious" 
				        data-widget-id="345994075649998848" 
				        data-theme="light" 
				        data-chrome="nofooter noborders noheader transparent" 
				        data-link-color="#cc0000"
				        data-tweet-limit="1" 
				        data-show-replies="false" 
				        lang="EN"></a>
				    <a class="btn socialite twitter-follow" href="https://twitter.com/kremalicious"><i class="icon-twitter"></i> Follow @kremalicious</a>
				</div>
			</div>
		</section>

	<?php } ?>
</aside>