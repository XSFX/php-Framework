<?php

/*
 * This class loads all the other classes utilising the namespaces set the same as directories; 
 */

class NamespaceLoaderClass {
    public static function autoload($class){
	//$pre = __DIR__ ."/";
	$homeDir = realpath(__DIR__.'/../../../');
	$class = $homeDir.'/'. str_replace('\\', '/', $class).".php";
//  	var_dump($class);
	if (is_readable($class))
// 		var_dump($class);
	    include ($class);
	}
	public static function  getAutoload() {
		spl_autoload_register(array('NamespaceLoaderClass', 'autoload'),false, true);
	}
}

