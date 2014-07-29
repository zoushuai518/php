<?php

//error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
error_reporting(E_ALL);

if (!defined('APPLICATION_PATH')) define('APPLICATION_PATH', __DIR__);
if (!defined('LOG4PHP_DIR')) define('LOG4PHP_DIR', APPLICATION_PATH . '/apache-log4php-2.3.0/src/main/php');

// Insert the path where you unpacked log4php
require_once(LOG4PHP_DIR . '/Logger.php');

// Tell log4php to use our configuration file.
Logger::configure('log4php_simple.xml');
//$logger = Logger::getRootLogger();

$log = Logger::getLogger('myLogger');
 
// Start logging
$log->trace("My first message.");   // Not logged because TRACE < WARN
$log->debug("My second message.");  // Not logged because DEBUG < WARN
$log->info("My third message.");    // Not logged because INFO < WARN
$log->warn("My fourth message.");   // Logged because WARN >= WARN
$log->error("My fifth message.");   // Logged because ERROR >= WARN
$log->fatal("My sixth message.");   // Logged because FATAL >= WARN

