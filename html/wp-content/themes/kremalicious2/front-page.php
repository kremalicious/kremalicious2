<?php get_header(); ?>
	
	<div class="row">
		<?php get_sidebar(); ?>
		<section role="main" id="main" class="col4">
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
		<a id="inifiniteLoader">Loading...</a>
	</div>

<?php get_footer(); ?>