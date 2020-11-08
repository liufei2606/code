
const http = require('http');
const url = require('url');

const server = http.createServer(function (request, response) {
	const { query } = url.parse(request.url, true);
	console.log(request.method + ': ' + request.url);

	if (request.method === 'POST') {
		let data = '';
		request.on('data', chunk => {
			data += chunk;
		});

		request.on('end', () => {
			try {
				const requestData = JSON.parse(data);
				requestData.ourMessage = 'success';
				response.setHeader('Content-Type', 'application/json');
				response.end(JSON.stringify(requestData));
			} catch (e) {
				response.statusCode = 400;
				response.end('Invalid JSON');
			}
		});
	} else if (query.name) {
		console.log(url.parse('http://user:pass@host.com:8080/path/to/file?query=string#hash'));
		response.end(`You requested parameter name with value ${query.name}`);
	} else {
		response.setHeader(
			'Set-Cookie',
			['myCookie=myValue'],
			['mySecondCookie=mySecondValue']
		);
		response.writeHead(200, { 'Content-Type': 'text/html' });
		response.end('<h1>Hello world!</h1><br\>' + `Your cookies are: ${request.headers.cookie}`);
	}
}).listen(8080, () => {
	console.log(`Server is running at http://127.0.0.1:8080/`); // 访问 http://localhost:8080
});


const PORT = process.env.PORT || 8081;
const server1 = http.createServer();

server1.on('request', (request, response) => {
	switch (request.url) {
		case '/':
			response.end('You are on the main page!');
			break;
		case '/about':
			response.end('You are on about page!');
			break;
		case '/api':
			const languages = request.headers['accept-language'];
			response.setHeader('content-type', 'application/json');
			response.end(JSON.stringify({ foo: 'bar' }));
			response.end('Hello, world!' + languages);
			break;
		default:
			response.statusCode = 404;
			response.end('Page not found!');
	}
});

server1.listen(PORT, () => {
	console.log(`starting server at port ${PORT}`);
});
