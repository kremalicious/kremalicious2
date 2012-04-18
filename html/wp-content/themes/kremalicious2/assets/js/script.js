
/*	Main js by Matthias Kretschmann | mkretschmann.com */

$(ASAP = function(){

	siteEffects.init();
	
});

$(window).load( AfterLoad = function() {
	
	if (Modernizr.touch) {
		//MBP.scaleFix();
		MBP.autogrow();
		MBP.enableActive();
	}

});


var siteEffects = {
	
	bannerHomeLink: function() {
		
		var $bannerTrigger  = $('#home span'),
			$banner			= $('header[role="banner"]');
			
		$bannerTrigger.hover(function() {
			
			if (Modernizr.cssanimations) {
				$banner.addClass('bannerSlideUp').removeClass('bannerFallDown');
			} else {
				$banner.stop().animate({'top':'-72px'}, 100, 'easeInCubic');
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
		var $commentList 	= $('#comments .commentlist, #respond'),
			$commentTrigger = $('#comments #commentShow');
		
		$commentList.hide();
		$commentTrigger.addClass('btn');
		
		$commentTrigger.click (function() {
			$commentList.slideToggle().css({'overflow':'visible'});
			$commentTrigger.toggleClass('open');
			$('html, body').animate({scrollTop: $(this).offset().top}, 500);
		});
	},
	
	socialiteButtons: function() {
		$('#share').one('mouseenter', function() {
			Socialite.load($(this)[0]);
		});
	},
	
	init: function(){
		this.commentShowup();
		this.socialiteButtons();
		this.bannerHomeLink();
	}
	
}