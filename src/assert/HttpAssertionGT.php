<?php

namespace apitest\assert;

use apitest\ContextBefore;

class HttpAssertionGT {
	public $config = array();
	public function __construct($config) {
		$this->config = $config;
	}

	public function assert($c) {
		$result = $c->current['result'];
		if (empty($result) || !is_array($result)) {
			return false;
		}


		foreach ($this->config as $key => $val) {

			if ($val instanceof ContextBefore) {
				$val = $c->getBefore($val->name);
			}
			if ($result[$key] < $val) {
				return false;
			}
		}
		return $result;
	}
}