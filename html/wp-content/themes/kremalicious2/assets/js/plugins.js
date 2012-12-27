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
 * MBP - Mobile boilerplate helper functions
 */

(function(document){

window.MBP = window.MBP || {};

/* 
   * Fast Buttons - read wiki below before using
   * https://github.com/h5bp/mobile-boilerplate/wiki/JavaScript-Helper
*/

MBP.fastButton = function (element, handler) {
  this.handler = handler;
	
	if (element.length && element.length > 1) {
    for (var singleElIdx in element) {
      this.addClickEvent(element[singleElIdx]);
    }
  } else {
    this.addClickEvent(element);
  }
};
 
MBP.fastButton.prototype.handleEvent = function(event) {
	event = event || window.event;
  switch (event.type) {
    case 'touchstart': this.onTouchStart(event); break;
    case 'touchmove': this.onTouchMove(event); break;
    case 'touchend': this.onClick(event); break;
    case 'click': this.onClick(event); break;
  }
};

MBP.fastButton.prototype.onTouchStart = function(event) {
  var element = event.srcElement;
  event.stopPropagation();
  element.addEventListener('touchend', this, false);
  document.body.addEventListener('touchmove', this, false);
  this.startX = event.touches[0].clientX;
  this.startY = event.touches[0].clientY;
  element.style.backgroundColor = "rgba(0,0,0,.7)";
};

MBP.fastButton.prototype.onTouchMove = function(event) {
  if(Math.abs(event.touches[0].clientX - this.startX) > 10 || 
    Math.abs(event.touches[0].clientY - this.startY) > 10    ) {
    this.reset(element);
  }
};

MBP.fastButton.prototype.onClick = function(event) {
	event = event || window.event;
  var element = event.srcElement;
  if (event.stopPropagation) { event.stopPropagation(); }
  this.reset(event);
  this.handler.apply(event.currentTarget, [event]);
  if(event.type == 'touchend') {
    MBP.preventGhostClick(this.startX, this.startY);
  }
  element.style.backgroundColor = "";
};

MBP.fastButton.prototype.reset = function(event) {
  var element = event.srcElement;
	rmEvt(element, "touchend", this, false);
	rmEvt(document.body, "touchmove", this, false);
  element.style.backgroundColor = "";
};

MBP.fastButton.prototype.addClickEvent = function(element) {
  addEvt(element, "touchstart", this, false);
  addEvt(element, "click", this, false);
};

MBP.preventGhostClick = function (x, y) {
  MBP.coords.push(x, y);
  window.setTimeout(function (){
    MBP.coords.splice(0, 2);
  }, 2500);
};

MBP.ghostClickHandler = function (event) {
  if (!MBP.hadTouchEvent && 'ontouchstart' in window) {
    // This is a bit of fun for Android 2.3...
    // If you change window.location via fastButton, a click event will fire
    // on the new page, as if the events are continuing from the previous page.
    // We pick that event up here, but MBP.coords is empty, because it's a new page,
    // so we don't prevent it. Here's we're assuming that click events on touch devices
    // that occur without a preceding touchStart are to be ignored. 
    event.stopPropagation();
    event.preventDefault();
    return;
  }
  for(var i = 0, len = MBP.coords.length; i < len; i += 2) {
    var x = MBP.coords[i];
    var y = MBP.coords[i + 1];
    if(Math.abs(event.clientX - x) < 25 && Math.abs(event.clientY - y) < 25) {
      event.stopPropagation();
      event.preventDefault();
    }
  }
};

if (document.addEventListener) {
  document.addEventListener('click', MBP.ghostClickHandler, true);
}

addEvt( document.documentElement, 'touchstart', function() {
  MBP.hadTouchEvent = true;
}, false);
                            
MBP.coords = [];

// fn arg can be an object or a function, thanks to handleEvent
// read more about the explanation at: http://www.thecssninja.com/javascript/handleevent
function addEvt(el, evt, fn, bubble) {
  if("addEventListener" in el) {
    // BBOS6 doesn't support handleEvent, catch and polyfill
    try {
      el.addEventListener(evt, fn, bubble);
    } catch(e) {
      if(typeof fn == "object" && fn.handleEvent) {
        el.addEventListener(evt, function(e){
        // Bind fn as this and set first arg as event object
        fn.handleEvent.call(fn,e);
        }, bubble);
      } else {
        throw e;
      }
    }
  } else if("attachEvent" in el) {
    // check if the callback is an object and contains handleEvent
    if(typeof fn == "object" && fn.handleEvent) {
      el.attachEvent("on" + evt, function(){
        // Bind fn as this
        fn.handleEvent.call(fn);
      });
    } else {
      el.attachEvent("on" + evt, fn);
    }
  }
}

function rmEvt(el, evt, fn, bubble) {
  if("removeEventListener" in el) {
    // BBOS6 doesn't support handleEvent, catch and polyfill
    try {
      el.removeEventListener(evt, fn, bubble);
    } catch(e) {
      if(typeof fn == "object" && fn.handleEvent) {
        el.removeEventListener(evt, function(e){
          // Bind fn as this and set first arg as event object
          fn.handleEvent.call(fn,e);
        }, bubble);
      } else {
        throw e;
      }
    }
  } else if("detachEvent" in el) {
    // check if the callback is an object and contains handleEvent
    if(typeof fn == "object" && fn.handleEvent) {
      el.detachEvent("on" + evt, function(){
        // Bind fn as this
        fn.handleEvent.call(fn);
      });
    } else {
      el.detachEvent("on" + evt, fn);
    }
  }
}


/* 
  * Enable active
  * Enable CSS active pseudo styles in Mobile Safari
  * http://miniapps.co.uk/blog/post/enable-css-active-pseudo-styles-in-mobile-safari/
*/

MBP.enableActive = function () {
  document.addEventListener("touchstart", function() {}, false);
};

})(document);
