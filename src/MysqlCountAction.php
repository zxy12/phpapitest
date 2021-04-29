<?php

namespace apitest;

abstract class MysqlCountAction extends MysqlAction {


	public function read($c) {
		$cs = $this->query[1];
		foreach ($cs as $key => $val) {
			if ($val instanceof ContextBefore) {
				$cs[$key] = $c->getBefore($val->name);
			}
		}
		$this->query[1] = $cs;
		$rs = call_user_func_array(array($this->db, 'count'), $this->query);
		$c->setCurrent(array(
			"name" => get_called_class(),
			"query" => $this->query,
			"result" => array(array('count' => $rs)),
		));
	}

}