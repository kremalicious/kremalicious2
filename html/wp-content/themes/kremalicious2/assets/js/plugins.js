/*
 * MBP - Mobile boilerplate helper functions
 */

(function(document){

window.MBP = window.MBP || {}; 


/* 
  * Fix for iPhone viewport scale bug 
  * http://www.blog.highub.com/mobile-2/a-fix-for-iphone-viewport-scale-bug/
*/

MBP.viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]');
MBP.ua = navigator.userAgent;

MBP.scaleFix = function () {
  if (MBP.viewportmeta && /iPhone|iPad|iPod/.test(MBP.ua) && !/Opera Mini/.test(MBP.ua)) {
    MBP.viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
    document.addEventListener("gesturestart", MBP.gestureStart, false);
  }
};
MBP.gestureStart = function () {
  MBP.viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
};

/* 
  * Autogrow
  * http://googlecode.blogspot.com/2009/07/gmail-for-mobile-html5-series.html
*/

MBP.autogrow = function (element, lh) {
  function handler(e){
    var newHeight = this.scrollHeight,
        currentHeight = this.clientHeight;
    if (newHeight > currentHeight) {
      this.style.height = newHeight + 3 * textLineHeight + "px";
    }
  }

  var setLineHeight = (lh) ? lh : 12,
      textLineHeight = element.currentStyle ? element.currentStyle.lineHeight : 
                       getComputedStyle(element, null).lineHeight;

  textLineHeight = (textLineHeight.indexOf("px") == -1) ? setLineHeight :
                   parseInt(textLineHeight, 10);

  element.style.overflow = "hidden";
  element.addEventListener ? element.addEventListener('keyup', handler, false) :
                             element.attachEvent('onkeyup', handler);
};

/* 
  * Enable active
  * Enable CSS active pseudo styles in Mobile Safari
  * http://miniapps.co.uk/blog/post/enable-css-active-pseudo-styles-in-mobile-safari/
*/

MBP.enableActive = function () {
  document.addEventListener("touchstart", function() {}, false);
};


})(document);


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
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
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
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});


/* ===========================================================
 * bootstrap-tooltip.js v2.0.2
 * http://twitter.github.com/bootstrap/javascript.html#tooltips
 * Inspired by the original jQuery.tipsy by Jason Frame
 * ===========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */

!function( $ ) {

  "use strict"

 /* TOOLTIP PUBLIC CLASS DEFINITION
  * =============================== */

  var Tooltip = function ( element, options ) {
    this.init('tooltip', element, options)
  }

  Tooltip.prototype = {

    constructor: Tooltip

  , init: function ( type, element, options ) {
      var eventIn
        , eventOut

      this.type = type
      this.$element = $(element)
      this.options = this.getOptions(options)
      this.enabled = true

      if (this.options.trigger != 'manual') {
        eventIn  = this.options.trigger == 'hover' ? 'mouseenter' : 'focus'
        eventOut = this.options.trigger == 'hover' ? 'mouseleave' : 'blur'
        this.$element.on(eventIn, this.options.selector, $.proxy(this.enter, this))
        this.$element.on(eventOut, this.options.selector, $.proxy(this.leave, this))
      }

      this.options.selector ?
        (this._options = $.extend({}, this.options, { trigger: 'manual', selector: '' })) :
        this.fixTitle()
    }

  , getOptions: function ( options ) {
      options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data())

      if (options.delay && typeof options.delay == 'number') {
        options.delay = {
          show: options.delay
        , hide: options.delay
        }
      }

      return options
    }

  , enter: function ( e ) {
      var self = $(e.currentTarget)[this.type](this._options).data(this.type)

      if (!self.options.delay || !self.options.delay.show) {
        self.show()
      } else {
        self.hoverState = 'in'
        setTimeout(function() {
          if (self.hoverState == 'in') {
            self.show()
          }
        }, self.options.delay.show)
      }
    }

  , leave: function ( e ) {
      var self = $(e.currentTarget)[this.type](this._options).data(this.type)

      if (!self.options.delay || !self.options.delay.hide) {
        self.hide()
      } else {
        self.hoverState = 'out'
        setTimeout(function() {
          if (self.hoverState == 'out') {
            self.hide()
          }
        }, self.options.delay.hide)
      }
    }

  , show: function () {
      var $tip
        , inside
        , pos
        , actualWidth
        , actualHeight
        , placement
        , tp

      if (this.hasContent() && this.enabled) {
        $tip = this.tip()
        this.setContent()

        if (this.options.animation) {
          $tip.addClass('fade')
        }

        placement = typeof this.options.placement == 'function' ?
          this.options.placement.call(this, $tip[0], this.$element[0]) :
          this.options.placement

        inside = /in/.test(placement)

        $tip
          .remove()
          .css({ top: 0, left: 0, display: 'block' })
          .appendTo(inside ? this.$element : document.body)

        pos = this.getPosition(inside)

        actualWidth = $tip[0].offsetWidth
        actualHeight = $tip[0].offsetHeight

        switch (inside ? placement.split(' ')[1] : placement) {
          case 'bottom':
            tp = {top: pos.top + pos.height, left: pos.left + pos.width / 2 - actualWidth / 2}
            break
          case 'top':
            tp = {top: pos.top - actualHeight, left: pos.left + pos.width / 2 - actualWidth / 2}
            break
          case 'left':
            tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left - actualWidth}
            break
          case 'right':
            tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left + pos.width}
            break
        }

        $tip
          .css(tp)
          .addClass(placement)
          .addClass('in')
      }
    }

  , setContent: function () {
      var $tip = this.tip()
      $tip.find('.tooltip-inner').html(this.getTitle())
      $tip.removeClass('fade in top bottom left right')
    }

  , hide: function () {
      var that = this
        , $tip = this.tip()

      $tip.removeClass('in')

      function removeWithAnimation() {
        var timeout = setTimeout(function () {
          $tip.off($.support.transition.end).remove()
        }, 500)

        $tip.one($.support.transition.end, function () {
          clearTimeout(timeout)
          $tip.remove()
        })
      }

      $.support.transition && this.$tip.hasClass('fade') ?
        removeWithAnimation() :
        $tip.remove()
    }

  , fixTitle: function () {
      var $e = this.$element
      if ($e.attr('title') || typeof($e.attr('data-original-title')) != 'string') {
        $e.attr('data-original-title', $e.attr('title') || '').removeAttr('title')
      }
    }

  , hasContent: function () {
      return this.getTitle()
    }

  , getPosition: function (inside) {
      return $.extend({}, (inside ? {top: 0, left: 0} : this.$element.offset()), {
        width: this.$element[0].offsetWidth
      , height: this.$element[0].offsetHeight
      })
    }

  , getTitle: function () {
      var title
        , $e = this.$element
        , o = this.options

      title = $e.attr('data-original-title')
        || (typeof o.title == 'function' ? o.title.call($e[0]) :  o.title)

      title = (title || '').toString().replace(/(^\s*|\s*$)/, "")

      return title
    }

  , tip: function () {
      return this.$tip = this.$tip || $(this.options.template)
    }

  , validate: function () {
      if (!this.$element[0].parentNode) {
        this.hide()
        this.$element = null
        this.options = null
      }
    }

  , enable: function () {
      this.enabled = true
    }

  , disable: function () {
      this.enabled = false
    }

  , toggleEnabled: function () {
      this.enabled = !this.enabled
    }

  , toggle: function () {
      this[this.tip().hasClass('in') ? 'hide' : 'show']()
    }

  }


 /* TOOLTIP PLUGIN DEFINITION
  * ========================= */

  $.fn.tooltip = function ( option ) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('tooltip')
        , options = typeof option == 'object' && option
      if (!data) $this.data('tooltip', (data = new Tooltip(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.tooltip.Constructor = Tooltip

  $.fn.tooltip.defaults = {
    animation: true
  , delay: 0
  , selector: false
  , placement: 'top'
  , trigger: 'hover'
  , title: ''
  , template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
  }

}( window.jQuery );