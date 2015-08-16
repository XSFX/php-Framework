<?php

namespace Framework\Apps\Bundle\Models;
use Framework\Vendor\Database\Database;

class account extends Database{
	public $id;

	public $name;
	
	public $password;
	
	public $test_id;
	
	public function tests(){
		return $this->belongsToMany('test');
	}
	
	public function test(){
		return $this->hasOne('test');
	}
}