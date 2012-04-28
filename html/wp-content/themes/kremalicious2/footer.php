
</div> <!--END content wrap .container-->
	
	<div class="container">
		
		<footer role="contentinfo" id="content-info">
			
			<?php if ( is_singular() OR is_archive() ) { ?>
				<div class="row divider-top hoverbuttons">
					<div class="col2">
						<p>Blog of designer &amp; developer Matthias Kretschmann.</p>
						
					</div>
					
					<div class="col4">
						<p class="hoverbuttons">
							<a class="btn btn-tag rss" href="http://feeds.feedburner.com/kremalicious"> RSS</a> <a class="btn btn-tag twitter" href="https://twitter.com/kremalicious"><i class="icon-twitter-sign"></i> Twitter</a> <a class="btn btn-tag google" href="https://plus.google.com/u/0/b/100015950464424503954/100015950464424503954/posts">Google+</a> <a class="btn btn-tag facebook" href="#"><i class="icon-facebook-sign"></i> Facebook</a>
						</p>
					</div>
				</div>
			<?php } ?>
			
			<div class="row">
				<div class="col6 divider-top">
					<p id="copyright" class="dimmed"><small>© 2008-2012 Matthias Kretschmann</small></p>
				</div>
			</div>
		</footer>
		
	</div>
  	
  	<?php wp_footer(); ?>

</body>
</html>