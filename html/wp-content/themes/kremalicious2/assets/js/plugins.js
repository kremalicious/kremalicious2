/*!
 * Masonry PACKAGED v3.0.1
 * Cascading grid layout library
 * http://masonry.desandro.com
 * MIT License
 * by David DeSandro
 */
(function(t){"use strict";function e(t){if(t){if("string"==typeof n[t])return t;t=t.charAt(0).toUpperCase()+t.slice(1);for(var e,o=0,r=i.length;r>o;o++)if(e=i[o]+t,"string"==typeof n[e])return e}}var i="Webkit Moz ms Ms O".split(" "),n=document.documentElement.style;"function"==typeof define&&define.amd?define(function(){return e}):t.getStyleProperty=e})(window),function(t){"use strict";function e(t){var e=parseFloat(t),i=-1===t.indexOf("%")&&!isNaN(e);return i&&e}function i(){for(var t={width:0,height:0,innerWidth:0,innerHeight:0,outerWidth:0,outerHeight:0},e=0,i=s.length;i>e;e++){var n=s[e];t[n]=0}return t}function n(t){function n(t){if("string"==typeof t&&(t=document.querySelector(t)),t&&"object"==typeof t&&t.nodeType){var n=r(t);if("none"===n.display)return i();var h={};h.width=t.offsetWidth,h.height=t.offsetHeight;for(var p=h.isBorderBox=!(!a||!n[a]||"border-box"!==n[a]),u=0,f=s.length;f>u;u++){var d=s[u],c=n[d],l=parseFloat(c);h[d]=isNaN(l)?0:l}var m=h.paddingLeft+h.paddingRight,y=h.paddingTop+h.paddingBottom,g=h.marginLeft+h.marginRight,v=h.marginTop+h.marginBottom,_=h.borderLeftWidth+h.borderRightWidth,b=h.borderTopWidth+h.borderBottomWidth,L=p&&o,E=e(n.width);E!==!1&&(h.width=E+(L?0:m+_));var I=e(n.height);return I!==!1&&(h.height=I+(L?0:y+b)),h.innerWidth=h.width-(m+_),h.innerHeight=h.height-(y+b),h.outerWidth=h.width+g,h.outerHeight=h.height+v,h}}var o,a=t("boxSizing");return function(){if(a){var t=document.createElement("div");t.style.width="200px",t.style.padding="1px 2px 3px 4px",t.style.borderStyle="solid",t.style.borderWidth="1px 2px 3px 4px",t.style[a]="border-box";var i=document.body||document.documentElement;i.appendChild(t);var n=r(t);o=200===e(n.width),i.removeChild(t)}}(),n}var o=document.defaultView,r=o&&o.getComputedStyle?function(t){return o.getComputedStyle(t,null)}:function(t){return t.currentStyle},s=["paddingLeft","paddingRight","paddingTop","paddingBottom","marginLeft","marginRight","marginTop","marginBottom","borderLeftWidth","borderRightWidth","borderTopWidth","borderBottomWidth"];"function"==typeof define&&define.amd?define(["get-style-property"],n):t.getSize=n(t.getStyleProperty)}(window),function(t){"use strict";var e=document.documentElement,i=function(){};e.addEventListener?i=function(t,e,i){t.addEventListener(e,i,!1)}:e.attachEvent&&(i=function(e,i,n){e[i+n]=n.handleEvent?function(){var e=t.event;e.target=e.target||e.srcElement,n.handleEvent.call(n,e)}:function(){var i=t.event;i.target=i.target||i.srcElement,n.call(e,i)},e.attachEvent("on"+i,e[i+n])});var n=function(){};e.removeEventListener?n=function(t,e,i){t.removeEventListener(e,i,!1)}:e.detachEvent&&(n=function(t,e,i){t.detachEvent("on"+e,t[e+i]);try{delete t[e+i]}catch(n){t[e+i]=void 0}});var o={bind:i,unbind:n};"function"==typeof define&&define.amd?define(o):t.eventie=o}(this),function(t){"use strict";function e(t){"function"==typeof t&&(e.isReady?t():r.push(t))}function i(t){var i="readystatechange"===t.type&&"complete"!==o.readyState;if(!e.isReady&&!i){e.isReady=!0;for(var n=0,s=r.length;s>n;n++){var a=r[n];a()}}}function n(n){return n.bind(o,"DOMContentLoaded",i),n.bind(o,"readystatechange",i),n.bind(t,"load",i),e}var o=t.document,r=[];e.isReady=!1,"function"==typeof define&&define.amd?define(["eventie"],n):t.docReady=n(t.eventie)}(this),function(t){"use strict";function e(){}function i(t,e){if(o)return e.indexOf(t);for(var i=e.length;i--;)if(e[i]===t)return i;return-1}var n=e.prototype,o=Array.prototype.indexOf?!0:!1;n._getEvents=function(){return this._events||(this._events={})},n.getListeners=function(t){var e,i,n=this._getEvents();if("object"==typeof t){e={};for(i in n)n.hasOwnProperty(i)&&t.test(i)&&(e[i]=n[i])}else e=n[t]||(n[t]=[]);return e},n.getListenersAsObject=function(t){var e,i=this.getListeners(t);return i instanceof Array&&(e={},e[t]=i),e||i},n.addListener=function(t,e){var n,o=this.getListenersAsObject(t);for(n in o)o.hasOwnProperty(n)&&-1===i(e,o[n])&&o[n].push(e);return this},n.on=n.addListener,n.defineEvent=function(t){return this.getListeners(t),this},n.defineEvents=function(t){for(var e=0;t.length>e;e+=1)this.defineEvent(t[e]);return this},n.removeListener=function(t,e){var n,o,r=this.getListenersAsObject(t);for(o in r)r.hasOwnProperty(o)&&(n=i(e,r[o]),-1!==n&&r[o].splice(n,1));return this},n.off=n.removeListener,n.addListeners=function(t,e){return this.manipulateListeners(!1,t,e)},n.removeListeners=function(t,e){return this.manipulateListeners(!0,t,e)},n.manipulateListeners=function(t,e,i){var n,o,r=t?this.removeListener:this.addListener,s=t?this.removeListeners:this.addListeners;if("object"!=typeof e||e instanceof RegExp)for(n=i.length;n--;)r.call(this,e,i[n]);else for(n in e)e.hasOwnProperty(n)&&(o=e[n])&&("function"==typeof o?r.call(this,n,o):s.call(this,n,o));return this},n.removeEvent=function(t){var e,i=typeof t,n=this._getEvents();if("string"===i)delete n[t];else if("object"===i)for(e in n)n.hasOwnProperty(e)&&t.test(e)&&delete n[e];else delete this._events;return this},n.emitEvent=function(t,e){var i,n,o,r=this.getListenersAsObject(t);for(n in r)if(r.hasOwnProperty(n))for(i=r[n].length;i--;)o=e?r[n][i].apply(null,e):r[n][i](),o===!0&&this.removeListener(t,r[n][i]);return this},n.trigger=n.emitEvent,n.emit=function(t){var e=Array.prototype.slice.call(arguments,1);return this.emitEvent(t,e)},"function"==typeof define&&define.amd?define(function(){return e}):t.EventEmitter=e}(this),function(t){"use strict";function e(){}function i(t){function i(e){e.prototype.option||(e.prototype.option=function(e){t.isPlainObject(e)&&(this.options=t.extend(!0,this.options,e))})}function o(e,i){t.fn[e]=function(o){if("string"==typeof o){for(var s=n.call(arguments,1),a=0,h=this.length;h>a;a++){var p=this[a],u=t.data(p,e);if(u)if(t.isFunction(u[o])&&"_"!==o.charAt(0)){var f=u[o].apply(u,s);if(void 0!==f)return f}else r("no such method '"+o+"' for "+e+" instance");else r("cannot call methods on "+e+" prior to initialization; "+"attempted to call '"+o+"'")}return this}return this.each(function(){var n=t.data(this,e);n?(n.option(o),n._init()):(n=new i(this,o),t.data(this,e,n))})}}if(t){var r="undefined"==typeof console?e:function(t){console.error(t)};t.bridget=function(t,e){i(e),o(t,e)}}}var n=Array.prototype.slice;"function"==typeof define&&define.amd?define(["jquery"],i):i(t.jQuery)}(window),function(t,e){"use strict";function i(t,e){return t[a](e)}function n(t){if(!t.parentNode){var e=document.createDocumentFragment();e.appendChild(t)}}function o(t,e){n(t);for(var i=t.parentNode.querySelectorAll(e),o=0,r=i.length;r>o;o++)if(i[o]===t)return!0;return!1}function r(t,e){return n(t),i(t,e)}var s,a=function(){if(e.matchesSelector)return"matchesSelector";for(var t=["webkit","moz","ms","o"],i=0,n=t.length;n>i;i++){var o=t[i],r=o+"MatchesSelector";if(e[r])return r}}();if(a){var h=document.createElement("div"),p=i(h,"div");s=p?i:r}else s=o;"function"==typeof define&&define.amd?define(function(){return s}):window.matchesSelector=s}(this,Element.prototype),function(t){"use strict";function e(t,e){for(var i in e)t[i]=e[i];return t}function i(t,e){t&&(this.element=t,this.layout=e,this.position={x:0,y:0},this._create())}var n=t.getSize,o=t.getStyleProperty,r=t.EventEmitter,s=document.defaultView,a=s&&s.getComputedStyle?function(t){return s.getComputedStyle(t,null)}:function(t){return t.currentStyle},h=o("transition"),p=o("transform"),u=h&&p,f=!!o("perspective"),d={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"otransitionend",transition:"transitionend"}[h],c=["transform","transition","transitionDuration","transitionProperty"],l=function(){for(var t={},e=0,i=c.length;i>e;e++){var n=c[e],r=o(n);r&&r!==n&&(t[n]=r)}return t}();e(i.prototype,r.prototype),i.prototype._create=function(){this.css({position:"absolute"})},i.prototype.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},i.prototype.getSize=function(){this.size=n(this.element)},i.prototype.css=function(t){var e=this.element.style;for(var i in t){var n=l[i]||i;e[n]=t[i]}},i.prototype.getPosition=function(){var t=a(this.element),e=this.layout.options,i=e.isOriginLeft,n=e.isOriginTop,o=parseInt(t[i?"left":"right"],10),r=parseInt(t[n?"top":"bottom"],10);o=isNaN(o)?0:o,r=isNaN(r)?0:r;var s=this.layout.size;o-=i?s.paddingLeft:s.paddingRight,r-=n?s.paddingTop:s.paddingBottom,this.position.x=o,this.position.y=r},i.prototype.layoutPosition=function(){var t=this.layout.size,e=this.layout.options,i={};e.isOriginLeft?(i.left=this.position.x+t.paddingLeft+"px",i.right=""):(i.right=this.position.x+t.paddingRight+"px",i.left=""),e.isOriginTop?(i.top=this.position.y+t.paddingTop+"px",i.bottom=""):(i.bottom=this.position.y+t.paddingBottom+"px",i.top=""),this.css(i),this.emitEvent("layout",[this])};var m=f?function(t,e){return"translate3d("+t+"px, "+e+"px, 0)"}:function(t,e){return"translate("+t+"px, "+e+"px)"};i.prototype._transitionTo=function(t,e){this.getPosition();var i=this.position.x,n=this.position.y,o=parseInt(t,10),r=parseInt(e,10),s=o===this.position.x&&r===this.position.y;if(this.setPosition(t,e),s&&!this.isTransitioning)return this.layoutPosition(),void 0;var a=t-i,h=e-n,p={},u=this.layout.options;a=u.isOriginLeft?a:-a,h=u.isOriginTop?h:-h,p.transform=m(a,h),this.transition({to:p,onTransitionEnd:this.layoutPosition,isCleaning:!0})},i.prototype.goTo=function(t,e){this.setPosition(t,e),this.layoutPosition()},i.prototype.moveTo=u?i.prototype._transitionTo:i.prototype.goTo,i.prototype.setPosition=function(t,e){this.position.x=parseInt(t,10),this.position.y=parseInt(e,10)},i.prototype._nonTransition=function(t){this.css(t.to),t.isCleaning&&this._removeStyles(t.to),t.onTransitionEnd&&t.onTransitionEnd.call(this)},i.prototype._transition=function(t){var e=this.layout.options.transitionDuration;if(!parseFloat(e))return this._nonTransition(t),void 0;var i=t.to,n=[];for(var o in i)n.push(o);var r={};if(r.transitionProperty=n.join(","),r.transitionDuration=e,this.element.addEventListener(d,this,!1),(t.isCleaning||t.onTransitionEnd)&&this.on("transitionEnd",function(e){return t.isCleaning&&e._removeStyles(i),t.onTransitionEnd&&t.onTransitionEnd.call(e),!0}),t.from){this.css(t.from);var s=this.element.offsetHeight;s=null}this.css(r),this.css(i),this.isTransitioning=!0},i.prototype.transition=i.prototype[h?"_transition":"_nonTransition"],i.prototype.onwebkitTransitionEnd=function(t){this.ontransitionend(t)},i.prototype.onotransitionend=function(t){this.ontransitionend(t)},i.prototype.ontransitionend=function(t){t.target===this.element&&(this.removeTransitionStyles(),this.element.removeEventListener(d,this,!1),this.isTransitioning=!1,this.emitEvent("transitionEnd",[this]))},i.prototype._removeStyles=function(t){var e={};for(var i in t)e[i]="";this.css(e)};var y={transitionProperty:"",transitionDuration:""};i.prototype.removeTransitionStyles=function(){this.css(y)},i.prototype.removeElem=function(){this.element.parentNode.removeChild(this.element),this.emitEvent("remove",[this])},i.prototype.remove=h?function(){var t=this;this.on("transitionEnd",function(){return t.removeElem(),!0}),this.hide()}:i.prototype.removeElem,i.prototype.reveal=function(){this.css({display:""});var t=this.layout.options;this.transition({from:t.hiddenStyle,to:t.visibleStyle,isCleaning:!0})},i.prototype.hide=function(){this.css({display:""});var t=this.layout.options;this.transition({from:t.visibleStyle,to:t.hiddenStyle,isCleaning:!0,onTransitionEnd:function(){this.css({display:"none"})}})},i.prototype.destroy=function(){this.css({position:"",left:"",right:"",top:"",bottom:"",transition:"",transform:""})},t.Outlayer={Item:i}}(window),function(t){"use strict";function e(t,e){for(var i in e)t[i]=e[i];return t}function i(t){return"[object Array]"===v.call(t)}function n(t){var e=[];if(i(t))e=t;else if("number"==typeof t.length)for(var n=0,o=t.length;o>n;n++)e.push(t[n]);else e.push(t);return e}function o(t){return t.replace(/(.)([A-Z])/g,function(t,e,i){return e+"-"+i}).toLowerCase()}function r(t,i){if("string"==typeof t&&(t=l.querySelector(t)),!t||!_(t))return m&&m.error("Bad "+this.settings.namespace+" element: "+t),void 0;this.element=t,this.options=e({},this.options),e(this.options,i);var n=++L;this.element.outlayerGUID=n,E[n]=this,this._create(),this.options.isInitLayout&&this.layout()}function s(t,i){t.prototype[i]=e({},r.prototype[i])}var a=t.Outlayer,h=a.Item,p=t.docReady,u=t.EventEmitter,f=t.eventie,d=t.getSize,c=t.matchesSelector,l=t.document,m=t.console,y=t.jQuery,g=function(){},v=Object.prototype.toString,_="object"==typeof HTMLElement?function(t){return t instanceof HTMLElement}:function(t){return t&&"object"==typeof t&&1===t.nodeType&&"string"==typeof t.nodeName},b=Array.prototype.indexOf?function(t,e){return t.indexOf(e)}:function(t,e){for(var i=0,n=t.length;n>i;i++)if(t[i]===e)return i;return-1},L=0,E={};r.prototype.settings={namespace:"outlayer",item:a.Item},r.prototype.options={containerStyle:{position:"relative"},isInitLayout:!0,isOriginLeft:!0,isOriginTop:!0,isResizeBound:!0,transitionDuration:"0.4s",hiddenStyle:{opacity:0,transform:"scale(0.001)"},visibleStyle:{opacity:1,transform:"scale(1)"}},e(r.prototype,u.prototype),r.prototype._create=function(){this.reloadItems(),this.stamps=[],this.stamp(this.options.stamp),e(this.element.style,this.options.containerStyle),this.options.isResizeBound&&this.bindResize()},r.prototype.reloadItems=function(){this.items=this._getItems(this.element.children)},r.prototype._getItems=function(t){for(var e=this._filterFindItemElements(t),i=this.settings.item,n=[],o=0,r=e.length;r>o;o++){var s=e[o],a=new i(s,this,this.options.itemOptions);n.push(a)}return n},r.prototype._filterFindItemElements=function(t){t=n(t);var e=this.options.itemSelector;if(!e)return t;for(var i=[],o=0,r=t.length;r>o;o++){var s=t[o];c(s,e)&&i.push(s);for(var a=s.querySelectorAll(e),h=0,p=a.length;p>h;h++)i.push(a[h])}return i},r.prototype.getItemElements=function(){for(var t=[],e=0,i=this.items.length;i>e;e++)t.push(this.items[e].element);return t},r.prototype.layout=function(){this._resetLayout(),this._manageStamps();var t=void 0!==this.options.isLayoutInstant?this.options.isLayoutInstant:!this._isLayoutInited;this.layoutItems(this.items,t),this._isLayoutInited=!0},r.prototype._init=r.prototype.layout,r.prototype._resetLayout=function(){this.getSize()},r.prototype.getSize=function(){this.size=d(this.element)},r.prototype._getMeasurement=function(t,e){var i,n=this.options[t];n?("string"==typeof n?i=this.element.querySelector(n):_(n)&&(i=n),this[t]=i?d(i)[e]:n):this[t]=0},r.prototype.layoutItems=function(t,e){t=this._getItemsForLayout(t),this._layoutItems(t,e),this._postLayout()},r.prototype._getItemsForLayout=function(t){for(var e=[],i=0,n=t.length;n>i;i++){var o=t[i];o.isIgnored||e.push(o)}return e},r.prototype._layoutItems=function(t,e){if(!t||!t.length)return this.emitEvent("layoutComplete",[this,t]),void 0;this._itemsOn(t,"layout",function(){this.emitEvent("layoutComplete",[this,t])});for(var i=[],n=0,o=t.length;o>n;n++){var r=t[n],s=this._getItemLayoutPosition(r);s.item=r,s.isInstant=e,i.push(s)}this._processLayoutQueue(i)},r.prototype._getItemLayoutPosition=function(){return{x:0,y:0}},r.prototype._processLayoutQueue=function(t){for(var e=0,i=t.length;i>e;e++){var n=t[e];this._positionItem(n.item,n.x,n.y,n.isInstant)}},r.prototype._positionItem=function(t,e,i,n){n?t.goTo(e,i):t.moveTo(e,i)},r.prototype._postLayout=function(){var t=this._getContainerSize();t&&(this._setContainerMeasure(t.width,!0),this._setContainerMeasure(t.height,!1))},r.prototype._getContainerSize=g,r.prototype._setContainerMeasure=function(t,e){if(void 0!==t){var i=this.size;i.isBorderBox&&(t+=e?i.paddingLeft+i.paddingRight+i.borderLeftWidth+i.borderRightWidth:i.paddingBottom+i.paddingTop+i.borderTopWidth+i.borderBottomWidth),t=Math.max(t,0),this.element.style[e?"width":"height"]=t+"px"}},r.prototype._itemsOn=function(t,e,i){function n(){return o++,o===r&&i.call(s),!0}for(var o=0,r=t.length,s=this,a=0,h=t.length;h>a;a++){var p=t[a];p.on(e,n)}},r.prototype.ignore=function(t){var e=this.getItem(t);e&&(e.isIgnored=!0)},r.prototype.unignore=function(t){var e=this.getItem(t);e&&delete e.isIgnored},r.prototype.stamp=function(t){if(t=this._find(t)){this.stamps=this.stamps.concat(t);for(var e=0,i=t.length;i>e;e++){var n=t[e];this.ignore(n)}}},r.prototype.unstamp=function(t){if(t=this._find(t))for(var e=0,i=t.length;i>e;e++){var n=t[e],o=b(this.stamps,n);-1!==o&&this.stamps.splice(o,1),this.unignore(n)}},r.prototype._find=function(t){return t?("string"==typeof t&&(t=this.element.querySelectorAll(t)),t=n(t)):void 0},r.prototype._manageStamps=function(){if(this.stamps&&this.stamps.length){this._getBoundingRect();for(var t=0,e=this.stamps.length;e>t;t++){var i=this.stamps[t];this._manageStamp(i)}}},r.prototype._getBoundingRect=function(){var t=this.element.getBoundingClientRect(),e=this.size;this._boundingRect={left:t.left+e.paddingLeft+e.borderLeftWidth,top:t.top+e.paddingTop+e.borderTopWidth,right:t.right-(e.paddingRight+e.borderRightWidth),bottom:t.bottom-(e.paddingBottom+e.borderBottomWidth)}},r.prototype._manageStamp=g,r.prototype._getElementOffset=function(t){var e=t.getBoundingClientRect(),i=this._boundingRect,n=d(t),o={left:e.left-i.left-n.marginLeft,top:e.top-i.top-n.marginTop,right:i.right-e.right-n.marginRight,bottom:i.bottom-e.bottom-n.marginBottom};return o},r.prototype.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},r.prototype.bindResize=function(){this.isResizeBound||(f.bind(t,"resize",this),this.isResizeBound=!0)},r.prototype.unbindResize=function(){f.unbind(t,"resize",this),this.isResizeBound=!1},r.prototype.onresize=function(){function t(){e.resize()}this.resizeTimeout&&clearTimeout(this.resizeTimeout);var e=this;this.resizeTimeout=setTimeout(t,100)},r.prototype.resize=function(){var t=d(this.element),e=this.size&&t;e&&t.innerWidth===this.size.innerWidth||(this.layout(),delete this.resizeTimeout)},r.prototype.addItems=function(t){var e=this._getItems(t);if(e.length)return this.items=this.items.concat(e),e},r.prototype.appended=function(t){var e=this.addItems(t);e.length&&(this.layoutItems(e,!0),this.reveal(e))},r.prototype.prepended=function(t){var e=this._getItems(t);if(e.length){var i=this.items.slice(0);this.items=e.concat(i),this._resetLayout(),this.layoutItems(e,!0),this.reveal(e),this.layoutItems(i)}},r.prototype.reveal=function(t){if(t&&t.length)for(var e=0,i=t.length;i>e;e++){var n=t[e];n.reveal()}},r.prototype.hide=function(t){if(t&&t.length)for(var e=0,i=t.length;i>e;e++){var n=t[e];n.hide()}},r.prototype.getItem=function(t){for(var e=0,i=this.items.length;i>e;e++){var n=this.items[e];if(n.element===t)return n}},r.prototype.getItems=function(t){if(t&&t.length){for(var e=[],i=0,n=t.length;n>i;i++){var o=t[i],r=this.getItem(o);r&&e.push(r)}return e}},r.prototype.remove=function(t){t=n(t);var e=this.getItems(t);this._itemsOn(e,"remove",function(){this.emitEvent("removeComplete",[this,e])});for(var i=0,o=e.length;o>i;i++){var r=e[i];r.remove();var s=b(this.items,r);this.items.splice(s,1)}},r.prototype.destroy=function(){var t=this.element.style;t.height="",t.position="",t.width="";for(var e=0,i=this.items.length;i>e;e++){var n=this.items[e];n.destroy()}this.unbindResize(),delete this.element.outlayerGUID},r.data=function(t){var e=t&&t.outlayerGUID;return e&&E[e]},r.create=function(t,i){function n(){r.apply(this,arguments)}return e(n.prototype,r.prototype),s(n,"options"),s(n,"settings"),e(n.prototype.options,i),n.prototype.settings.namespace=t,n.data=r.data,n.Item=function(){h.apply(this,arguments)},n.Item.prototype=new r.Item,n.prototype.settings.item=n.Item,p(function(){for(var e=o(t),i=l.querySelectorAll(".js-"+e),r="data-"+e+"-options",s=0,a=i.length;a>s;s++){var h,p=i[s],u=p.getAttribute(r);try{h=u&&JSON.parse(u)}catch(f){m&&m.error("Error parsing "+r+" on "+p.nodeName.toLowerCase()+(p.id?"#"+p.id:"")+": "+f);continue}var d=new n(p,h);y&&y.data(p,t,d)}}),y&&y.bridget&&y.bridget(t,n),n},r.Item=h,t.Outlayer=r}(window),function(t){"use strict";function e(t,e){var n=t.create("masonry");return n.prototype._resetLayout=function(){this.getSize(),this._getMeasurement("columnWidth","outerWidth"),this._getMeasurement("gutter","outerWidth"),this.measureColumns();var t=this.cols;for(this.colYs=[];t--;)this.colYs.push(0);this.maxY=0},n.prototype.measureColumns=function(){var t=this.items[0],i=t&&t.element;this.columnWidth||(this.columnWidth=i?e(i).outerWidth:this.size.innerWidth),this.columnWidth+=this.gutter,this.cols=Math.floor((this.size.innerWidth+this.gutter)/this.columnWidth),this.cols=Math.max(this.cols,1)},n.prototype._getItemLayoutPosition=function(t){t.getSize();var e=Math.ceil(t.size.outerWidth/this.columnWidth);e=Math.min(e,this.cols);for(var n=this._getColGroup(e),o=Math.min.apply(Math,n),r=i(n,o),s={x:this.columnWidth*r,y:o},a=o+t.size.outerHeight,h=this.cols+1-n.length,p=0;h>p;p++)this.colYs[r+p]=a;return s},n.prototype._getColGroup=function(t){if(1===t)return this.colYs;for(var e=[],i=this.cols+1-t,n=0;i>n;n++){var o=this.colYs.slice(n,n+t);e[n]=Math.max.apply(Math,o)}return e},n.prototype._manageStamp=function(t){var i=e(t),n=this._getElementOffset(t),o=this.options.isOriginLeft?n.left:n.right,r=o+i.outerWidth,s=Math.floor(o/this.columnWidth);s=Math.max(0,s);var a=Math.floor(r/this.columnWidth);a=Math.min(this.cols-1,a);for(var h=(this.options.isOriginTop?n.top:n.bottom)+i.outerHeight,p=s;a>=p;p++)this.colYs[p]=Math.max(h,this.colYs[p])},n.prototype._getContainerSize=function(){return this.maxY=Math.max.apply(Math,this.colYs),{height:this.maxY}},n}var i=Array.prototype.indexOf?function(t,e){return t.indexOf(e)}:function(t,e){for(var i=0,n=t.length;n>i;i++){var o=t[i];if(o===e)return i}return-1};"function"==typeof define&&define.amd?define(["outlayer","get-size"],e):t.Masonry=e(t.Outlayer,t.getSize)}(window);

/*
 * MBP - Mobile boilerplate helper functions
 */

(function(document){

window.MBP = window.MBP || {};

/**
     * Fast Buttons - read wiki below before using
     * https://github.com/h5bp/mobile-boilerplate/wiki/JavaScript-Helper
     */

    MBP.fastButton = function(element, handler, pressedClass) {
        this.handler = handler;
        // styling of .pressed is defined in the project's CSS files
        this.pressedClass = typeof pressedClass === 'undefined' ? 'pressed' : pressedClass;

        MBP.listenForGhostClicks();

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
        var element = event.target || event.srcElement;
        event.stopPropagation();
        element.addEventListener('touchend', this, false);
        document.body.addEventListener('touchmove', this, false);
        this.startX = event.touches[0].clientX;
        this.startY = event.touches[0].clientY;

        element.className+= ' ' + this.pressedClass;
    };

    MBP.fastButton.prototype.onTouchMove = function(event) {
        if (Math.abs(event.touches[0].clientX - this.startX) > 10 ||
            Math.abs(event.touches[0].clientY - this.startY) > 10) {
            this.reset(event);
        }
    };

    MBP.fastButton.prototype.onClick = function(event) {
        event = event || window.event;
        var element = event.target || event.srcElement;
        if (event.stopPropagation) {
            event.stopPropagation();
        }
        this.reset(event);
        this.handler.apply(event.currentTarget, [event]);
        if (event.type == 'touchend') {
            MBP.preventGhostClick(this.startX, this.startY);
        }
        var pattern = new RegExp(' ?' + this.pressedClass, 'gi');
        element.className = element.className.replace(pattern, '');
    };

    MBP.fastButton.prototype.reset = function(event) {
        var element = event.target || event.srcElement;
        rmEvt(element, 'touchend', this, false);
        rmEvt(document.body, 'touchmove', this, false);

        var pattern = new RegExp(' ?' + this.pressedClass, 'gi');
        element.className = element.className.replace(pattern, '');
    };

    MBP.fastButton.prototype.addClickEvent = function(element) {
        addEvt(element, 'touchstart', this, false);
        addEvt(element, 'click', this, false);
    };

    MBP.preventGhostClick = function(x, y) {
        MBP.coords.push(x, y);
        window.setTimeout(function() {
            MBP.coords.splice(0, 2);
        }, 2500);
    };

    MBP.ghostClickHandler = function(event) {
        if (!MBP.hadTouchEvent && MBP.dodgyAndroid) {
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
        for (var i = 0, len = MBP.coords.length; i < len; i += 2) {
            var x = MBP.coords[i];
            var y = MBP.coords[i + 1];
            if (Math.abs(event.clientX - x) < 25 && Math.abs(event.clientY - y) < 25) {
                event.stopPropagation();
                event.preventDefault();
            }
        }
    };

    // This bug only affects touch Android 2.3 devices, but a simple ontouchstart test creates a false positive on
    // some Blackberry devices. https://github.com/Modernizr/Modernizr/issues/372
    // The browser sniffing is to avoid the Blackberry case. Bah
    MBP.dodgyAndroid = ('ontouchstart' in window) && (navigator.userAgent.indexOf('Android 2.3') != -1);

    MBP.listenForGhostClicks = (function() {
        var alreadyRan = false;

        return function() {
            if(alreadyRan) {
                return;
            }

            if (document.addEventListener) {
                document.addEventListener('click', MBP.ghostClickHandler, true);
            }
            addEvt(document.documentElement, 'touchstart', function() {
                MBP.hadTouchEvent = true;
            }, false);

            alreadyRan = true;
        };
    })();

    MBP.coords = [];

    // fn arg can be an object or a function, thanks to handleEvent
    // read more about the explanation at: http://www.thecssninja.com/javascript/handleevent
    function addEvt(el, evt, fn, bubble) {
        if ('addEventListener' in el) {
            // BBOS6 doesn't support handleEvent, catch and polyfill
            try {
                el.addEventListener(evt, fn, bubble);
            } catch(e) {
                if (typeof fn == 'object' && fn.handleEvent) {
                    el.addEventListener(evt, function(e){
                        // Bind fn as this and set first arg as event object
                        fn.handleEvent.call(fn,e);
                    }, bubble);
                } else {
                    throw e;
                }
            }
        } else if ('attachEvent' in el) {
            // check if the callback is an object and contains handleEvent
            if (typeof fn == 'object' && fn.handleEvent) {
                el.attachEvent('on' + evt, function(){
                    // Bind fn as this
                    fn.handleEvent.call(fn);
                });
            } else {
                el.attachEvent('on' + evt, fn);
            }
        }
    }

    function rmEvt(el, evt, fn, bubble) {
        if ('removeEventListener' in el) {
            // BBOS6 doesn't support handleEvent, catch and polyfill
            try {
                el.removeEventListener(evt, fn, bubble);
            } catch(e) {
                if (typeof fn == 'object' && fn.handleEvent) {
                    el.removeEventListener(evt, function(e){
                        // Bind fn as this and set first arg as event object
                        fn.handleEvent.call(fn,e);
                    }, bubble);
                } else {
                    throw e;
                }
            }
        } else if ('detachEvent' in el) {
            // check if the callback is an object and contains handleEvent
            if (typeof fn == 'object' && fn.handleEvent) {
                el.detachEvent("on" + evt, function() {
                    // Bind fn as this
                    fn.handleEvent.call(fn);
                });
            } else {
                el.detachEvent('on' + evt, fn);
            }
        }
    }


    /**
     * Enable CSS active pseudo styles in Mobile Safari
     * http://alxgbsn.co.uk/2011/10/17/enable-css-active-pseudo-styles-in-mobile-safari/
     */

    MBP.enableActive = function() {
        document.addEventListener('touchstart', function() {}, false);
    };

})(document);

/*!
 * imagesLoaded PACKAGED v3.0.2
 * JavaScript is all like "You images are done yet or what?"
 */

(function(e){"use strict";function t(){}function n(e,t){if(r)return t.indexOf(e);for(var n=t.length;n--;)if(t[n]===e)return n;return-1}var i=t.prototype,r=Array.prototype.indexOf?!0:!1;i._getEvents=function(){return this._events||(this._events={})},i.getListeners=function(e){var t,n,i=this._getEvents();if("object"==typeof e){t={};for(n in i)i.hasOwnProperty(n)&&e.test(n)&&(t[n]=i[n])}else t=i[e]||(i[e]=[]);return t},i.getListenersAsObject=function(e){var t,n=this.getListeners(e);return n instanceof Array&&(t={},t[e]=n),t||n},i.addListener=function(e,t){var i,r=this.getListenersAsObject(e);for(i in r)r.hasOwnProperty(i)&&-1===n(t,r[i])&&r[i].push(t);return this},i.on=i.addListener,i.defineEvent=function(e){return this.getListeners(e),this},i.defineEvents=function(e){for(var t=0;e.length>t;t+=1)this.defineEvent(e[t]);return this},i.removeListener=function(e,t){var i,r,s=this.getListenersAsObject(e);for(r in s)s.hasOwnProperty(r)&&(i=n(t,s[r]),-1!==i&&s[r].splice(i,1));return this},i.off=i.removeListener,i.addListeners=function(e,t){return this.manipulateListeners(!1,e,t)},i.removeListeners=function(e,t){return this.manipulateListeners(!0,e,t)},i.manipulateListeners=function(e,t,n){var i,r,s=e?this.removeListener:this.addListener,o=e?this.removeListeners:this.addListeners;if("object"!=typeof t||t instanceof RegExp)for(i=n.length;i--;)s.call(this,t,n[i]);else for(i in t)t.hasOwnProperty(i)&&(r=t[i])&&("function"==typeof r?s.call(this,i,r):o.call(this,i,r));return this},i.removeEvent=function(e){var t,n=typeof e,i=this._getEvents();if("string"===n)delete i[e];else if("object"===n)for(t in i)i.hasOwnProperty(t)&&e.test(t)&&delete i[t];else delete this._events;return this},i.emitEvent=function(e,t){var n,i,r,s=this.getListenersAsObject(e);for(i in s)if(s.hasOwnProperty(i))for(n=s[i].length;n--;)r=t?s[i][n].apply(null,t):s[i][n](),r===!0&&this.removeListener(e,s[i][n]);return this},i.trigger=i.emitEvent,i.emit=function(e){var t=Array.prototype.slice.call(arguments,1);return this.emitEvent(e,t)},"function"==typeof define&&define.amd?define(function(){return t}):e.EventEmitter=t})(this),function(e){"use strict";var t=document.documentElement,n=function(){};t.addEventListener?n=function(e,t,n){e.addEventListener(t,n,!1)}:t.attachEvent&&(n=function(t,n,i){t[n+i]=i.handleEvent?function(){var t=e.event;t.target=t.target||t.srcElement,i.handleEvent.call(i,t)}:function(){var n=e.event;n.target=n.target||n.srcElement,i.call(t,n)},t.attachEvent("on"+n,t[n+i])});var i=function(){};t.removeEventListener?i=function(e,t,n){e.removeEventListener(t,n,!1)}:t.detachEvent&&(i=function(e,t,n){e.detachEvent("on"+t,e[t+n]);try{delete e[t+n]}catch(i){e[t+n]=void 0}});var r={bind:n,unbind:i};"function"==typeof define&&define.amd?define(r):e.eventie=r}(this),function(e){"use strict";function t(e,t){for(var n in t)e[n]=t[n];return e}function n(e){return"[object Array]"===a.call(e)}function i(e){var t=[];if(n(e))t=e;else if("number"==typeof e.length)for(var i=0,r=e.length;r>i;i++)t.push(e[i]);else t.push(e);return t}function r(e,n){function r(e,n,o){if(!(this instanceof r))return new r(e,n);"string"==typeof e&&(e=document.querySelectorAll(e)),this.elements=i(e),this.options=t({},this.options),"function"==typeof n?o=n:t(this.options,n),o&&this.on("always",o),this.getImages(),s&&(this.jqDeferred=new s.Deferred);var h=this;setTimeout(function(){h.check()})}function a(e){this.img=e}r.prototype=new e,r.prototype.options={},r.prototype.getImages=function(){this.images=[];for(var e=0,t=this.elements.length;t>e;e++){var n=this.elements[e];"IMG"===n.nodeName&&this.addImage(n);for(var i=n.querySelectorAll("img"),r=0,s=i.length;s>r;r++){var o=i[r];this.addImage(o)}}},r.prototype.addImage=function(e){var t=new a(e);this.images.push(t)},r.prototype.check=function(){function e(e,r){return t.options.debug&&h&&o.log("confirm",e,r),t.progress(e),n++,n===i&&t.complete(),!0}var t=this,n=0,i=this.images.length;if(this.hasAnyBroken=!1,!i)return this.complete(),void 0;for(var r=0;i>r;r++){var s=this.images[r];s.on("confirm",e),s.check()}},r.prototype.progress=function(e){this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded,this.emit("progress",this,e),this.jqDeferred&&this.jqDeferred.notify(this,e)},r.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emit(e,this),this.emit("always",this),this.jqDeferred){var t=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[t](this)}},s&&(s.fn.imagesLoaded=function(e,t){var n=new r(this,e,t);return n.jqDeferred.promise(s(this))});var f={};return a.prototype=new e,a.prototype.check=function(){var e=f[this.img.src];if(e)return this.useCached(e),void 0;if(f[this.img.src]=this,this.img.complete&&void 0!==this.img.naturalWidth)return this.confirm(0!==this.img.naturalWidth,"naturalWidth"),void 0;var t=this.proxyImage=new Image;n.bind(t,"load",this),n.bind(t,"error",this),t.src=this.img.src},a.prototype.useCached=function(e){if(e.isConfirmed)this.confirm(e.isLoaded,"cached was confirmed");else{var t=this;e.on("confirm",function(e){return t.confirm(e.isLoaded,"cache emitted confirmed"),!0})}},a.prototype.confirm=function(e,t){this.isConfirmed=!0,this.isLoaded=e,this.emit("confirm",this,t)},a.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},a.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindProxyEvents()},a.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindProxyEvents()},a.prototype.unbindProxyEvents=function(){n.unbind(this.proxyImage,"load",this),n.unbind(this.proxyImage,"error",this)},r}var s=e.jQuery,o=e.console,h=o!==void 0,a=Object.prototype.toString;"function"==typeof define&&define.amd?define(["eventEmitter","eventie"],r):e.imagesLoaded=r(e.EventEmitter,e.eventie)}(window);
