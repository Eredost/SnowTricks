(self.webpackChunk=self.webpackChunk||[]).push([[736],{8814:function(e,t,n){function r(e,t){var n;if("undefined"==typeof Symbol||null==e[Symbol.iterator]){if(Array.isArray(e)||(n=function(e,t){if(!e)return;if("string"==typeof e)return o(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);"Object"===n&&e.constructor&&(n=e.constructor.name);if("Map"===n||"Set"===n)return Array.from(e);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return o(e,t)}(e))||t&&e&&"number"==typeof e.length){n&&(e=n);var r=0,a=function(){};return{s:a,n:function(){return r>=e.length?{done:!0}:{done:!1,value:e[r++]}},e:function(e){throw e},f:a}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var i,c=!0,l=!1;return{s:function(){n=e[Symbol.iterator]()},n:function(){var e=n.next();return c=e.done,e},e:function(e){l=!0,i=e},f:function(){try{c||null==n.return||n.return()}finally{if(l)throw i}}}}function o(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}n(4916),n(5306);var a={init:function(){var e,t=r(document.getElementsByClassName("new_trick_media"));try{for(t.s();!(e=t.n()).done;){e.value.addEventListener("click",a.handleAddButtonClick)}}catch(e){t.e(e)}finally{t.f()}var n,o=r(document.getElementsByClassName("js-delete-media"));try{for(o.s();!(n=o.n()).done;){n.value.addEventListener("click",a.handleCloseButtonClick)}}catch(e){o.e(e)}finally{o.f()}},handleAddButtonClick:function(e){var t=e.currentTarget.previousElementSibling,n=t.dataset.prototype;a.addFormToCollection(n,t)},addFormToCollection:function(e,t){var n=t.querySelector(".js-media-template").cloneNode(!0);n.classList.remove("hide"),n.querySelector(".js-delete-media").addEventListener("click",a.handleCloseButtonClick);var r=t.childElementCount-1;e=e.replace(/__name__/g,r);var o=document.createElement("div");o.innerHTML=e,n.prepend(o.firstChild),t.appendChild(n)},handleCloseButtonClick:function(e){e.preventDefault(),e.currentTarget.parentNode.remove()}};document.addEventListener("DOMContentLoaded",a.init)},1530:function(e,t,n){"use strict";var r=n(8710).charAt;e.exports=function(e,t,n){return t+(n?r(e,t).length:1)}},7007:function(e,t,n){"use strict";n(4916);var r=n(1320),o=n(7293),a=n(5112),i=n(2261),c=n(8880),l=a("species"),u=!o((function(){var e=/./;return e.exec=function(){var e=[];return e.groups={a:"7"},e},"7"!=="".replace(e,"$<a>")})),s="$0"==="a".replace(/./,"$0"),f=a("replace"),d=!!/./[f]&&""===/./[f]("a","$0"),v=!o((function(){var e=/(?:)/,t=e.exec;e.exec=function(){return t.apply(this,arguments)};var n="ab".split(e);return 2!==n.length||"a"!==n[0]||"b"!==n[1]}));e.exports=function(e,t,n,f){var p=a(e),h=!o((function(){var t={};return t[p]=function(){return 7},7!=""[e](t)})),g=h&&!o((function(){var t=!1,n=/a/;return"split"===e&&((n={}).constructor={},n.constructor[l]=function(){return n},n.flags="",n[p]=/./[p]),n.exec=function(){return t=!0,null},n[p](""),!t}));if(!h||!g||"replace"===e&&(!u||!s||d)||"split"===e&&!v){var x=/./[p],y=n(p,""[e],(function(e,t,n,r,o){return t.exec===i?h&&!o?{done:!0,value:x.call(t,n,r)}:{done:!0,value:e.call(n,t,r)}:{done:!1}}),{REPLACE_KEEPS_$0:s,REGEXP_REPLACE_SUBSTITUTES_UNDEFINED_CAPTURE:d}),E=y[0],m=y[1];r(String.prototype,e,E),r(RegExp.prototype,p,2==t?function(e,t){return m.call(e,this,t)}:function(e){return m.call(e,this)})}f&&c(RegExp.prototype[p],"sham",!0)}},647:function(e,t,n){var r=n(7908),o=Math.floor,a="".replace,i=/\$([$&'`]|\d\d?|<[^>]*>)/g,c=/\$([$&'`]|\d\d?)/g;e.exports=function(e,t,n,l,u,s){var f=n+e.length,d=l.length,v=c;return void 0!==u&&(u=r(u),v=i),a.call(s,v,(function(r,a){var i;switch(a.charAt(0)){case"$":return"$";case"&":return e;case"`":return t.slice(0,n);case"'":return t.slice(f);case"<":i=u[a.slice(1,-1)];break;default:var c=+a;if(0===c)return r;if(c>d){var s=o(c/10);return 0===s?r:s<=d?void 0===l[s-1]?a.charAt(1):l[s-1]+a.charAt(1):r}i=l[c-1]}return void 0===i?"":i}))}},133:function(e,t,n){var r=n(7293);e.exports=!!Object.getOwnPropertySymbols&&!r((function(){return!String(Symbol())}))},7651:function(e,t,n){var r=n(4326),o=n(2261);e.exports=function(e,t){var n=e.exec;if("function"==typeof n){var a=n.call(e,t);if("object"!=typeof a)throw TypeError("RegExp exec method returned something other than an Object or null");return a}if("RegExp"!==r(e))throw TypeError("RegExp#exec called on incompatible receiver");return o.call(e,t)}},2261:function(e,t,n){"use strict";var r,o,a=n(7066),i=n(2999),c=RegExp.prototype.exec,l=String.prototype.replace,u=c,s=(r=/a/,o=/b*/g,c.call(r,"a"),c.call(o,"a"),0!==r.lastIndex||0!==o.lastIndex),f=i.UNSUPPORTED_Y||i.BROKEN_CARET,d=void 0!==/()??/.exec("")[1];(s||d||f)&&(u=function(e){var t,n,r,o,i=this,u=f&&i.sticky,v=a.call(i),p=i.source,h=0,g=e;return u&&(-1===(v=v.replace("y","")).indexOf("g")&&(v+="g"),g=String(e).slice(i.lastIndex),i.lastIndex>0&&(!i.multiline||i.multiline&&"\n"!==e[i.lastIndex-1])&&(p="(?: "+p+")",g=" "+g,h++),n=new RegExp("^(?:"+p+")",v)),d&&(n=new RegExp("^"+p+"$(?!\\s)",v)),s&&(t=i.lastIndex),r=c.call(u?n:i,g),u?r?(r.input=r.input.slice(h),r[0]=r[0].slice(h),r.index=i.lastIndex,i.lastIndex+=r[0].length):i.lastIndex=0:s&&r&&(i.lastIndex=i.global?r.index+r[0].length:t),d&&r&&r.length>1&&l.call(r[0],n,(function(){for(o=1;o<arguments.length-2;o++)void 0===arguments[o]&&(r[o]=void 0)})),r}),e.exports=u},7066:function(e,t,n){"use strict";var r=n(9670);e.exports=function(){var e=r(this),t="";return e.global&&(t+="g"),e.ignoreCase&&(t+="i"),e.multiline&&(t+="m"),e.dotAll&&(t+="s"),e.unicode&&(t+="u"),e.sticky&&(t+="y"),t}},2999:function(e,t,n){"use strict";var r=n(7293);function o(e,t){return RegExp(e,t)}t.UNSUPPORTED_Y=r((function(){var e=o("a","y");return e.lastIndex=2,null!=e.exec("abcd")})),t.BROKEN_CARET=r((function(){var e=o("^r","gy");return e.lastIndex=2,null!=e.exec("str")}))},8710:function(e,t,n){var r=n(9958),o=n(4488),a=function(e){return function(t,n){var a,i,c=String(o(t)),l=r(n),u=c.length;return l<0||l>=u?e?"":void 0:(a=c.charCodeAt(l))<55296||a>56319||l+1===u||(i=c.charCodeAt(l+1))<56320||i>57343?e?c.charAt(l):a:e?c.slice(l,l+2):i-56320+(a-55296<<10)+65536}};e.exports={codeAt:a(!1),charAt:a(!0)}},7908:function(e,t,n){var r=n(4488);e.exports=function(e){return Object(r(e))}},3307:function(e,t,n){var r=n(133);e.exports=r&&!Symbol.sham&&"symbol"==typeof Symbol.iterator},5112:function(e,t,n){var r=n(7854),o=n(2309),a=n(6656),i=n(9711),c=n(133),l=n(3307),u=o("wks"),s=r.Symbol,f=l?s:s&&s.withoutSetter||i;e.exports=function(e){return a(u,e)||(c&&a(s,e)?u[e]=s[e]:u[e]=f("Symbol."+e)),u[e]}},4916:function(e,t,n){"use strict";var r=n(2109),o=n(2261);r({target:"RegExp",proto:!0,forced:/./.exec!==o},{exec:o})},5306:function(e,t,n){"use strict";var r=n(7007),o=n(9670),a=n(7466),i=n(9958),c=n(4488),l=n(1530),u=n(647),s=n(7651),f=Math.max,d=Math.min;r("replace",2,(function(e,t,n,r){var v=r.REGEXP_REPLACE_SUBSTITUTES_UNDEFINED_CAPTURE,p=r.REPLACE_KEEPS_$0,h=v?"$":"$0";return[function(n,r){var o=c(this),a=null==n?void 0:n[e];return void 0!==a?a.call(n,o,r):t.call(String(o),n,r)},function(e,r){if(!v&&p||"string"==typeof r&&-1===r.indexOf(h)){var c=n(t,e,this,r);if(c.done)return c.value}var g=o(e),x=String(this),y="function"==typeof r;y||(r=String(r));var E=g.global;if(E){var m=g.unicode;g.lastIndex=0}for(var S=[];;){var b=s(g,x);if(null===b)break;if(S.push(b),!E)break;""===String(b[0])&&(g.lastIndex=l(x,a(g.lastIndex),m))}for(var C,A="",R=0,I=0;I<S.length;I++){b=S[I];for(var _=String(b[0]),T=f(d(i(b.index),x.length),0),k=[],w=1;w<b.length;w++)k.push(void 0===(C=b[w])?C:String(C));var $=b.groups;if(y){var P=[_].concat(k,T,x);void 0!==$&&P.push($);var O=String(r.apply(void 0,P))}else O=u(_,x,T,k,$,r);T>=R&&(A+=x.slice(R,T)+O,R=T+_.length)}return A+x.slice(R)}]}))}},0,[[8814,666,109]]]);