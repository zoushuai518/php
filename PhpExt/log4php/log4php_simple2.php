<?php

//error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
error_reporting(E_ALL);

if (!defined('APPLICATION_PATH')) define('APPLICATION_PATH', __DIR__);
if (!defined('LOG4PHP_DIR')) define('LOG4PHP_DIR', APPLICATION_PATH . '/apache-log4php-2.3.0/src/main/php');

// Insert the path where you unpacked log4php
require_once(LOG4PHP_DIR . '/Logger.php');

// Tell log4php to use our configuration file.
Logger::configure('log4php_simple2.xml');

 
/**
	 * This is a classic usage pattern: one logger object per class.
	  */
class Foo
{
	/** Holds the Logger. */
	private $log;

	/** Logger is instantiated in the constructor. */
	public function __construct()
	{
		// The __CLASS__ constant holds the class name, in our case "Foo".
		// Therefore this creates a logger named "Foo" (which we configured in the config file)
		$this->log = Logger::getLogger(__CLASS__);
	}

	/** Logger can be used from any member method. */
	public function go()
	{
		$this->log->info("We have liftoff.");
	}
}
 
$foo = new Foo();
$foo->go();
