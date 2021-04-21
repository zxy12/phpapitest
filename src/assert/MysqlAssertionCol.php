<?php

namespace apitest\assert;

class MysqlAssertionCol {
	public $config = array();
	public function __construct($config) {
		$this->config = $config;
	}

	public function assert($result) {
		if (!is_array($result) || count($result) != 1) {
			return false;
		}

		$result = $result[0];

		foreach ($this->config as $key => $val) {
			if ($result[$key] != $val) {
				return false;
			}
		}
		return $result;
	}
}