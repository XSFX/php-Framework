<?php

namespace Framework\Apps\Bundle\Controllers;


class homeController extends MainController{
	public function home(){
		Parent::view("home", ['parameter1' => 123456789, 'parameter2' => 987654321,]);
	}
}