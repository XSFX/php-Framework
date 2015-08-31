<?php

namespace Framework\Vendor\App;

/*
 *  handle the incoming requests and pont them to ther controllers and methods
 */
class Routing {
	public $request;
	public $router;
	public function __construct($routing) {
		$this->router = $routing;
		$this->request = new Request ();
		$this->getControllerAndMethod($this->urlToString());
	}
	public function urlToString() {
		
		if (isset ( $this->request->urlElements)) {
			unset ( $this->request->urlElements[0] );
			
			$this->request->urlElements = array_values ( $this->request->urlElements );
		}
		
		
		

		
		
// 		print_r($this->request->urlElements);
		if (isset($this->request->urlElements)){
			return implode ( '/', $this->request->urlElements );
		}
		
	}
	
	public function getControllerAndMethod($arrayIndex){
		if(isset($this->router[$arrayIndex])){
			$methods = explode("@", $this->router[$arrayIndex]);
			 $nSpace =  "\Framework\Apps\Bundle\Controllers\\". $methods[0];
			 $controller =  new $nSpace();
// 			 var_dump($controller);
			 $controller->$methods[1]();
// 			 $this->router[$arrayIndex];
		}
		
		
		
	}
	
// 	public function urlVars(){
// 		// 		print_r($this->request->urlElements);
// 		foreach ($this->request->urlElements as $key => $element){
				
// 			if(substr($element,0,1) == '{' && substr($element,-1) == '}'){
// 				$elements[] = $element;
// 			}
				
// 		}
// 		return $elements;
// 	}
	
}