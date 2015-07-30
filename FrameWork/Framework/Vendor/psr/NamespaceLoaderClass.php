<?php



class NamespaceLoaderClass {
    public static function autoload($class){
	//$pre = __DIR__ ."/";
	$homeDir = realpath(__DIR__.'/../../../');
	$class = $homeDir.'/'. str_replace('\\', '/', $class).".php";
// 	var_dump($start_dir);
	if (is_readable($class))
		
	    include ($class);
	}
	
	
	public static function  getAutoload() {
		spl_autoload_register(array('NamespaceLoaderClass', 'autoload'),false, true);
	}
}

