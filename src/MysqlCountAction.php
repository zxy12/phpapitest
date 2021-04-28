<?php

namespace apitest;

abstract class MysqlCountAction extends MysqlAction {


	public function read($c) {
		$cs = $this->query[3];
		foreach ($cs as $key => $val) {
			if ($val instanceof ContextBefore) {
				$cs[$key] = $c->getBefore($val->name);
			}
		}
		$this->query[3] = $cs;
		$rs = call_user_func_array(array($this->db, 'count'), $this->query);
		//var_dump($this->db);
		$c->setCurrent(array(
			"name" => get_called_class(),
			"query" => $this->query,
			"result" => array(array('count' => $rs)),
		));
	}

}