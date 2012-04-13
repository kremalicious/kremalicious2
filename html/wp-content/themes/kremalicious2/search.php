<?php get_header(); ?>
    <div id="content">
      <div id="main" role="main">
        <div class="page-header">
          <h1><?php _e('Search Results for', 'roots'); ?> <?php echo get_search_query(); ?></h1>
        </div>
        <?php get_template_part('loop', 'search'); ?>
      </div><!-- /#main -->
    </div><!-- /#content -->
<?php get_footer(); ?>