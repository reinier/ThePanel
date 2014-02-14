var thelink=encodeURIComponent(location.href);
var thetitle=encodeURIComponent(document.title);
window.location = "http://{{ Config::get('bookmarklet.base_url'); }}/backlog/add?url="+thelink+"&title="+thetitle+"&bookmarklet=true";