/*

 MAIN JS FOR KREMALICIOUS.COM
 -----------------------------------------------------------------
 
 Copyright (c) 2012 Matthias Kretschmann | http://mkretschmann.com

 Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/

//@codekit-prepend "bootstrap-dropdown.js"
//@codekit-prepend "libs/infinitescroll/jquery.infinitescroll.js"
//@codekit-prepend "libs/socialite/socialite.js"
//@codekit-prepend "libs/tweet/tweet/jquery.tweet.js"

//@codekit-prepend "bootstrap-alert.js"
//@codekit-prepend "bootstrap-tooltip.js"
//@codekit-prepend "bootstrap-transition.js"
//@codekit-prepend "libs/jquery.fancybox.js"

//@codekit-prepend "plugins.js"

$(ASAP = function(){

	photoGrid.init();
	interface.init();
	lightbox.init();
	
});

$(window).load( AfterLoad = function() {

	siteEffects.init();
	infiniteScroll.init();
	
});


var lightbox = {

	initiateLightbox: function() {
		var $linkedImages = $('#main').find('a[href*=".jpg"],a[href*=".jpeg"],a[href*=".png"]');
		$linkedImages.addClass('linkedImage');
		$linkedImages.fancybox({
	         closeClick : true,
	         closeBtn: false,
	         padding: 0
	     });
	},
	
	init: function(){
		if ( $('#main img').length > 0 ) {
			this.initiateLightbox();
		}
	}
}

var photoGrid = {
	
	photoStreamGridSetup: function() {
		
		if ( $('body.blog, body.search').length > 0 ) {
			
			var $mainContent = $('section[role="main"]'),
				// a bit weird logic because we have no dividers we can throw at nextUntil()
				// but it works, so who would complain
				noPhotoPhosts	= $mainContent.find('article.format-standard, article.format-link'),
				// used when there's no non-image post before image group on a page
				photoPostSibling = $mainContent.find('article.format-image:first + article.format-image');

	    	noPhotoPhosts.each(function() {
	    		// only fire when has image sibling
	    		if ( $(this).nextUntil(noPhotoPhosts).length > 1 ) {
	    			$(this).nextUntil(noPhotoPhosts, 'article').wrapAll('<div class="masonryWrap"></div>');
	    		}
	    	});

			if ( !photoPostSibling.parent('.masonryWrap').length > 0 ) {
				photoPostSibling
					.prevAll('article.format-image').andSelf()
					.nextAll('article.format-image').andSelf()
					.wrapAll('<div class="masonryWrap"></div>');
			}
		}
	},
	
	masonryLayout: function() {
		var $container = $('section[role="main"] .masonryWrap');
		
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
		// only fire when photo post present and screen bigger than 481px (so it won't fire on smartphones in landscape)
		if ( $('section[role="main"] .format-image').length > 0 && Modernizr.mq('only screen and (min-width: 481px)')  ) {
			this.photoStreamGridSetup();
			if ( $('section[role="main"] .masonryWrap').length > 0 ) {
				this.masonryLayout();
			}
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
			$commentStuffHidden = $commentStuff.detach(),
			$commentTrigger 	= $('#comments #commentShow');
		
		$commentTrigger.addClass('btn');
		
		$commentTrigger.click(function() {
			showTheComments();
			$('html, body').animate({scrollTop: $commentTrigger.offset().top}, 500);
		});
		
		// comments paged nav case
		if ( location.href.indexOf('#comments') != -1 ) {
			showTheComments();
		}
		// comment link case
		if ( location.href.indexOf('#comment') != -1 ) {
			showTheComments();
		}
		
		function showTheComments() {
			
			if ( $commentStuffHidden ) {
				$commentStuffHidden.insertAfter('#commentShow').find('label').inFieldLabels();
				$commentStuffHidden = null;
				$('#comments .load-gravatar').async_gravatars({ ssl: true, size: 80 });
			}
			else {
				$commentStuffHidden = $commentStuff.detach();
			}
			$commentTrigger.toggleClass('open');
			
		}

	},
	
	toolTips: function() {
		$('#content [rel="tooltip"]').tooltip();
	},
	
	rememberCloseAlerts: function() {
		var alertToRemember = $('#content').find('.rememberClose');
		alertToRemember.bind('close', function () {
			$.cookie('alertmessage','dismissed');
		});
		
		var alertDismissed = $.cookie('alertmessage');
		if ( $.cookie('alertmessage') ) {
			alertToRemember.detach();
		}
		
	},
	
	init: function(){
		this.commentShowup();
		if ( Modernizr.mq('only screen and (min-width: 650px)')  ) {
			this.bannerHomeLink();
		}
		this.toolTips();
		this.rememberCloseAlerts();
		$('#respond label').inFieldLabels();
		$('#topicmenu .dropdown-toggle').dropdown();
	}
		
}

var siteEffects = {
	
	socialiteButtons: function() {
		$('#sharebuttons, #tweetsWrap').one('mouseenter', function() {
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

		$('#tweets').filter(":visible").tweet({
	        username: 'kremalicious',
	        count: 1,
	        fetch: 10,
	        template: '{text}{time}',
	        loading_text: '...',
	        filter: function(t){ return ! /^@\w+/.test(t.tweet_raw_text); }
	    });
	    
	},
	
	init: function(){
		this.socialiteButtons();
		this.searchFancySchmanzy();
		this.latestTweet();
	}
	
}

var infiniteScroll = {
	
	infiniteScrollSetup: function() { 
		
		if ( $('body.archive.category-photos').length > 0 ) {
			var items	= '#main .masonryWrap';
		} else {
			var items	= '#main article.hentry';
		}
		var	$scrollContent 	= $('#main');
		
		$scrollContent.infinitescroll({
			loading: {
				img: '/wp-content/themes/kremalicious2/assets/img/texture.png'
			},
			itemSelector	: items,
			nextSelector	: '#post-nav a:first',
			navSelector		: '#post-nav',
			binder			: $scrollContent,
			behavior 		: 'krlc2',
		}, function(this) {
			// run the photogrid over retrieved items
			photoGrid.init();
		});

	},
	
	init: function(){
		this.infiniteScrollSetup();
	}
	
}

/*
	--------------------------------
	Infinite Scroll Behavior
	Manual mode with minimal loader
	
	Usage: behavior: 'krlc2'
	--------------------------------
*/
$.extend($.infinitescroll.prototype,{

	_setup_krlc2: function infscr_setup_krlc2 () {
		var opts = this.options,
			instance = this,
			loader = $('<span class="loading"> ...</span>');
		
		$(opts.nextSelector).parent().parent().addClass('infiniteLoader');
		
		// Bind nextSelector link to retrieve
		$(opts.nextSelector).click(function(e) {
			if (e.which == 1 && !e.metaKey && !e.shiftKey) {
				e.preventDefault();
				instance.retrieve();
			}
		});

		// custom start
		instance.options.loading.start = function (opts) {
			loader
				.appendTo(opts.nextSelector)
				.show(opts.loading.speed, function () {
                	beginAjax(opts);
            });
		}
		
		// custom finish
		instance.options.loading.finished = function(opts) {
			loader.detach();
		};
		
	}

});