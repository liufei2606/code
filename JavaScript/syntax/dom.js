var p = document.createElement('p');
document.body.appendChild(p);

function DOMComb(parent, callback) {
	if (parent.hasChildNodes()) {
		for (var node = parent.firstChild; node; node = node.nextSibling) {
			DOMComb(node, callback);
		}
	}
	callback(parent);
}

// 用法
DOMComb(document.body, console.log)

var cloneUL = document.querySelector('ul').cloneNode(true);
