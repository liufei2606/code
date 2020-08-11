package main

import (
	"log"
	"net/http"

	"github.com/gin-gonic/gin"
)

type Person1 struct {
	Name    string `form:"name"`
	Address string `form:"address"`
}

func main() {
	route := gin.Default()
	route.Any("/testing", startPage1)

	// 查询字符串参数使用已存在的底层请求对象进行解析
	// 示例请求 URL:  /welcome?firstname=Jane&lastname=Doe
	router.GET("/welcome", func(c *gin.Context) {
		firstname := c.DefaultQuery("firstname", "Guest")
		lastname := c.Query("lastname") // 底层调用的是 c.Request.URL.Query().Get("lastname")

		c.String(http.StatusOK, "Hello %s %s", firstname, lastname)
	})

	route.Run(":8085")
}

func startPage1(c *gin.Context) {
	var person Person1
	if c.ShouldBindQuery(&person) == nil {
		log.Println("====== Only Bind By Query String ======")
		log.Println(person.Name)
		log.Println(person.Address)
	}
	c.String(200, "Success")
}