<?php
class Calculator {

	private $data;
	private $data2;

	public function __construct ($data, $data2) {
		echo "The result of $data and $data2 is following : <br/><br/>";
		$this->data = $data;
		$this->data2 = $data2;
	}
	public function addition () {
		return $this->data + $this->data2;
	}

	public function subtract () {
		return $this->data - $this->data2;
	}

	public function divided () {
		return $this->data / $this->data2;
	}

	public function multiple () {
		return $this->data * $this->data2;
	}
}

$object = new Calculator(52, 23);
echo "Addition: <br/>";
$add = $object->addition();
echo $add;

echo "<hr/>";
echo "Substruct: <br/>";
$substruct = $object->subtract();
echo $substruct;

echo "<hr/>";
echo "Divided: <br/>";
$substruct = $object->divided();
echo $substruct;

echo "<hr/>";
echo "Multiple: <br/>";
$substruct = $object->multiple();
echo $substruct;