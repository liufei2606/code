package main

import (
	"fmt"
	"github.com/gin-gonic/gin"
)

func main() {
	router := gin.Default()

	router.POST("/post", func(c *gin.Context) {
		// 从查询字符串获取数据
		ids := c.QueryMap("ids")
		// 从请求表单获取数据
		names := c.PostFormMap("names")

		fmt.Printf("ids: %v; names: %v", ids, names)
	})

	router.Run(":8080")
}