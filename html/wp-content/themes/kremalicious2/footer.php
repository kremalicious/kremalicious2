
</div> <!--END content wrap .container-->
	
	<div class="container">
		
		<footer role="contentinfo" id="content-info">
			
			<?php if ( is_singular() OR is_archive() ) { ?>
				<div class="row divider-top hoverbuttons">
					<div class="col2">
						<p id="description" class="dimmed"><?php bloginfo('description'); ?></p>
					</div>
					
					<div class="col2">
						<p id="subscribe">
							<a class="btn btn-tag rss" href="http://kremalicious.com/feed"><i class="icon-rss-sign"></i> RSS</a> <a class="btn btn-tag twitter" href="https://twitter.com/kremaliciouscom"><i class="icon-twitter-sign"></i> Twitter</a> <a class="btn btn-tag google" href="https://plus.google.com/100015950464424503954"><i class="icon-google-plus-sign"></i> Google+</a> <!--<a class="btn btn-tag facebook" href="#"><i class="icon-facebook-sign"></i>Facebook</a>-->
						</p>
					</div>
					<div id="tweetsWrap" class="col2">
						<div id="tweets" class="dimmed"></div>
						<a class="btn socialite twitter follow" href="https://twitter.com/kremalicious" data-show-count="false"><i class="icon-twitter-alt"></i> Follow @kremalicious</a>
					</div>
				</div>
			<?php } ?>
			
			<div class="row">
				<div id="siteMeta" class="col6 divider-top dimmed">
					<p id="copyright">© 2007-<?php echo date('Y'); ?> <a href="http://matthiaskretschmann.com" rel="me">Matthias Kretschmann</a>.</p>
					<p>Code snippets: <a href="http://www.opensource.org/licenses/mit-license.php">MIT License</a>. Article images/goodies: <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/">CC BY NC SA</a>. Hosted by <a href="http://www.mediatemple.net#a_aid=4f37f8fe3e47e" title="Media Temple">(mt)</a></p>
				</div>
			</div>
		</footer>
		
	</div>
  	
  	<?php wp_footer(); ?>

</body>
</html>