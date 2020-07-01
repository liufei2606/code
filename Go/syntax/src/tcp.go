package main

import (
	"bytes"
	"fmt"
	"io"
	"net"
	"os"
	"time"
)

func main() {
	if len(os.Args) != 2 {
		fmt.Fprintf(os.Stderr, "Usage: %s host:port", os.Args[0])
		os.Exit(1)
	}
	// 从参数中读取主机信息
	service := os.Args[1]

	// dial 使用及原理
	// Dial() 函数是对 dialTCP()、dialUDP()、dialIP() 和 dialUnix() 的封装,底层真正建立连接是通过 dialSingle() 函数完成
	// 通过从传入参数中获取网络协议类型调用对应的连接建立函数并返回连接对象,底层函数最终都调用了 syscall 包的 Socket() 函数与对应平台操纵系统的 Socket API 交互实现网络连接的建立，针对不同的通信协议，建立不同的连接类型
	// typ 代表 Socket 的类型，比如 TCP 对应的 Socket 类型常量是 syscall.SOCK_STREAM（面向连接通信）
	// UDP 对应的 Socket 类型常量是 syscall.SOCK_DGRAM（面向无连接通信）
	// SOCK_RAW 是原始的 IP 协议包
	// SOCK_SEQPACKET 与 SOCK_STREAM 类似，都是面向连接的，只不过前者有消息边界，传输的是数据包，而不是字节流
	// 建立网络连接
	//conn, err := net.Dial("tcp", service)
	// 添加连接超时
	conn, err := net.DialTimeout("tcp", service, 3*time.Second)
	// 连接出错则打印错误消息并退出程序
	checkError(err)

	// 设置读写超时时间
	err = conn.SetDeadline(time.Now().Add(5 * time.Second))
	checkError(err)

	// 调用返回的连接对象提供的 Write 方法发送请求
	_, err = conn.Write([]byte("HEAD / HTTP/1.0\r\n\r\n"))
	checkError(err)

	// 通过连接对象提供的 Read 方法读取所有响应数据
	result, err := readFully(conn)
	checkError(err)

	// 打印响应数据
	fmt.Println(string(result))
	os.Exit(0)
}

func checkError(err error) {
	if err != nil {
		fmt.Fprintf(os.Stderr, "Fatal error: %s", err.Error())
		os.Exit(1)
	}
}

func readFully(conn net.Conn) ([]byte, error) {
	// 读取所有响应数据后主动关闭连接
	defer conn.Close()

	result := bytes.NewBuffer(nil)
	var buf [512]byte
	for {
		n, err := conn.Read(buf[0:])
		result.Write(buf[0:n])
		if err != nil {
			if err == io.EOF {
				break
			}
			return nil, err
		}
	}
	return result.Bytes(), nil
}

// go run tcp.go xueyuanjun.com:http
// go run tcp.go xueyuanjun.com:80
