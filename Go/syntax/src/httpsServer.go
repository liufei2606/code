package main

import (
	"fmt"
	"log"
	"net/http"
)

func main() {

	// Generate CA private key  openssl genrsa -out ca.key 2048
	// Generate CSR openssl req -new -key ca.key -out ca.csr
	// Generate Self Signed certificate（CA 根证书） openssl x509 -req -days 365 -in ca.csr -signkey ca.key -out ca.crt
	http.HandleFunc("/hello", func(writer http.ResponseWriter, request *http.Request) {
		params := request.URL.Query()
		fmt.Fprintf(writer, "你好, %s", params.Get("name"))
	})
	err := http.ListenAndServeTLS(":8443", "./https/ca.crt", "./https/ca.key", nil)
	if err != nil {
		log.Fatalf("启动 HTTPS 服务器失败: %v", err)
	}
}
