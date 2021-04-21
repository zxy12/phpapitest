<?php

require __DIR__  . "/vendor/autoload.php";

use apitest\Run;
use apitest\MysqlAction;
use apitest\HttpAction;
use apitest\DBConfig;
use apitest\DBSql;
use apitest\ContextBefore;
use apitest\assert\MysqlAssertionCol;

$dbConfig = [
    'database_type' => 'mysql',
    'database_name' => 'dbname',
    'server' => 'host:port',
    'username' => 'dbuser',
    'password' => 'dbpass'
];

class PackageInfoAction extends MysqlAction{}
class PackageInfoAction2 extends MysqlAction{}

$db = new DBConfig($dbConfig);

$ac = array(
    new PackageInfoAction($db, array('table1', ['id'], ['id'=>1000166]), new MysqlAssertionCol(array("id" => 1000166))),
    new PackageInfoAction2($db, array('table1', ['id'], ['id'=> new ContextBefore('id')]), new MysqlAssertionCol(array("id" => 1000166))),
);

new Run($ac);
