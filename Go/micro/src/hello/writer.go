package main

import (
	"fmt"
	"github.com/golang/protobuf/proto"
	proto "proto/proto"
	"io/ioutil"
)

func main() {
	message := &proto.protoWorld{}
	message.Id = 1
	message.Str = "学院君"
	message.Opt = proto.protoWorld_WRITE

	out, err := proto.Marshal(message)
	if err != nil {
		fmt.Printf("消息编码失败: %v\n", err)
		return
	}
	err = ioutil.WriteFile("log", out, 0644)
	if err != nil {
		fmt.Printf("文件写入 log 失败: %v\n", err)
		return
	}
	fmt.Printf("将消息编码并写入到文件成功: %s\n", message)
}