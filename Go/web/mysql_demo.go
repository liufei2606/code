package main

import (
	"database/sql"
	"log"
	"time"
)

func MysqlDemoCode() {
	db ,err := sql.Open("mysql", "go_web@go_web@tcp(127.0.0.1:3306)/go_web")
	if err != nil {
		log.Fatal(err)
	}
	defer db.Close()
	if err := db.Ping(); err != nil {
		log.Fatal(err)
	}

	query := `
	create table users (
		id int AUTO_INCREMENT,
		username TEXT NOT NULL,
		password TEXT NOT NULL,
		created_at DATE_TIME,
		PRIMARY KEY(id)
	);`
	_,err = db.Exec(query)

	user := "Henry"
	password := "password"
	created_at := time.Now()
	res, err := db.Exec(`ISERT Into users (user, password, created_at) values (?,?,?)` ,user, password, created_at)
	userId, err = res.LastInsertId()

	type userS struct {
		id int
		username string
		password string
		createdAt time.Time
	}
	var u userS
	query = `SELECT id, username, password, created_at FROM users WHERE id = ?`
	err = db.Exec(query, 1).Scan(&u.id, &u.username, &u.password, &u.createdAt)

	rows,err := db.Query(`SELECT id, username, password, created_at FROM users `)
	db.Close()

	var users []userS
	for rows.Next() {
		var u userS
		err = rows.Scan(&u.id, &u.username, &u.password, &u.createdAt)
		users  = append(users, u)
	}
	err = rows.Err()

	res, err =  db.Exec(`DELETE FROM users where id =? , 1`)
}

func main() {


}