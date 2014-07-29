<?php

//error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
error_reporting(E_ALL);

if (!defined('APPLICATION_PATH')) define('APPLICATION_PATH', __DIR__);
if (!defined('LOG4PHP_DIR')) define('LOG4PHP_DIR', APPLICATION_PATH . '/apache-log4php-2.3.0/src/main/php');

require_once(LOG4PHP_DIR . '/Logger.php');

Logger::configure('log4php_advanced.xml');
//$logger = Logger::getRootLogger();

$logger_debug = Logger::getLogger('php-debug');
$logger_debug ->debug("测试LOG4PHP debug");

//$logger_info = Logger::getLogger('info');
//$logger_info ->info("测试LOG4PHP info");

//$logger ->warn("测试LOG4PHP warn");
//$logger ->error("测试LOG4PHP error");
//$logger ->fatal("测试LOG4PHP fatal");

