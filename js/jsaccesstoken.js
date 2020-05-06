//Da accesstoken a href de action
var linkinsert = document.getElementById('linkinsert');
var hrefbaselinkinsert = linkinsert.href;
var accesstoken = localStorage.getItem('access-token');
var accesstokencode = encodeURIComponent(accesstoken);
var hreftotallinkinder = hrefbaselinkinsert + accesstokencode;
linkinsert.setAttribute('href', hreftotallinkinder);

var linkmodify = document.getElementById('linkmodify');
var hrefbaselinkmodify = linkmodify.href;
var hreftotallinkmodify = hrefbaselinkmodify + accesstokencode;
linkmodify.setAttribute('href', hreftotallinkmodify);




