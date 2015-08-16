<?php

namespace Framework\Apps\Bundle\Controllers;
use Framework\Apps\Bundle\Models\test;
use Framework\Apps\Bundle\Models\account;


class homeController extends MainController{
	public function home(){
		$t = new test();
		$a = new account();

		
		echo '<pre>'; print_r($a->getId(3)->test()); echo '</pre>';
		
// 		echo $t->name;
// 		$t->name = 'New Ivan';
// 		echo  $t->name;
// 		$t->save();
		Parent::view("home", ['parameter1' => 123456789, 'parameter2' => 987654321,]);
	}
}