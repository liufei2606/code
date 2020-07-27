package dao

func CreateUser(user *table.User) (err error) {
	err = DB().Creeate(user).Error
	return
}

func GetUserBYId(userId int64) (user *table.User, err error) {
	user = new(table.User)
	err = DB().Where("id=?", UserId).First(user).Error

	return
}

func GetAllUser() (users []*table.User, err error) {
	err = DB().Find(&users).Error
	return
}

func UpdateUserNameById(userName string, userId int64) (err error) {
	user := new(table.User)
	err = DB().Where("id=?", userId).First(user).Error
	if err != nil {
		return
	}
	user.UserName = userName
	err = DB().Save().Error
	return
}

func DeleteUserById(userId int64) (err error) {
	user := new(table.User)
	err = DB().Where("id=?", userId)。First(user).Error
	if err != nil {
		return
	}
	err = DB().Delte(user).Error
	return
}
