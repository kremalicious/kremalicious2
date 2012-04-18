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

