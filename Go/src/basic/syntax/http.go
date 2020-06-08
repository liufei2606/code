package main

import (
	"fmt"
	"io"
	"net/http"
	"net/url"
	"os"
)

// http 使用及原理
func main() {
	// get
	resp, err := http.Get("https://xueyuanjun.com")
	if err != nil {
		fmt.Printf("发起请求失败：%v", err)
		return
	}
	defer resp.Body.Close()
	io.Copy(os.Stdout, resp.Body)

	resp, err = http.Post("https://xueyuanjun.com/avatar", "image/jpeg", &imageDataBuf)
	if err != nil {
		// 处理错误
		return
	}

	if resp.StatusCode != http.StatusOK {
		// 处理错误
		return
	}
	defer resp.Body.Close()
	io.Copy(os.Stdout, resp.Body)

	// postForm
	resp, err = http.PostForm("https://xueyuanjun.com/login", url.Values{"name": {"学院君"}, "password": {"test-passwd"}})
	if err != nil {
		// 处理错误
		return
	}
	if resp.StatusCode != http.StatusOK {
		// 处理错误
		return
	}

	// head
	resp, err = http.Head("https://xueyuanjun.com")
	if err != nil {
		fmt.Println("Request Failed: ", err.Error())
		return
	}
	defer resp.Body.Close()
	for key, value := range resp.Header {
		fmt.Println(key, ":", value)
	}

	// Do
	// 初始化客户端请求对象
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
	resp, err = client.Do(req)
	if err != nil {
		fmt.Printf("客户端发起请求失败：%v", err)
		return
	}

	defer resp.Body.Close()
	io.Copy(os.Stdout, resp.Body)
}
