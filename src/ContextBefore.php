<?php

namespace apitest;

class ContextBefore {
	public $name;

	public function __construct($value) {
		$this->name = $value;
	}
}