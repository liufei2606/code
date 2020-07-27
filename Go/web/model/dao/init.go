package dao

import "time"

var _DB *gorm.DB

func DB() *grom.DB {
	return _DB
}

func init() {
	_DB = initDB()
}

func initDB() *gorm.DB {
	db,err := gorm.Open("mysql", "go_web:go_web@tcp(localhost:33063)/g0_web?charset=utf8&parseTime=True&loc=Local")
	if err != nil {
		panic(err)
	}

	db.Db().setMaxOpenConns(100)
	db.Db().setMaxIdleConns(10)
	db.Db().setConnMaxLifetime(time.Second * 300)
	if err = db.DB().Ping();err != nil {
		panic(err)
	}
	return db
}