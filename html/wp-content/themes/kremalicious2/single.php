<?php get_header(); ?>
	<section role="main">
		<div id="devWarning" class="row divider-bottom">
			<p class="alert alert-block col6">
				<i class="icon-warning-sign icon-large"></i>This site is currently undergoing heavy restructuring &amp; maintenance. Please excuse if some parts of it behave somehow funky for you. Oh, and welcome to the new site!
			</p>
		</div>
		<?php get_template_part('loop', 'single'); ?>
	</section><!-- /#main -->
	
<?php get_footer(); ?>