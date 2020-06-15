package main

import (
	"database/sql"
	"github.com/jinzhu/gorm"
	_ "github.com/jinzhu/gorm/dialects/sqlite"
	"time"
)

type Model struct {
	ID        uint `gorm:"primary_key"`
	CreatedAt time.Time
	UpdatedAt time.Time
	DeletedAt *time.Time
}

type Product struct {
	gorm.Model
	Code  string
	Price uint
}

type User struct {
	gorm.Model
	Name         string
	Age          sql.NullInt64
	Birthday     *time.Time
	Email        string  `gorm:"type:varchar(100);unique_index"`
	Role         string  `gorm:"size:255"`        //设置字段的大小为255个字节
	MemberNumber *string `gorm:"unique;not null"` // 设置 memberNumber 字段唯一且不为空
	Num          int     `gorm:"AUTO_INCREMENT"`  // 设置 Num字段自增
	Address      string  `gorm:"index:addr"`      // 给Address 创建一个名字是  `addr`的索引
	IgnoreMe     int     `gorm:"-"`               //忽略这个字段
}

func (User) TableName() string {
	return "profiles"
}
func (u User) TableName() string {
	if u.Role == "admin" {
		return "admin_users"
	} else {
		return "users"
	}
}

func main() {
	db, err := gorm.Open("sqlite3", "test.db")
	if err != nil {
		panic("failed to connect database")
	}
	defer db.Close()

	//自动检查 Product 结构是否变化，变化则进行迁移
	db.AutoMigrate(&Product{})

	// 增
	db.Create(&Product{Code: "L1212", Price: 1000})

	// 查
	var product Product
	db.First(&product, 1)                   // 找到id为1的产品
	db.First(&product, "code = ?", "L1212") // 找出 code 为 l1212 的产品

	// 改 - 更新产品的价格为 2000
	db.Model(&product).Update("Price", 2000)

	// 删 - 删除产品
	//db.Delete(&product)

	// 用 `User` 结构体创建 `delete_users` 表
	db.Table("deleted_users").CreateTable(&User{})

	var deleted_users []User
	db.Table("deleted_users").Find(&deleted_users)
	//// SELECT * FROM deleted_users;

	db.Table("deleted_users").Where("name = ?", "jinzhu").Delete()
	//// DELETE FROM deleted_users WHERE name = 'jinzhu';
}
