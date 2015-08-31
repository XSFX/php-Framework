<?php

namespace Framework\Apps\Bundle\Controllers;
use Framework\Apps\Bundle\Models\test;
use Framework\Apps\Bundle\Models\account;
use Framework\Vendor\App\Redirect;
use Framework\Vendor\App\Auth\Auth;
class userController extends MainController{
	public function home(){
		
		$hash =	Auth::encrypt('password');
		var_dump(Auth::check('psssword',$hash));
		Parent::view("home" );
// 		Redirect::url('dev');
	}
	
	
	public function login(){
		Parent::view("AdminPanel/login",['parameter1' => 123456789, 'parameter2' => 987654321,]);
	}
}