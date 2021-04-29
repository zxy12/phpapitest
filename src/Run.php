<?php

namespace apitest;

class Run {
	
	public $context = array();
	private $actions = array();
	public $current = array();

	public function __construct($actions) {
		$this->actions = $actions;
		foreach ($this->actions as $act) {
			$this->before();

			$act->init($this);
			$act->write($this);
			$act->read($this);
			$act->assert($this);

			$this->after();
		}
	}


	public function before() {
		if (!empty($this->current)) {
			$this->context[] = $this->current;
		}
		$this->current = array();
	}

	public function after() {

	}

	public function setCurrent($arr) {
		$this->current = array_merge($arr, $this->current);
	}

	public function setNextData($arr) {
		if (!is_array($arr)) {
			return;
		}
		if (empty($this->current['c'])) {
			$this->current['c'] = array();
		}
		$this->current['c'] = array_merge($this->current['c'], $arr);
	}

	public function getBefore($key) {
		if (($c = count($this->context)) > 0) {
			return $this->context[$c - 1]['c'][$key];
		}
		return null;
	}
}

