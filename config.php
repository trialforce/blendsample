<?php

//change to your absolute path
require '/var/www/html/blend/src/blend.php';
define('APP_PATH', adjusthPath(dirname(__FILE__)));
\DataHandle\Config::set('serverUrl', 'http://localhost:8080/sample/');
new \Db\ConnInfo('default', \Db\ConnInfo::TYPE_MYSQL, 'localhost', 'sample', 'root', '');
