package main

import (
	"fmt"
	"io"
	"net/http"
	"os"
)

func main() {
	req, err := http.NewRequest("GET", "http://127.0.0.1:8080/hello?name=学院君", nil)
	if err != nil {
		fmt.Printf("请求初始化失败：%v", err)
		return
	}
	// 添加自定义请求头
	req.Header.Add("Custom-Header", "Custom-Value")
	// ... 其它请求头配置
	client := &http.Client{
		// ... 设置客户端属性
	}
	resp, err := client.Do(req)
	if err != nil {
		fmt.Printf("客户端发起请求失败：%v", err)
		return
	}

	defer resp.Body.Close()
	io.Copy(os.Stdout, resp.Body)
}
