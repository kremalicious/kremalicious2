/*
 * Socialite v1.0
 * http://socialitejs.com
 * Copyright (c) 2011 David Bushell
 * Dual-licensed under the BSD or MIT licenses: http://socialitejs.com/license.txt
 */
window.Socialite=function(a,b,c){var d={},e={},f={},g={},h={},i={},j={},k=a.setTimeout,l=encodeURIComponent,m=typeof b.getElementsByClassName=="function";return e.appendScript=function(a,d,f){if(g[a]||h[a]===c)return!1;var j=g[a]=b.createElement("script");return j.async=!0,j.src=h[a],j.onload=j.onreadystatechange=function(){if(e.hasLoaded(a))return;var b=j.readyState;if(!b||b==="loaded"||b==="complete")i[a]=!0,j.onload=j.onreadystatechange=null,f!==c?typeof f=="function"&&f():e.activateCache(a)},d&&(j.id=d),b.body.appendChild(j),!0},e.hasLoaded=function(a){return typeof a!="string"?!1:i[a]===!0},e.removeScript=function(a){return e.hasLoaded(a)?(b.body.removeChild(g[a]),g[a]=i[a]=!1,!0):!1},e.createIframe=function(a,d){var f=b.createElement("iframe");return f.style.cssText="overflow: hidden; border: none;",f.setAttribute("allowtransparency","true"),f.setAttribute("frameborder","0"),f.setAttribute("scrolling","no"),f.setAttribute("src",a),d!==c&&(m?f.onload=f.onreadystatechange=function(){f.onload=f.onreadystatechange=null,e.activateInstance(d)}:k(function(){e.activateInstance(d)},10)),f},e.activateInstance=function(a){if(a.loaded)return;a.loaded=!0,a.container.className+=" socialite-loaded"},e.activateCache=function(a){if(j[a]!==c)for(var b=0;b<j[a].length;b++)e.activateInstance(j[a][b])},e.copyDataAttributes=function(a,b){var c,d=a.attributes;for(c=0;c<d.length;c++){var e=d[c].name,f=d[c].value;e.indexOf("data-")===0&&f.length&&b.setAttribute(e,f)}},e.getDataAttributes=function(a,b,c){var d,e="",f={},g=a.attributes;for(d=0;d<g.length;d++){var h=g[d].name,i=g[d].value;h.indexOf("data-")===0&&i.length&&(b===!0&&(h=h.substring(5)),c?f[h]=i:e+=l(h)+"="+l(i)+"&")}return c?f:e},e.getElements=function(a,b){if(m)return a.getElementsByClassName(b);var c=0,d=[],e=a.getElementsByTagName("*"),f=e.length;for(c=0;c<f;c++){var g=" "+e[c].className+" ";g.indexOf(" "+b+" ")!==-1&&d.push(e[c])}return d},d.activate=function(a,b){d.load(null,a,b)},d.load=function(a,g,h){a=typeof a=="object"&&a!==null&&a.nodeType===1?a:b;if(g===c||g===null){var i=e.getElements(a,"socialite"),k=i,l=i.length;if(!l)return;if(typeof k.item!==c){k=[];for(var m=0;m<l;m++)k[m]=i[m]}d.load(a,k,h);return}if(typeof g=="object"&&g.length){for(var n=0;n<g.length;n++)d.load(a,g[n],h);return}if(typeof g!="object"||g.nodeType!==1)return;if(typeof h!="string"||f[h]===c){h=null;var o=g.className.split(" ");for(var p=0;p<o.length;p++)if(f[o[p]]!==c){h=o[p];break}if(typeof h!="string")return}typeof f[h]=="string"&&(h=f[h]);if(typeof f[h]!="function")return;var q=b.createElement("div"),r=b.createElement("div");q.className="socialised "+h,r.className="socialite-button";var s=g.parentNode;s===null?(s=a===b?b.body:a,s.appendChild(q)):s.insertBefore(q,g),q.appendChild(r),r.appendChild(g),g.className=g.className.replace(/\bsocialite\b/,""),j[h]===c&&(j[h]=[]);var t={elem:g,button:r,container:q,parent:s,loaded:!1};j[h].push(t),f[h](t,e)},d.extend=function(a,b,d){if(typeof a!="string"||typeof b!="function")return!1;a=a.indexOf(" ")>0?a.split(" "):[a];if(f[a[0]]!==c)return!1;for(var e=1;e<a.length;e++)f[a[e]]=a[0];return d!==c&&typeof d=="string"&&(h[a[0]]=d),f[a[0]]=b,!0},d}(window,window.document),function(a,b,c,d){c.extend("twitter tweet",function(c,e){var f=c.elem,g=" "+f.className+" ";if(g.indexOf(" tweet ")!==-1)f.className="twitter-tweet";else{var h=b.createElement("a"),i=f.getAttribute("data-type"),j=["share","follow","hashtag","mention"],k=0;for(var l=1;l<4;l++)if(i===j[l]||g.indexOf(" "+j[l]+" ")!==-1)k=l;h.className="twitter-"+j[k]+"-button",f.getAttribute("href")!==d&&h.setAttribute("href",f.href),e.copyDataAttributes(f,h),c.button.replaceChild(h,f)}var m=a.twttr;typeof m=="object"&&typeof m.widgets=="object"&&typeof m.widgets.load=="function"?(m.widgets.load(),e.activateInstance(c)):(e.hasLoaded("twitter")&&e.removeScript("twitter"),e.appendScript("twitter","twitter-wjs",!1)&&(a.twttr={_e:[function(){e.activateCache("twitter")}]}))},"//platform.twitter.com/widgets.js"),c.extend("googleplus",function(c,d){var e=c.elem,f=b.createElement("div");f.className="g-plusone",d.copyDataAttributes(e,f),c.button.replaceChild(f,e),typeof a.gapi=="object"&&typeof a.gapi.plusone=="object"&&typeof gapi.plusone.render=="function"?(a.gapi.plusone.render(c.button,d.getDataAttributes(f,!0,!0)),d.activateInstance(c)):d.hasLoaded("googleplus")||d.appendScript("googleplus")},"//apis.google.com/js/plusone.js"),c.extend("facebook",function(a,c){var d=a.elem,e=b.createElement("div"),f=b.getElementById("fb-root");if(!f&&!c.hasLoaded("facebook"))f=b.createElement("div"),f.id="fb-root",b.body.appendChild(f),e.className="fb-like",c.copyDataAttributes(d,e),a.button.replaceChild(e,d),c.appendScript("facebook","facebook-jssdk");else{var g="//www.facebook.com/plugins/like.php?";g+=c.getDataAttributes(d,!0);var h=c.createIframe(g,a);a.button.replaceChild(h,d)}},"//connect.facebook.net/en_US/all.js#xfbml=1"),c.extend("linkedin",function(c,d){var e=c.elem,f=e.attributes,g=b.createElement("script");g.type="IN/Share",d.copyDataAttributes(e,g),c.button.replaceChild(g,e),typeof a.IN=="object"&&typeof a.IN.init=="function"?(a.IN.init(),d.activateInstance(c)):d.hasLoaded("linkedin")||d.appendScript("linkedin")},"//platform.linkedin.com/in.js"),c.extend("pinit",function(a,c){var e=a.elem,f=b.createElement("a");f.className="pin-it-button",e.getAttribute("href")!==d&&f.setAttribute("href",e.href);var g=e.getAttribute("data-count-layout")||"horizontal";f.setAttribute("count-layout",g),a.button.replaceChild(f,e),c.hasLoaded("pinit")&&c.removeScript("pinit"),c.appendScript("pinit")},"//assets.pinterest.com/js/pinit.js"),c.extend("spotify-play",function(a,b){var c=a.elem,d="https://embed.spotify.com/?",e=parseInt(c.getAttribute("data-width"),10),f=parseInt(c.getAttribute("data-height"),10);c.removeAttribute("data-width"),c.removeAttribute("data-height"),d+="uri="+c.getAttribute("href")+"&",d+=b.getDataAttributes(c,!0);var g=b.createIframe(d,a);g.style.width=(isNaN(e)?300:e)+"px",g.style.height=(isNaN(f)?380:f)+"px",a.button.replaceChild(g,c),b.activateInstance(a)},"")}(window,window.document,window.Socialite);


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

(function(h,d,e){d.infinitescroll=function(a,c,b){this.element=d(b);this._create(a,c)||(this.failed=!0)};d.infinitescroll.defaults={loading:{finished:e,finishedMsg:"<em>Congratulations, you've reached the end of the internet.</em>",img:"http://www.infinite-scroll.com/loading.gif",msg:null,msgText:"<em>Loading the next set of posts...</em>",selector:null,speed:"fast",start:e},state:{isDuringAjax:!1,isInvalidPage:!1,isDestroyed:!1,isDone:!1,isPaused:!1,currPage:1},callback:e,debug:!1,behavior:e,binder:d(h),
nextSelector:"div.navigation a:first",navSelector:"div.navigation",contentSelector:null,extraScrollPx:150,itemSelector:"div.post",animate:!1,pathParse:e,dataType:"html",appendCallback:!0,bufferPx:40,errorCallback:function(){},infid:0,pixelsFromNavToBottom:e,path:e};d.infinitescroll.prototype={_binding:function(a){var c=this,b=c.options;b.v="2.0b2.111027";if(b.behavior&&this["_binding_"+b.behavior]!==e)this["_binding_"+b.behavior].call(this);else{if("bind"!==a&&"unbind"!==a)return this._debug("Binding value  "+
a+" not valid"),!1;if("unbind"==a)this.options.binder.unbind("smartscroll.infscr."+c.options.infid);else this.options.binder[a]("smartscroll.infscr."+c.options.infid,function(){c.scroll()});this._debug("Binding",a)}},_create:function(a,c){var b=d.extend(!0,{},d.infinitescroll.defaults,a);if(!this._validate(a))return!1;this.options=b;var g=d(b.nextSelector).attr("href");if(!g)return this._debug("Navigation selector not found"),!1;b.path=this._determinepath(g);b.contentSelector=b.contentSelector||this.element;
b.loading.selector=b.loading.selector||b.contentSelector;b.loading.msg=d('<div id="infscr-loading"><img alt="Loading..." src="'+b.loading.img+'" /><div>'+b.loading.msgText+"</div></div>");(new Image).src=b.loading.img;b.pixelsFromNavToBottom=d(document).height()-d(b.navSelector).offset().top;b.loading.start=b.loading.start||function(){d(b.navSelector).hide();b.loading.msg.appendTo(b.loading.selector).show(b.loading.speed,function(){beginAjax(b)})};b.loading.finished=b.loading.finished||function(){b.loading.msg.fadeOut("normal")};
b.callback=function(a,g){b.behavior&&a["_callback_"+b.behavior]!==e&&a["_callback_"+b.behavior].call(d(b.contentSelector)[0],g);c&&c.call(d(b.contentSelector)[0],g,b)};this._setup();return!0},_debug:function(){if(this.options&&this.options.debug)return h.console&&console.log.call(console,arguments)},_determinepath:function(a){var c=this.options;if(c.behavior&&this["_determinepath_"+c.behavior]!==e)this["_determinepath_"+c.behavior].call(this,a);else{if(c.pathParse)return this._debug("pathParse manual"),
c.pathParse(a,this.options.state.currPage+1);if(a.match(/^(.*?)\b2\b(.*?$)/))a=a.match(/^(.*?)\b2\b(.*?$)/).slice(1);else if(a.match(/^(.*?)2(.*?$)/)){if(a.match(/^(.*?page=)2(\/.*|$)/))return a=a.match(/^(.*?page=)2(\/.*|$)/).slice(1);a=a.match(/^(.*?)2(.*?$)/).slice(1)}else{if(a.match(/^(.*?page=)1(\/.*|$)/))return a=a.match(/^(.*?page=)1(\/.*|$)/).slice(1);this._debug("Sorry, we couldn't parse your Next (Previous Posts) URL. Verify your the css selector points to the correct A tag. If you still get this error: yell, scream, and kindly ask for help at infinite-scroll.com.");
c.state.isInvalidPage=!0}this._debug("determinePath",a);return a}},_error:function(a){var c=this.options;c.behavior&&this["_error_"+c.behavior]!==e?this["_error_"+c.behavior].call(this,a):("destroy"!==a&&"end"!==a&&(a="unknown"),this._debug("Error",a),"end"==a&&this._showdonemsg(),c.state.isDone=!0,c.state.currPage=1,c.state.isPaused=!1,this._binding("unbind"))},_loadcallback:function(a,c){var b=this.options,g=this.options.callback,f=b.state.isDone?"done":!b.appendCallback?"no-append":"append";if(b.behavior&&
this["_loadcallback_"+b.behavior]!==e)this["_loadcallback_"+b.behavior].call(this,a,c);else{switch(f){case "done":return this._showdonemsg(),!1;case "no-append":"html"==b.dataType&&(c=d("<div>"+c+"</div>").find(b.itemSelector));break;case "append":var i=a.children();if(0==i.length)return this._error("end");for(f=document.createDocumentFragment();a[0].firstChild;)f.appendChild(a[0].firstChild);this._debug("contentSelector",d(b.contentSelector)[0]);d(b.contentSelector)[0].appendChild(f);c=i.get()}b.loading.finished.call(d(b.contentSelector)[0],
b);b.animate&&(f=d(h).scrollTop()+d("#infscr-loading").height()+b.extraScrollPx+"px",d("html,body").animate({scrollTop:f},800,function(){b.state.isDuringAjax=!1}));b.animate||(b.state.isDuringAjax=!1);g(this,c)}},_nearbottom:function(){var a=this.options,c=0+d(document).height()-a.binder.scrollTop()-d(h).height();if(a.behavior&&this["_nearbottom_"+a.behavior]!==e)return this["_nearbottom_"+a.behavior].call(this);this._debug("math:",c,a.pixelsFromNavToBottom);return c-a.bufferPx<a.pixelsFromNavToBottom},
_pausing:function(a){var c=this.options;if(c.behavior&&this["_pausing_"+c.behavior]!==e)this["_pausing_"+c.behavior].call(this,a);else{"pause"!==a&&("resume"!==a&&null!==a)&&this._debug("Invalid argument. Toggling pause value instead");switch(a&&("pause"==a||"resume"==a)?a:"toggle"){case "pause":c.state.isPaused=!0;break;case "resume":c.state.isPaused=!1;break;case "toggle":c.state.isPaused=!c.state.isPaused}this._debug("Paused",c.state.isPaused);return!1}},_setup:function(){var a=this.options;if(a.behavior&&
this["_setup_"+a.behavior]!==e)this["_setup_"+a.behavior].call(this);else return this._binding("bind"),!1},_showdonemsg:function(){var a=this.options;a.behavior&&this["_showdonemsg_"+a.behavior]!==e?this["_showdonemsg_"+a.behavior].call(this):(a.loading.msg.find("img").hide().parent().find("div").html(a.loading.finishedMsg).animate({opacity:1},2E3,function(){d(this).parent().fadeOut("normal")}),a.errorCallback.call(d(a.contentSelector)[0],"done"))},_validate:function(a){for(var c in a)if(c.indexOf&&
-1<c.indexOf("Selector")&&0===d(a[c]).length)return this._debug("Your "+c+" found no elements."),!1;return!0},bind:function(){this._binding("bind")},destroy:function(){this.options.state.isDestroyed=!0;return this._error("destroy")},pause:function(){this._pausing("pause")},resume:function(){this._pausing("resume")},retrieve:function(a){var c=this,b=c.options,g=b.path,f,i,j,h,a=a||null;beginAjax=function(a){a.state.currPage++;c._debug("heading into ajax",g);f=d(a.contentSelector).is("table")?d("<tbody/>"):
d("<div/>");i=g.join(a.state.currPage);j="html"==a.dataType||"json"==a.dataType?a.dataType:"html+callback";a.appendCallback&&"html"==a.dataType&&(j+="+callback");switch(j){case "html+callback":c._debug("Using HTML via .load() method");f.load(i+" "+a.itemSelector,null,function(a){c._loadcallback(f,a)});break;case "html":c._debug("Using "+j.toUpperCase()+" via $.ajax() method");d.ajax({url:i,dataType:a.dataType,complete:function(a,b){(h="undefined"!==typeof a.isResolved?a.isResolved():"success"===b||
"notmodified"===b)?c._loadcallback(f,a.responseText):c._error("end")}});break;case "json":c._debug("Using "+j.toUpperCase()+" via $.ajax() method"),d.ajax({dataType:"json",type:"GET",url:i,success:function(b,d,g){h="undefined"!==typeof g.isResolved?g.isResolved():"success"===d||"notmodified"===d;a.appendCallback?a.template!=e?(b=a.template(b),f.append(b),h?c._loadcallback(f,b):c._error("end")):(c._debug("template must be defined."),c._error("end")):h?c._loadcallback(f,b):c._error("end")},error:function(){c._debug("JSON ajax request failed.");
c._error("end")}})}};if(b.behavior&&this["retrieve_"+b.behavior]!==e)this["retrieve_"+b.behavior].call(this,a);else{if(b.state.isDestroyed)return this._debug("Instance is destroyed"),!1;b.state.isDuringAjax=!0;b.loading.start.call(d(b.contentSelector)[0],b)}},scroll:function(){var a=this.options,c=a.state;a.behavior&&this["scroll_"+a.behavior]!==e?this["scroll_"+a.behavior].call(this):!c.isDuringAjax&&!c.isInvalidPage&&!c.isDone&&!c.isDestroyed&&!c.isPaused&&this._nearbottom()&&this.retrieve()},toggle:function(){this._pausing()},
unbind:function(){this._binding("unbind")},update:function(a){d.isPlainObject(a)&&(this.options=d.extend(!0,this.options,a))}};d.fn.infinitescroll=function(a,c){switch(typeof a){case "string":var b=Array.prototype.slice.call(arguments,1);this.each(function(){var c=d.data(this,"infinitescroll");if(!c||!d.isFunction(c[a])||"_"===a.charAt(0))return!1;c[a].apply(c,b)});break;case "object":this.each(function(){var b=d.data(this,"infinitescroll");b?b.update(a):(b=new d.infinitescroll(a,c,this),b.failed||
d.data(this,"infinitescroll",b))})}return this};var k=d.event,l;k.special.smartscroll={setup:function(){d(this).bind("scroll",k.special.smartscroll.handler)},teardown:function(){d(this).unbind("scroll",k.special.smartscroll.handler)},handler:function(a,c){var b=this,e=arguments;a.type="smartscroll";l&&clearTimeout(l);l=setTimeout(function(){d.event.handle.apply(b,e)},"execAsap"===c?0:100)}};d.fn.smartscroll=function(a){return a?this.bind("smartscroll",a):this.trigger("smartscroll",["execAsap"])}})(window,
jQuery);