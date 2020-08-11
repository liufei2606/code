package main

import (
	"github.com/gin-gonic/gin"
	"net/http"
)

func getting(c *gin.Context)  {
	c.String(http.StatusOK, "HTTP GET Method")
}

func posting(c *gin.Context)  {
	c.String(http.StatusOK, "HTTP POST Method")
}

func putting(c *gin.Context)  {
	c.String(http.StatusOK, "HTTP PUT Method")
}

func deleting(c *gin.Context)  {
	c.String(http.StatusOK, "HTTP DELETE Method")
}

func patching(c *gin.Context)  {
	c.String(http.StatusOK, "HTTP PATCH Method")
}

func head(c *gin.Context)  {
	c.String(http.StatusOK, "HTTP HEAD Method")
}

func options(c *gin.Context)  {
	c.String(http.StatusOK, "HTTP OPTIONS Method")
}

func main() {
	// Creates a gin router with default middleware:
	// logger and recovery (crash-free) middleware
	router := gin.Default()

	router.GET("/get", getting)
	router.POST("/post", posting)
	router.PUT("/put", putting)
	router.DELETE("/delete", deleting)
	router.PATCH("/patch", patching)
	router.HEAD("/head", head)
	router.OPTIONS("/options", options)

	// By default it serves on :8080 unless a
	// PORT environment variable was defined.
	router.Run(":8088")
}
