<?php

namespace Framework\Apps\Bundle\Controllers;
use Framework\Vendor\App\Requests;
use Framework\Vendor\App\Call;
use Framework\Vendor\App\Auth\Auth;
use Framework\Apps\Bundle\Authorizations\Authorizations;

class MainController {
// 	protected static $call;
	protected $request;
	
	public function __construct(){
		$this->request = new Requests();
		
	}
	public static function view($name, $parameters = null){
		
		Call::view($name, $parameters);
	}
	public function dev(){
// 		echo 'dev';
		Authorizations::havePermition(false);
		self::view('AdminPanel/index');
	}
	
}