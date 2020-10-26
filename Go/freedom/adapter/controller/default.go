//Package controller generated by 'freedom new-project freedom'
package controller

import (
	"freedom/domain"
	"freedom/infra"
	"github.com/8treenet/freedom"
)

func init() {
	freedom.Prepare(func(initiator freedom.Initiator) {
		initiator.BindController("/", &Default{})
	})
}

// Default .
type Default struct {
	Sev     *domain.Default
	Worker  freedom.Worker
	Request *infra.Request
}

//Get handles the GET: / route.
func (c *Default) Get() freedom.Result {
	c.Worker.Logger().Info("我是控制器")
	remote := c.Sev.RemoteInfo()
	return &infra.JSONResponse{Object: remote}
}

//GetHello handles the GET: /hello route.
func (c *Default) GetHello() string {
	field := freedom.LogFields{
		"framework": "freedom",
		"like":      "DDD",
	}
	c.Worker.Logger().Info("hello", field)
	c.Worker.Logger().Infof("hello %s", "format", field)
	c.Worker.Logger().Debug("hello", field)
	c.Worker.Logger().Debugf("hello %s", "format", field)
	c.Worker.Logger().Error("hello", field)
	c.Worker.Logger().Errorf("hello %s", "format", field)
	c.Worker.Logger().Warn("hello", field)
	c.Worker.Logger().Warnf("hello %s", "format", field)
	c.Worker.Logger().Print("hello")
	c.Worker.Logger().Println("hello")
	return "hello"
}

//PutHello handles the PUT: /hello route.
func (c *Default) PutHello() freedom.Result {
	return &infra.JSONResponse{Object: "putHello"}
}

// PostHello handles the POST: /hello route.
func (c *Default) PostHello() freedom.Result {
	var postJSONData struct {
		UserName     string `json:"userName" validate:"required"`
		UserPassword string `json:"userPassword" validate:"required"`
	}
	if err := c.Request.ReadJSON(&postJSONData); err != nil {
		return &infra.JSONResponse{Error: err}
	}

	return &infra.JSONResponse{Object: "postHello"}
}

// BeforeActivation .
func (c *Default) BeforeActivation(b freedom.BeforeActivation) {
	b.Handle("ANY", "/custom", "CustomHello")
	//b.Handle("GET", "/custom", "CustomHello")
	//b.Handle("PUT", "/custom", "CustomHello")
	//b.Handle("POST", "/custom", "CustomHello")
}

//CustomHello handles the POST: /hello route.
func (c *Default) CustomHello() freedom.Result {
	method := c.Worker.IrisContext().Request().Method
	c.Worker.Logger().Info("CustomHello", freedom.LogFields{"method": method})
	return &infra.JSONResponse{Object: method + "CustomHello"}
}

//GetUserBy handles the GET: /user/{username:string}?token=ftoken123&id=1&ip=192&ip=168&ip=1&ip=1 route.
func (c *Default) GetUserBy(username string) freedom.Result {
	var query struct {
		/*
			Equal
			c.Worker.IrisContext().URLParam("token")
			c.Worker.IrisContext().URLParamInt64("id")
		*/
		Token string  `url:"token" validate:"required"`
		ID    int64   `url:"id" validate:"required"`
		IP    []int64 `url:"ip"` //Support array parameters
	}
	if err := c.Request.ReadQuery(&query); err != nil {
		return &infra.JSONResponse{Error: err}
	}

	var data struct {
		Name  string
		Token string
		ID    int64
		IP    []int64
	}
	data.ID = query.ID
	data.Token = query.Token
	data.Name = username
	data.IP = query.IP
	return &infra.JSONResponse{Object: data}
}

//GetAgeByUserBy handles the GET: /age/{age:int}/user/{user:string} route.
func (c *Default) GetAgeByUserBy(age int, user string) freedom.Result {
	var result struct {
		User string
		Age  int
	}
	result.Age = age
	result.User = user

	return &infra.JSONResponse{Object: result}
}
