<?php

namespace Framework\Apps\Bundle\Controllers;
use Framework\Apps\Bundle\Models\test;


class homeController extends MainController{
	public function home(){
		$t = new test();
		
		$t->getId(1);
		echo $t->name;
		$t->name = 'New Ivan';
		echo  $t->name;
		$t->save();
		Parent::view("home", ['parameter1' => 123456789, 'parameter2' => 987654321,]);
	}
}