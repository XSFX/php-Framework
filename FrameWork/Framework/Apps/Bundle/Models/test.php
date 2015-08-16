<?php

namespace Framework\Apps\Bundle\Models;
use Framework\Vendor\Database\Database;

class test extends Database{
	
	public $id;
	
	public $text;
	
	public $name;
	
	public function accounts(){
		return $this->hasMany('account');
	}
	
}