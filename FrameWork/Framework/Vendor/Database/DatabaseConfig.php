<?php
namespace Framework\Vendor\Database;


class DatabaseConfig{
	public $user  = "root";
	public $password = "pass";
	public $host = "localhost";
	public $database = "framework";
	public $connection;
	private static $init = 0;
	
	public function __construct(){
		
		if (self::$init !=0){
			
			return;
		}
		self::$init++;
		return $this->initConnection();
	}
	
	public  function initConnection(){
// 		echo "connection";
		 $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);
		 if (mysqli_connect_errno())
		 {
		 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
		 }
		 
		 
		
	}
	
	
}