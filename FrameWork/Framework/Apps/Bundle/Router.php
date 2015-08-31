<?php
namespace Framework\Apps\Bundle;
use \Framework\Vendor\App\Routing;

class Router{
	
	
	public function __construct(){
		$routers = [
				'' => 'userController@login',
				
				'dev' => 'MainController@dev', // !!!Remove this line before publishing the app!!!
				
		];
		new Routing($routers);
		
		
	}
	
	
	
	
}