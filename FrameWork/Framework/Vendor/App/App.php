<?php
/*
 * Initialise the framework
 *	Start the class loader
 */

namespace Framework\Vendor\App;
use Framework\Apps\Bundle\Router;
class App {
	
	public function  __construct(){
				
		
		$c = new Router;
	}
}