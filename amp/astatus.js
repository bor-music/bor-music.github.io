window.onload = addLinkMsg;

// Adds a status bar message to all links on the page
function addLinkMsg() {
if (!document.getElementsByTagName) return;

// Get all the anchors/links in the document
// and step through them all, assigning events as we go...
var anchors = document.getElementsByTagName('a');
for (var i=0; i < anchors.length; i++) {
anchors[i].onmouseover = function() {window.status = 'The Renegade Amp [www.bor-music.de]'; return true;}
anchors[i].onmouseout = function() {window.status = 'The Renegade Amp [www.bor-music.de]'; return true;}
}
}