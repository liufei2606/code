## gin

* 在中间件或处理器中开启新的协程时，不应该在其中使用原生的上下文对象，而应该使用它的只读副本
* 模型绑定将请求数据绑定到类型:所有需要绑定的字段上设置相应的绑定标签
    - Must Bind
        + 方法：Bind, BindJSON, BindXML, BindQuery, BindYAML
        + 行为：这些方法会调用底层的 MustBindWith 方法，如果出现绑定错误，会通过 c.AbortWithError(400, err).SetType(ErrorTypeBind) 退出请求，如果你想要对该行为有更多的控制，请使用下面 Should Bind 这套方案
    - Should Bind
        + 方法：ShouldBind, ShouldBindJSON, ShouldBindXML, ShouldBindQuery, ShouldBindYAML
        + 行为：这些方法会调用底层的 ShouldBindWith 方法，如果出现绑定错误，需要开发者自己来处理

```shell script
# 初始化：路由功能 auth 获取参数
go mod init gin_demo/basic
go get -u github.com/gin-gonic/gin
curl https://raw.githubusercontent.com/gin-gonic/examples/master/basic/main.go > main.go
go run main.go

curl http://localhost:8080/ping
curl http://localhost:8080/user/foo
curl -X POST -H "Content-Type:application/json" -d '{"user":"foo","value":"1"}' foo:bar@localhost:8080/admin

# 返回json
go mod init gin-demo/examples
go mod tidy
go run asciijson.go
curl http://localhost:8080/asciiJSON

# 表单参数绑定
curl http://localhost:8080/getb?field_a=AAA&field_b=BBB
curl http://localhost:8080/getc?field_a=AAA&field_c=CCCC
curl http://localhost:8080/getd?field_x=AAA&field_d=DDDDD

# 绑定 checkbox
go run html_checkbox.go
# GET|POST http://localhost:8080/colors 
curl -X POST "Content-Type: application/x-www-form-urlencoded"  -d 'colors[]=red' -d 'colors[]=green' localhost:8080/colors

# 绑定查询字符串或 POST 数据
go run request_data.go
curl -X GET "localhost:8085/testing?name=henry&address=xadfg&birthday=1993-03-23"
curl -X POST "localhost:8085/testing"  -d "name=henry&address=xadfg&birthday=1993-03-23"

# 绑定 URL 路由参数
go run url_params.go
curl -v localhost:8088/henry/28346019-489b-48bd-97b4-b19a85f09937

# 使用 HTML 模板构建二进制文件
go get github.com/jessevdk/go-assets-builder
go-assets-builder templates/html -o assets.go
go build -o assets-in-binary assets.go template.go
./assets-in-binary
http localhost:8080

# 控制日志输出颜色
go run log_color.go
http localhost:8080/ping

# 自定义 HTTP 服务器配置

# 自定义日志格式
go run log_custom.go
http localhost:8080/ping

# 自定义中间件
go run middleware.go
http localhost:8080/test

# 自定义表单验证器
go run validator.go
http "localhost:8085/bookable?check_in=2020-09-09&check_out=2020-09-10"

# 定义路由日志格式
go run route_log.go
http localhost:8080/status
http localhost:8080/bar

# 中间件中使用协程的注意事项
go run goroutine.go
http localhost:8080/long_sync
http localhost:8080/long_async

# 路由分组
go run route_groups.go
http -f POST localhost:8080/v1/login
http -f POST localhost:8080/v2/submit

# 日志信息写入文件
go run log_file.go
http localhost:8080/ping

# HTML 视图模板渲染
go run html.go
http localhost:8080/index

# 多目录
go run htmls.go
http localhost:8080/home/index
http localhost:8080/posts/index
http localhost:8080/users/index

# 自定义模板引擎
go run html_custom.go
http localhost:8080/raw

# 实现 HTTP/2 服务器推送
go run http2_pusher.go
# http://localhost:8085

# 优雅重启
go run grace_shutdown.go

# 字典格式的查询字符串和表单请求数据
go run query_param.go
curl --location --request POST 'localhost:8080/post?ids[a]=234234&ids[b]=fdgsgfd' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'names[first]=Henry' \
--data-urlencode 'names[last]=Lee'

# 模型绑定和验证
go run model_binding.go
curl -X POST -H "Content-Type: application/json"  http://localhost:8080/loginJSON -d '{"user":"xueyuanjun","password":"123456"}'
curl -X POST -H "Content-Type: application/x-www-form-urlencoded" localhost:8080/loginForm -d 'user=xueyuanjun&password=123456' 
#curl -X POST "Content-Type: application/x-www-form-urlencoded"  -d 'colors[]=red' -d 'colors[]=green' localhost:8080/loginXML

# Multipart/Urlencoded 绑定和数据解析
go run form_bind.go
curl -v --form user=xueyuanjun --form password=123456 http://localhost:8080/login

# 只绑定查询字符串
go run query_string.go
http 'localhost:8085/testing?name=henry&address=Newyork'

# URL 路径中的参数
go run url_param.go
http localhost:8080/user/henry/run

# PureJSON
curl localhost:8080/json
curl localhost:8080/purejson

# 获取查询字符串以及 POST 表单请求数据
go run query_form_body.go
curl -X POST 'localhost:8080/post?id=345465' \
-d 'page=4&name=henry&message=welcome_the_world'

# 重定向
go run redirect.go
http  -v localhost:8080/test
http  -v localhost:8080/test1

# 运行多个服务器
go run multi_service.go 
http localhost:8080

# SecureJSON 可以防止 JSON 劫持,默认会添加 "while(1)," 前缀到响应实体
go run securejson.go
http localhost:8080/someJSON

# 下载文件
go run download_file.go
# localhost:8080/dataFromReader
```