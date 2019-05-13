<?php


class Myclass
{
	private $firstName;
	private $secondField;

	public function __get($porperty)
	{
		if (property_exists($this, $porperty)) {
			return $this->$porperty;
		}
	}

	public function __set($property, $value)
	{
		if (property_exists($this, $property)) {
			$this->$property = $value;
		}

		return $this;
	}
}

$instance = new MyClass();
$instance->firstName = 'Henry ';
$instance->secondField = 'Lee';

echo $instance->firstName . $instance->secondField;
