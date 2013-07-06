<?php get_header(); ?>

	<section role="main" id="main" class="row">
		<?php get_template_part('loop', 'single'); ?>
	</section><!-- /#main -->
	
	<nav id="post-nav-single" class="row pager">
		<p class="previous col3 alignleft"><?php previous_post_link('<i class="icon-chevron-left"></i> %link'); ?> </p>
		<p class="next col3 alignright"><?php next_post_link('%link <i class="icon-chevron-right"></i>'); ?> </p>
	</nav>
	
<?php get_footer(); ?>