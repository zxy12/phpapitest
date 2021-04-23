<?php

namespace apitest;

class HttpRequest {

	const URL = 'url';
	const METHOD = 'method';
	const QUERY = 'query';
	const DATA = 'data';
	const RAWDATA = 'rawdata';
	const HEADER = 'header';
	const COOKIE = 'cookie';

	public $url;
	public $method;
	public $query;
	public $data;
	public $rawdata;
	public $header;
	public $cookie;

	public function __construct($c) {
		if (!is_array($c)) {
			return;
		}
		foreach ($c as $key => $val) {
			if (property_exists($this, $key)) {
				$this->$key = $val;
			}
		}
	}
}