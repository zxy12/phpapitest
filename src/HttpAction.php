<?php

namespace apitest;

class HttpAction implements IAction {

	private $config;


	public function __construct($config) {
		$this->config = $config;
	}
	
	public function init($c) {
		var_dump($c, 'http-init');
	}

	public function read($c) {
		var_dump($c, 'http-read');
	}

	public function write($c) {
		var_dump($c, 'http-write');
	}

	public function assert($c) {
		var_dump($c, 'http-assert');
	}
}