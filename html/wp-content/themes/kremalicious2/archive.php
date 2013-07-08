<?php get_header(); ?>
	
	<header class="heading-cat row">
		<h1 class="heading-cat-title"><?php single_cat_title('<a rel="tooltip" title="Back To Home" href="/">/</a>'); ?></h1>
	</header>
	
	<section role="main" id="main" class="row">
		<?php if ( is_category('photos') ) { ?>
		<div class="masonryWrap">
    		<div class="grid-sizer"></div>
    		<?php } ?>
    
    		<?php get_template_part('loop', 'index'); ?>
    		
    		<?php if ( is_category('photos') ) { ?>
		</div> <!--END #masonryWrap-->
		<?php } ?>
	</section>
	
	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php if ($wp_query->max_num_pages > 1) { ?>
		<nav id="post-nav" class="row pager">
			<p class="previous alignleft"><?php next_posts_link('<i class="icon-arrow-left"></i> Older posts'); ?></p>
			<p class="next alignright"><?php previous_posts_link('Newer posts <i class="icon-arrow-right"></i>'); ?></p>
		</nav>
	<?php } ?>

<?php get_footer(); ?>