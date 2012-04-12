<?php get_header(); ?>
    <div id="content">
      <div id="main" role="main">
        <div class="page-header">
          <h1><?php _e('Latest Posts', 'roots');?></h1>
        </div>
        <?php get_template_part('loop', 'index'); ?>
      </div><!-- /#main -->
    </div><!-- /#content -->
<?php get_footer(); ?>