	</section> <!-- END role=document -->
	
	<footer role="contentinfo">
		<?php if ( is_singular() OR is_archive() ) { ?>
			<section id="siteMeta">
				<p id="description">Blog of designer &amp; developer <a href="http://matthiaskretschmann.com">Matthias Kretschmann</a></p>
				<?php krlc2_subscribe_buttons(); ?>
				<div id="tweetsWrap">
					<a class="twitter-timeline" href="https://twitter.com/kremalicious" 
					    data-widget-id="345994075649998848" 
					    data-theme="light" 
					    data-chrome="nofooter noborders noheader transparent" 
					    data-link-color="#cc0000"
					    data-tweet-limit="1" 
					    data-show-replies="false" 
					    lang="EN"></a>
					<a class="btn socialite twitter-follow" href="https://twitter.com/kremalicious"><i class="icon-twitter"></i> Follow @kremalicious</a>
				</div>
			</section>
		<?php } ?>
		
		<section id="siteCopyright" class="dimmed">
			<p>© 2007-<?php echo date('Y'); ?> <a href="http://matthiaskretschmann.com" rel="me">Matthias Kretschmann</a>.</p>
			<p class="license">Code snippets: <a rel="item-license" href="http://www.opensource.org/licenses/mit-license.php">MIT License</a>. Goodies: <a rel="item-license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">CC BY NC SA</a>. Hosted by <a href="http://www.mediatemple.net#a_aid=4f37f8fe3e47e" title="Media Temple">(mt)</a></p>
		</section>
	</footer>
	
	<?php wp_footer(); ?>
	
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</body>
</html>