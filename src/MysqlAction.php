<?php

namespace apitest;

abstract class MysqlAction implements IAction {

	protected $db;

	protected $query;

	protected $assertion;

	public function __construct($mysqlQuery, $assertion) {
		$this->db = $mysqlQuery->db;
		$this->query = $mysqlQuery->query;
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
		//var_dump($this->db);
		$c->setCurrent(array(
			"name" => get_called_class(),
			"query" => $this->query,
			"result" => $rs,
		));
	}

	public function write($c) {
	}

	public function assert($c) {
		if (!$this->assertion) {
			return;
		}
		if (is_array($this->assertion)) {
			foreach ($this->assertion as $ast) {
				$rs = $ast->assert($c);
				$c->setCurrent(array('assert' => $ast->config));
				if (!$rs) {
					assert(false, "assert mysql fail, current " . print_r($c->current, 1));
					exit;
				}
				$c->setAssert($ast->config);
			}
		} else {
			$rs = $this->assertion->assert($c);
			$c->setCurrent(array('assert' => $this->assertion->config));
			if (!$rs) {
				assert(false, "assert mysql fail, current " . print_r($c->current, 1));
				exit;
			}
			$c->setAssert($this->assertion->config);
		}
		echo get_called_class() .  " success..." . PHP_EOL;
	}

}