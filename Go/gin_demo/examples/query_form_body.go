package main

import (
	"fmt"

	"github.com/gin-gonic/gin"
)

func main() {
	router := gin.Default()

	router.POST("/post", func(c *gin.Context) {
		id := c.Query("id")  // 查询字符串
		page := c.DefaultQuery("page", "0")  // 查询字符串（带默认值）
		name := c.PostForm("name")   //  POST 表单数据
		message := c.PostForm("message")  //  同上

		fmt.Printf("id: %s; page: %s; name: %s; message: %s", id, page, name, message)
	})
	router.Run(":8080")
}