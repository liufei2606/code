package oop

type IntNumber interface {
	Equal(i Integer) bool
	LessThan(i Integer) bool
	MoreThan(i Integer) bool
	Increase(i Integer)
	Decrease(i Integer)
}
