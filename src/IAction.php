<?php

namespace apitest;

interface IAction {
	public function init($c);
	public function read($c);
	public function write($c);
	public function assert($c);
}

