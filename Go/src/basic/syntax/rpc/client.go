package main

import (
	"basic/syntax/rpc/utils"
	"fmt"
	"log"
	"net/rpc"
)

func main() {
	// 建立连接
	var serverAddress = "localhost"
	client, err := rpc.DialHTTP("tcp", serverAddress+":8080")
	if err != nil {
		log.Fatal("建立与服务端连接失败:", err)
	}

	// 调用
	args := &utils.Args{10, 10}
	var reply int
	err = client.Call("MathService.Multiply", args, &reply)
	if err != nil {
		log.Fatal("调用远程方法 MathService.Multiply 失败:", err)
	}
	fmt.Printf("%d*%d=%d\n", args.A, args.B, reply)

	// 同步调用通过在连接对象上调用 Call 方法实现，所谓同步调用指的是只有接收完 RPC 服务端的处理结果之后才可以继续执行后面的程序
	divideCall := client.Go("MathService.Divide", args, &reply, nil)
	for {
		select {
		case <-divideCall.Done:
			fmt.Printf("%d/%d=%d\n", args.A, args.B, reply)
			return
		}
	}
}
