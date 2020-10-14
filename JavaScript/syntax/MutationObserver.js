var observer = new MutationObserver(function (mutations, observer) {
	mutations.forEach(function (mutation) {
		console.log(mutation);
	});
});

var article = document.querySelector('article');

var options = {
	'childList': true,
	'attributes': true
};

observer.observe(article, options);


var callback = function (records) {
	records.map(function (record) {
		console.log('Mutation type: ' + record.type);
		console.log('Mutation target: ' + record.target);
	});
};

var mo = new MutationObserver(callback);

var option = {
	'childList': true,
	'subtree': true
};

mo.observe(document.body, option);

var callback = function (records) {
	records.map(function (record) {
		console.log('Previous attribute value: ' + record.oldValue);
	});
};

var mo = new MutationObserver(callback);

var element = document.getElementById('#my_element');

var options = {
	'attributes': true,
	'attributeOldValue': true
}

mo.observe(element, options);

var observer = new MutationObserver(callback);
observer.observe(document.documentElement, {
	childList: true,
	subtree: true
});
