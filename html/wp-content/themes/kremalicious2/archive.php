<?php get_header(); ?>
	
	<div class="row">
		<?php get_sidebar(); ?>
		<section role="main" id="main" class="col4">
			<?php if ( is_category('photos') ) { ?>
			<div class="masonryWrap">
			<?php } ?>

			<?php get_template_part('loop', 'index'); ?>
			
			<?php if ( is_category('photos') ) { ?>
			</div> <!--END #masonryWrap-->
			<?php } ?>
		</section>
	</div>
	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php if ($wp_query->max_num_pages > 1) { ?>
		<div class="row">
			<div class="col2"></div>
			<nav id="post-nav" class="pager col4">
				<p class="previous alignleft"><?php next_posts_link('<i class="icon-chevron-left"></i> Older posts'); ?></p>
				<p class="next alignright"><?php previous_posts_link('Newer posts <i class="icon-chevron-right"></i>'); ?></p>
			</nav>
		</div>
	<?php } ?>

<?php get_footer(); ?>