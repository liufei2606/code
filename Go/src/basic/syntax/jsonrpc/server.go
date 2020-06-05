package main

import (
	"log"
	"net"
	"net/rpc"
	"net/rpc/jsonrpc"
)

// 服务端的rpc处理器
type ServiceHandler struct{}

func (serviceHandler *ServiceHandler) GetName(id int, item *Item) error {
	log.Printf("receive GetName call, id: %d", id)
	item.Id = id
	item.Name = "学院君"
	return nil
}

func (serviceHandler *ServiceHandler) SaveName(item Item, resp *Response) error {
	log.Printf("receive SaveName call, Item: %v", item)
	resp.Ok = true
	resp.Id = item.Id
	resp.Message = "存储成功"
	return nil
}

func main() {
	// 初始化 RPC 服务端
	server := rpc.NewServer()

	// 监听端口 8080
	listener, err := net.Listen("tcp", ":8080")
	if err != nil {
		log.Fatalf("监听端口失败：%v", err)
	}
	defer listener.Close()

	log.Println("Start listen on port localhost:8080")

	// 初始化服务处理器
	serviceHandler := &ServiceHandler{}
	// 注册处理器
	err = server.Register(serviceHandler)
	if err != nil {
		log.Fatalf("注册服务处理器失败：%v", err)
	}

	// 等待并处理客户端连接
	for {
		conn, err := listener.Accept()
		if err != nil {
			log.Fatalf("接收客户端连接请求失败: %v", err)
		}

		// 自定义 RPC 编码器：新建一个 jsonrpc 编码器，并将该编码器绑定给 RPC 服务端处理器
		// 次拿到新的客户端连接 conn 后，通过 jsonrpc.NewServerCodec(conn) 对其进行封装，以便在处理接收到的请求数据和发送响应数据时通过 JSON 对数据进行编码和解码，然后将这个编解码器通过 server.ServeCodec 分配给 RPC 服务端，从而完成对数据编解码工具的自定义
		go server.ServeCodec(jsonrpc.NewServerCodec(conn))
	}
}

// go run server.go utils.go
