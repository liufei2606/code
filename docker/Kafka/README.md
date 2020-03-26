
```
## 单体
docker run -d --name zookeeper -p 2181:2181  zookeeper

## create one container
docker run -d --name kafka -p 9092:9092 -e KAFKA_BROKER_ID=0 -e KAFKA_ZOOKEEPER_CONNECT=192.168.1.6:2181/kafka -e KAFKA_ADVERTISED_LISTENERS=PLAINTEXT://192.168.1.6:9092 -e KAFKA_LISTENERS=PLAINTEXT://0.0.0.0:9092 wurstmeister/kafka

docker exec -it kafka /bin/sh

cd /opt/kafka_2.11-2.0.0/bin/
./kafka-console-producer.sh --broker-list localhost:9092 --topic sun
{"datas":[{"channel":"","metric":"temperature","producer":"ijinus","sn":"IJA0101-00002245","time":"1543207156000","value":"80"}],"ver":"1.0"}

# consumer
kafka-console-consumer.sh --bootstrap-server localhost:9092 --topic sun --from-beginning

docker exec -it zookeeper /bin/sh

zkCli.sh
ls -s /kafka/brokers/topics/sun/partitions
get /kafka/brokers/topics/sun

kafka-topics.sh --create --zookeeper 192.168.1.6:2181/kafka --topic topic-test1 --replication-factor 1 --partitions 2

kafka-topics.sh --delete --zookeeper 192.168.1.6:2181/kafka --topic sun

ls /kafka/brokers/topics

##数据文件保存的路径
/opt/kafka_2.11-2.0.0/config/service.config # 文件路径


## 集群
# Produce another kafka container
docker run -d --name kafka -p 9093:9093 -e KAFKA_BROKER_ID=1 -e KAFKA_ZOOKEEPER_CONNECT=192.168.1.6:2181/kafka -e KAFKA_ADVERTISED_LISTENERS=PLAINTEXT://192.168.1.6:9093 -e KAFKA_LISTENERS=PLAINTEXT://0.0.0.0:9093 wurstmeister/kafka

cd /opt/kafka_2.11-2.0.0/bin/
kafka-topics.sh --create --topic test1 --zookeeper 192.168.1.6:2181/kafka --replication-factor 2 --partitions 2 # 创建
kafka-topics.sh --describe --zookeeper 192.168.1.6:2181/kafka --topic test1 # 查看

Topic: test1	PartitionCount: 2	ReplicationFactor: 2	Configs: 
	Topic: test1	Partition: 0	Leader: 1	Replicas: 1,0	Isr: 1,0
	Topic: test1	Partition: 1	Leader: 0	Replicas: 0,1	Isr: 0

docker stop kafka (one)

kafka-topics.sh --describe --zookeeper 192.168.1.6:2181/kafka --topic test1 # 两个分区对应的节点都指向了BROKER_ID=0，实现了高可用

{"datas":[{"channel":"","metric":"temperature","producer":"ijinus","sn":"IJA0101-00002245","time":"1543207156000","value":"80"}],"ver":"1.0"}

# consumer
kafka-console-consumer.sh --bootstrap-server localhost:9092 --topic sun --from-beginning

kafka-topics.sh --create --zookeeper 192.168.1.6:2181/kafka --topic topic-test1 --replication-factor 1 --partitions 2

kafka-topics.sh --delete --zookeeper 192.168.1.6:2181/kafka --topic sun
```

## compose

```sh
zoo2 172.19.0.2
zoo1 172.19.0.4,
zoo3 172.19.0.3
broker3 172.19.0.5
broker2 172.19.0.7
broker1 172.19.0.6


docker-compose up -d
```
