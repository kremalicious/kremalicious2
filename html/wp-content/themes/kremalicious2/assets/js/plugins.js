/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright Â© 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	}
});


/**
 * @license In-Field Label jQuery Plugin
 * http://fuelyourcoding.com/scripts/infield.html
 *
 * Copyright (c) 2009-2010 Doug Neiner
 * Dual licensed under the MIT and GPL licenses.
 * Uses the same license as jQuery, see:
 * http://docs.jquery.com/License
 *
 * @version 0.1.2
 */
(function ($) {

  $.InFieldLabels = function (label, field, options) {
    // To avoid scope issues, use 'base' instead of 'this'
    // to reference this class from internal events and functions.
    var base = this;
  
    // Access to jQuery and DOM versions of each element
    base.$label = $(label);
    base.label  = label;

    base.$field = $(field);
    base.field  = field;

    base.$label.data("InFieldLabels", base);
    base.showing = true;

    base.init = function () {
      // Merge supplied options with default options
      base.options = $.extend({}, $.InFieldLabels.defaultOptions, options);

      // Check if the field is already filled in
      if (base.$field.val() !== "") {
        base.$label.hide();
        base.showing = false;
      }

      base.$field.focus(function () {
        base.fadeOnFocus();
      }).blur(function () {
        base.checkForEmpty(true);
      }).bind('keydown.infieldlabel', function (e) {
        // Use of a namespace (.infieldlabel) allows us to
        // unbind just this method later
        base.hideOnChange(e);
      }).bind('paste', function (e) {
        // Since you can not paste an empty string we can assume
        // that the fieldis not empty and the label can be cleared.
        base.setOpacity(0.0);
      }).change(function (e) {
        base.checkForEmpty();
      }).bind('onPropertyChange', function () {
        base.checkForEmpty();
      });
    };

    // If the label is currently showing
    // then fade it down to the amount
    // specified in the settings
    base.fadeOnFocus = function () {
      if (base.showing) {
        base.setOpacity(base.options.fadeOpacity);
      }
    };

    base.setOpacity = function (opacity) {
      base.$label.stop().animate({ opacity: opacity }, base.options.fadeDuration);
      base.showing = (opacity > 0.0);
    };

    // Checks for empty as a fail safe
    // set blur to true when passing from
    // the blur event
    base.checkForEmpty = function (blur) {
      if (base.$field.val() === "") {
        base.prepForShow();
        base.setOpacity(blur ? 1.0 : base.options.fadeOpacity);
      } else {
        base.setOpacity(0.0);
      }
    };

    base.prepForShow = function (e) {
      if (!base.showing) {
        // Prepare for a animate in...
        base.$label.css({opacity: 0.0}).show();

        // Reattach the keydown event
        base.$field.bind('keydown.infieldlabel', function (e) {
          base.hideOnChange(e);
        });
      }
    };

    base.hideOnChange = function (e) {
      if (
          (e.keyCode === 16) || // Skip Shift
          (e.keyCode === 9) // Skip Tab
        ) {
        return; 
      }

      if (base.showing) {
        base.$label.hide();
        base.showing = false;
      }

      // Remove keydown event to save on CPU processing
      base.$field.unbind('keydown.infieldlabel');
    };

    // Run the initialization method
    base.init();
  };

  $.InFieldLabels.defaultOptions = {
    fadeOpacity: 0.5, // Once a field has focus, how transparent should the label be
    fadeDuration: 300 // How long should it take to animate from 1.0 opacity to the fadeOpacity
  };


  $.fn.inFieldLabels = function (options) {
    return this.each(function () {
      // Find input or textarea based on for= attribute
      // The for attribute on the label must contain the ID
      // of the input or textarea element
      var for_attr = $(this).attr('for'), $field;
      if (!for_attr) {
        return; // Nothing to attach, since the for field wasn't used
      }

      // Find the referenced input or textarea element
      $field = $(
        "input#" + for_attr + "[type='text']," + 
        "input#" + for_attr + "[type='search']," + 
        "input#" + for_attr + "[type='tel']," + 
        "input#" + for_attr + "[type='url']," + 
        "input#" + for_attr + "[type='email']," + 
        "input#" + for_attr + "[type='password']," + 
        "textarea#" + for_attr
      );

      if ($field.length === 0) {
        return; // Again, nothing to attach
      } 

      // Only create object for input[text], input[password], or textarea
      (new $.InFieldLabels(this, $field[0], options));
    });
  };

}(jQuery));

/**
 * jQuery Masonry v2.1.05
 * A dynamic layout plugin for jQuery
 * The flip-side of CSS Floats
 * http://masonry.desandro.com
 *
 * Licensed under the MIT license.
 * Copyright 2012 David DeSandro
 */
(function(a,b,c){"use strict";var d=b.event,e;d.special.smartresize={setup:function(){b(this).bind("resize",d.special.smartresize.handler)},teardown:function(){b(this).unbind("resize",d.special.smartresize.handler)},handler:function(a,c){var d=this,f=arguments;a.type="smartresize",e&&clearTimeout(e),e=setTimeout(function(){b.event.handle.apply(d,f)},c==="execAsap"?0:100)}},b.fn.smartresize=function(a){return a?this.bind("smartresize",a):this.trigger("smartresize",["execAsap"])},b.Mason=function(a,c){this.element=b(c),this._create(a),this._init()},b.Mason.settings={isResizable:!0,isAnimated:!1,animationOptions:{queue:!1,duration:500},gutterWidth:0,isRTL:!1,isFitWidth:!1,containerStyle:{position:"relative"}},b.Mason.prototype={_filterFindBricks:function(a){var b=this.options.itemSelector;return b?a.filter(b).add(a.find(b)):a},_getBricks:function(a){var b=this._filterFindBricks(a).css({position:"absolute"}).addClass("masonry-brick");return b},_create:function(c){this.options=b.extend(!0,{},b.Mason.settings,c),this.styleQueue=[];var d=this.element[0].style;this.originalStyle={height:d.height||""};var e=this.options.containerStyle;for(var f in e)this.originalStyle[f]=d[f]||"";this.element.css(e),this.horizontalDirection=this.options.isRTL?"right":"left",this.offset={x:parseInt(this.element.css("padding-"+this.horizontalDirection),10),y:parseInt(this.element.css("padding-top"),10)},this.isFluid=this.options.columnWidth&&typeof this.options.columnWidth=="function";var g=this;setTimeout(function(){g.element.addClass("masonry")},0),this.options.isResizable&&b(a).bind("smartresize.masonry",function(){g.resize()}),this.reloadItems()},_init:function(a){this._getColumns(),this._reLayout(a)},option:function(a,c){b.isPlainObject(a)&&(this.options=b.extend(!0,this.options,a))},layout:function(a,b){for(var c=0,d=a.length;c<d;c++)this._placeBrick(a[c]);var e={};e.height=Math.max.apply(Math,this.colYs);if(this.options.isFitWidth){var f=0;c=this.cols;while(--c){if(this.colYs[c]!==0)break;f++}e.width=(this.cols-f)*this.columnWidth-this.options.gutterWidth}this.styleQueue.push({$el:this.element,style:e});var g=this.isLaidOut?this.options.isAnimated?"animate":"css":"css",h=this.options.animationOptions,i;for(c=0,d=this.styleQueue.length;c<d;c++)i=this.styleQueue[c],i.$el[g](i.style,h);this.styleQueue=[],b&&b.call(a),this.isLaidOut=!0},_getColumns:function(){var a=this.options.isFitWidth?this.element.parent():this.element,b=a.width();this.columnWidth=this.isFluid?this.options.columnWidth(b):this.options.columnWidth||this.$bricks.outerWidth(!0)||b,this.columnWidth+=this.options.gutterWidth,this.cols=Math.floor((b+this.options.gutterWidth)/this.columnWidth),this.cols=Math.max(this.cols,1)},_placeBrick:function(a){var c=b(a),d,e,f,g,h;d=Math.ceil(c.outerWidth(!0)/this.columnWidth),d=Math.min(d,this.cols);if(d===1)f=this.colYs;else{e=this.cols+1-d,f=[];for(h=0;h<e;h++)g=this.colYs.slice(h,h+d),f[h]=Math.max.apply(Math,g)}var i=Math.min.apply(Math,f),j=0;for(var k=0,l=f.length;k<l;k++)if(f[k]===i){j=k;break}var m={top:i+this.offset.y};m[this.horizontalDirection]=this.columnWidth*j+this.offset.x,this.styleQueue.push({$el:c,style:m});var n=i+c.outerHeight(!0),o=this.cols+1-l;for(k=0;k<o;k++)this.colYs[j+k]=n},resize:function(){var a=this.cols;this._getColumns(),(this.isFluid||this.cols!==a)&&this._reLayout()},_reLayout:function(a){var b=this.cols;this.colYs=[];while(b--)this.colYs.push(0);this.layout(this.$bricks,a)},reloadItems:function(){this.$bricks=this._getBricks(this.element.children())},reload:function(a){this.reloadItems(),this._init(a)},appended:function(a,b,c){if(b){this._filterFindBricks(a).css({top:this.element.height()});var d=this;setTimeout(function(){d._appended(a,c)},1)}else this._appended(a,c)},_appended:function(a,b){var c=this._getBricks(a);this.$bricks=this.$bricks.add(c),this.layout(c,b)},remove:function(a){this.$bricks=this.$bricks.not(a),a.remove()},destroy:function(){this.$bricks.removeClass("masonry-brick").each(function(){this.style.position="",this.style.top="",this.style.left=""});var c=this.element[0].style;for(var d in this.originalStyle)c[d]=this.originalStyle[d];this.element.unbind(".masonry").removeClass("masonry").removeData("masonry"),b(a).unbind(".masonry")}},b.fn.imagesLoaded=function(a){function h(){a.call(c,d)}function i(a){var c=a.target;c.src!==f&&b.inArray(c,g)===-1&&(g.push(c),--e<=0&&(setTimeout(h),d.unbind(".imagesLoaded",i)))}var c=this,d=c.find("img").add(c.filter("img")),e=d.length,f="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",g=[];return e||h(),d.bind("load.imagesLoaded error.imagesLoaded",i).each(function(){var a=this.src;this.src=f,this.src=a}),c};var f=function(b){a.console&&a.console.error(b)};b.fn.masonry=function(a){if(typeof a=="string"){var c=Array.prototype.slice.call(arguments,1);this.each(function(){var d=b.data(this,"masonry");if(!d){f("cannot call methods on masonry prior to initialization; attempted to call method '"+a+"'");return}if(!b.isFunction(d[a])||a.charAt(0)==="_"){f("no such method '"+a+"' for masonry instance");return}d[a].apply(d,c)})}else this.each(function(){var c=b.data(this,"masonry");c?(c.option(a||{}),c._init()):b.data(this,"masonry",new b.Mason(a,this))});return this}})(window,jQuery);

/*!
 * jQuery Cookie Plugin
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
(function($) {
    $.cookie = function(key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = $.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {};
        var decode = options.raw ? function(s) { return s; } : decodeURIComponent;

        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key) return decode(pair[1] || ''); // IE saves cookies with empty string as "c; ", e.g. without "=" as opposed to EOMB, thus pair[1] may be undefined
        }
        return null;
    };
})(jQuery);

/*
Copyright (c) 2011 Joseph Scott

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
 */

( function( $ ) {
$.fn.async_gravatars = function( args ) {
	var opt = {
		'default_img'	: 'identicon',
		'hash_attr'		: 'data-gravatar_hash',
		'rating'		: 'pg',
		'size'			: 64,
		'ssl'			: false
	};

	return this.each( function() {
		if ( args ) {
			$.extend( opt, args );
		}

		var host = 'http://www.gravatar.com/avatar/';
		if ( opt.ssl == true ) {
			host = 'https://secure.gravatar.com/avatar/';
		}

		var email_hash = $( this ).attr( opt.hash_attr );

		var grav_url = host + encodeURIComponent( email_hash ) + '.jpg?';
		grav_url += 's=' + encodeURIComponent( opt.size );
		grav_url += '&d=' + encodeURIComponent( opt.default_img );
		grav_url += '&r=' + encodeURIComponent( opt.rating );

		$( this ).attr( 'src', grav_url );
	} );
};
} )( jQuery );

/*
	--------------------------------
	Infinite Scroll
	--------------------------------
	+ https://github.com/paulirish/infinite-scroll
	+ version 2.0b2.120519
	+ Copyright 2011/12 Paul Irish & Luke Shumard
	+ Licensed under the MIT license
	
	+ Documentation: http://infinite-scroll.com/
	
*/

(function (window, $, undefined) {
	
	$.infinitescroll = function infscr(options, callback, element) {
		
		this.element = $(element);
		
                // Flag the object in the event of a failed creation
		if (!this._create(options, callback)) {
                  this.failed = true;
                }
	
	};
	
	$.infinitescroll.defaults = {
		loading: {
			finished: undefined,
			finishedMsg: "<em>Congratulations, you've reached the end of the internet.</em>",
			img: "http://www.infinite-scroll.com/loading.gif",
			msg: null,
			msgText: "<em>Loading the next set of posts...</em>",
			selector: null,
			speed: 'fast',
			start: undefined
		},
		state: {
			isDuringAjax: false,
			isInvalidPage: false,
			isDestroyed: false,
			isDone: false, // For when it goes all the way through the archive.
			isPaused: false,
			currPage: 1
		},
		callback: undefined,
		debug: false,
		behavior: undefined,
		binder: $(window), // used to cache the selector
		nextSelector: "div.navigation a:first",
		navSelector: "div.navigation",
		contentSelector: null, // rename to pageFragment
		extraScrollPx: 150,
		itemSelector: "div.post",
		animate: false,
		pathParse: undefined,
		dataType: 'html',
		appendCallback: true,
		bufferPx: 40,
		errorCallback: function () { },
		infid: 0, //Instance ID
		pixelsFromNavToBottom: undefined,
		path: undefined
	};


    $.infinitescroll.prototype = {

        /*	
        ----------------------------
        Private methods
        ----------------------------
        */

        // Bind or unbind from scroll
        _binding: function infscr_binding(binding) {

            var instance = this,
				opts = instance.options;
				
			opts.v = '2.0b2.111027';

            // if behavior is defined and this function is extended, call that instead of default
			if (!!opts.behavior && this['_binding_'+opts.behavior] !== undefined) {
				this['_binding_'+opts.behavior].call(this);
				return;
			}

			if (binding !== 'bind' && binding !== 'unbind') {
                this._debug('Binding value  ' + binding + ' not valid')
                return false;
            }

            if (binding == 'unbind') {

                (this.options.binder).unbind('smartscroll.infscr.' + instance.options.infid);

            } else {

                (this.options.binder)[binding]('smartscroll.infscr.' + instance.options.infid, function () {
                    instance.scroll();
                });

            };

            this._debug('Binding', binding);

        },

		// Fundamental aspects of the plugin are initialized
		_create: function infscr_create(options, callback) {

            // Add custom options to defaults
            var opts = $.extend(true, {}, $.infinitescroll.defaults, options);

            // Validate selectors
            if (!this._validate(options)) { return false; }
            this.options = opts;

            // Validate page fragment path
            var path = $(opts.nextSelector).attr('href');
            if (!path) {
              this._debug('Navigation selector not found');
              return false;
            }

            // Set the path to be a relative URL from root.
            opts.path = this._determinepath(path);

            // contentSelector is 'page fragment' option for .load() / .ajax() calls
            opts.contentSelector = opts.contentSelector || this.element;

            // loading.selector - if we want to place the load message in a specific selector, defaulted to the contentSelector
            opts.loading.selector = opts.loading.selector || opts.contentSelector;

            // Define loading.msg
            opts.loading.msg = $('<div id="infscr-loading"><img alt="Loading..." src="' + opts.loading.img + '" /><div>' + opts.loading.msgText + '</div></div>');

            // Preload loading.img
            (new Image()).src = opts.loading.img;

            // distance from nav links to bottom
            // computed as: height of the document + top offset of container - top offset of nav link
            opts.pixelsFromNavToBottom = $(document).height() - $(opts.navSelector).offset().top;

			// determine loading.start actions
            opts.loading.start = opts.loading.start || function() {
				
				$(opts.navSelector).hide();
				opts.loading.msg
					.appendTo(opts.loading.selector)
					.show(opts.loading.speed, function () {
	                	beginAjax(opts);
	            });
			};
			
			// determine loading.finished actions
			opts.loading.finished = opts.loading.finished || function() {
				opts.loading.msg.fadeOut('normal');
			};

            // callback loading
            opts.callback = function(instance,data) {
				if (!!opts.behavior && instance['_callback_'+opts.behavior] !== undefined) {
					instance['_callback_'+opts.behavior].call($(opts.contentSelector)[0], data);
				}
				if (callback) {
					callback.call($(opts.contentSelector)[0], data, opts);
				}
			};

            this._setup();
            
            // Return true to indicate successful creation
            return true;
        },

        // Console log wrapper
        _debug: function infscr_debug() {

			if (this.options && this.options.debug) {
                return window.console && console.log.call(console, arguments);
            }

        },

        // find the number to increment in the path.
        _determinepath: function infscr_determinepath(path) {

            var opts = this.options;

			// if behavior is defined and this function is extended, call that instead of default
			if (!!opts.behavior && this['_determinepath_'+opts.behavior] !== undefined) {
				this['_determinepath_'+opts.behavior].call(this,path);
				return;
			}

            if (!!opts.pathParse) {

                this._debug('pathParse manual');
                return opts.pathParse(path, this.options.state.currPage+1);

            } else if (path.match(/^(.*?)\b2\b(.*?$)/)) {
                path = path.match(/^(.*?)\b2\b(.*?$)/).slice(1);

                // if there is any 2 in the url at all.    
            } else if (path.match(/^(.*?)2(.*?$)/)) {

                // page= is used in django:
                // http://www.infinite-scroll.com/changelog/comment-page-1/#comment-127
                if (path.match(/^(.*?page=)2(\/.*|$)/)) {
                    path = path.match(/^(.*?page=)2(\/.*|$)/).slice(1);
                    return path;
                }

                path = path.match(/^(.*?)2(.*?$)/).slice(1);

            } else {

                // page= is used in drupal too but second page is page=1 not page=2:
                // thx Jerod Fritz, vladikoff
                if (path.match(/^(.*?page=)1(\/.*|$)/)) {
                    path = path.match(/^(.*?page=)1(\/.*|$)/).slice(1);
                    return path;
                } else {
                    this._debug('Sorry, we couldn\'t parse your Next (Previous Posts) URL. Verify your the css selector points to the correct A tag. If you still get this error: yell, scream, and kindly ask for help at infinite-scroll.com.');
                    // Get rid of isInvalidPage to allow permalink to state
                    opts.state.isInvalidPage = true;  //prevent it from running on this page.
                }
            }
            this._debug('determinePath', path);
            return path;

        },

        // Custom error
        _error: function infscr_error(xhr) {

            var opts = this.options;

			// if behavior is defined and this function is extended, call that instead of default
			if (!!opts.behavior && this['_error_'+opts.behavior] !== undefined) {
				this['_error_'+opts.behavior].call(this,xhr);
				return;
			}

            if (xhr !== 'destroy' && xhr !== 'end') {
                xhr = 'unknown';
            }

            this._debug('Error', xhr);

            if (xhr == 'end') {
                this._showdonemsg();
            }

            opts.state.isDone = true;
            opts.state.currPage = 1; // if you need to go back to this instance
            opts.state.isPaused = false;
            this._binding('unbind');

        },

        // Load Callback
        _loadcallback: function infscr_loadcallback(box, data) {

            var opts = this.options,
	    		callback = this.options.callback, // GLOBAL OBJECT FOR CALLBACK
	    		result = (opts.state.isDone) ? 'done' : (!opts.appendCallback) ? 'no-append' : 'append',
	    		frag;
	
			// if behavior is defined and this function is extended, call that instead of default
			if (!!opts.behavior && this['_loadcallback_'+opts.behavior] !== undefined) {
				this['_loadcallback_'+opts.behavior].call(this,box,data);
				return;
			}

            switch (result) {

                case 'done':

                    this._showdonemsg();
                    return false;

                    break;

                case 'no-append':

                    if (opts.dataType == 'html') {
                        data = '<div>' + data + '</div>';
                        data = $(data).find(opts.itemSelector);
                    }

                    break;

                case 'append':

                    var children = box.children();

                    // if it didn't return anything
                    if (children.length == 0) {
                        return this._error('end');
                    }


                    // use a documentFragment because it works when content is going into a table or UL
                    frag = document.createDocumentFragment();
                    while (box[0].firstChild) {
                        frag.appendChild(box[0].firstChild);
                    }

                    this._debug('contentSelector', $(opts.contentSelector)[0])
                    $(opts.contentSelector)[0].appendChild(frag);
                    // previously, we would pass in the new DOM element as context for the callback
                    // however we're now using a documentfragment, which doesnt havent parents or children,
                    // so the context is the contentContainer guy, and we pass in an array
                    //   of the elements collected as the first argument.

                    data = children.get();


                    break;

            }

            // loadingEnd function
			opts.loading.finished.call($(opts.contentSelector)[0],opts)
            

            // smooth scroll to ease in the new content
            if (opts.animate) {
                var scrollTo = $(window).scrollTop() + $('#infscr-loading').height() + opts.extraScrollPx + 'px';
                $('html,body').animate({ scrollTop: scrollTo }, 800, function () { opts.state.isDuringAjax = false; });
            }

            if (!opts.animate) opts.state.isDuringAjax = false; // once the call is done, we can allow it again.

            callback(this,data);

        },

        _nearbottom: function infscr_nearbottom() {

            var opts = this.options,
	        	pixelsFromWindowBottomToBottom = 0 + $(document).height() - (opts.binder.scrollTop()) - $(window).height();

            // if behavior is defined and this function is extended, call that instead of default
			if (!!opts.behavior && this['_nearbottom_'+opts.behavior] !== undefined) {
				return this['_nearbottom_'+opts.behavior].call(this);
			}

			this._debug('math:', pixelsFromWindowBottomToBottom, opts.pixelsFromNavToBottom);

            // if distance remaining in the scroll (including buffer) is less than the orignal nav to bottom....
            return (pixelsFromWindowBottomToBottom - opts.bufferPx < opts.pixelsFromNavToBottom);

        },

		// Pause / temporarily disable plugin from firing
        _pausing: function infscr_pausing(pause) {

            var opts = this.options;

            // if behavior is defined and this function is extended, call that instead of default
			if (!!opts.behavior && this['_pausing_'+opts.behavior] !== undefined) {
				this['_pausing_'+opts.behavior].call(this,pause);
				return;
			}

			// If pause is not 'pause' or 'resume', toggle it's value
            if (pause !== 'pause' && pause !== 'resume' && pause !== null) {
                this._debug('Invalid argument. Toggling pause value instead');
            };

            pause = (pause && (pause == 'pause' || pause == 'resume')) ? pause : 'toggle';

            switch (pause) {
                case 'pause':
                    opts.state.isPaused = true;
                    break;

                case 'resume':
                    opts.state.isPaused = false;
                    break;

                case 'toggle':
                    opts.state.isPaused = !opts.state.isPaused;
                    break;
            }

            this._debug('Paused', opts.state.isPaused);
            return false;

        },

		// Behavior is determined
		// If the behavior option is undefined, it will set to default and bind to scroll
		_setup: function infscr_setup() {
			
			var opts = this.options;
			
			// if behavior is defined and this function is extended, call that instead of default
			if (!!opts.behavior && this['_setup_'+opts.behavior] !== undefined) {
				this['_setup_'+opts.behavior].call(this);
				return;
			}
			
			this._binding('bind');
			
			return false;
			
		},

        // Show done message
        _showdonemsg: function infscr_showdonemsg() {

            var opts = this.options;

			// if behavior is defined and this function is extended, call that instead of default
			if (!!opts.behavior && this['_showdonemsg_'+opts.behavior] !== undefined) {
				this['_showdonemsg_'+opts.behavior].call(this);
				return;
			}

            opts.loading.msg
	    		.find('img')
	    		.hide()
	    		.parent()
	    		.find('div').html(opts.loading.finishedMsg).animate({ opacity: 1 }, 2000, function () {
	    		    $(this).parent().fadeOut('normal');
	    		});

            // user provided callback when done    
            opts.errorCallback.call($(opts.contentSelector)[0],'done');

        },

		// grab each selector option and see if any fail
        _validate: function infscr_validate(opts) {

            for (var key in opts) {
                if (key.indexOf && key.indexOf('Selector') > -1 && $(opts[key]).length === 0) {
                    this._debug('Your ' + key + ' found no elements.');
                    return false;
                }
            }
            
            return true;
            
        },

        /*	
        ----------------------------
        Public methods
        ----------------------------
        */

		// Bind to scroll
		bind: function infscr_bind() {
			this._binding('bind');
		},

        // Destroy current instance of plugin
        destroy: function infscr_destroy() {

            this.options.state.isDestroyed = true;
            return this._error('destroy');

        },

		// Set pause value to false
		pause: function infscr_pause() {
			this._pausing('pause');
		},
		
		// Set pause value to false
		resume: function infscr_resume() {
			this._pausing('resume');
		},

        // Retrieve next set of content items
        retrieve: function infscr_retrieve(pageNum) {

            var instance = this,
				opts = instance.options,
				path = opts.path,
				box, frag, desturl, method, condition,
	    		pageNum = pageNum || null,
				getPage = (!!pageNum) ? pageNum : opts.state.currPage;
				beginAjax = function infscr_ajax(opts) {
					
					// increment the URL bit. e.g. /page/3/
	                opts.state.currPage++;

	                instance._debug('heading into ajax', path);

	                // if we're dealing with a table we can't use DIVs
	                box = $(opts.contentSelector).is('table') ? $('<tbody/>') : $('<div/>');

	                desturl = path.join(opts.state.currPage);

	                method = (opts.dataType == 'html' || opts.dataType == 'json' ) ? opts.dataType : 'html+callback';
	                if (opts.appendCallback && opts.dataType == 'html') method += '+callback'

	                switch (method) {

	                    case 'html+callback':

	                        instance._debug('Using HTML via .load() method');
	                        box.load(desturl + ' ' + opts.itemSelector, null, function infscr_ajax_callback(responseText) {
	                            instance._loadcallback(box, responseText);
	                        });

	                        break;

	                    case 'html':
                            instance._debug('Using ' + (method.toUpperCase()) + ' via $.ajax() method');
                            $.ajax({
                                // params
                                url: desturl,
                                dataType: opts.dataType,
                                complete: function infscr_ajax_callback(jqXHR, textStatus) {
                                    condition = (typeof (jqXHR.isResolved) !== 'undefined') ? (jqXHR.isResolved()) : (textStatus === "success" || textStatus === "notmodified");
                                    (condition) ? instance._loadcallback(box, jqXHR.responseText) : instance._error('end');
                                }
                            });
    
                            break;
	                    case 'json':
	                        instance._debug('Using ' + (method.toUpperCase()) + ' via $.ajax() method');
                            $.ajax({
                              dataType: 'json',
                              type: 'GET',
                              url: desturl,
                              success: function(data, textStatus, jqXHR) {
                                condition = (typeof (jqXHR.isResolved) !== 'undefined') ? (jqXHR.isResolved()) : (textStatus === "success" || textStatus === "notmodified");
                                if(opts.appendCallback) {
                                    // if appendCallback is true, you must defined template in options. 
                                    // note that data passed into _loadcallback is already an html (after processed in opts.template(data)).
                                    if(opts.template != undefined) {
                                        var theData = opts.template(data);
                                        box.append(theData);
                                        (condition) ? instance._loadcallback(box, theData) : instance._error('end');
                                    } else {
                                        instance._debug("template must be defined.");
                                        instance._error('end');
                                    }
                                } else {
                                    // if appendCallback is false, we will pass in the JSON object. you should handle it yourself in your callback.
                                    (condition) ? instance._loadcallback(box, data) : instance._error('end');
                                }
                              },
                              error: function(jqXHR, textStatus, errorThrown) {
                                instance._debug("JSON ajax request failed.");
                                instance._error('end');
                              }
                            });
	
	                        break;
	                }
				};
				
			// if behavior is defined and this function is extended, call that instead of default
			if (!!opts.behavior && this['retrieve_'+opts.behavior] !== undefined) {
				this['retrieve_'+opts.behavior].call(this,pageNum);
				return;
			}

            
			// for manual triggers, if destroyed, get out of here
			if (opts.state.isDestroyed) {
                this._debug('Instance is destroyed');
                return false;
            };

            // we dont want to fire the ajax multiple times
            opts.state.isDuringAjax = true;

            opts.loading.start.call($(opts.contentSelector)[0],opts);

        },

        // Check to see next page is needed
        scroll: function infscr_scroll() {

            var opts = this.options,
				state = opts.state;

            // if behavior is defined and this function is extended, call that instead of default
			if (!!opts.behavior && this['scroll_'+opts.behavior] !== undefined) {
				this['scroll_'+opts.behavior].call(this);
				return;
			}

			if (state.isDuringAjax || state.isInvalidPage || state.isDone || state.isDestroyed || state.isPaused) return;

            if (!this._nearbottom()) return;

            this.retrieve();

        },
		
		// Toggle pause value
		toggle: function infscr_toggle() {
			this._pausing();
		},
		
		// Unbind from scroll
		unbind: function infscr_unbind() {
			this._binding('unbind');
		},
		
		// update options
		update: function infscr_options(key) {
			if ($.isPlainObject(key)) {
				this.options = $.extend(true,this.options,key);
			}
		}

    }


    /*	
    ----------------------------
    Infinite Scroll function
    ----------------------------
	
    Borrowed logic from the following...
	
    jQuery UI
    - https://github.com/jquery/jquery-ui/blob/master/ui/jquery.ui.widget.js
	
    jCarousel
    - https://github.com/jsor/jcarousel/blob/master/lib/jquery.jcarousel.js
	
    Masonry
    - https://github.com/desandro/masonry/blob/master/jquery.masonry.js		
	
    */

    $.fn.infinitescroll = function infscr_init(options, callback) {


        var thisCall = typeof options;

        switch (thisCall) {

            // method 
            case 'string':

                var args = Array.prototype.slice.call(arguments, 1);

                this.each(function () {

                    var instance = $.data(this, 'infinitescroll');

                    if (!instance) {
                        // not setup yet
                        // return $.error('Method ' + options + ' cannot be called until Infinite Scroll is setup');
						return false;
                    }
                    if (!$.isFunction(instance[options]) || options.charAt(0) === "_") {
                        // return $.error('No such method ' + options + ' for Infinite Scroll');
						return false;
                    }

                    // no errors!
                    instance[options].apply(instance, args);

                });

                break;

            // creation 
            case 'object':

                this.each(function () {

                    var instance = $.data(this, 'infinitescroll');

                    if (instance) {

                        // update options of current instance
                        instance.update(options);

                    } else {

                        // initialize new instance
                        instance = new $.infinitescroll(options, callback, this);

                        // don't attach if instantiation failed
                        if (!instance.failed) {
                          $.data(this, 'infinitescroll', instance);
                        }

                    }

                });

                break;

        }

        return this;

    };



    /* 
    * smartscroll: debounced scroll event for jQuery *
    * https://github.com/lukeshumard/smartscroll
    * Based on smartresize by @louis_remi: https://github.com/lrbabe/jquery.smartresize.js *
    * Copyright 2011 Louis-Remi & Luke Shumard * Licensed under the MIT license. *
    */

    var event = $.event,
		scrollTimeout;

    event.special.smartscroll = {
        setup: function () {
            $(this).bind("scroll", event.special.smartscroll.handler);
        },
        teardown: function () {
            $(this).unbind("scroll", event.special.smartscroll.handler);
        },
        handler: function (event, execAsap) {
            // Save the context
            var context = this,
		      args = arguments;

            // set correct event type
            event.type = "smartscroll";

            if (scrollTimeout) { clearTimeout(scrollTimeout); }
            scrollTimeout = setTimeout(function () {
                $.event.handle.apply(context, args);
            }, execAsap === "execAsap" ? 0 : 100);
        }
    };

    $.fn.smartscroll = function (fn) {
        return fn ? this.bind("smartscroll", fn) : this.trigger("smartscroll", ["execAsap"]);
    };


})(window, jQuery);

/*
	--------------------------------
	Infinite Scroll Behavior
	Manual / Twitter-style
	
	REWRITTEN TO USE CUSTOM LOADER
	--------------------------------
	+ https://github.com/paulirish/infinitescroll/
	+ version 2.0b2.110617
	+ Copyright 2011 Paul Irish & Luke Shumard
	+ Licensed under the MIT license
	
	+ Documentation: http://infinite-scroll.com/
	
*/

$.extend($.infinitescroll.prototype,{

	_setup_twitter: function infscr_setup_twitter () {
		var opts = this.options,
			instance = this,
			loader = $('<span class="loading"> ...</span>');

		// custom start
		instance.options.loading.start = function (opts) {
			loader
				.appendTo(opts.loading.selector)
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