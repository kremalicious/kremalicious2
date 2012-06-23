	</div> <!-- END #content -->
	
	<footer role="contentinfo">
		<?php if ( is_singular() OR is_archive() ) { ?>
			<section id="siteMeta">
				<p id="description"><?php bloginfo('description'); ?></p>
				<?php krlc2_subscribe_buttons(); ?>
				<div id="tweetsWrap">
					<div id="tweets" class="dimmed"></div>
					<a class="btn socialite twitter-follow" href="https://twitter.com/kremalicious"><i class="icon-twitter"></i> Follow @kremalicious</a>
				</div>
			</section>
		<?php } ?>
		
		<section id="siteCopyright" class="dimmed">
			<p>© 2007-<?php echo date('Y'); ?> <a href="http://matthiaskretschmann.com" rel="me">Matthias Kretschmann</a>.</p>
			<p>Code snippets: <a href="http://www.opensource.org/licenses/mit-license.php">MIT License</a>. Goodies: <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/">CC BY NC SA</a>. Hosted by <a href="http://www.mediatemple.net#a_aid=4f37f8fe3e47e" title="Media Temple">(mt)</a></p>
		</section>
	</footer>
	
	<?php wp_footer(); ?>

</body>
</html>