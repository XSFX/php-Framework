<?php

namespace Framework\Vendor\Database;

use Framework\Vendor\Database\DatabaseConfig;
use Framework\Vendor\Database\QueryBuilder;

class Database {
	private $mysqli;
	private $columns;
	private $table;
	private $builder;
	private $doesExist = false;
	public function __construct() {
		$this->mysqli = new DatabaseConfig ();
		
		$this->builder = new QueryBuilder ();
	}
	private function fetchAll() {
		$q = $this->builder->select ()->getTable ( $this->table )->query;
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
		$q = $this->builder->select ()->getTable ( $this->table )->where ( 'id', '=', $id [0] )->query;
		
		$result = $this->result ( $q );
		
		$row = mysqli_fetch_assoc ( $result );
		foreach ( $row as $col => $data ) {
			$this->$col = $data;
		}
		$this->doesExist = true;
		return $row;
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
				$q = $this->builder->update ( $this->table, $col )->where ( 'id', '=', $this->columns ['id'] )->query;
				$this->result ( $q );
			}
		}
	}
	public function __call($method, $arguments) {
		$this->columns = get_object_vars ( $this );
		$this->table = explode ( '\\', get_class ( $this ) );
		$this->table = $this->table [count ( $this->table ) - 1];
		// unset($this->columns['connection']);
		unset ( $this->columns ['columns'] );
		unset ( $this->columns ['table'] );
		unset ( $this->columns ['mysqli'] );
		unset ( $this->columns ['builder'] );
		unset ( $this->columns ['doesExist'] );
		
		return $this->$method ( $arguments );
	}
	private function result($query) {
		return mysqli_query ( $this->mysqli->connection, $query );
	}
}