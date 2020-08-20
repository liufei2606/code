server.on('stream', (stream, headers) => {
    const path = headers[":path"];
    switch (path) {
        case '/':
            {
                stream.respond({
                    'content-type': 'text/html',
                    ':status': 200
                });
                stream.end(`
        <head>
          <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
          <h1>Hello World</h1>
        </body>
      `);
                break;
            }
        case '/style.css':
            {
                stream.respond({
                    'content-type': 'text/css',
                    ':status': 200
                });
                stream.end(`
        body {
          color: red;
        }
      `);
                break;
            }
        default:
            {
                stream.respond({
                    ':status': 404
                });
                stream.end();
            }
    }
});