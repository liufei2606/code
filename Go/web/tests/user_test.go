package tests

import (
	"reflect"
	"testing"
)

func TestCreateUser(t *testing.T) {
	type args struct {
		user *table.User
	}
	tests := []struct {
		name    string
		args    args
		wantErr bool
	}{
		// TODO: Add test cases.
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			if err := CreateUser(tt.args.user); (err != nil) != tt.wantErr {
				t.Errorf("CreateUser() error = %v, wantErr %v", err, tt.wantErr)
			}
		})
	}
}

func TestDeleteUserById(t *testing.T) {
	type args struct {
		userId int64
	}
	tests := []struct {
		name    string
		args    args
		wantErr bool
	}{
		// TODO: Add test cases.
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			if err := DeleteUserById(tt.args.userId); (err != nil) != tt.wantErr {
				t.Errorf("DeleteUserById() error = %v, wantErr %v", err, tt.wantErr)
			}
		})
	}
}

func TestGetAllUser(t *testing.T) {
	var tests []struct {
		name      string
		wantUsers []*table.User
		wantErr   bool
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			gotUsers, err := GetAllUser()
			if (err != nil) != tt.wantErr {
				t.Errorf("GetAllUser() error = %v, wantErr %v", err, tt.wantErr)
				return
			}
			if !reflect.DeepEqual(gotUsers, tt.wantUsers) {
				t.Errorf("GetAllUser() gotUsers = %v, want %v", gotUsers, tt.wantUsers)
			}
		})
	}
}

func TestGetUserBYId(t *testing.T) {
	type args struct {
		userId int64
	}
	tests := []struct {
		name     string
		args     args
		wantUser *table.User
		wantErr  bool
	}{
		// TODO: Add test cases.
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			gotUser, err := GetUserBYId(tt.args.userId)
			if (err != nil) != tt.wantErr {
				t.Errorf("GetUserBYId() error = %v, wantErr %v", err, tt.wantErr)
				return
			}
			if !reflect.DeepEqual(gotUser, tt.wantUser) {
				t.Errorf("GetUserBYId() gotUser = %v, want %v", gotUser, tt.wantUser)
			}
		})
	}
}

func TestUpdateUserNameById(t *testing.T) {
	type args struct {
		userName string
		userId   int64
	}
	tests := []struct {
		name    string
		args    args
		wantErr bool
	}{
		// TODO: Add test cases.
	}
	for _, tt := range tests {
		t.Run(tt.name, func(t *testing.T) {
			if err := UpdateUserNameById(tt.args.userName, tt.args.userId); (err != nil) != tt.wantErr {
				t.Errorf("UpdateUserNameById() error = %v, wantErr %v", err, tt.wantErr)
			}
		})
	}
}