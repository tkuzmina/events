function showCommentForm() {
	setVisible('commentForm', true);
}

function hideCommentForm() {
	setVisible('commentForm', false);
}

function showTagForm() {
	setVisible('addTagLink', false);
	setVisible('tagForm', true);
}

function hideTagForm() {
	setVisible('addTagLink', true);
	setVisible('tagForm', false);
}

function show(elementName) {
    setVisible(elementName, true);
}

function hide(elementName) {
    setVisible(elementName, false);
}

/* make a UI element visible / not visible */
function setVisible(elementName, isVisible) {
	element = document.getElementById(elementName)
	if (element != null) {
		element.style.display = isVisible ? 'block' : 'none';
	}
}

function applicationLoad() {
	hideCommentForm();
	hideTagForm();
}

function open_url(url) {
    window.location.href=url;
}

