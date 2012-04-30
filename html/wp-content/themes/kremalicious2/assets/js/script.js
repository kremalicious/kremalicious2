
/*	Main js by Matthias Kretschmann | mkretschmann.com */

$(ASAP = function(){
	
	if ( $('#content .format-image').length > 0 ) {
		photoGrid.init();
	}
	interface.init();
	$('#respond label').inFieldLabels();
	
});

$(window).load( AfterLoad = function() {
	
	if (Modernizr.touch) {
		MBP.autogrow();
		MBP.enableActive();
	}
	
	siteEffects.init();
	codeSnippets.init();
	
	$('#content [rel="tooltip"]').tooltip();

});

var photoGrid = {
	
	photoStreamGridSetup: function() {
		
		if ( $('body.blog, body.search').length > 0 ) {
			// a bit weird logic because we have no dividers we can throw at nextUntil()
			// but it works, so who would complain
			var noPhotoPhosts	= $('#content').find('article.format-standard, article.format-link');

		    	noPhotoPhosts.each(function() {
		    		// only fire when has image sibling
		    		if ( $(this).nextUntil(noPhotoPhosts).length > 1 ) {
		    			$(this).nextUntil(noPhotoPhosts).wrapAll('<div class="masonryWrap clearfix divider-bottom"></div>');
		    		}
		    	});

			// used when there's no non-image post before image group on a page
			var photoPostSibling = $('#content').find('article.format-image:first + article.format-image');
			
			if ( !photoPostSibling.parent('.masonryWrap').length > 0 ) {
				photoPostSibling
					.prevAll('article.format-image').andSelf()
					.nextAll('article.format-image').andSelf()
					.wrapAll('<div class="masonryWrap clearfix divider-bottom"></div>');
			}
		}
	},
	
	masonryLayout: function() {
		var $container = $('#content .masonryWrap');
		
		$container.imagesLoaded( function(){
			$container.masonry({
				itemSelector : 'article',
				isAnimated: !Modernizr.csstransitions,
				columnWidth : function( containerWidth ) {
					return containerWidth / 2;
				}
			});
		});
	},
	
	init: function(){
						
		this.photoStreamGridSetup();
		if ( $('#content .masonryWrap').length > 0 ) {
			this.masonryLayout();
		}
	}
		
}

var interface = {
	
	bannerHomeLink: function() {
			
		var $bannerTrigger  = $('#home span'),
			$banner			= $('header[role="banner"]');
			
		$bannerTrigger.hover(function() {
			
			if (Modernizr.cssanimations) {
				$banner.addClass('bannerSlideUp').removeClass('bannerFallDown');
			} else {
				$banner.stop().animate({'top':'-82px'}, 100, 'easeInCubic');
			}

		}, function() {
			
			if (Modernizr.cssanimations) {
				$banner.addClass('bannerFallDown').removeClass('bannerSlideUp');
			} else {
				$banner.stop().animate({'top':'0'}, 600, 'easeOutBounce');
			}
			
		});
	},
	
	commentShowup: function(){
		var $commentStuff 		= $('#commentlistWrap, #respond'),
			$commentStuffHidden = $commentStuff.detach();
			$commentTrigger 	= $('#comments #commentShow');
		
		$commentTrigger.addClass('btn');
		
		$commentTrigger.click (function() {
			showTheComments();
			$('html, body').animate({scrollTop: $commentTrigger.offset().top}, 500);
		});
		
		if (location.href.indexOf('#comments') != -1) {
			showTheComments();
		}
		
		function showTheComments() {
			
			if ( $commentStuffHidden ) {
				$commentStuffHidden.appendTo('#comments');
				$commentStuffHidden = null;
			} else {
				$commentStuffHidden = $commentStuff.detach();
			}
			$commentTrigger.toggleClass('open');
			
		}

	},
	
	init: function(){
		this.commentShowup();
		this.bannerHomeLink();
	}
		
}

var siteEffects = {
	
	socialiteButtons: function() {
		$('#meta, #tweetsWrap').one('mouseenter', function() {
			Socialite.load($(this)[0]);
		});
	},
	
	searchFancySchmanzy: function() {
		
		var hiddenMenus 	  = $('#menubar nav[role="navigation"]'),
			globalSearch 	  = $('#menubar #s'),
			searchPlaceholder = globalSearch.attr('placeholder');
		
		globalSearch.attr('placeholder', '');
		globalSearch.blur(function(){
			globalSearch.attr('placeholder', '');
			hiddenMenus.toggleClass('in');
		}).focus(function() {                
		    hiddenMenus.addClass('fade').removeClass('in');
		    globalSearch.attr('placeholder', searchPlaceholder );
		});
		
	},
	
	latestTweet: function() {
		$('#tweets').tweet({
	        username: "kremalicious",
	        count: 1,
	        template: '{text}{time}',
	        loading_text: "loading tweets..."
	    });
	},
	
	init: function(){
		this.socialiteButtons();
		this.searchFancySchmanzy();
		this.latestTweet();
	}
	
}

var codeSnippets = {

	addCodeAttributes: function() {
		
		var codeBlocks = $('#content pre code');
		
		if (codeBlocks.length) {
		
			codeBlocks.each(function() {
				if ( !$(this).is('[data-language]') ) {
		        	if ( $(this).is(':contains(<?php)') ) {
		        		$(this).attr('data-language', 'php');
		        	} else if ( $(this).hasClass('css') ) {
		        		$(this).attr('data-language', 'css');
		        	} else {
		        		$(this).attr('data-language', 'generic');
		        	}
	        	}
	        });
	        
        }
	},
	
	init: function(){
		this.addCodeAttributes();
	}
	
}
