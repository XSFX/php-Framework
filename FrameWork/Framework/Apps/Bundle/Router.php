<?php
namespace Framework\Apps\Bundle;
use \Framework\Vendor\App\Routing;

class Router{
	
	
	public function __construct(){
		$routers = [
				'home' => 'homeController@home',
				'notHome/new/url' => 'notHomeController@notHome'
		];
		new Routing($routers);
		
		
	}
	
	
	
	
}