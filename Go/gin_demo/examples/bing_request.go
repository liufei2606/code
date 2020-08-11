package main

import (
	"github.com/gin-gonic/gin"
	"github.com/gin-gonic/gin/binding"
	"net/http"
)

type formA struct {
	Foo string `json:"foo" xml:"foo" binding:"required"`
}

type formB struct {
	Bar string `json:"bar" xml:"bar" binding:"required"`
}

func SomeHandler(c *gin.Context) {
	objA := formA{}
	objB := formB{}
	// c.ShouldBind 使用 c.Request.Body 并且不能被复用
	if errA := c.ShouldBindBodyWith(&objA, binding.JSON); errA == nil {
		c.String(http.StatusOK, `the body should be formA`)
		// 这里总是会报错，因为 c.Request.Body 现在是 EOF
	} else if errB := c.ShouldBindBodyWith(&objB, binding.JSON); errB == nil {
		c.String(http.StatusOK, `the body should be formB`)
	} else {
		// 其他结构体
		c.String(http.StatusOK, `the body should be other form`)
	}
}

func main()  {
	r := gin.Default()
	r.POST("/bindBodyToStruct", SomeHandler)
	r.Run(":8080")
}