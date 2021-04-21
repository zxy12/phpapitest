<?php

namespace apitest;

class MysqlAction implements IAction {

	private $db;

	private $query;

	private $assertion;

	public function __construct($db, $query, $assertion) {
		$this->db = $db;
		$this->query = $query;
		$this->assertion = $assertion;
	}

	public function init($c) {
		$c->setCurrent(array(
			"name" => get_called_class(),
		));
	}

	public function read($c) {
		$cs = $this->query[2];
		foreach ($cs as $key => $val) {
			if ($val instanceof ContextBefore) {
				$cs[$key] = $c->getBefore($val->name);
			}
		}
		$this->query[2] = $cs;
		$rs = call_user_func_array(array($this->db, 'select'), $this->query);
		$c->setCurrent(array(
			"name" => get_called_class(),
			"query" => $this->query,
			"result" => $rs,
		));
	}

	public function write($c) {
	}

	public function assert($c) {
		$rs = $this->assertion->assert($c->current["result"]);
		$c->setCurrent(array('assert' => $this->assertion->config));
		if (!$rs) {
			assert(false, "assert mysql fail, current " . print_r($c->current, 1));
			exit;
		}
		$c->setCurrent(array('package_id' => $rs['package_id']));
		echo "assert success..." . PHP_EOL;
	}

}