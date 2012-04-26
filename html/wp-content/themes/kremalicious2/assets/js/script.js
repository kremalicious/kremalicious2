
/*	Main js by Matthias Kretschmann | mkretschmann.com */

$(ASAP = function(){

	siteEffects.init();

	$('#respond label').inFieldLabels();
	
});

$(window).load( AfterLoad = function() {
	
	if (Modernizr.touch) {
		MBP.autogrow();
		MBP.enableActive();
	}
	
	codeSnippets.init();
	
	$('#content [rel="tooltip"]').tooltip();

});


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

var siteEffects = {
	
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
		var $commentStuff 	= $('#commentlistWrap, #respond'),
			$commentTrigger = $('#comments #commentShow');
		
		$commentStuff.hide();
		$commentTrigger.addClass('btn');
		
		$commentTrigger.click (function() {
			showTheComments();
			$('html, body').animate({scrollTop: $commentTrigger.offset().top}, 500);
		});
		
		if (location.href.indexOf('#comments') != -1) {
			showTheComments();
		}
		
		function showTheComments() {
			$commentStuff.fadeToggle().css({'overflow':'visible'});
			$commentTrigger.toggleClass('open');
		}

	},
	
	socialiteButtons: function() {
		$('#meta').one('mouseenter', function() {
			Socialite.load($(this)[0]);
		});
	},
	
	searchFancySchmanzy: function() {
		
		// topbar search field fancy schmanzy
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
	
	init: function(){
		this.commentShowup();
		this.socialiteButtons();
		this.bannerHomeLink();
		this.searchFancySchmanzy();
	}
	
}