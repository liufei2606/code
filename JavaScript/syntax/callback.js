fs.readFile("/etc/passwd", "utf-8", function (err, data) {
	if (err) throw err;
	console.log(data);
});

function f1(callback) {
	// ...
	callback();
}

function f2() {
	// ...
}

f1(f2);
