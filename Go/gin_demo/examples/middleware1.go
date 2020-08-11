package main

import "github.com/gin-gonic/gin"

func main() {
	// 创建一个默认不使用任何中间件的路由器
	r := gin.New()

	// 设置全局中间件
	// Logger 中间件会记录日志到 gin.DefaultWriter，即使你设置了 GIN_MODE=release 这个环境变量
	// 默认情况下 gin.DefaultWriter = os.Stdout（控制台标准输出）
	r.Use(gin.Logger())

	// Recovery 中间件会从任意 panics 中恢复并且返回 500 响应（服务端错误）
	r.Use(gin.Recovery())

	// 设置路由中间件
	// 路由中间件可以被添加到指定路由上，并且不限数量
	r.GET("/benchmark", MyBenchLogger(), benchEndpoint)

	// 为指定路由分组设置中间件
	// 认证组
	// authorized := r.Group("/", AuthRequired())
	// 上面这行代码等同于下面下的代码:
	authorized := r.Group("/")
	// 下面为 `/` 前缀的路由分组设置中间件 AuthRequired，表示该分组下的路由用户认证后才能访问
	authorized.Use(AuthRequired())
	{
		authorized.POST("/login", loginEndpoint)
		authorized.POST("/submit", submitEndpoint)
		authorized.POST("/read", readEndpoint)

		// 嵌套分组
		testing := authorized.Group("testing")
		testing.GET("/analytics", analyticsEndpoint)
	}

	// Listen and serve on 0.0.0.0:8080
	r.Run(":8080")
}
