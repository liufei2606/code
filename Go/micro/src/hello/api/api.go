package main

import (
	"context"
	"encoding/json"
	"github.com/micro/go-micro"
	api "github.com/micro/go-micro/api/proto"
	"github.com/micro/go-micro/errors"
	hello "hello/proto"
	"log"
	"strings"
)

type Say struct {
	Client hello.GreeterService
}

func (s *Say) Hello(ctx context.Context, req *api.Request, rsp *api.Response) error {
	log.Print("收到 Say.Hello API 请求")

	// 从请求参数中获取 name 值
	name, ok := req.Get["name"]
	if !ok || len(name.Values) == 0 {
		return errors.BadRequest("go.micro.api.greeter", "名字不能为空")
	}

	// 将参数交由底层服务处理
	response, err := s.Client.Hello(ctx, &hello.HelloRequest{
		Name: strings.Join(name.Values, " "),
	})
	if err != nil {
		return err
	}

	// 处理成功，则返回处理结果
	rsp.StatusCode = 200
	b, _ := json.Marshal(map[string]string{
		"message": response.Greeting,
	})
	rsp.Body = string(b)

	return nil
}

func main() {
	// 创建一个新的服务
	service := micro.NewService(
		micro.Name("go.micro.api.greeter"),
	)

	// 解析命令行参数
	service.Init()

	// 将请求转发给底层 go.micro.srv.greeter 服务处理
	service.Server().Handle(
		service.Server().NewHandler(
			&Say{Client: hello.NewGreeterService("go.micro.srv.greeter", service.Client())},
		),
	)

	// 运行服务
	if err := service.Run(); err != nil {
		log.Fatal(err)
	}
}