<?php

class Person  {
	public $name;
	public $age;
	public $sex;

	public function __construct($name = '', $age = 22, $sex = 'Male'){
		$this->name = $name;
		$this->age = $age;
		$this->sex = $sex;
	}

	public function say(){
		echo "Name：".$this->name.",Sex：".$this->sex.",Age：".$this->age . ";\n";
	}

	public function __call($funName, $arguments){
          echo "The function you called：" . $funName . "(parameter：" ;  // 输出不存在的方法的名称
          print_r($arguments); // 输出不存在的方法的参数列表
          echo ")does not exist!！<br>\n";
    }

	public function __destruct() {
		echo "Well, my name is ".$this->name . "\n";
	}
}

$person = new Person('John');
$person->say();
$person->run('teacher');
$person->eat('John', 'apple');
unset($person);
