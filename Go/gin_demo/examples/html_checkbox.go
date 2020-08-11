package main

import (
	"github.com/gin-gonic/gin"
	"net/http"
)
// 绑定 HTML 复选框 checkbox
type myForm struct {
	Colors []string `form:"colors[]"`
}

func main()  {
	r := gin.Default()
	r.LoadHTMLGlob("templates/**/*")
	r.GET("/colors", func(c *gin.Context) {
		c.HTML(http.StatusOK, "checkbox/color.tmpl", gin.H{
			"title": "Select Colors",
		})
	})
	r.POST("/colors", func(c *gin.Context) {
		var fakeForm myForm
		// ShouldBind 和 Bind 类似，不过会在出错时退出而不是返回400状态码
		c.ShouldBind(&fakeForm)
		c.JSON(200, gin.H{"color": fakeForm.Colors})
	})
	r.Run()
}