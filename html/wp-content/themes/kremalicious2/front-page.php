<?php get_header(); ?>
	
	<section role="main" id="main">
		<?php 
		/* ===================================================== */
		/* Attention Please! Dashboard Widget Output */
		/* ===================================================== */
		
		$widget_options = krlc2_attention_widget_Options();
		
		if ( $widget_options['attentionMessageShown'] == 1 ) {
		
			if ( !is_paged() ) { ?>
				
				<div id="devWarning" class="alert alert-block rememberClose fade in">
					<a class="close" data-dismiss="alert" href="#">&times;</a>
					<p>
						<i class="icon-warning-sign icon-large"></i>
						<?php echo wp_kses_data( $widget_options["attentionMesssage"] ); ?>
					</p>
					<a class="rememberCloseButton" data-dismiss="alert" href="#">Hide this.</a>
				</div>
				
			<?php } 
		
		} ?>
		<?php get_template_part('loop', 'index'); ?>
		
	</section>
	
	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php if ($wp_query->max_num_pages > 1) { ?>
		<nav id="post-nav" class="pager">
			<p class="previous alignleft"><?php next_posts_link('<i class="icon-chevron-left"></i> Older posts'); ?></p>
			<p class="next alignright"><?php previous_posts_link('Newer posts <i class="icon-chevron-right"></i>'); ?></p>
		</nav>
	<?php } ?>

<?php get_footer(); ?>