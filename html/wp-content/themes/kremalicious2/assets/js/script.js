/* Author:

*/
/*	Main js by Matthias Kretschmann | mkretschmann.com */

$(ASAP = function(){

	siteEffects.init();
	
});


var siteEffects = {
	
	commentShowup: function(){
		var commentList 	= $('#comments .commentlist, #respond'),
			commentTrigger 	= $('#comments #commentShow');
		
		commentList.hide();
		commentTrigger.addClass('btn');
		
		commentTrigger.click (function() {
			commentList.slideToggle().css({'overflow':'visible'});
			commentTrigger.toggleClass('open');
			$('html, body').animate({scrollTop: $(this).offset().top}, 500);
		});
	},
	
	init: function(){
		this.commentShowup();
	}
	
}