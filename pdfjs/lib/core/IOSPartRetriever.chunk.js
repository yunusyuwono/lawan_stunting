/** Notice * This file contains works from many authors under various (but compatible) licenses. Please see core.txt for more information. **/
(function(){(window.wpCoreControlsBundle=window.wpCoreControlsBundle||[]).push([[10],{392:function(ia,y,e){e.r(y);var fa=e(1),x=e(215);ia=e(384);var ha=e(32);e=e(316);var ea={},da=function(e){function w(w,r){var h=e.call(this,w,r)||this;h.url=w;h.range=r;h.status=x.a.NOT_STARTED;return h}Object(fa.c)(w,e);w.prototype.start=function(e){var r=this;ea[this.range.start]={Wr:function(f){var h=atob(f),w,x=h.length;f=new Uint8Array(x);for(w=0;w<x;++w)f[w]=h.charCodeAt(w);h=f.length;w="";var z=0;if(Object(ha.o)())for(;z<
h;)x=f.subarray(z,z+1024),z+=1024,w+=String.fromCharCode.apply(null,x);else for(x=Array(1024);z<h;){for(var ba=0,y=Math.min(z+1024,h);z<y;ba++,z++)x[ba]=f[z];w+=String.fromCharCode.apply(null,1024>ba?x.slice(0,ba):x)}r.Wr(w,e)},FN:function(){r.status=x.a.ERROR;e({code:r.status})}};var h=document.createElement("IFRAME");h.setAttribute("src",this.url);document.documentElement.appendChild(h);h.parentNode.removeChild(h);h=null;this.status=x.a.STARTED;r.vz()};return w}(ia.ByteRangeRequest);ia=function(e){function w(w,
r,h,f){w=e.call(this,w,r,h,f)||this;w.xv=da;return w}Object(fa.c)(w,e);w.prototype.Ft=function(e,r){return e+"#"+r.start+"&"+(r.stop?r.stop:"")};w.bka=function(e,r){var h=ea[r];delete ea[r];h.Wr(e)};w.aka=function(e,r){e=ea[r];delete ea[r];e.FN()};return w}(ia["default"]);Object(e.a)(ia);Object(e.b)(ia);y["default"]=ia}}]);}).call(this || window)