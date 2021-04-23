<?php

namespace apitest;

abstract class HttpAction implements IAction {

	private $request;

	private $snoopy;

	private $assertion;



	public function __construct($request, $assertion) {
		$this->request = $request;
		$this->snoopy = new Snoopy;
		$this->assertion = $assertion;
	}
	
	public function init($c) {
		$c->setCurrent(array(
			"name" => get_called_class(),
			"request" => $this->request,
		));
	}

	public function read($c) {
	}

	public function write($c) {
		if (strtolower($this->request->method) == "post") {
			if ($this->request->rawdata) {
				$this->snoopy->set_submit_json();
			}
			$url = $this->request->url;
			if ($this->request->query) {
				$url = $url . "?" . $this->request->query;
			}
			$r = $this->snoopy->submit($url, $this->request->data);
			$c->setCurrent(array(
				"response" => $this->snoopy->results,
			));
       		$this->getResponse($c);
		}
	}

	public function assert($c) {
		if (!$this->assertion) {
			return;
		}
		$c->setCurrent(array('assert' => $this->assertion->config));
		$rs = $this->assertion->assert($c);
		if (!$rs) {
			assert(false, "assert http fail, current " . print_r($c->current, 1));
			exit;
		}
		echo get_called_class() .  " success..." . PHP_EOL;
	}

    abstract public function getResponse($c);
}
