<?php

namespace Framework\Vendor\App;

class Requests extends Request{
	public function getAll(){
		return $this->parameters;
	}
	public function getField($field){
		return $this->parameters[$field];
	}
}