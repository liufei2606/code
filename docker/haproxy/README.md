```
docker run --detach \
  --name dtr-lb \
  --publish 443:443 \
  --publish 80:80 \
  --publish 8181:8181 \
  --restart=unless-stopped \
  --volume ${PWD}/haproxy.cfg:/usr/local/etc/haproxy/haproxy.cfg:ro \
  haproxy:1.7-alpine haproxy -d -f /usr/local/etc/haproxy/haproxy.cfg
```
