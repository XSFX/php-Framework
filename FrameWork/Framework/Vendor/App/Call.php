<?php
namespace Framework\Vendor\App;
class Call {
// 	public $vars = 1;
	
	public function __contruct(){
		
	}
	
	public static  function view($name , $vars = null){
		$viewDir =  realpath(__dir__.'/../../Apps/Bundle/Views');
		include $viewDir.'/'.$name."View.php";
	}
	
	public static function assets($name){
		$assetDir = realpath(__DIR__.'/../../public/Assets');
		echo   $assetDir.'/'.$name;
	}
	
	
	
}