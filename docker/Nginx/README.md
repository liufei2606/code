```
docker run --name nginx -d -p 80:80 -p 81:81 -v $PWD/html:/usr/share/nginx/html -v $PWD/conf:/etc/nginx/conf -v $PWD/logs:/var/log/nginx --restart=always nginx:1.14-alpine
```
