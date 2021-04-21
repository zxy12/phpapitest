<?php

namespace apitest;

// assert_options(ASSERT_ACTIVE, 1);
// assert_options(ASSERT_WARNING, 0);
//assert_options(ASSERT_QUIET_EVAL, 1);

// Create a handler function
function my_assert_handler($file, $line, $code)
{
    echo "<hr>Assertion Failed:File '$file'<br />Line '$line'<br />Code '$code'<br /><hr />";
    exit;
}
//assert_options(ASSERT_CALLBACK, 'my_assert_handler');

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

	public function getBefore($key) {
		if (($c = count($this->context)) > 0) {
			return $this->context[$c - 1][$key];
		}
		return null;
	}
}

