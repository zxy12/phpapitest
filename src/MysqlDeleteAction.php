<?php

namespace apitest;

class MysqlDeleteAction extends MysqlAction {


	public function read($c) {
	}

	public function write($c) {
		$rs = call_user_func_array(array($this->db, 'delete'), $this->query);
		echo $this->query[0] . " deleted...\n";
	}
}