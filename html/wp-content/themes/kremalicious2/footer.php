</section> <!-- END role=document -->
	
<footer role="contentinfo" class="container">
	
    <nav role="navigation" class="nav-main row">
		<?php
		    $goodies_id = get_cat_ID( 'goodies' );
		    $goodies_link = get_category_link( $goodies_id );
			
		    $photos_id = get_cat_ID( 'photos' );
		    $photos_link = get_category_link( $photos_id );
			
		    $personal_id = get_cat_ID( 'personal' );
		    $personal_link = get_category_link( $personal_id );
			
		    $design_id = get_cat_ID( 'design' );
		    $design_link = get_category_link( $design_id );
			
		    $photography_id = get_cat_ID( 'photography' );
		    $photography_link = get_category_link( $photography_id );
		?>
    	<ul>
    		<li <?php if ( is_category('goodies') ) echo 'class="current_page_item"';  ?>>
    		    <a class="nav-main-link" href="<?php echo esc_url( $goodies_link ); ?>">goodies</a>
    		</li>
    		<li <?php if ( is_category('photos') ) echo 'class="current_page_item"';  ?>>
    		    <a class="nav-main-link" href="<?php echo esc_url( $photos_link ); ?>">photos</a>
    		</li>
    		<li <?php if ( is_category('personal') ) echo 'class="current_page_item"';  ?>>
    		    <a class="nav-main-link" href="<?php echo esc_url( $personal_link ); ?>">personal</a>
    		</li>
    		<li <?php if ( is_category('design') ) echo 'class="current_page_item"';  ?>>
    		    <a class="nav-main-link" href="<?php echo esc_url( $design_link ); ?>">design</a>
    		</li>
    		<li <?php if ( is_category('photography') ) echo 'class="current_page_item"';  ?>>
    		    <a class="nav-main-link" href="<?php echo esc_url( $photography_link ); ?>">photography</a>
    		</li>
    		<!--<li>
    			<?php get_search_form(); ?>
    		</li>	-->			
    	</ul>
    </nav>
	
	<?php krlc2_subscribe_buttons(); ?>
	
	<aside id="tweetsWrap">
		<a class="twitter-timeline" href="https://twitter.com/kremalicious" 
		    data-widget-id="345994075649998848" 
		    data-theme="light" 
		    data-chrome="nofooter noborders noheader transparent" 
		    data-link-color="#cc0000"
		    data-tweet-limit="1" 
		    data-show-replies="false" 
		    lang="EN"></a>
		<a class="btn socialite twitter-follow" href="https://twitter.com/kremalicious"><i class="icon-twitter"></i> Follow @kremalicious</a>
	</aside>
	
	<section id="siteCopyright" class="row">
		<div class="col6">
			<p>© 2007-<?php echo date('Y'); ?> <a href="http://matthiaskretschmann.com" rel="me">Matthias Kretschmann</a>.</p>
			<p class="license">Code snippets: <a rel="item-license" href="http://www.opensource.org/licenses/mit-license.php">MIT License</a>. Goodies: <a rel="item-license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">CC BY NC SA</a>. Hosted by <a href="http://www.mediatemple.net#a_aid=4f37f8fe3e47e" title="Media Temple">(mt)</a></p>
		</div>
	</section>
</footer>
	
	<?php wp_footer(); ?>
	
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</body>
</html>