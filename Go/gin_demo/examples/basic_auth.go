package main

import (
	"github.com/gin-gonic/gin"
	"net/http"
)

// 模拟一些私有数据
var secrets = gin.H{
	"foo":    gin.H{"email": "foo@bar.com", "phone": "123433"},
	"austin": gin.H{"email": "austin@example.com", "phone": "666"},
	"lena":   gin.H{"email": "lena@guapa.com", "phone": "523443"},
}

func main() {
	r := gin.Default()

	// 在 /admin 分组中使用 gin.BasicAuth() 中间件
	// 通过 gin.Accounts 来初始化一些测试用户信息（用户名/密码键值对）
	authorized := r.Group("/admin", gin.BasicAuth(gin.Accounts{
		"foo":    "bar",
		"austin": "1234",
		"lena":   "hello2",
		"manu":   "4321",
	}))

	// /admin/secrets
	// 匹配 "localhost:8088/admin/secrets
	authorized.GET("/secrets", func(c *gin.Context) {
		// 获取用户，通过 BasicAuth 中间件设置
		user := c.MustGet(gin.AuthUserKey).(string)
		if secret, ok := secrets[user]; ok {
			c.JSON(http.StatusOK, gin.H{"user": user, "secret": secret})
		} else {
			c.JSON(http.StatusOK, gin.H{"user": user, "secret": "NO SECRET :("})
		}
	})

	// 监听 0.0.0.0:8080，等待客户端请求
	r.Run(":8088")
}