package main

import "fmt"

type Animal struct {
	name string
}

func (a Animal) Call() string {
	return "animal's call"
}

func (a Animal) Favriate() string {
	return "animal's Favriate"
}

func (a Animal) GetName() string {
	return a.name
}

type Dog struct {
	inhabit string
	Animal
}

func (d Dog) Favriate() string {
	return "bone"
}

func (d Dog) Call() string {
	return "Wang wang ..."
}

type Puppy struct {
	Dog
	*Animal
}

func main() {
	animal := Animal{"狗"}
	dog := Dog{"Euporean", animal}
	fmt.Println(dog.GetName(), "的叫声是", dog.Call(), "，最爱是", dog.Favriate())

	// 多重继承有重复方法时：直接调用会报错，使用时用声明该方法的类调用
	puppy := Puppy{dog, &animal}
	fmt.Println(puppy.Dog.Animal.GetName(), "的叫声是", animal.Call(), "，最爱是", dog.Favriate())
}
