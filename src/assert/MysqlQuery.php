<?php

namespace apitest;

class MysqlQuery {
	public $db;
	public $query;

	public function __construct($db, $query) {
		$this->db = $db;
		$this->query = $query;
	}
}