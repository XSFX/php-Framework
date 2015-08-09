<?php

namespace Framework\Apps\Bundle\Controllers;
use Framework\Apps\Bundle\Models\test;


class homeController extends MainController{
	public function home(){
		$t = new test();
		$t->name = "ivan";
		$t->text = "hi";
		$t->getId(1);
		$t->name = "Pesho";
		
		$t->save();
		Parent::view("home", ['parameter1' => 123456789, 'parameter2' => 987654321,]);
	}
}