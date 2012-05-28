<?php function krlc2_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('divider-bottom'); ?>>
		<article id="comment-<?php comment_ID(); ?>">
			
			<header class="comment-author vcard">
				<span id="leAvatar">
					<img data-gravatar_hash="<?php echo md5( strtolower( trim( $comment->comment_author_email ) ) ); ?>" class="load-gravatar avatar photo" height="68" width="68" src="" />
				</span>
				<?php printf(__('<cite class="fn">%s</cite>', 'roots'), get_comment_author_link()); ?>
			</header>
			
			<?php if ($comment->comment_approved == '0') { ?>
				<div class="alert alert-block fade in">
				<a class="close" data-dismiss="alert">&times;</a>
				<p><?php _e('Your comment is awaiting moderation.', 'roots'); ?></p>
				</div>
			<?php } ?>
			
			<section class="comment-content">
				<?php comment_text() ?>
			</section>
			
			<footer>
				
				<?php edit_comment_link('Edit', '', ''); ?>
				
				<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				
				<time datetime="<?php echo comment_date('c'); ?>"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php printf(__('%1$s', 'roots'), get_comment_date(),  get_comment_time()); ?></a></time>

			</footer>
			
		</article>
<?php } ?>

<?php if (post_password_required()) { ?>
  <section id="comments">
    <div class="alert alert-block fade in">
      <a class="close" data-dismiss="alert">&times;</a>
      <p><?php _e('This post is password protected. Enter the password to view comments.', 'roots'); ?></p>
    </div>
  </section><!-- /#comments -->
<?php
  return;
} ?>

<?php if (have_comments()) { ?>

	<section id="comments">
		
		<h2 id="commentShow">
			<i class="icon-comments"></i>
			<?php printf(_n('One Response', '%1$s Responses', get_comments_number(), 'roots'), number_format_i18n(get_comments_number()) ); ?>
			<i class="icon-chevron-down"></i>
		</h2>
		
		<div id="commentlistWrap">
			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { // are there comments to navigate through ?>
			
				<nav id="comments-nav-top" class="pager comments-nav clearfix">
					<div class="aligncenter"><?php paginate_comments_links(); ?></div>
				</nav>
			
			<?php } // check for comment navigation ?>
			
			<ol class="commentlist divider-top">
				<?php wp_list_comments(array('callback' => 'krlc2_comment')); ?>
			</ol>
			
			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { // are there comments to navigate through ?>
			
				<nav id="comments-nav-bottom" class="pager comments-nav clearfix">
					<div class="aligncenter"><?php paginate_comments_links(); ?></div>
				</nav>
			
			<?php } // check for comment navigation ?>
			
			<?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) { ?>
				<div class="alert alert-block fade in">
				<a class="close" data-dismiss="alert">&times;</a>
				<p><?php _e('Comments are closed.', 'roots'); ?></p>
				</div>
			<?php } ?>
		</div>
	</section><!-- /#comments -->
  
<?php } else { ?>
	
	<section id="comments">
		<h2 id="commentShow">
			<i class="icon-comments"></i>
			<?php printf(_n('One Response', '%1$s Responses', get_comments_number(), 'roots'), number_format_i18n(get_comments_number()) ); ?>
			<i class="icon-chevron-down"></i>
		</h2>
		
		<?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) { ?>
			<div class="alert alert-block fade in">
			<a class="close" data-dismiss="alert">&times;</a>
			<p><?php _e('Comments are closed.', 'roots'); ?></p>
			</div>
		<?php } ?>
	</section><!-- /#comments -->
	
<?php } ?>

<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) { ?>
  <section id="comments">
    <div class="alert alert-block fade in">
      <a class="close" data-dismiss="alert">&times;</a>
      <p><?php _e('Comments are closed.', 'roots'); ?></p>
    </div>
  </section><!-- /#comments -->
<?php } ?>

<?php if (comments_open()) { ?>
  <section id="respond">
    <h2><i class="icon-comment"></i> Have Your Say</h2>
    <p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p>
    <?php if (get_option('comment_registration') && !is_user_logged_in()) { ?>
      <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'roots'), wp_login_url(get_permalink())); ?></p>
    <?php } else { ?>
      <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        <p>
        	<small class="dimmed">Be nice, don't spam. You can just use <a href="http://daringfireball.net/projects/markdown/syntax">Markdown</a>. Code snippets should be wrapped in <code>&lt;code&gt;</code> tags. Everything in between gets automatically encoded to HTML entities, wrapped in pre tags and syntax highlighted.</small>
        </p>
        <p>
        	<label for="comment"><?php _e('Comment', 'roots'); ?></label>
        	<textarea name="comment" id="comment" rows="4" tabindex="4"></textarea>
        </p>
        
        <?php if (is_user_logged_in()) { ?>
          <p><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'roots'), get_option('siteurl'), $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'roots'); ?>"><?php _e('Log out &raquo;', 'roots'); ?></a></p>
        <?php } else { ?>
          <p>
	          <label for="author"><?php _e('Name', 'roots'); if ($req) _e(' (required)', 'roots'); ?></label>
	          <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?>>
          </p>
          <p>
          	<label for="email"><?php _e('Email (will not be published)', 'roots'); if ($req) _e(' (required)', 'roots'); ?></label>
          	<input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?>>
          </p>
          <p>
          	<label for="url"><?php _e('Website', 'roots'); ?></label>
          	<input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3">
          </p>
        <?php } ?>
        
        <p>
        	<input name="submit" class="btn btn-primary" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'roots'); ?>">
        </p>
        <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
      </form>
    <?php } // if registration required and not logged in ?>
  </section><!-- /#respond -->
<?php } ?>