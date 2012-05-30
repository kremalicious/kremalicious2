<?php get_header(); ?>
	
	<div class="row">
		<?php get_sidebar(); ?>
		<section role="main" id="main" class="col4">
			<?php get_template_part('loop', 'index'); ?>
		</section>
		<a id="inifiniteLoader">Loading...</a>
	</div>

<?php get_footer(); ?>