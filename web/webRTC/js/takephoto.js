
var picture = document.querySelector('canvas#picture');
picture.width = 640;
picture.height = 480;

picture.getContext('2d').drawImage(localVideo, 0, 0, picture.width, picture.height);

function downLoad(url) {
	var oA = document.createElement("a");
	oA.download = 'photo';
	oA.href = url;
	document.body.appendChild(oA);
	oA.click();
	oA.remove();
}

document.querySelector("button#save").onclick = function () {
	downLoad(picture.toDataURL("image/jpeg"));
}

var filtersSelect = document.querySelector('select#filter');
picture.className = filtersSelect.value;
