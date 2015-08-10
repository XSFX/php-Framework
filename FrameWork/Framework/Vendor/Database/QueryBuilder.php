<?php

namespace Framework\Vendor\Database;

class QueryBuilder {
	private $commands = array ();
	private $operants = array ();
	private $variables = array ();
	public $query;
	
	public function __construct() {
		
	}
	public function where($column, $operator, $term) {
		$query = ' WHERE ' .$column.' '. $operator.' '.$term;
		$this->query .= $query;
		return $this;
	}
	public function orWhere($column, $operator, $term) {
		$query = ' OR '.$column.' '. $operator.' '.$term;
		$this->query .= $query;
		return $this;
	}
	public function andWhere($column, $operator, $term) {
		$query = ' AND '.$column.' '. $operator.' '.$term;
		$this->query .= $query;
		return $this;
	}
	public function getTable($table) {
		$query = ' FROM ' . $table;
		$this->query .= $query;
		return $this;
	}
	public function select($column = '*') {
		$query = ' SELECT ' . $column;
		$this->query .= $query;
		return $this;
	}
	public function orderBy($column, $order) {
		if (strtoupper ( trim ( $order ) ) !== 'ASC' || strtoupper ( trim ( $order ) ) !== 'DESC') {
			return;
		}
		$query = ' ORDER BY ' . $column . ' ' . $order . ' ';
		$this->query .= $query;
		return $this;
	}
	public function groupBy($column) {
		$query = ' GROUP BY ' . $column;
		$this->query .= $query;
		return $this;
	}
	public function limitBy($number, $offset = null) {
		$query = ' LIMIT ' . $number;
		if ($offset !== null) {
			$query .= ', ' . $offset;
		}
		$this->query .= $query;
		return $this;
	}
	public function update($table, $params = array()) {
		$query = ' UPDATE ' . $table . ' SET ';
		$i = 0;
		foreach ( $params as $col => $var ) {
			if(is_string($var)){
				$var = '"'.$var.'"';
			}
			if ($i != 0) {
				$query .= ', ';
			}
			$query .= ' ' . $col . ' = ' . $var . ' ';
			$i++;
		}
		$this->query = $query;
		return $this;
	}
	public function insert($table, $params = array()) {
		$query = ' INSERT INTO ' . $table . ' SET ';
		$i = 0;
		
		foreach ( $params as $col => $var ) {
			if(is_string($var)){
				$var = '"'.$var.'"';
			}
			if ($i != 0) {
				$query .= ', ';
			}
			
			$query .= ' ' . $col . ' = ' . $var . ' ';
			$i++;
		}
		$this->query = $query;
		return $this;
	}
}