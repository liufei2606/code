package main

import (
	"database/sql"
	"fmt"
	"github.com/gofrs/uuid"
	"strings"
	"time"

	"github.com/jinzhu/gorm"
	_ "github.com/jinzhu/gorm/dialects/mysql"
	"github.com/spaolacci/murmur3"
)

type Test struct {
	Id  int
	Num int
}

type View struct {
	ID        int    `gorm:"primary_key"`
	Ip        string `gorm:"type:varchar(20);not null;index:ip_idx"`
	Ua        string `gorm:"type:varchar(256);not null;"`
	Title     string `gorm:"type:varchar(128);not null;index:title_idx"`
	Hash      uint64
	CreatedAt time.Time
}

type Like struct {
	ID        int    `gorm:"primary_key"`
	Ip        string `gorm:"type:varchar(20);not null;index:ip_idx"`
	Ua        string `gorm:"type:varchar(256);not null;"`
	Title     string `gorm:"type:varchar(128);not null;index:title_idx"`
	Hash      uint64 `gorm:"unique_index:hash_idx;"`
	CreatedAt time.Time
}

type Comment struct {
	ID        int    `gorm:"primary_key"`
	Ip        string `gorm:"type:varchar(20);not null;"`
	Ua        string `gorm:"type:varchar(256);not null;"`
	Title     string `gorm:"type:varchar(128);not null;index:title_idx"`
	Content   string `gorm:"type:varchar(1024);not null;"`
	Nickname  string `gorm:"type:varchar(64);"`
	Mail      string `gorm:"type:varchar(256);"`
	CreatedAt time.Time
}

type User struct {
	gorm.Model
	Name         string
	Age          *int `gorm:"default:18"`
	Birthday     *time.Time
	Email        string  `gorm:"type:varchar(100);unique_index"`
	Role         string  `gorm:"size:255"`        //设置字段的大小为255个字节
	//MemberNumber *string `gorm:"unique;not null;"` // 设置 memberNumber 字段唯一且不为空
	Num          int     `gorm:"AUTO_INCREMENT"`  // 设置 Num字段自增
	Address      string  `gorm:"index:addr"`      // 给Address 创建一个名字是  `addr`的索引
	IgnoreMe     int     `gorm:"-"`               //忽略这个字段
}

// 使用 scanner/valuer
//type User struct {
//	gorm.Model
//	Name string
//	Age  sql.NullInt64
//}

func (user *User) BeforeCreate(scope *gorm.Scope) error {
	scope.SetColumn("ID", uuid.NewGen())
	return nil
}

func createTables(db *gorm.DB) {
	db.CreateTable(&Test{})
}

func main() {
	db, err := gorm.Open("mysql", "root:4268@(localhost:3306)/world?charset=utf8&parseTime=True&loc=Local")
	if err == nil {
		fmt.Println("open db sucess")
	} else {
		fmt.Println("open db error ", err)
		return
	}

	if !db.HasTable(&User{}) {
		if err := db.Set("gorm:table_options", "ENGINE=InnoDB DEFAULT CHARSET=utf8").CreateTable(&User{}).Error; err != nil {
			panic(err)
		}
	}
	if !db.HasTable("tests") {
		createTables(db)
	}

	if !db.HasTable(&View{}) {
		if err := db.Set("gorm:table_options", "ENGINE=InnoDB DEFAULT CHARSET=utf8").CreateTable(&View{}).Error; err != nil {
			panic(err)
		}
	}
	if !db.HasTable(&Like{}) {
		if err := db.Set("gorm:table_options", "ENGINE=InnoDB DEFAULT CHARSET=utf8").CreateTable(&Like{}).Error; err != nil {
			panic(err)
		}
	}
	if !db.HasTable(&Comment{}) {
		if err := db.Set("gorm:table_options", "ENGINE=InnoDB DEFAULT CHARSET=utf8").CreateTable(&Comment{}).Error; err != nil {
			panic(err)
		}
	}
	//插入数据
	test := Test{Num: 123456}
	db.Create(&test)

	like := Like{Ip: "192.168.183.103", Ua: "ua", Title: "title", Hash: murmur3.Sum64([]byte(strings.Join([]string{"192.168.183.103", "ua", "title"}, "-"))) >> 1, CreatedAt: time.Now()}
	db.Create(&like)

	//查询
	result1 := db.First(&like)
	fmt.Println(result1)

	user := User{Name: "Jinzhu"}
	db.NewRecord(user) // => 返回 `true` ，因为主键为空
	db.Create(&user)
	db.NewRecord(user) // => 在 `user` 之后创建返回 `false`

	db.First(&user)
	db.Take(&user)
	db.Last(&user)
	//db.Find(&users)
	db.First(&user, 10)
	db.Where("name = ?", "jinzhu").First(&user)
	db.Where("name in (?)", []string{"jinzhu", "jinzhu 2"}).Find(&user)
	db.Where("name LIKE ?", "%jin%").Find(&user)
	db.Where("name = ? AND age >= ?", "jinzhu", "22").Find(&user)
	db.Where("updated_at > ?", lastWeek).Find(&user)
	db.Where("created_at BETWEEN ? AND ?", lastWeek, today).Find(&user)
	// 通过 struct 进行查询的时候，GORM 将会查询这些字段的非零值,段包含 0， ''， false 或者其他 零值 , 将不会出现在查询语句中
	db.Where(&User{Name: "jinzhu", Age: 20}).First(&user)
	db.Where(map[string]interface{}{"name": "jinzhu", "age": 20}).Find(&user)
	db.Where([]int64{20, 21, 22}).Find(&user)
	db.Not("name", "jinzhu").First(&user)
	db.Not("name", []string{"jinzhu", "jinzhu 2"}).Find(&users)
	//不在主键 slice 中
	db.Not([]int64{1,2,3}).First(&user)
	db.Not([]int64{}).First(&user)
	db.Where("role = ?", "admin").Or("role = ?", "super_admin").Find(&users)



	defer db.Close()
}
