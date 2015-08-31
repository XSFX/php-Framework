<?php
/*
 * Handling the request so to have prety urls.
 */
namespace Framework\Vendor\App;

class Request {
	public $urlElements;
	public $verb;
	public $parameters;
	
	public function __construct(){
		$this->verb = $_SERVER['REQUEST_METHOD'];
		if(isset($_SERVER['PATH_INFO'])){
			$this->urlElements = explode('/', $_SERVER['PATH_INFO']);
		}
		$this->parseIncomingParams();
		$this->format = 'json';
		if(isset($this->parameters['format'])){
			$this->format = $this->parameters['format'];
		}
		return true;
	}
	
	public function parseIncomingParams() {
		$parameters = array();
		
		if(isset($_SERVER['QUERY_STRING'])){
			parse_str($_SERVER['QUERY_STRING'], $parameters);
		}
		
		$body = file_get_contents('php://input');
		$contentType = false;
		if(isset($_SERVER['CONTENT_TYPE'])){
			$contentType = $_SERVER['CONTENT_TYPE'];
		}
		switch ($contentType){
			case "application/json":
				$bodyParams = json_decode($body);
				if($bodyParams){
					foreach ($bodyParams as $paramName => $paramValue ){
						$parameters[$paramName] = $paramValue;
					}
				}
				$this->format = 'json';
				break;
			case "application/x-www-form-urlencoded":
				parse_str($body, $postVars);
				foreach ($postVars as $field => $value){
					$parameters[$field] = $value;
				}
				$this->format = 'html';
				break;
			default:
				break;
				
		}
		$this->parameters = $parameters;
	}
}