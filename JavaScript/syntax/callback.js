fs.readFile("/etc/passwd", "utf-8", function (err, data) {
	if (err) throw err;
	console.log(data);
});
