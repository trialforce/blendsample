<?php

session_name("sistema");
date_default_timezone_set("America/Sao_Paulo");
mb_internal_encoding("UTF-8");
header('Content-Type: text/html; charset=utf-8');
ini_set('default_socket_timeout', '30');
ini_set("display_errors", "1");
ini_set("log_errors", "1");
ini_set("error_log", getcwd() . '/error.log');
ini_set('memory_limit', '1024M');

try
{
    require 'config.php';
    \DataHandle\Config::set('theme', 'Sample');
    \DataHandle\Config::set('defaultPage', \DataHandle\Session::get('user') ? 'page\home\main' : '');
    require 'sample.php';

    $app = new App();
    $app->handle();
}
catch (\Exception $e)
{
    \Log::exception($e);

    if (\DataHandle\Server::getInstance()->isAjax())
    {
        toast($e->getMessage(), 'danger');
        echo App::prepareResponse();
    }
    else
    {
        echo 'Error: ' . $e->getMessage() . ' file: ' . $e->getFile() . ' line: ' . $e->getLine();
    }
}