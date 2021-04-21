<?php

namespace apitest;

class DBSql {
	public $sql = '';

	public $args = array();

	public function __construct($sql, $args) {
		$this->sql = $sql;
		$this->args = $args;
	}

	public function parse($c) {
		if (!$this->$args) {
			return $this->sql;
		}
		return "todo";
	}
}