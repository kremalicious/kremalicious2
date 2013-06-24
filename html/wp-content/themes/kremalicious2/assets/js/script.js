/*

 MAIN JS FOR KREMALICIOUS.COM
 -----------------------------------------------------------------

 Copyright (c) 2013 Matthias Kretschmann | http://mkretschmann.com

 Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/

//@codekit-prepend "bootstrap-dropdown.js"
//@codekit-prepend "libs/masonry/masonry.js"
//@codekit-prepend "libs/infinitescroll/jquery.infinitescroll.js"
//@codekit-prepend "libs/socialite/socialite.js"

//@codekit-prepend "bootstrap-tooltip.js"
//@codekit-prepend "bootstrap-transition.js"

//@codekit-prepend "plugins.js"

$(ASAP = function(){

	photoGrid.init();
	interface.init();

	if (Modernizr.touch){
		new MBP.fastButton($('#nav a, .btn'));
	}

});

$(window).load( AfterLoad = function() {

	siteEffects.init();
	infiniteScroll.init();

});

var photoGrid = {

	masonryLayout: function() {
		var $container = $('#main .masonryWrap');
        
        $container.imagesLoaded( function(){
    		$container.masonry({
    			itemSelector : 'article',
    			columnWidth  : '.grid-sizer'
    		});
    	});
	},

	init: function(){
		// only fire when photo post present and screen bigger than 481px (so it won't fire on smartphones in landscape)
		if ( $('section[role="main"] .masonryWrap').length > 0 && Modernizr.mq('only screen and (min-width: 481px)') ) {
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

	toolTips: function() {
		$('section[role="document"] [rel="tooltip"]').tooltip();
	},

	init: function(){
		if ( Modernizr.mq('only screen and (min-width: 40.625em)')  ) {
			this.bannerHomeLink();
		}
		this.toolTips();
		$('#respond label').inFieldLabels();
		$('#topicmenu .dropdown-toggle').dropdown();
	}

}

var siteEffects = {

	socialiteButtons: function() {
		$('#tweetsWrap').one('mouseenter', function() {
			Socialite.load($(this)[0]);
		});
	},

	searchFancySchmanzy: function() {

		var hiddenMenus 	  = $('#menubar nav[role="navigation"]'),
			globalSearch 	  = $('#menubar #s'),
			searchPlaceholder = globalSearch.attr('placeholder');

		globalSearch.attr('placeholder', '');
		globalSearch.focusout(function(){
			globalSearch.attr('placeholder', '');
			hiddenMenus.toggleClass('in');
		}).focusin(function() {
		    hiddenMenus.removeClass('in');
		    globalSearch.attr('placeholder', searchPlaceholder );
		});

	},

	init: function(){
		this.socialiteButtons();
		this.searchFancySchmanzy();
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
			itemSelector	: items,
			nextSelector	: '#post-nav a:first',
			navSelector		: '#post-nav',
			binder			: $scrollContent,
			behavior 		: 'krlc2',
		}, function($scrollContent) {
			 //run the photogrid over retrieved items
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
                	instance.beginAjax(opts);
            });
		}

		// custom finish
		instance.options.loading.finished = function(opts) {
			loader.detach();
		};

	}

});