<?php

namespace Framework\Apps\Bundle\Controllers;
use Framework\Vendor\App\Requests;
use Framework\Vendor\App\Call;
class MainController {
// 	protected static $call;
	protected $request; 
	
	public function __construct(){
		$this->request = new Requests();
		
	}
	public static function view($name, $parameters = null){
		$call = new Call();
		$call->view($name, $parameters);
	}
	
}