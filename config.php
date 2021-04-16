<?php

//change to your absolute path
require '/vagrant/blend/src/blend.php';

define('APP_PATH', adjusthPath(dirname(__FILE__)));

\DataHandle\Config::set('use-module', true);

new \Db\ConnInfo('default', \Db\ConnInfo::TYPE_MYSQL, 'localhost', 'gps', 'root', '');
