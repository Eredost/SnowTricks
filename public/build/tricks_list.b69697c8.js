(self.webpackChunk=self.webpackChunk||[]).push([[183],{4175:function(e,t,r){function n(e,t){var r;if("undefined"==typeof Symbol||null==e[Symbol.iterator]){if(Array.isArray(e)||(r=function(e,t){if(!e)return;if("string"==typeof e)return a(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);"Object"===r&&e.constructor&&(r=e.constructor.name);if("Map"===r||"Set"===r)return Array.from(e);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return a(e,t)}(e))||t&&e&&"number"==typeof e.length){r&&(e=r);var n=0,o=function(){};return{s:o,n:function(){return n>=e.length?{done:!0}:{done:!1,value:e[n++]}},e:function(e){throw e},f:o}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var i,c=!0,l=!1;return{s:function(){r=e[Symbol.iterator]()},n:function(){var e=r.next();return c=e.done,e},e:function(e){l=!0,i=e},f:function(){try{c||null==r.return||r.return()}finally{if(l)throw i}}}}function a(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n}r(8309),r(1539),r(8674),r(7727),r(4916),r(5306);var o={init:function(){o.wrapper=document.getElementById("js-tricks-wrapper"),o.template=document.getElementById("js-trick-card"),o.loaderElement=document.getElementById("js-loading"),o.page=1,o.limit=15,o.count=0,o.loadMoreButton=document.getElementById("js-load-more"),o.loadMoreButton.addEventListener("click",o.handleLoadMoreClick),o.linkTarget=o.loadMoreButton.dataset.targetLink;var e=document.createEvent("HTMLEvents");e.initEvent("click",!1,!0),o.loadMoreButton.dispatchEvent(e)},handleLoadMoreClick:function(e){o.toggleLoader();var t=e.currentTarget.dataset.tricksCount;fetch(e.currentTarget.dataset.tricksPath+"?page="+o.page+"&limit="+o.limit).then((function(e){return e.json()})).then((function(e){o.page++,o.count+=e.length,o.count==t&&o.loadMoreButton.remove(),o.count>15&&document.getElementById("js-tricks-arrow").classList.remove("hide"),o.displayTricks(e)})).catch((function(e){console.error(e)})).finally((function(){o.toggleLoader()}))},toggleLoader:function(){o.loaderElement.classList.toggle("hide"),o.loadMoreButton.classList.toggle("hide")},displayTricks:function(e){var t,r=n(e);try{for(r.s();!(t=r.n()).done;){var a=t.value,i=document.importNode(o.template.content,!0);i.querySelector(".trick-card__name > a").textContent=a.name;var c,l=n(i.querySelectorAll(".trick__link"));try{for(l.s();!(c=l.n()).done;){c.value.href=o.linkTarget.replace(/slug$/,a.slug)}}catch(e){l.e(e)}finally{l.f()}if(a.trickImages[0]){var u=i.querySelector(".trick-card__image > img");u.src=u.src.replace(/\/figure-placeholder\.jpg$/,"/images/"+a.trickImages[0].src)}var s=i.querySelector(".trick-card__actions");if(s){var f=s.querySelector(".trick-card__edit"),d=s.querySelector(".trick-card__delete");f.href=f.href.replace(/\/slug\//,"/"+a.slug+"/"),d.action=d.action.replace(/\/slug\//,"/"+a.slug+"/")}o.wrapper.appendChild(i)}}catch(e){r.e(e)}finally{r.f()}}};document.addEventListener("DOMContentLoaded",o.init)},1530:function(e,t,r){"use strict";var n=r(8710).charAt;e.exports=function(e,t,r){return t+(r?n(e,t).length:1)}},7007:function(e,t,r){"use strict";r(4916);var n=r(1320),a=r(7293),o=r(5112),i=r(2261),c=r(8880),l=o("species"),u=!a((function(){var e=/./;return e.exec=function(){var e=[];return e.groups={a:"7"},e},"7"!=="".replace(e,"$<a>")})),s="$0"==="a".replace(/./,"$0"),f=o("replace"),d=!!/./[f]&&""===/./[f]("a","$0"),g=!a((function(){var e=/(?:)/,t=e.exec;e.exec=function(){return t.apply(this,arguments)};var r="ab".split(e);return 2!==r.length||"a"!==r[0]||"b"!==r[1]}));e.exports=function(e,t,r,f){var p=o(e),v=!a((function(){var t={};return t[p]=function(){return 7},7!=""[e](t)})),h=v&&!a((function(){var t=!1,r=/a/;return"split"===e&&((r={}).constructor={},r.constructor[l]=function(){return r},r.flags="",r[p]=/./[p]),r.exec=function(){return t=!0,null},r[p](""),!t}));if(!v||!h||"replace"===e&&(!u||!s||d)||"split"===e&&!g){var y=/./[p],E=r(p,""[e],(function(e,t,r,n,a){return t.exec===i?v&&!a?{done:!0,value:y.call(t,r,n)}:{done:!0,value:e.call(r,t,n)}:{done:!1}}),{REPLACE_KEEPS_$0:s,REGEXP_REPLACE_SUBSTITUTES_UNDEFINED_CAPTURE:d}),m=E[0],x=E[1];n(String.prototype,e,m),n(RegExp.prototype,p,2==t?function(e,t){return x.call(e,this,t)}:function(e){return x.call(e,this)})}f&&c(RegExp.prototype[p],"sham",!0)}},647:function(e,t,r){var n=r(7908),a=Math.floor,o="".replace,i=/\$([$&'`]|\d\d?|<[^>]*>)/g,c=/\$([$&'`]|\d\d?)/g;e.exports=function(e,t,r,l,u,s){var f=r+e.length,d=l.length,g=c;return void 0!==u&&(u=n(u),g=i),o.call(s,g,(function(n,o){var i;switch(o.charAt(0)){case"$":return"$";case"&":return e;case"`":return t.slice(0,r);case"'":return t.slice(f);case"<":i=u[o.slice(1,-1)];break;default:var c=+o;if(0===c)return n;if(c>d){var s=a(c/10);return 0===s?n:s<=d?void 0===l[s-1]?o.charAt(1):l[s-1]+o.charAt(1):n}i=l[c-1]}return void 0===i?"":i}))}},7651:function(e,t,r){var n=r(4326),a=r(2261);e.exports=function(e,t){var r=e.exec;if("function"==typeof r){var o=r.call(e,t);if("object"!=typeof o)throw TypeError("RegExp exec method returned something other than an Object or null");return o}if("RegExp"!==n(e))throw TypeError("RegExp#exec called on incompatible receiver");return a.call(e,t)}},2261:function(e,t,r){"use strict";var n,a,o=r(7066),i=r(2999),c=RegExp.prototype.exec,l=String.prototype.replace,u=c,s=(n=/a/,a=/b*/g,c.call(n,"a"),c.call(a,"a"),0!==n.lastIndex||0!==a.lastIndex),f=i.UNSUPPORTED_Y||i.BROKEN_CARET,d=void 0!==/()??/.exec("")[1];(s||d||f)&&(u=function(e){var t,r,n,a,i=this,u=f&&i.sticky,g=o.call(i),p=i.source,v=0,h=e;return u&&(-1===(g=g.replace("y","")).indexOf("g")&&(g+="g"),h=String(e).slice(i.lastIndex),i.lastIndex>0&&(!i.multiline||i.multiline&&"\n"!==e[i.lastIndex-1])&&(p="(?: "+p+")",h=" "+h,v++),r=new RegExp("^(?:"+p+")",g)),d&&(r=new RegExp("^"+p+"$(?!\\s)",g)),s&&(t=i.lastIndex),n=c.call(u?r:i,h),u?n?(n.input=n.input.slice(v),n[0]=n[0].slice(v),n.index=i.lastIndex,i.lastIndex+=n[0].length):i.lastIndex=0:s&&n&&(i.lastIndex=i.global?n.index+n[0].length:t),d&&n&&n.length>1&&l.call(n[0],r,(function(){for(a=1;a<arguments.length-2;a++)void 0===arguments[a]&&(n[a]=void 0)})),n}),e.exports=u},7066:function(e,t,r){"use strict";var n=r(9670);e.exports=function(){var e=n(this),t="";return e.global&&(t+="g"),e.ignoreCase&&(t+="i"),e.multiline&&(t+="m"),e.dotAll&&(t+="s"),e.unicode&&(t+="u"),e.sticky&&(t+="y"),t}},2999:function(e,t,r){"use strict";var n=r(7293);function a(e,t){return RegExp(e,t)}t.UNSUPPORTED_Y=n((function(){var e=a("a","y");return e.lastIndex=2,null!=e.exec("abcd")})),t.BROKEN_CARET=n((function(){var e=a("^r","gy");return e.lastIndex=2,null!=e.exec("str")}))},8710:function(e,t,r){var n=r(9958),a=r(4488),o=function(e){return function(t,r){var o,i,c=String(a(t)),l=n(r),u=c.length;return l<0||l>=u?e?"":void 0:(o=c.charCodeAt(l))<55296||o>56319||l+1===u||(i=c.charCodeAt(l+1))<56320||i>57343?e?c.charAt(l):o:e?c.slice(l,l+2):i-56320+(o-55296<<10)+65536}};e.exports={codeAt:o(!1),charAt:o(!0)}},7908:function(e,t,r){var n=r(4488);e.exports=function(e){return Object(n(e))}},8309:function(e,t,r){var n=r(9781),a=r(3070).f,o=Function.prototype,i=o.toString,c=/^\s*function ([^ (]*)/,l="name";n&&!(l in o)&&a(o,l,{configurable:!0,get:function(){try{return i.call(this).match(c)[1]}catch(e){return""}}})},4916:function(e,t,r){"use strict";var n=r(2109),a=r(2261);n({target:"RegExp",proto:!0,forced:/./.exec!==a},{exec:a})},5306:function(e,t,r){"use strict";var n=r(7007),a=r(9670),o=r(7466),i=r(9958),c=r(4488),l=r(1530),u=r(647),s=r(7651),f=Math.max,d=Math.min;n("replace",2,(function(e,t,r,n){var g=n.REGEXP_REPLACE_SUBSTITUTES_UNDEFINED_CAPTURE,p=n.REPLACE_KEEPS_$0,v=g?"$":"$0";return[function(r,n){var a=c(this),o=null==r?void 0:r[e];return void 0!==o?o.call(r,a,n):t.call(String(a),r,n)},function(e,n){if(!g&&p||"string"==typeof n&&-1===n.indexOf(v)){var c=r(t,e,this,n);if(c.done)return c.value}var h=a(e),y=String(this),E="function"==typeof n;E||(n=String(n));var m=h.global;if(m){var x=h.unicode;h.lastIndex=0}for(var S=[];;){var k=s(h,y);if(null===k)break;if(S.push(k),!m)break;""===String(k[0])&&(h.lastIndex=l(y,o(h.lastIndex),x))}for(var I,b="",_=0,A=0;A<S.length;A++){k=S[A];for(var R=String(k[0]),T=f(d(i(k.index),y.length),0),C=[],$=1;$<k.length;$++)C.push(void 0===(I=k[$])?I:String(I));var L=k.groups;if(E){var w=[R].concat(C,T,y);void 0!==L&&w.push(L);var B=String(n.apply(void 0,w))}else B=u(R,y,T,C,L,n);T>=_&&(b+=y.slice(_,T)+B,_=T+R.length)}return b+y.slice(_)}]}))}},0,[[4175,666,109,893]]]);