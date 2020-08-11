package main

import (
	"github.com/gin-gonic/gin"
	"net/http"
	"time"
)

func main() {
	// 禁止日志颜色
	gin.DisableConsoleColor()

	// 强制设置日志颜色
	gin.ForceConsoleColor()

	// 使用默认中间件（logger 和 recovery）创建 gin 路由器
	router := gin.Default()

	// 定义路由
	router.GET("/ping", func(c *gin.Context) {
		c.String(200, "pong")
	})

	// 启动服务器
	// 第一种
	//router.Run(":8080")
	// 第二种
	//http.ListenAndServe(":8080", router)

	// 第三种
	s := &http.Server{
		Addr:           ":8080",
		Handler:        router,
		ReadTimeout:    10 * time.Second,
		WriteTimeout:   10 * time.Second,
		MaxHeaderBytes: 1 << 20,
	}
	s.ListenAndServe()
}