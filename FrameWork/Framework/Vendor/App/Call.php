<?php
namespace Framework\Vendor\App;
class Call {
	
	
	public function __contruct(){
		
	}
	
	public  function view($name , $parameters = null){
		$viewDir =  realpath(__dir__.'/../../Apps/Bundle/Views');
		include $viewDir.'/'.$name."View.php";
	}
	
	
}