package main

import (
	"github.com/gin-gonic/gin"
	"fmt"
)

func main() {
	router := gin.Default()

	router.GET("/cookie", func(c *gin.Context) {
		// 读取 Cookie
		cookie, err := c.Cookie("gin_cookie")

		if err != nil {
			cookie = "NotSet"
			// 设置 Cookie
			c.SetCookie("gin_cookie", "test", 3600, "/", "localhost", false, true)
		}

		fmt.Printf("Cookie value: %s \n", cookie)
	})

	router.Run(":8080")
}