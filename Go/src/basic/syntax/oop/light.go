package oop

// 申明结构体
type Light struct {
	Status string
}

//添加方法
func (l Light) On() string {
	l.Status = "light is on"
	return l.Status
}
func (l Light) Off() string {
	l.Status = "light is off"
	return l.Status
}

////switch v := i.(type) {
////}
//
