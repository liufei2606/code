package oop

type Integer int

func (a Integer) Equal(i Integer) bool {
	return a == i
}

func (a Integer) LessThan(i Integer) bool {
	return a < i
}

func (a Integer) MoreThan(i Integer) bool {
	return a > i
}

func (a *Integer) Increase(i Integer) {
	*a = *a + i
}

func (a *Integer) Decrease(i Integer) {
	*a = *a - i
}
