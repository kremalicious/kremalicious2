<?php get_header(); ?>

	<section role="main" id="main" class="row">
		<?php get_template_part('loop', 'index'); ?>
	</section>
	
	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php if ($wp_query->max_num_pages > 1) { ?>
		<nav id="post-nav" class="row pager">
			<p class="previous alignleft"><?php next_posts_link('<i class="icon-chevron-left"></i> Older posts'); ?></p>
			<p class="next alignright"><?php previous_posts_link('Newer posts <i class="icon-chevron-right"></i>'); ?></p>
		</nav>
	<?php } ?>

<?php get_footer(); ?>