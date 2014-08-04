<?php

error_reporting(E_ALL);

if (!defined('APPLICATION_PATH')) define('APPLICATION_PATH', __DIR__);
if (!defined('LOG4PHP_DIR')) define('LOG4PHP_DIR', APPLICATION_PATH . '/apache-log4php-2.3.0/src/main/php');

// Insert the path where you unpacked log4php
require_once(LOG4PHP_DIR . '/Logger.php');

// Tell log4php to use our configuration file.
Logger::configure('log4php_b5m_demo.xml');
//$logger = Logger::getRootLogger();

$log = Logger::getLogger('pro_data');
$log ->info('pro_data');

$log = Logger::getLogger('post_order_params');
$log ->info('post_order_params');

$log = Logger::getLogger('order_data');
$log ->info('order_data');
?>
