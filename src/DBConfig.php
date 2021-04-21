<?php

namespace apitest;
use Medoo\Medoo;

// Initialize


class DBConfig {
	private $db = null;
	public function __construct($config) {
		$this->db = new Medoo($config);
	}

	public function __call($name, $args) {
		return call_user_func_array(array($this->db, $name), $args);
	}
}