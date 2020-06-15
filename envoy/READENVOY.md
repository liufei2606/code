# ENVOY

- node : 节点标识，配置的是 Envoy 的标记信息，management server 利用它来标识不同的 Envoy 实例。参考 core.Node
- static_resources : 定义静态配置，是 Envoy 核心工作需要的资源，由 Listener、Cluster 和 Secret 三部分组成。参考 config.bootstrap.v2.Bootstrap.StaticResources
  - listener : Envoy 监听地址，暴露一个或多个 Listener 来监听客户端请求
  - filter : 过滤器。在 Envoy 中指的是一些“可插拔”和可组合的逻辑处理层，是 Envoy 核心逻辑处理单元
  - route_config : 路由规则配置。即将请求路由到后端的哪个集群
  - cluster : 服务提供方集群。通过服务发现定位集群成员并获取服务，具体路由到哪个集群成员由负载均衡策略决定
- dynamic_resources : 定义动态配置，通过 xDS 来获取配置。可以同时配置动态和静态。
- cluster_manager : 管理所有的上游集群。它封装了连接后端服务的操作，当 Filter 认为可以建立连接时，便调用 cluster_manager 的 API 来建立连接。cluster_manager 负责处理负载均衡、健康检查等细节。
- hds_config : 健康检查服务发现动态配置。
- stats_sinks : 状态输出插件。可以将状态数据输出到多种采集系统中。一般通过 Envoy 的管理接口 /stats/prometheus 就可以获取 Prometheus 格式的指标，这里的配置应该是为了支持其他的监控系统。
- stats_config : 状态指标配置。
- stats_flush_interval : 状态指标刷新时间。
- watchdog : 看门狗配置。Envoy 内置了一个看门狗系统，可以在 Envoy 没有响应时增加相应的计数器，并根据计数来决定是否关闭 Envoy 服务。
- tracing : 分布式追踪相关配置。
- runtime : 运行时状态配置（已弃用）。
- layered_runtime : 层级化的运行时状态配置。可以静态配置，也可以通过 RTDS 动态加载配置。
- admin : 管理接口。
- overload_manager : 过载过滤器。
- header_prefix : Header 字段前缀修改。例如，如果将该字段设为 X-Foo，那么 Header 中的 x-envoy-retry-on 将被会变成 x-foo-retry-on。
- use_tcp_for_dns_lookups : 强制使用 TCP 查询 DNS。可以在 Cluster 的配置中覆盖此配置

```sh
envoy -c ./basic-front-proxy.yaml
curl -s -o /dev/null -vvv -H 'Host: bing.com' localhost:15001
curl -vvv -H 'Host: baidu.com' 127.0.0.1:1500
```

## 过滤器

- 进程中运行着一系列 Inbound/Outbound 监听器（Listener），Inbound 代理入站流量，Outbound 代理出站流量
- Listener 的核心就是过滤器链（FilterChain），链中每个过滤器都能够控制流量的处理流程
  - 网络过滤器（Network Filters）: 工作在 L3/L4，是 Envoy 网络连接处理的核心，处理的是原始字节，分为 Read、Write 和 Read/Write 三类
  - HTTP 过滤器（HTTP Filters）: 工作在 L7，由特殊的网络过滤器 HTTP connection manager 管理，专门处理 HTTP1/HTTP2/gRPC 请求。它将原始字节转换成 HTTP 格式，从而可以对 HTTP 协议进行精确控制
  - Thrift Proxy
- 监听器过滤器（Listener Filters）:在过滤器链之前执行，用于操纵连接的元数据。目的:无需更改 Envoy 的核心代码就可以方便地集成更多功能

## 替换nginx


```
curl localhost:85
```