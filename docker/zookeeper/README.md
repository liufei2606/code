
```sh
docker network create zoo_kafka

docker run -d \
     --restart=always \
     -v $PWD/data:/data \
     -v $PWD/datalog:/datalog \
     -e ZOO_MY_ID=1 \
     -p 2181:2181 \
     -e ZOO_SERVERS="server.1=zoo1:2888:3888 server.2=zoo2:2888:3888 server.3=zoo3:2888:3888" \
     --name=zoo1 \
     --net=zoo_kafka \
     --privileged \
     zookeeper

docker run -d \
     --restart=always \
     -v $PWD/zoo2/data:/data \
     -v $PWD/datalog:/datalog \
     -e ZOO_MY_ID=2 \
     -p 2182:2181 \
     -e ZOO_SERVERS="server.1=zoo1:2888:3888 server.2=zoo2:2888:3888 server.3=zoo3:2888:3888" \
     --name=zoo2 \
     --net=zoo_kafka \
     --privileged \
     zookeeper

docker run -d \
     --restart=always \
     -v $PWD/zoo3/data:/data \
     -v $PWD/zoo3/datalog:/datalog \
     -e ZOO_MY_ID=3 \
     -p 2183:2181 \
     -e ZOO_SERVERS="server.1=zoo1:2888:3888 server.2=zoo2:2888:3888 server.3=zoo3:2888:3888" \
     --name=zoo3 \
     --net=zoo_kafka \
     --privileged \
     zookeeper

docker exec zoo1 bash
zkServer.sh status
```


```sh
docker run --name some-zookeeper --restart always -d -v $(pwd)/zoo.cfg:/conf/zoo.cfg zookeeper

docker run --name some-app --link some-zookeeper:zookeeper -d application-that-uses-zookeeper
docker run -it --rm --link some-zookeeper:zookeeper zookeeper zkCli.sh -server zookeeper

# cluster
docker-compose  -f stack.yml up

# 连接 ZK 集群
docker run -it --rm \
--link zookeeper_zoo3_1 \
--link zookeeper_zoo2_1 \
--link zookeeper_zoo1_1 \
zookeeper zkCli.sh -server zk1:2181,zk2:2181,zk3:2181

Cannot link to /zookeeper_zoo2_1, as it does not belong to the default network.

echo stat | nc 127.0.0.1 2181
```
