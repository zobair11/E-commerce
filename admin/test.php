<?php

// instance 
// inheritance


class myClass {
	public function show () {
		echo 'hello world';
	}
}

$object = new myClass;

class otherClass extends myClass {
	public function show2 () {
		parent::show();
	}
}

$object2 = new otherClass;