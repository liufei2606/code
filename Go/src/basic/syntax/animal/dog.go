package animal

type Dog struct {
	inhabit string
	*Animal
}

func (d Dog) Favriate() string {
	return "bone"
}

func (d Dog) Call() string {
	return "Wang wang ..."
}
