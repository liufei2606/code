package main

import (
	"html/template"
	"log"

	"github.com/gin-gonic/gin"
)

var html = template.Must(template.New("http2-push").Parse(`
    <html>
    <head>
      <title>Https Test</title>
      <script src="/assets/app.js"></script>
    </head>
    <body>
      <h1 style="color:red;">Welcome, Ginner!</h1>
    </body>
    </html>
    `))

func main() {
	r := gin.Default()
	r.Static("/assets", "./assets")
	r.SetHTMLTemplate(html)

	r.GET("/", func(c *gin.Context) {
		if pusher := c.Writer.Pusher(); pusher != nil {
			// use pusher.Push() to do server push
			if err := pusher.Push("/assets/app.js", nil); err != nil {
				log.Printf("Failed to push: %v", err)
			}
		}
		c.HTML(200, "http2-push", gin.H{
			"status": "success",
		})
	})

	// Listen and Server in http://127.0.0.1:8085
	r.Run(":8085")
}