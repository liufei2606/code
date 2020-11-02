## Dynamic Routing Based On Redis

```sh
redis-server

./redis-cli
redis> set foo apache.org
redis> set bar nginx.org

curl --user-agent foo localhost:8080

curl --user-agent bar localhost:8080
```
