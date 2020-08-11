package main

import (
	"github.com/gin-gonic/gin"
)

type LoginForm struct {
	User     string `form:"user" binding:"required"`
	Password string `form:"password" binding:"required"`
}

func main() {
	router := gin.Default()
	router.POST("/login", func(c *gin.Context) {
		// you can bind multipart form with explicit binding declaration:
		// c.ShouldBindWith(&form, binding.Form)
		// or you can simply use autobinding with ShouldBind method:
		var form LoginForm
		// in this case proper binding will be automatically selected
		if c.ShouldBind(&form) == nil {
			if form.User == "xueyuanjun" && form.Password == "123456" {
				c.JSON(200, gin.H{"status": "you are logged in"})
			} else {
				c.JSON(401, gin.H{"status": "unauthorized"})
			}
		}
	})

	router.POST("/form_post", func(c *gin.Context) {
		// 解析表单字段 message
		message := c.PostForm("message")
		// 解析表单字段 nick，如果为空的话使用默认值 xueyuanjun
		nick := c.DefaultPostForm("nick", "xueyuanjun")

		c.JSON(200, gin.H{
			"status":  "posted",
			"message": message,
			"nick":    nick,
		})
	})

	router.Run(":8080")
}