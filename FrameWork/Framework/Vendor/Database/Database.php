<?php

namespace Framework\Vendor\Database;

use Framework\Vendor\Database\DatabaseConfig;
use Framework\Vendor\Database\QueryBuilder;

class Database {
	private $mysqli;
	private $columns;
	private $table;
	private $builder;
	private $connection;
	private $doesExist = false;
	public function __construct() {
		$this->mysqli = new DatabaseConfig ();
		$this->connection = DatabaseConfig::$connection;
		// var_dump($this->connection);
	}
	private function fetchAll() {
		$q = $this->builder->select ( $this->table )->query;
		$result = $this->result ( $q );
		$arr = array ();
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			$arr [] = $row;
		}
		foreach ( $this->columns as $c => $d ) {
			$this->$c = array ();
		}
		foreach ( $arr as $r ) {
			foreach ( $r as $col => $data ) {
				
				array_push ( $this->$col, $data );
			}
		}
		$this->doesExist = true;
		return $arr;
	}
	private function getId($id) {
		$q = $this->builder->select ( $this->table )->where ( 'id', '=', $id [0] )->query;
		
		$result = $this->result ( $q );
		
		$row = mysqli_fetch_assoc ( $result );
		foreach ( $row as $col => $data ) {
			$this->$col = $data;
		}
		$this->doesExist = true;
		return $this;
	}
	private function save() {
		if ($this->doesExist === false) {
			if (array_key_exists ( 'id', $this->columns )) {
				unset ( $this->columns ['id'] );
			}
			
			$q = $this->builder->insert ( $this->table, $this->columns )->query;
			
			$this->result ( $q );
		} else {
			if (array_key_exists ( 'id', $this->columns )) {
				$col = $this->columns;
				if (array_key_exists ( 'id', $col )) {
					unset ( $col ['id'] );
				}
				// print_r($col);
				$q = $this->builder->update ( $this->table, $col )->where ( 'id', '=', $this->columns ['id'] )->query;
				$this->result ( $q );
			}
		}
	}
	public function __call($method, $arguments) {
		$this->columns = get_object_vars ( $this );
		$this->table = explode ( '\\', get_class ( $this ) );
		$this->table = $this->table [count ( $this->table ) - 1];
		$this->builder = new QueryBuilder ( $this->table );
		unset ( $this->columns ['connection'] );
		unset ( $this->columns ['columns'] );
		unset ( $this->columns ['table'] );
		unset ( $this->columns ['mysqli'] );
		unset ( $this->columns ['builder'] );
		unset ( $this->columns ['doesExist'] );
		
		return $this->$method ( $arguments );
	}
	private function result($query) {
		return mysqli_query ( $this->connection, $query );
	}
	/*
	 * hasOne expects 2 arguments:
	 * first: foreign table;
	 * second: local reference column. (optional)
	 *
	 */
	private function hasOne($args){
	if(!isset($args[1])){
			$args[1] = $args[0].'_id';
	}
// 	 $met = $args[1];
	
	 
	$foreignTable = $this->builder->select($args[0])->where('id','=',$this->$args[1])->query;
	$result = $this->result($foreignTable);
	return mysqli_fetch_assoc($result);
	}
	/*
	 * hasMany expects 2 arguments:
	 * first: foreign table;
	 * second: foreign reference column. (optional)
	 * 
	 */
	private function hasMany($args){
		if(!isset($args[1])){
			$args[1] = $this->table.'_id';
		}
		$foreignTable = $this->builder->select($args[0])->where($args[1],'=',$this->id)->query;
		$result = $this->result($foreignTable);
		while($row = mysqli_fetch_assoc($result)){
			$array[] = $row; 
		}
		return $array;
	}
	private function belongsToMany($args) {
		$pivotTable = $this->builder->select ( $this->table . '_' . $args [0] )->where ( $this->table . '_id', '=', $this->columns ['id'] )->query;
		$result = $this->result ( $pivotTable );
		$relation_result = array ();
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			$this->builder->query = null;
			$foreignTable = $this->builder->select ( $args [0] )->where ( 'id', '=', $row [$args [0] . '_id'] )->query;
			$result2 = $this->result ( $foreignTable );
			while ( $row2 = mysqli_fetch_assoc ( $result2 ) ) {
				$relation_result [] = $row2;
			}
		}
		foreach ( $relation_result as $key => $val ) {
			$array [$val ['id']] = $val;
		}
		
		return $array;
	}
}